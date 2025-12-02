🏫 Sistema Escolar — Autenticação, Controle de Acesso e Instalação Completa

Este documento combina o guia técnico de autenticação e controle de acesso com o passo a passo completo de instalação e estrutura do sistema.
O objetivo é que qualquer desenvolvedor ou avaliador consiga instalar, executar e compreender toda a lógica do Sistema Escolar em PHP.

📘 Descrição do Projeto

O Sistema Escolar é uma aplicação desenvolvida em PHP com autenticação segura, controle de sessões, proteção de páginas internas e perfis de usuário.
Ele implementa mensagens claras de erro/sucesso e organiza o código de forma modular, utilizando PDO, prepared statements e boas práticas de segurança.

A aplicação foi projetada para rodar localmente com XAMPP, utilizando o MySQL como banco de dados.

Além do componente Web, o projeto inclui uma API REST segura, estruturada em controllers separados, permitindo que futuras aplicações (mobile, dashboards externos, integrações) consumam os dados diretamente.

⚙️ Requisitos

PHP 7.4 ou superior

XAMPP (Apache e MySQL ativos)

PhpMyAdmin

Extensão PDO habilitada

Navegador moderno

Editor de código (ex.: VS Code)

🗄️ Banco de Dados

Banco: escola

Sistema: MySQL via localhost/phpmyadmin

Conexão via PDO com prepared statements

Arquivo de referência: app/banco.sql

Estrutura mínima da tabela usuarios
| Campo       | Tipo         | Comentário                       |
| ----------- | ------------ | -------------------------------- |
| id          | INT (PK, AI) | Identificador único              |
| tipo        | ENUM         | Admin, Professor, Aluno          |
| nome        | VARCHAR(255) | Nome completo                    |
| cpf         | VARCHAR      | CPF do usuário                   |
| matricula   | VARCHAR      | Matrícula institucional          |
| email       | VARCHAR      | E-mail do usuário                |
| nome_pai    | VARCHAR      | Nome do pai                      |
| nome_mae    | VARCHAR      | Nome da mãe                      |
| data_nascim | VARCHAR      | Data de nascimento               |
| senha_hash  | VARCHAR      | Senha hasheada (`password_hash`) |

👤 Usuário de Teste
| Matrícula  | Senha         | Perfil |
| ---------- | ------------- | ------ |
| 231-000655 | 123456@abcdef | Admin  |

🧩 Estrutura do Projeto
Projeto_teste2/
├── app/
│   └── banco.sql
├── api/
│   ├── config.php
│   ├── index.php
│   ├── Response.php
│   ├── Auth.php
│   ├── AuthController.php
│   ├── AlunoController.php
│   └── NotasController.php
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
cd C:\xampp\htdocs
git clone https://github.com/seu-usuario/seu-repositorio.git Projeto_teste2

2️⃣ Importar o Banco

Abra XAMPP

Vá em phpMyAdmin

Crie a base escola

Importe app/banco.sql

3️⃣ Configurar Conexão

Arquivo public/conexao.php.

4️⃣ Executar o Sistema
http://localhost/Projeto_teste2/index.php

🧠 Estrutura e Funcionalidades dos Arquivos
🔹 index.php (Web)

Tela de login com validação e mensagens claras.

🔹 index_script.js

Valida campos, mostra/oculta senha e controla o botão de envio.

🔹 autentica.php

Valida credenciais

password_verify()

Cria sessão e redireciona conforme perfil

🔹 verifica_sessao.php

Protege páginas internas.

🔹 Dashboards

dashboard.php – Admin

dashboard_aluno.php

dashboard_professor.php

🔹 Logout

Finaliza sessão com segurança.

🌐 API REST — Documentação Oficial

A API foi criada para permitir integração com apps externos, dashboards e sistemas de terceiros.

🧱 Estrutura da API (/api/)

index.php – roteador

AuthController.php – login seguro

AlunoController.php – dados dos alunos

NotasController.php – notas e rendimento

Auth.php – gerencia sessão e usuário logado

Response.php – respostas JSON padronizadas

🔑 Rotas da API

🔹 GET /api/index.php?rota=alunos

Lista alunos.

🔹 GET /api/index.php?rota=alunos/{id}

Retorna dados do aluno + notas.

🔹 GET /api/index.php?rota=notas

Lista todas as notas cadastradas.

🔒 Segurança e Boas Práticas

A API e o sistema Web utilizam:

password_hash() e password_verify()

Sessão regenerada pós-login

SQL com prepared statements

Controle de sessão em todas as páginas internas

Proteção contra brute-force

Sanitização de entradas

Erros não revelam detalhes sensíveis

🔁 Fluxo de Autenticação (Web)

Usuário envia matrícula + senha

Validado com password_verify()

Sessão é criada e ID regenerado

Usuário é redirecionado para o dashboard do seu perfil

Sessão expira após período definido

Logout limpa sessão com segurança

🌐 Fluxo da Autenticação via API

Cliente (app / JS / serviço externo) envia JSON

API busca usuário pela matrícula

password_verify() compara senha enviada com hash

Se válido → retorna dados essenciais

Se inválido → retorna HTTP 401

Sessão é automaticamente vinculada ao request se necessário

📋 Observações para Professores

Podem logar via matrícula ou CPF

Apenas páginas específicas são liberadas

Tentativas incorretas são contabilizadas

Acesso negado redireciona para sem_permissao.php

🧩 Problemas Comuns & Soluções

(mantido como no original)

💡 Boas Práticas Extras

(mantido como no original)

🤝 Como Contribuir

(mantido como no original)

📜 Licença

(mantido como no original)

📬 Contato e Suporte

(mantido como no original)