🏫 Sistema Escolar — Autenticação, Controle de Acesso e Instalação Completa

Este documento combina o guia técnico de autenticação e controle de acesso com o passo a passo completo de instalação e estrutura do sistema.
O objetivo é que qualquer desenvolvedor ou avaliador consiga instalar, executar e compreender toda a lógica do Sistema Escolar em PHP.

📘 Descrição do Projeto

O Sistema Escolar é uma aplicação desenvolvida em PHP com autenticação segura, controle de sessões, proteção de páginas internas e perfis de usuário.
Ele implementa mensagens claras de erro/sucesso e organiza o código de forma modular, utilizando PDO, prepared statements e boas práticas de segurança.

A aplicação foi projetada para rodar localmente com XAMPP, utilizando o MySQL como banco de dados.

⚙️ Requisitos

PHP 7.4 ou superior

XAMPP (Apache e MySQL ativos)

PhpMyAdmin

Extensão PDO habilitada

Navegador moderno (Chrome, Firefox, Edge, etc.)

Editor de código (ex.: VS Code)

🗄️ Banco de Dados

Banco: escola

Sistema de gerenciamento: MySQL (via localhost/phpmyadmin)

Conexão via PDO com prepared statements para segurança.

Arquivo de referência: app/banco.sql (inclui criação da tabela e usuário de teste).

Estrutura mínima da tabela usuarios
Campo	Tipo	Comentário
id	INT (PK, AI)	Identificador único
tipo	ENUM	Admin, Professor, Aluno
nome	VARCHAR(255)	Nome completo
cpf	VARCHAR	CPF do usuário
matricula	VARCHAR	Matrícula institucional
email	VARCHAR	E-mail do usuário
nome_pai	VARCHAR	Nome do pai
nome_mae	VARCHAR	Nome da mãe
data_nascim	VARCHAR	Data de nascimento
senha_hash	VARCHAR	Senha hasheada (password_hash)

O arquivo banco.sql cria essa estrutura e insere um usuário de teste.

👤 Usuário de Teste
Matrícula	Senha	Perfil
231-000655	123456@abcdef	Admin

A senha foi criada com complexidade mínima exigida (letras, números e símbolo).

🧩 Estrutura do Projeto

Ao clonar o repositório, os arquivos estarão organizados da seguinte forma:

Projeto_teste2/
├──api/
│ ├── AuthController.php
│ ├── NotasController.php
│ ├── Response.php
│ ├── config.php
│ └── index.php
├── app/
│   └── banco.sql
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       ├── index_script.js
│       ├── cadastro_script.js
│       └── dashboard_admin_script.js
├── public/
│   ├── autentica.php
│   ├── conexao.php
│   ├── dashboard.php
│   ├── dashboard_aluno.php
│   ├── dashboard_professor.php
│   ├── cadastro_usuarios.php
│   ├── cadastro_sucesso.php
│   ├── processa_cadastro.php
│   ├── verifica_sessao.php
│   ├── sem_permissao.php
│   ├── logout.php
├── index.php
└── README.md

🧭 Instalação Passo a Passo
1️⃣ Clonar o Repositório

Abra o Git Bash ou terminal dentro da pasta do XAMPP (htdocs):

cd C:\xampp\htdocs
git clone https://github.com/seu-usuario/seu-repositorio.git Projeto_teste2


Substitua seu-usuario/seu-repositorio pela URL real do seu repositório GitHub.

2️⃣ Importar o Banco de Dados

Inicie Apache e MySQL pelo painel do XAMPP.

Acesse: http://localhost/phpmyadmin

Crie um banco chamado escola.

Vá em Importar → Selecione app/banco.sql → Executar.

3️⃣ Configurar Conexão

Abra public/conexao.php e confira os parâmetros:

<?php
$host = 'localhost';
$db   = 'escola';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>

4️⃣ Executar o Sistema

No navegador, acesse:

http://localhost/Projeto_teste2/index.php


Faça login com as credenciais de teste.

🧠 Estrutura e Funcionalidades dos Arquivos
🔹 index.php

Página inicial de login.

Campos de matrícula ou CPF e senha.

Exibe mensagens de erro/sucesso.

Inclui validações via index_script.js.

Contém botão visual “Esqueceu sua senha?” (não funcional ainda).

🔹 index_script.js

Validação de campos e feedbacks em tempo real.

Habilita botão “Entrar” apenas se os campos forem válidos.

Função para mostrar/ocultar senha.

🔹 autentica.php

Recebe dados via POST.

Sanitiza e valida.

Consulta banco com PDO e prepared statements.

Usa password_verify para autenticação segura.

Cria sessão e redireciona para o dashboard correspondente ao perfil.

Implementa contador de tentativas e bloqueio após 5 erros.

🔹 verifica_sessao.php

Protege páginas internas.

Verifica se $_SESSION['usuario'] existe.

Redireciona para index.php se a sessão estiver expirada.

Impede acesso de perfis não permitidos (sem_permissao.php).

🔹 dashboard.php

Dashboard do administrador.

Exibe mensagem de boas-vindas e botões de acesso.

Inclui verifica_sessao.php para segurança.

Usa dashboard_admin_script.js para validações.

🔹 dashboard_aluno.php / dashboard_professor.php

Versões simplificadas para alunos e professores.

Contêm estrutura básica com links de navegação e logout.

Serão expandidas em entregas futuras.

🔹 logout.php

Finaliza sessão com session_unset() e session_destroy().

Redireciona para index.php.

🔹 sem_permissao.php

Página exibida ao tentar acessar conteúdo não autorizado.

Mensagem clara e estilizada de “Acesso Negado”.

🔹 cadastro_usuarios.php / processa_cadastro.php

Permitem cadastrar novos usuários.

Armazenam senha com password_hash.

Exibem confirmação via cadastro_sucesso.php.

🔒 Segurança e Boas Práticas

Senha com hash: password_hash e password_verify.

Sessão segura: session_regenerate_id(true) após login.

SQL seguro: consultas com PDO e prepared statements.

Timeout de sessão: configurado em verifica_sessao.php (padrão: 10 minutos).

Tentativas limitadas de login: impede brute-force.

Mensagens de erro limpas: não revelam detalhes sensíveis.

Filtros de entrada e saída: sanitização e escaping.

🔁 Fluxo de Autenticação

Usuário acessa index.php e preenche credenciais.

autentica.php valida login e senha:

✅ Se válidos → cria sessão → redireciona ao dashboard correto.

❌ Se inválidos → exibe erro e soma tentativa.

verifica_sessao.php protege todas as páginas internas.

Acesso negado → sem_permissao.php.

Logout → logout.php limpa sessão e retorna ao login.

📋 Observações para Professores

Professores podem logar via matrícula ou CPF.

O sistema identifica automaticamente o perfil e redireciona.

Caso o perfil não tenha permissão → sem_permissao.php.

Perfis futuros (coordenador, secretaria, etc.) podem ser adicionados facilmente via ENUM.

🧩 Problemas Comuns & Soluções
Problema	Solução
Página em branco / erro 500	Habilite display_errors=On no php.ini
Banco não conecta	Verifique conexao.php, MySQL ativo e credenciais corretas
CSS não carrega	Confirme o caminho relativo assets/css/style.css
Sessão expira rápido	Ajuste $timeout em verifica_sessao.php
Login não funciona	Verifique hash no banco e campos matricula/senha
💡 Boas Práticas Extras

Mantenha banco.sql atualizado.

Adicione .gitignore para excluir arquivos sensíveis.

Crie backups periódicos do banco.

Documente novas funções diretamente no README ou Wiki do projeto.

🤝 Como Contribuir

Faça um fork do projeto.

Crie uma nova branch: git checkout -b feature/nova-funcionalidade.

Realize commits descritivos.

Envie um Pull Request com resumo das alterações.

📜 Licença

Projeto aberto para uso acadêmico e aprendizado.
Pode ser distribuído sob a licença MIT (recomendado).
Adicione o arquivo LICENSE se desejar formalizar.

📬 Contato e Suporte

Para dúvidas, suporte técnico ou aprimoramentos, entre em contato pelo repositório GitHub ou envie mensagem com o título:
"Suporte Sistema Escolar - Autenticação"

📖 Nota final: Este projeto está em fase inicial. As telas de alunos, professores e administradores são versões básicas que serão evoluídas em futuras entregas, conforme novos módulos forem implementados (relatórios, notas, permissões e cadastros avançados).

📡 Documentação da API (Auth, Notas, Response, Config, Roteamento)

A seguir está a documentação completa da API contida na pasta api/, adicionada sem alterar nenhuma parte anterior do README.

📁 Estrutura da API
api/
 ├── AuthController.php
 ├── NotasController.php
 ├── Response.php
 ├── config.php
 └── index.php

⚙️ 1. config.php — Configurações da API

Contém:

Credenciais de login fixas (exemplo: admin / 1234)

Configurações gerais

Array retornado para os controladores

Exemplo:

return [
    'auth' => [
        'username' => 'admin',
        'password' => '1234'
    ]
];

📤 2. Response.php — Padronização de Respostas

Classe responsável por enviar respostas JSON.

Métodos principais:
Método	Descrição
json($data, $status)	Envia JSON com código de status
success($msg, $data)	Resposta de sucesso
error($msg, $status)	Resposta de erro

Formato padrão:

{
  "success": true,
  "message": "Descrição",
  "data": { ... }
}

🔐 3. AuthController.php — Login

Endpoint para autenticação básica.

POST /auth/login
Corpo da requisição:
{
  "username": "admin",
  "password": "1234"
}

Resposta — Sucesso:
{
  "success": true,
  "message": "Autenticado com sucesso",
  "data": {
    "token": "token_fake_123"
  }
}

Resposta — Erro:
{
  "success": false,
  "message": "Credenciais inválidas"
}

📝 4. NotasController.php — Cálculo de Notas

Calcula média de 0 a 10 e retorna aprovado/reprovado.

POST /notas/calcular
Requisição:
{
  "nome": "Carlos",
  "matricula": "2024001",
  "nota1": 8,
  "nota2": 7
}

Regra:
média ≥ 6 → aprovado
média < 6 → reprovado

Resposta:
{
  "success": true,
  "message": "Cálculo realizado",
  "data": {
    "nome": "Carlos",
    "matricula": "2024001",
    "nota1": 8,
    "nota2": 7,
    "media": 7.5,
    "resultado": "Aprovado"
  }
}

🌐 5. index.php — Roteamento da API

O router identifica:

Método HTTP

Caminho solicitado

Controller

Método do controller

Rotas disponíveis:
Método	Endpoint	Controller → Método
POST	/auth/login	AuthController → login()
POST	/notas/calcular	NotasController → calcular()

Fluxo:

Lê URL

Lê JSON do php://input

Chama o controller correspondente

Retorna resposta JSON padronizada

📘 Exemplos de Uso da API
🔹 Login
POST http://localhost/api/auth/login

🔹 Calcular Notas
POST http://localhost/api/notas/calcular
