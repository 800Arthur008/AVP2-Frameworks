<?php

namespace Tests\Feature;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware(VerifyCsrfToken::class);
    }

    public function test_non_admin_cannot_access_admin_panel(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin');

        $response->assertForbidden();
    }

    public function test_admin_can_view_admin_panel(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertOk()
            ->assertInertia(fn ($page) => $page->component('Admin/Panel'));
    }

    public function test_admin_can_create_category(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)
            ->withSession(['_token' => 'test-token'])
            ->post('/admin/categories', [
                '_token' => 'test-token',
            'name' => 'Ciência',
            'icon' => '🔬',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('categories', [
            'name' => 'Ciência',
            'icon' => '🔬',
        ]);
    }

    public function test_admin_can_create_questions(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $category = Category::create(['name' => 'Teste', 'icon' => '🧪']);

        $response = $this->actingAs($admin)
            ->withSession(['_token' => 'test-token'])
            ->post('/admin/questions', [
                '_token' => 'test-token',
            'category_id' => $category->id,
            'question' => 'Qual a capital da França?',
            'options' => ['Paris', 'Londres', 'Berlim', 'Roma'],
            'correct_option' => 0,
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('questions', [
            'category_id' => $category->id,
            'question' => 'Qual a capital da França?',
        ]);
    }
}

