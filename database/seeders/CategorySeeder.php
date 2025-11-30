<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Criar categorias
        $categories = [
            ['name' => 'História', 'icon' => '📚'],
            ['name' => 'Jogos', 'icon' => '🎮'],
            ['name' => 'Filmes', 'icon' => '🎬'],
            ['name' => 'Geografia', 'icon' => '🌎'],
            ['name' => 'Computação', 'icon' => '💻'],
            ['name' => 'Programação', 'icon' => '⌨️'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Perguntas de História
        Question::create([
            'category_id' => 1,
            'question' => 'Quem foi o primeiro imperador de Roma?',
            'options' => ['Júlio César', 'Nero', 'Augusto', 'Trajano'],
            'correct_option' => 2
        ]);

        Question::create([
            'category_id' => 1,
            'question' => 'Qual evento marcou o início da Segunda Guerra Mundial?',
            'options' => ['Ataque a Pearl Harbor', 'Invasão da Polônia', 'Queda da Bolsa de 1929', 'Batalha de Stalingrado'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 1,
            'question' => 'Quem descobriu o Brasil em 1500?',
            'options' => ['Cristóvão Colombo', 'Bartolomeu Dias', 'Pedro Álvares Cabral', 'Vasco da Gama'],
            'correct_option' => 2
        ]);

        Question::create([
            'category_id' => 1,
            'question' => 'A Revolução Francesa começou em que ano?',
            'options' => ['1492', '1789', '1815', '1914'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 1,
            'question' => 'Que civilização construiu as pirâmides de Gizé?',
            'options' => ['Fenícios', 'Egípcios', 'Sumérios', 'Babilônios'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 1,
            'question' => 'Quem foi o líder responsável pela unificação da Alemanha no século XIX?',
            'options' => ['Bismarck', 'Napoleão', 'Churchill', 'Lênin'],
            'correct_option' => 0
        ]);

        Question::create([
            'category_id' => 1,
            'question' => 'Qual país lançou a primeira bomba atômica?',
            'options' => ['Alemanha', 'Japão', 'EUA', 'URSS'],
            'correct_option' => 2
        ]);

        Question::create([
            'category_id' => 1,
            'question' => 'O que foi a Guerra Fria?',
            'options' => [
                'Conflito direto entre EUA e URSS',
                'Conflito político e ideológico sem combate direto',
                'Invasão da Coreia do Sul pela Coreia do Norte',
                'Guerra civil na União Soviética',
            ],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 1,
            'question' => 'Quem pintou a Mona Lisa?',
            'options' => ['Michelangelo', 'Da Vinci', 'Rafael', 'Botticelli'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 1,
            'question' => 'A Idade Média terminou aproximadamente com qual evento?',
            'options' => [
                'Revolução Russa',
                'Revolução Industrial',
                'Queda de Constantinopla',
                'Independência dos EUA',
            ],
            'correct_option' => 2
        ]);

        // Perguntas de Jogos
        Question::create([
            'category_id' => 2,
            'question' => 'Em qual jogo aparece o personagem Master Chief?',
            'options' => ['Halo', 'Doom', 'Crysis', 'Destiny'],
            'correct_option' => 0
        ]);

        Question::create([
            'category_id' => 2,
            'question' => 'Qual empresa criou o PlayStation?',
            'options' => ['Nintendo', 'Sega', 'Microsoft', 'Sony'],
            'correct_option' => 3
        ]);

        Question::create([
            'category_id' => 2,
            'question' => 'Qual jogo popular tem a frase "The cake is a lie"?',
            'options' => ['Half-Life', 'Portal', 'Bioshock', 'Fallout'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 2,
            'question' => 'Qual é o gênero principal de "The Witcher 3"?',
            'options' => ['Corrida', 'Aventura', 'RPG', 'FPS'],
            'correct_option' => 2
        ]);

        Question::create([
            'category_id' => 2,
            'question' => 'Mario é mascote de qual empresa?',
            'options' => ['Sega', 'Capcom', 'Nintendo', 'Ubisoft'],
            'correct_option' => 2
        ]);

        Question::create([
            'category_id' => 2,
            'question' => 'Qual empresa criou a franquia The Legend of Zelda?',
            'options' => ['Nintendo', 'Sony', 'Ubisoft', 'EA'],
            'correct_option' => 0
        ]);

        Question::create([
            'category_id' => 2,
            'question' => 'No jogo Minecraft, qual é o nome do chefe final padrão?',
            'options' => ['Ender Dragon', 'Wither', 'Slime King', 'Creeper'],
            'correct_option' => 0
        ]);

        Question::create([
            'category_id' => 2,
            'question' => 'Qual desses jogos é um Battle Royale?',
            'options' => ['Overwatch', 'Fortnite', 'The Witcher 3', 'Hollow Knight'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 2,
            'question' => 'Qual é o nome do protagonista de God of War?',
            'options' => ['Dante', 'Kratos', 'Leon', 'Marcus'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 2,
            'question' => 'Em GTA V, qual desses NÃO é um dos protagonistas principais?',
            'options' => ['Michael', 'Franklin', 'Trevor', 'Carl Johnson'],
            'correct_option' => 3
        ]);

        // Perguntas de Filmes
        Question::create([
            'category_id' => 3,
            'question' => 'Quem dirigiu o filme "Jurassic Park"?',
            'options' => ['James Cameron', 'George Lucas', 'Steven Spielberg', 'Ridley Scott'],
            'correct_option' => 2
        ]);

        Question::create([
            'category_id' => 3,
            'question' => 'Qual filme tem o personagem Darth Vader?',
            'options' => ['Star Wars', 'Star Trek', 'Duna', 'Avatar'],
            'correct_option' => 0
        ]);

        Question::create([
            'category_id' => 3,
            'question' => 'Em qual filme aparece o personagem "Coringa" interpretado por Heath Ledger?',
            'options' => ['Joker', 'Batman Begins', 'O Cavaleiro das Trevas', 'Esquadrão Suicida'],
            'correct_option' => 2
        ]);

        Question::create([
            'category_id' => 3,
            'question' => 'Qual filme venceu o Oscar de Melhor Filme em 1997?',
            'options' => ['Titanic', 'Forrest Gump', 'Gladiador', 'Matrix'],
            'correct_option' => 0
        ]);

        Question::create([
            'category_id' => 3,
            'question' => '"Buzz Lightyear" é personagem de qual franquia?',
            'options' => ['Minions', 'Toy Story', 'Shrek', 'Carros'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 3,
            'question' => 'Qual personagem é conhecido pela frase “Eu sou o seu pai”?',
            'options' => ['Gollum', 'Darth Vader', 'Voldemort', 'Neo'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 3,
            'question' => 'Qual ator interpreta Tony Stark no MCU?',
            'options' => ['Chris Evans', 'Robert Downey Jr.', 'Tom Holland', 'Chris Pratt'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 3,
            'question' => 'O filme “Matrix” foi lançado em:',
            'options' => ['1999', '2001', '1995', '2003'],
            'correct_option' => 0
        ]);

        Question::create([
            'category_id' => 3,
            'question' => 'Qual desses filmes é de animação?',
            'options' => ['Gladiador', 'Spirit', 'O Resgate do Soldado Ryan', 'Titanic'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 3,
            'question' => '“Elsa” é personagem de qual animação?',
            'options' => ['Moana', 'Valente', 'Frozen', 'Encanto'],
            'correct_option' => 2
        ]);

        // Perguntas de Geografia
        Question::create([
            'category_id' => 4,
            'question' => 'Qual é o maior oceano do mundo?',
            'options' => ['Atlântico', 'Índico', 'Pacífico', 'Ártico'],
            'correct_option' => 2
        ]);

        Question::create([
            'category_id' => 4,
            'question' => 'Qual é a capital do Canadá?',
            'options' => ['Vancouver', 'Toronto', 'Montreal', 'Ottawa'],
            'correct_option' => 3
        ]);

        Question::create([
            'category_id' => 4,
            'question' => 'O Monte Everest fica em qual continente?',
            'options' => ['América', 'Europa', 'Ásia', 'África'],
            'correct_option' => 2
        ]);

        Question::create([
            'category_id' => 4,
            'question' => 'Qual é o rio mais extenso do mundo?',
            'options' => ['Mississippi', 'Nilo', 'Yangtzé', 'Amazonas'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 4,
            'question' => 'Qual país possui a maior população do mundo?',
            'options' => ['China', 'Índia', 'EUA', 'Indonésia'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 4,
            'question' => 'Qual é o país mais extenso do mundo?',
            'options' => ['Canadá', 'Rússia', 'China', 'Brasil'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 4,
            'question' => 'Em qual continente está Madagascar?',
            'options' => ['Ásia', 'América do Sul', 'África', 'Oceania'],
            'correct_option' => 2
        ]);

        Question::create([
            'category_id' => 4,
            'question' => 'Qual desses países NÃO faz fronteira com o Brasil?',
            'options' => ['Colômbia', 'Chile', 'Bolívia', 'Peru'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 4,
            'question' => 'Qual é o menor país do mundo?',
            'options' => ['Mônaco', 'Vaticano', 'San Marino', 'Liechtenstein'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 4,
            'question' => 'O deserto do Saara está localizado em qual continente?',
            'options' => ['Europa', 'América', 'África', 'Ásia'],
            'correct_option' => 2
        ]);

        // Perguntas de Computação
        Question::create([
            'category_id' => 5,
            'question' => 'O que é RAM?',
            'options' => ['Memória permanente', 'Memória volátil de acesso rápido', 'Processador gráfico', 'Tipo de disco rígido'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 5,
            'question' => 'Qual desses é um sistema operacional?',
            'options' => ['Chrome', 'Windows', 'Bluetooth', 'HDMI'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 5,
            'question' => 'O que significa "IP" em redes?',
            'options' => ['Internal Program', 'Internet Protocol', 'Input Process', 'Integrated Port'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 5,
            'question' => 'Qual porta é usada por padrão pelo HTTP?',
            'options' => ['22', '43', '80', '8080'],
            'correct_option' => 2
        ]);

        Question::create([
            'category_id' => 5,
            'question' => 'Qual empresa criou o processador M1?',
            'options' => ['AMD', 'Intel', 'Qualcomm', 'Apple'],
            'correct_option' => 3
        ]);

        Question::create([
            'category_id' => 5,
            'question' => 'Qual desses é um protocolo seguro de transferência de arquivos?',
            'options' => ['FTP', 'HTTP', 'SFTP', 'Telnet'],
            'correct_option' => 2
        ]);

        Question::create([
            'category_id' => 5,
            'question' => 'Qual componente é responsável pelo processamento gráfico?',
            'options' => ['SSD', 'GPU', 'RAM', 'Fonte'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 5,
            'question' => 'Qual tipo de malware exige pagamento para liberar arquivos?',
            'options' => ['Vírus', 'Worm', 'Spyware', 'Ransomware'],
            'correct_option' => 3
        ]);

        Question::create([
            'category_id' => 5,
            'question' => 'Qual desses é um sistema operacional baseado em Linux?',
            'options' => ['macOS', 'Windows', 'Ubuntu', 'Chrome'],
            'correct_option' => 2
        ]);

        Question::create([
            'category_id' => 5,
            'question' => 'O que é um firewall?',
            'options' => [
                'Antivírus',
                'Sistema de controle de tráfego de rede',
                'Cabo de rede',
                'Malware de proteção',
            ],
            'correct_option' => 1
        ]);

        // Perguntas de Programação
        Question::create([
            'category_id' => 6,
            'question' => 'Qual é a linguagem usada para estruturar páginas da web?',
            'options' => ['CSS', 'HTML', 'Python', 'SQL'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 6,
            'question' => 'Em Python, qual símbolo é usado para comentários de linha única?',
            'options' => ['//', '<!-- -->', '#', '/* */'],
            'correct_option' => 2
        ]);

        Question::create([
            'category_id' => 6,
            'question' => 'Qual estrutura de dados funciona no modelo FIFO?',
            'options' => ['Pilha', 'Lista Encadeada', 'Árvore Binária', 'Fila'],
            'correct_option' => 3
        ]);

        Question::create([
            'category_id' => 6,
            'question' => 'O que significa "==" em linguagens como C e JavaScript?',
            'options' => ['Atribuição', 'Comparação de igualdade', 'Comparação de tipos', 'Operador lógico'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 6,
            'question' => 'No Git, qual comando envia mudanças para o repositório remoto?',
            'options' => ['git push', 'git add', 'git commit', 'git fetch'],
            'correct_option' => 0
        ]);

        Question::create([
            'category_id' => 6,
            'question' => 'Qual linguagem é amplamente usada para desenvolvimento de apps Android nativos?',
            'options' => ['Swift', 'Kotlin', 'PHP', 'Ruby'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 6,
            'question' => 'Qual desses é um banco de dados relacional?',
            'options' => ['MongoDB', 'Redis', 'PostgreSQL', 'Firebase'],
            'correct_option' => 2
        ]);

        Question::create([
            'category_id' => 6,
            'question' => 'O que significa "for" em programação?',
            'options' => ['Condicional', 'Loop de repetição', 'Declaração de variável', 'Função de retorno'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 6,
            'question' => 'Qual o resultado de 3 + "3" em JavaScript?',
            'options' => ['6', '33', 'Erro', '3'],
            'correct_option' => 1
        ]);

        Question::create([
            'category_id' => 6,
            'question' => 'Em C, qual especificador imprime um número inteiro?',
            'options' => ['%c', '%f', '%d', '%s'],
            'correct_option' => 2
        ]);
    }
}