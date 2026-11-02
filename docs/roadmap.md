# Dependencies and phased roadmap

## Planned dependencies

- Laravel 13 framework and official Livewire starter kit for session authentication, password reset, Blade, and frontend build integration.
- PostgreSQL driver and native Laravel migrations/Eloquent; no separate database abstraction.
- A maintained Laravel RBAC package (Spatie Laravel Permission is the leading candidate) or an equivalent small first-party permission layer after compatibility review.
- Tailwind CSS through the starter kit/Vite pipeline; Lucide icons and Chart.js through pinned NPM dependencies.
- Laravel notifications, queues, policies, validation, rate limiting, and private filesystem disks for cross-cutting infrastructure.
- Export libraries only when the first authorized report requires PDF/XLSX output; evaluate maintenance, license, and Laravel/PHP compatibility then.

Exact package versions must be locked in `composer.lock` and `package-lock.json` after PHP/Composer are available. Do not install unverified versions or commit generated credentials.

## Phases and completion gates

1. **Foundation — in progress:** Laravel 13 scaffold, PostgreSQL configuration, session sign-in, active-account check, organization/employee tables, first-party roles and permissions, audit log schema, and initial dashboard. Remaining: company settings workflow, audit writer, notification setup, account recovery, and migration/auth/authorization checks. Gate: migrations/seeds and auth/authorization checks pass.
2. **HR — in progress:** employee and department schema, permission-checked employee directory and employee creation. Remaining: department/job administration, employee edit/archive flow, self-service profile, attendance, leave, employee documents, performance, lifecycle, and record-scope checks. Gate: scoped CRUD and approval workflow validated.
3. **IT assets:** registration, assignments, returns, warranties, maintenance, reports. Gate: full assignment history and authorized access.
4. **Helpdesk:** ticket lifecycle, categories, assignment, comments, private attachments, service-time reporting. Gate: permissions and status transitions validated.
5. **Inventory and procurement:** products, locations, stock movements, requisitions, approvals, POs, delivery. Gate: transaction-safe stock balances and approval history.
6. **Documents:** versions, categories, department access, approvals, search, access audit. Gate: private storage and download authorization reviewed.
7. **Infrastructure and cybersecurity:** authorized devices/agents, status history, incidents, policies, alerts. Gate: integrations are authenticated and no unauthorized collection path exists.
8. **Visitors:** registration, host association, check-in/out, reception view. Gate: identity data minimization and access scope.
9. **Management reporting:** company summaries, permission-aware filters, charts, exports. Gate: report scopes match record scopes.
10. **Release readiness:** automated checks, security review, performance, backup/restore procedure, Nginx deployment guide, operational documentation. Gate: reviewed release checklist completed.

Every phase gets migrations, validation, policies, relevant automated tests, and documentation before the next module depends on it. User-provided or generated sample records are development fixtures only, never production records. The module pages currently present in the application are placeholders and do not represent completed workflows.

## Current environment notes

The workspace has PHP 8.5 and Composer. The Laravel scaffold and locked Composer dependencies have been created. PostgreSQL server availability and application migrations against PostgreSQL have not been confirmed. Frontend build assets have not been generated. Do not describe the application as production-ready until the phase gates and release readiness work are complete.
