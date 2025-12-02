🏫 Sistema Escolar — Autenticação, Controle de Acesso e Gestão de Notas

Este documento combina o guia técnico de autenticação e controle de acesso com o passo a passo completo de instalação e estrutura do sistema.
O objetivo é que qualquer desenvolvedor ou avaliador consiga instalar, executar e compreender toda a lógica do Sistema Escolar em PHP.

📘 Descrição do Projeto

O Sistema Escolar é uma aplicação desenvolvida em PHP com autenticação segura, controle de sessões, proteção de páginas internas e perfis de usuário. O sistema expandiu suas funcionalidades para incluir o Gerenciamento de Notas por parte de Administradores/Professores e a Visualização de Rendimento por parte dos Alunos.

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

Campo

Tipo

Comentário

id

INT (PK, AI)

Identificador único

tipo

ENUM

Admin, Professor, Aluno

nome

VARCHAR(255)

Nome completo

cpf

VARCHAR

CPF do usuário

matricula

VARCHAR

Matrícula institucional

email

VARCHAR

E-mail do usuário

nome_pai

VARCHAR

Nome do pai

nome_mae

VARCHAR

Nome da mãe

data_nascim

VARCHAR

Data de nascimento

senha_hash

VARCHAR

Senha hasheada (password_hash)

Estrutura da tabela notas (Para API e Aplicação Web)

Campo

Tipo

Comentário

id

INT (PK, AI)

Identificador único

aluno_id

INT (FK)

Chave estrangeira para usuarios.id

nota_final

DECIMAL(5,2)

Valor da nota (média final)

status

VARCHAR(50)

Situação (Ex: Aprovado, Reprovado)

data_registro

DATETIME

Data e hora do registro

O arquivo banco.sql cria essa estrutura e insere um usuário de teste.

👤 Usuário de Teste

Matrícula

Senha

Perfil

231-000655

123456@abcdef

Admin

A senha foi criada com complexidade mínima exigida (letras, números e símbolo).

🧩 Estrutura do Projeto

Ao clonar o repositório, os arquivos estarão organizados da seguinte forma:

Projeto_teste2/
├── app/
│   └── banco.sql
├── api/
│   ├── config.php        
│   ├── index.php         
│   ├── Auth.php          
│   ├── Response.php      
│   ├── AuthController.php
│   ├── AlunoController.php
│   └── NotasController.php 
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       ├── index_script.js
│       ├── cadastro_script.js
│       └── dashboard_admin_script.js
└── public/           # Componente de Aplicação Web Tradicional (Sessão)
   ├── autentica.php
   ├── conexao.php
   ├── dashboard.php
   ├── dashboard_aluno.php
   ├── dashboard_professor.php
   ├── cadastro_usuarios.php
   ├── cadastro_sucesso.php
   ├── processa_cadastro.php
   ├── verifica_sessao.php
   ├── sem_permissao.php
   ├── logout.php
   ├── listar_alunos.php
   ├── cadastrar_nota.php
   ├── processa_cadastrar_nota.php
   ├── editar_nota.php
   ├── processa_editar_nota.php
   ├── ver_notas_aluno.php
   └── notas_meu_rendimento.php









Atenção: A arquitetura atual utiliza o arquivo index.php na raiz do projeto como o ponto de entrada principal para o Componente API REST. A aplicação web tradicional é acessada via public/ (ex: http://localhost/Projeto_teste2/public/).

🧭 Instalação Passo a Passo

(Passos 1 a 3 omitidos por serem idênticos à versão anterior)

4️⃣ Executar o Sistema (Componente Web)

Para acessar a Aplicação Web Tradicional (Interface), inicie o sistema pelo caminho:

http://localhost/Projeto_teste2/public/


Você será redirecionado para a tela de login.

🧠 Estrutura e Funcionalidades dos Arquivos

🔹 index.php (Roteador Principal da API REST)

Ponto de entrada da API.

Define o cabeçalho Content-Type: application/json.

Inclui todos os arquivos de configuração e classes.

Faz o roteamento manual baseado no parâmetro $_GET['rota'] (Ex: index.php?rota=login).

Encaminha a requisição para o Controller e método apropriado.

🔹 Auth.php

Contém a lógica de verificação de sessão e extração de dados do usuário autenticado.

🔹 Response.php

Classe estática para padronizar as respostas da API em formato JSON (status, message, data).

🔹 AuthController.php

Implementa as rotas de login da API. Ainda possui a vulnerabilidade de não usar password_verify para autenticação.

🔹 AlunoController.php

Implementa as rotas para listar todos os alunos (/alunos) e buscar detalhes de um aluno específico (/alunos/{id}).

🔹 NotasController.php

Implementa a rota para listar todas as notas cadastradas no sistema (/notas).

🔹 Arquivos do Componente Web (public/)

Mantêm as funcionalidades de autenticação, proteção de rotas e controle de sessão descritas na documentação anterior.

🗺️ Rotas da Aplicação Web Tradicional (Componente /public/)

Caminho (/public/...)

Perfil de Acesso

Funcionalidade Principal

(Raiz)

Público

Tela de Login

dashboard.php

Administrador

Página principal, acesso a cadastro/listas

dashboard_aluno.php

Aluno

Página principal do aluno

dashboard_professor.php

Professor

Página principal do professor

listar_alunos.php

Admin / Professor

Lista de alunos e links de ação (notas)

cadastrar_nota.php

Admin / Professor

Formulário para registrar média final

ver_notas_aluno.php

Admin / Professor

Visualiza notas de um aluno específico

notas_meu_rendimento.php

Aluno

Visualiza o próprio histórico de notas

logout.php

Todos

Encerra a sessão

🗺️ Rotas da API REST (Acessíveis via index.php)

Rota (index.php?rota=...)

Método HTTP

Controller/Método

Descrição

login

POST

AuthController::login()

Autentica um usuário. Espera JSON com matricula e senha.

alunos

GET

AlunoController::listar()

Lista todos os alunos cadastrados no sistema.

notas

GET

NotasController::listar()

Lista todas as notas.

/alunos/{id}

(GET)

AlunoController::detalhes($id)

Busca detalhes de um aluno, incluindo suas notas. (Requer implementação de rota paramétrica no roteador index.php)

🔒 Segurança e Boas Práticas

🔴 ALERTA DE VULNERABILIDADE NA API REST (REFORÇO)

O arquivo AuthController.php da API REST não utiliza a função password_verify(), comparando a senha diretamente com a senha do banco, o que anula o uso do senha_hash.

Correção Urgente Necessária: O código deve ser alterado para buscar o usuário pela matrícula e, em seguida, usar o password_verify($senha_enviada, $senha_hash_do_banco) para validar.

⚠️ ALERTA DE INCONSISTÊNCIA NO COMPONENTE WEB

Os arquivos public/editar_nota.php e public/processa_editar_nota.php estão desatualizados e tentam manipular campos (disciplina, nota) que não existem na tabela notas (que usa nota_final e status). Eles devem ser corrigidos ou removidos.

💡 Boas Práticas Extras

Mantenha app/banco.sql atualizado.

Adicione .gitignore para excluir arquivos sensíveis.

Crie backups periódicos do banco.

Documente novas funções diretamente no README ou Wiki do projeto.

📜 Licença

Projeto aberto para uso acadêmico e aprendizado.
Pode ser distribuído sob a licença MIT (recomendado).
Adicione o arquivo LICENSE se desejar formalizar.

📬 Contato e Suporte

Para dúvidas, suporte técnico ou aprimoramentos, entre em contato pelo repositório GitHub ou envie mensagem com o título:
"Suporte Sistema Escolar - Gestão de Notas"> 📖 **Nota final:** Este projeto está em fase inicial. As telas de alunos, professores e administradores são versões básicas que serão evoluídas em futuras entregas, conforme novos módulos forem implementados (relatórios, notas, permissões e cadastros avançados).
