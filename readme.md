## 📘 Arquivo README.me do Sistema Escolar (Estrutura Completa)

Este documento combina o guia técnico de **autenticação e controle de acesso** com o passo a passo completo de **instalação e estrutura** do sistema. O objetivo é que qualquer desenvolvedor ou avaliador consiga instalar, executar e compreender toda a lógica do Sistema Escolar em PHP.

---

## 📝 Descrição do Projeto

O **Sistema Escolar** é uma aplicação desenvolvida em PHP com **autenticação segura**, controle de sessões, proteção de páginas internas e perfis de usuário (**Admin, Professor, Aluno**).

Ele implementa mensagens claras de erro/sucesso e organiza o código de forma **modular**, utilizando **PDO**, **prepared statements** e boas práticas de segurança.

A aplicação foi projetada para rodar localmente com **XAMPP**, utilizando o **MySQL** como banco de dados.

Além do componente Web, o projeto inclui uma **API REST segura**, estruturada em controllers separados, permitindo que futuras aplicações (mobile, dashboards externos, integrações) consumam os dados diretamente.

---

## ⚙️ Requisitos

* **PHP** 7.4 ou superior
* **XAMPP** (Apache e MySQL ativos)
* **PhpMyAdmin**
* Extensão **PDO** habilitada
* Navegador moderno
* Editor de código (ex.: VS Code)

---

## 🗄️ Banco de Dados

* **Banco:** `escola`
* **Sistema:** MySQL via `localhost/phpmyadmin`
* **Conexão:** via PDO com prepared statements
* **Arquivo de Referência:** `app/banco.sql`

| Campo | Tipo | Comentário |
| :--- | :--- | :--- |
| **id** | `INT` (PK, AI) | Identificador único |
| **tipo** | `ENUM` | `Admin`, `Professor`, `Aluno` |
| **nome** | `VARCHAR(255)` | Nome completo |
| **cpf** | `VARCHAR` | CPF do usuário |
| **matricula**| `VARCHAR` | Matrícula institucional |
| **email** | `VARCHAR` | E-mail do usuário |
| **nome_pai** | `VARCHAR` | Nome do pai |
| **nome_mae** | `VARCHAR` | Nome da mãe |
| **data_nascim**| `VARCHAR` | Data de nascimento |
| **senha_hash**| `VARCHAR` | Senha hasheada (`password_hash`) |

### 👤 Usuário de Teste (Admin)

| Matrícula | Senha | Perfil |
| :--- | :--- | :--- |
| `231-000655` | `123456@abcdef` | **Admin** |

---

## 🧩 Estrutura do Projeto

Projeto_teste2/ ├── app/ │ └── banco.sql ├── api/ │ ├── config.php │ ├── index.php │ ├── Response.php │ ├── Auth.php │ ├── AuthController.php │ ├── AlunoController.php │ └── NotasController.php ├── assets/ │ ├── css/ │ │ └── style.css │ └── js/ │ ├── index_script.js │ ├── cadastro_script.js │ └── dashboard_admin_script.js ├── public/ │ ├── autentica.php │ ├── conexao.php │ ├── dashboard.php │ ├── dashboard_aluno.php │ ├── dashboard_professor.php │ ├── cadastro_usuarios.php │ ├── cadastro_sucesso.php │ ├── processa_cadastro.php │ ├── verifica_sessao.php │ ├── sem_permissao.php │ └── logout.php ├── index.php └── README.md


---

## 🧭 Instalação Passo a Passo

### 1️⃣ Clonar o Repositório

Abra o terminal ou Git Bash e navegue até o diretório do XAMPP:

```bash
cd C:\xampp\htdocs
git clone [https://github.com/seu-usuario/seu-repositorio.git](https://github.com/seu-usuario/seu-repositorio.git) Projeto_teste2
2️⃣ Importar o Banco de Dados
Abra o XAMPP Control Panel e inicie o Apache e MySQL.

Vá para o phpMyAdmin (http://localhost/phpmyadmin).

Crie uma nova base de dados chamada escola.

Com a base escola selecionada, clique em Importar e carregue o arquivo app/banco.sql.

3️⃣ Configurar Conexão (Opcional)
Verifique e ajuste as credenciais de conexão no arquivo public/conexao.php se necessário (assumindo usuário root e sem senha por padrão do XAMPP).

4️⃣ Executar o Sistema
Acesse a URL no seu navegador:

http://localhost/Projeto_teste2/index.php
🧠 Estrutura e Funcionalidades dos Arquivos (Web)
index.php (Web): Tela de login inicial com validação de formulário e exibição de mensagens claras.

index_script.js: Realiza validações de campos, mostra/oculta a senha e controla o botão de envio.

autentica.php:

Valida as credenciais utilizando password_verify().

Cria a sessão e regenera o ID da sessão pós-login.

Redireciona para o dashboard correto com base no perfil.

verifica_sessao.php: Middleware que protege todas as páginas internas, verificando se a sessão está ativa e se o usuário tem permissão para acessar o recurso.

Dashboards:

dashboard.php – Admin

dashboard_aluno.php – Aluno

dashboard_professor.php – Professor

logout.php: Finaliza a sessão com segurança, limpando todas as variáveis de sessão.

🌐 API REST — Documentação Oficial
A API foi criada para permitir a integração com aplicativos externos (mobile), dashboards e sistemas de terceiros de forma segura.

🧱 Estrutura da API (/api/)
index.php – Roteador principal da API.

AuthController.php – Lógica de login seguro e controle de acesso à API.

AlunoController.php – Endpoint para dados dos alunos.

NotasController.php – Endpoint para notas e rendimento.

Auth.php – Classe que gerencia a sessão e o usuário logado no contexto da API.

Response.php – Classe utilitária para gerar respostas JSON padronizadas.

🔑 Rotas da API

Entrada (JSON):

🔹 GET /api/index.php?rota=alunos
Lista todos os alunos cadastrados (requer autenticação).

🔹 GET /api/index.php?rota=alunos/{id}
Retorna dados específicos do aluno e suas notas.

🔹 GET /api/index.php?rota=notas
Lista todas as notas cadastradas no sistema.

🔒 Segurança e Boas Práticas
O sistema Web e a API foram construídos com foco em segurança:

Criptografia: Utilização de password_hash() e password_verify() para senhas.

Sessão: Sessão é regenerada pós-login para mitigar Session Fixation.

Banco de Dados: Todas as consultas utilizam Prepared Statements com PDO para proteção contra SQL Injection.

Controle de Acesso: Verificação rigorosa de sessão/permissão em todas as páginas internas.

Proteção: Mecanismos básicos contra brute-force (contagem de tentativas incorretas).

Tratamento de Erros: Erros não revelam detalhes sensíveis da aplicação ou do banco de dados ao usuário.

Sanitização: Entradas são sanitizadas antes de serem processadas.

🔁 Fluxos de Autenticação
Fluxo de Autenticação (Web)
Usuário envia matrícula + senha no index.php.

autentica.php busca o usuário e valida a senha com password_verify().

Se válido, a sessão é criada e o ID da sessão é regenerado.

Usuário é redirecionado para o dashboard correspondente ao seu perfil (tipo).

Em páginas internas, verifica_sessao.php garante a validade da sessão.

logout.php encerra a sessão de forma segura.

Fluxo da Autenticação via API
Cliente (app/JS/serviço) envia o JSON de login para a rota /login.

AuthController.php busca o usuário pela matrícula.

password_verify() compara a senha enviada com o hash armazenado.

Se válido, retorna um JSON com status 200 e dados essenciais (id, nome, tipo).

Se inválido, retorna um status HTTP 401 (Unauthorized).

A autenticação persiste na API por meio da sessão vinculada ao request, quando necessário para rotas protegidas.

📋 Observações Específicas
Professores: Podem realizar o login via matrícula ou CPF.

Permissão: Acesso a páginas não liberadas para o perfil resulta em redirecionamento para sem_permissao.php.

Brute-Force: Tentativas incorretas de login são contabilizadas.

💡 Boas Práticas Extras
(mantido como no original)

🤝 Como Contribuir
(mantido como no original)

📜 Licença
(mantido como no original)

📬 Contato e Suporte
(mantido como no original)## 📘 Arquivo README.me do Sistema Escolar (Estrutura Completa)

Este documento combina o guia técnico de **autenticação e controle de acesso** com o passo a passo completo de **instalação e estrutura** do sistema. O objetivo é que qualquer desenvolvedor ou avaliador consiga instalar, executar e compreender toda a lógica do Sistema Escolar em PHP.

---

## 📝 Descrição do Projeto

O **Sistema Escolar** é uma aplicação desenvolvida em PHP com **autenticação segura**, controle de sessões, proteção de páginas internas e perfis de usuário (**Admin, Professor, Aluno**).

Ele implementa mensagens claras de erro/sucesso e organiza o código de forma **modular**, utilizando **PDO**, **prepared statements** e boas práticas de segurança.

A aplicação foi projetada para rodar localmente com **XAMPP**, utilizando o **MySQL** como banco de dados.

Além do componente Web, o projeto inclui uma **API REST segura**, estruturada em controllers separados, permitindo que futuras aplicações (mobile, dashboards externos, integrações) consumam os dados diretamente.

---

## ⚙️ Requisitos

* **PHP** 7.4 ou superior
* **XAMPP** (Apache e MySQL ativos)
* **PhpMyAdmin**
* Extensão **PDO** habilitada
* Navegador moderno
* Editor de código (ex.: VS Code)

---

## 🗄️ Banco de Dados

* **Banco:** `escola`
* **Sistema:** MySQL via `localhost/phpmyadmin`
* **Conexão:** via PDO com prepared statements
* **Arquivo de Referência:** `app/banco.sql`

| Campo | Tipo | Comentário |
| :--- | :--- | :--- |
| **id** | `INT` (PK, AI) | Identificador único |
| **tipo** | `ENUM` | `Admin`, `Professor`, `Aluno` |
| **nome** | `VARCHAR(255)` | Nome completo |
| **cpf** | `VARCHAR` | CPF do usuário |
| **matricula**| `VARCHAR` | Matrícula institucional |
| **email** | `VARCHAR` | E-mail do usuário |
| **nome_pai** | `VARCHAR` | Nome do pai |
| **nome_mae** | `VARCHAR` | Nome da mãe |
| **data_nascim**| `VARCHAR` | Data de nascimento |
| **senha_hash**| `VARCHAR` | Senha hasheada (`password_hash`) |

### 👤 Usuário de Teste (Admin)

| Matrícula | Senha | Perfil |
| :--- | :--- | :--- |
| `231-000655` | `123456@abcdef` | **Admin** |

---

## 🧩 Estrutura do Projeto

Projeto_teste2/ ├── app/ │ └── banco.sql ├── api/ │ ├── config.php │ ├── index.php │ ├── Response.php │ ├── Auth.php │ ├── AuthController.php │ ├── AlunoController.php │ └── NotasController.php ├── assets/ │ ├── css/ │ │ └── style.css │ └── js/ │ ├── index_script.js │ ├── cadastro_script.js │ └── dashboard_admin_script.js ├── public/ │ ├── autentica.php │ ├── conexao.php │ ├── dashboard.php │ ├── dashboard_aluno.php │ ├── dashboard_professor.php │ ├── cadastro_usuarios.php │ ├── cadastro_sucesso.php │ ├── processa_cadastro.php │ ├── verifica_sessao.php │ ├── sem_permissao.php │ └── logout.php ├── index.php └── README.md


---

## 🧭 Instalação Passo a Passo

### 1️⃣ Clonar o Repositório

Abra o terminal ou Git Bash e navegue até o diretório do XAMPP:

```bash
cd C:\xampp\htdocs
git clone [https://github.com/seu-usuario/seu-repositorio.git](https://github.com/seu-usuario/seu-repositorio.git) Projeto_teste2
2️⃣ Importar o Banco de Dados
Abra o XAMPP Control Panel e inicie o Apache e MySQL.

Vá para o phpMyAdmin (http://localhost/phpmyadmin).

Crie uma nova base de dados chamada escola.

Com a base escola selecionada, clique em Importar e carregue o arquivo app/banco.sql.

3️⃣ Configurar Conexão (Opcional)
Verifique e ajuste as credenciais de conexão no arquivo public/conexao.php se necessário (assumindo usuário root e sem senha por padrão do XAMPP).

4️⃣ Executar o Sistema
Acesse a URL no seu navegador:

http://localhost/Projeto_teste2/index.php
🧠 Estrutura e Funcionalidades dos Arquivos (Web)
index.php (Web): Tela de login inicial com validação de formulário e exibição de mensagens claras.

index_script.js: Realiza validações de campos, mostra/oculta a senha e controla o botão de envio.

autentica.php:

Valida as credenciais utilizando password_verify().

Cria a sessão e regenera o ID da sessão pós-login.

Redireciona para o dashboard correto com base no perfil.

verifica_sessao.php: Middleware que protege todas as páginas internas, verificando se a sessão está ativa e se o usuário tem permissão para acessar o recurso.

Dashboards:

dashboard.php – Admin

dashboard_aluno.php – Aluno

dashboard_professor.php – Professor

logout.php: Finaliza a sessão com segurança, limpando todas as variáveis de sessão.

🌐 API REST — Documentação Oficial
A API foi criada para permitir a integração com aplicativos externos (mobile), dashboards e sistemas de terceiros de forma segura.

🧱 Estrutura da API (/api/)
index.php – Roteador principal da API.

AuthController.php – Lógica de login seguro e controle de acesso à API.

AlunoController.php – Endpoint para dados dos alunos.

NotasController.php – Endpoint para notas e rendimento.

Auth.php – Classe que gerencia a sessão e o usuário logado no contexto da API.

Response.php – Classe utilitária para gerar respostas JSON padronizadas.

🔑 Rotas da API
🔹 POST /api/index.php?rota=login
Autentica o usuário e retorna dados essenciais.

Entrada (JSON):

JSON

{
  "matricula": "231-000655",
  "senha": "123456@abcdef"
}
Saída (JSON):

JSON

{
  "status": 200,
  "msg": "Login OK",
  "data": {
    "id": 1,
    "nome": "Admin",
    "tipo": "Admin"
  }
}
🔹 GET /api/index.php?rota=alunos
Lista todos os alunos cadastrados (requer autenticação).

🔹 GET /api/index.php?rota=alunos/{id}
Retorna dados específicos do aluno e suas notas.

🔹 GET /api/index.php?rota=notas
Lista todas as notas cadastradas no sistema.

🔒 Segurança e Boas Práticas
O sistema Web e a API foram construídos com foco em segurança:

Criptografia: Utilização de password_hash() e password_verify() para senhas.

Sessão: Sessão é regenerada pós-login para mitigar Session Fixation.

Banco de Dados: Todas as consultas utilizam Prepared Statements com PDO para proteção contra SQL Injection.

Controle de Acesso: Verificação rigorosa de sessão/permissão em todas as páginas internas.

Proteção: Mecanismos básicos contra brute-force (contagem de tentativas incorretas).

Tratamento de Erros: Erros não revelam detalhes sensíveis da aplicação ou do banco de dados ao usuário.

Sanitização: Entradas são sanitizadas antes de serem processadas.

🔁 Fluxos de Autenticação
Fluxo de Autenticação (Web)
Usuário envia matrícula + senha no index.php.

autentica.php busca o usuário e valida a senha com password_verify().

Se válido, a sessão é criada e o ID da sessão é regenerado.

Usuário é redirecionado para o dashboard correspondente ao seu perfil (tipo).

Em páginas internas, verifica_sessao.php garante a validade da sessão.

logout.php encerra a sessão de forma segura.

Fluxo da Autenticação via API
Cliente (app/JS/serviço) envia o JSON de login para a rota /login.

AuthController.php busca o usuário pela matrícula.

password_verify() compara a senha enviada com o hash armazenado.

Se válido, retorna um JSON com status 200 e dados essenciais (id, nome, tipo).

Se inválido, retorna um status HTTP 401 (Unauthorized).

A autenticação persiste na API por meio da sessão vinculada ao request, quando necessário para rotas protegidas.

📋 Observações Específicas
Professores: Podem realizar o login via matrícula ou CPF.

Permissão: Acesso a páginas não liberadas para o perfil resulta em redirecionamento para sem_permissao.php.

Brute-Force: Tentativas incorretas de login são contabilizadas.

💡 Boas Práticas Extras
(mantido como no original)

🤝 Como Contribuir
(mantido como no original)

📜 Licença
(mantido como no original)

📬 Contato e Suporte
(mantido como no original)