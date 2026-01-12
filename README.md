# Sistema de Recadastramento de Servidores

Sistema web desenvolvido com **CodeIgniter 4**, voltado ao **recadastramento de servidores**, com controle de acesso por perfis, autenticação robusta e fluxo orientado por etapas.

O projeto segue uma arquitetura organizada, segura e preparada para evolução, atendendo cenários institucionais e administrativos.

---

## Visão Geral

Este sistema permite:

- Autenticação e autorização de usuários
- Recadastramento de servidores por etapas
- Controle de acesso por grupos e permissões
- Área administrativa separada
- Organização clara de responsabilidades (MVC)

A aplicação utiliza **CodeIgniter Shield** para autenticação e autorização, com customizações específicas para o domínio do projeto.

---

## Tecnologias Utilizadas

- **PHP 8+**
- **CodeIgniter 4**
- **CodeIgniter Shield** (Auth & ACL)
- **MySQL / MariaDB**
- **Composer**
- **HTML / CSS**
- **JavaScript (básico)**

---

## Estrutura do Projeto

```text
app/
├── Config/          # Configurações da aplicação
├── Controllers/     # Controllers (Admin, Login, Recadastro, etc.)
├── Models/          # Modelos de dados
├── Views/           # Views organizadas por módulo
├── Database/
│   ├── Migrations/ # Migrações
│   └── Seeds/      # Seeds
├── Language/        # Idiomas (pt-BR / en)
└── Filters/         # Filtros de autenticação e autorização
