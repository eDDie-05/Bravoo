# Bravado Enterprise Management System

**One company. One platform. Complete operational control.**

BEMS is a Laravel modular monolith for Bravado Ltd. It brings company identity and authorization together with HR, IT assets, helpdesk, documents, infrastructure, cybersecurity, procurement, inventory, visitor management, and management reporting.

## Current delivery

The Laravel 13 application foundation is in place: PostgreSQL configuration, session sign-in and sign-out, inactive-account rejection, organization and RBAC tables, role/permission seeding, a protected operations dashboard, and an HR employee directory with permission-checked employee creation. Other module pages are navigation placeholders; their business workflows are not implemented yet. See the [delivery roadmap](docs/roadmap.md) for phase status.

## Stack

- PHP 8.3+ and Laravel 13
- PostgreSQL
- Blade server-rendered interface
- Laravel session authentication, CSRF protection, password hashing, and request validation
- Native role/permission tables and explicit permission checks

## Local setup

Requirements: PHP 8.3+, Composer, PostgreSQL, Node.js and NPM.

```sh
composer install
cp .env.example .env
```

Set `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in `.env`. Create the PostgreSQL database, then run:

```sh
php artisan key:generate
php artisan migrate --seed
php artisan bems:create-admin
```

The admin command prompts for a name, work email, and password of at least 12 characters. It refuses to create another super administrator if one already exists. Start the local server with `php artisan serve` and sign in at `/login`.

Keep `.env`, real company records, uploaded documents, and generated credentials out of Git. Use a separate database and accounts for development.

## Project documents

- [Architecture and module boundaries](docs/architecture.md)
- [Database relationships](docs/database.md)
- [Roles and permissions](docs/authorization.md)
- [Delivery roadmap and phase gates](docs/roadmap.md)

## Security and operational boundaries

- Authorization must be enforced on every page, action, export, notification, and file download. Hiding a navigation link is not access control.
- HR, employee documents, cybersecurity records, and procurement approvals need narrow record scopes before their workflows are released.
- Store private uploads on a private disk and authorize downloads. Do not log credentials, tokens, or file contents.
- Endpoint monitoring must use explicitly registered and authorized agents. No covert collection, remote control, or arbitrary command execution.
- The current RBAC layer is a first-party foundation. Role assignments and policy scopes need review as each module is implemented.
- No production deployment, security review, backups, or operational recovery procedure has been completed.
