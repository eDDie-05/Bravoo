# BEMS architecture

## Requirements analysis

BEMS has shared concerns across every department: identity, employee and department references, authorization, notifications, files, audit history, and reporting. Modules must therefore live in one application and use shared records instead of making their own user or department copies. Finance is an extension point only; it is outside the initial release.

The initial deployment is a Laravel modular monolith. Module boundaries are expressed through namespaces, routes, policies, services, and migrations, while deployment remains a single application and database. This keeps approvals and reporting transactional and avoids premature service-to-service infrastructure. Queue workers can be added for email, exports, and other slow tasks without changing module ownership.

## Module boundaries

| Module | Owns | Shared dependencies |
| --- | --- | --- |
| Identity and company settings | users, roles, permissions, settings, login history | all modules |
| HR | employees, departments, jobs, attendance, leave, employee documents, performance | identity, notifications, audit |
| IT assets | assets, assignments, returns, maintenance | employees, departments, audit |
| Helpdesk | tickets, categories, assignments, comments, resolutions | employees, assets, files, notifications |
| Documents | document metadata, versions, approvals, access records | employees, departments, private storage, audit |
| Infrastructure | network devices, monitoring samples, incidents, maintenance, alert rules | IT assets, notifications, audit |
| Cybersecurity | endpoints, agent reports, policies, incidents, alerts | users, assets, notifications, audit |
| Procurement | suppliers, requisitions, approvals, purchase orders, deliveries | employees, inventory, notifications, audit |
| Inventory | products, locations, balances, stock movements, transfers | suppliers, procurement, audit |
| Visitors | visitors, visit records, check-in/out | employees, audit |
| Management reporting | permission-scoped aggregates and exports | all authorized module read models |

Finance can later integrate through its own module and permission namespace. Initial procurement and inventory schemas must not assume a full ledger or accounting system.

## Application layers

- **HTTP and Livewire:** authentication, request validation, authorization checks, and UI orchestration. Controllers and components stay thin.
- **Application services:** transactional workflows such as leave approval, stock movement, asset assignment, and purchase approval.
- **Domain models and policies:** relationships, state transitions, and record-level access rules.
- **Persistence:** PostgreSQL migrations, indexes, constraints, and query scopes.
- **Infrastructure:** private file storage, mail, queues, monitoring integrations, and report export adapters.
- **Presentation:** shared Blade layouts/components and Livewire screens; Tailwind tokens define light/dark themes.

Use database transactions around multi-record state changes. Use queued jobs for email and large exports. All public-facing records must be authorized by a policy or an equivalent explicit permission check.

## Planned directory layout

```text
app/
  Domain/                         # Shared company settings and common value types
  Modules/
    Identity/{Actions,Models,Policies}
    HR/{Actions,Models,Policies,Services}
    Assets/{Actions,Models,Policies,Services}
    Helpdesk/{Actions,Models,Policies,Services}
    Documents/{Actions,Models,Policies,Services}
    Infrastructure/{Actions,Models,Policies,Services}
    Security/{Actions,Models,Policies,Services}
    Procurement/{Actions,Models,Policies,Services}
    Inventory/{Actions,Models,Policies,Services}
    Visitors/{Actions,Models,Policies,Services}
    Reporting/{Actions,Queries,Exports}
  Http/{Controllers,Middleware,Requests}
  Notifications/
  Providers/
database/{migrations,seeders,factories}
resources/{views,css,js,lang}
routes/{web,api}.php
tests/{Feature,Unit}
docs/
```

Module routes and migrations may be split into provider-registered files as the application grows. Avoid a generic repository layer unless a real persistence boundary needs it.

## Cross-cutting rules

- Users authenticate centrally. Employees optionally link to a user; an employee record is not a second login identity.
- Enforce both permission and record scope. Department-scoped roles must not infer access from hidden navigation alone.
- Store sensitive uploads on a private disk and serve them only after authorization. Store file metadata and immutable versions in PostgreSQL.
- Write audit events for security-sensitive changes and access to protected documents. Do not store passwords, tokens, or file contents in audit payloads.
- Collect endpoint telemetry only through explicitly registered, authorized agents or approved integrations. No covert collection, remote-control feature, or arbitrary command execution.
- Dashboard and export queries must use the same authorization scopes as record pages.
- Use UUIDs only where external references or exposure risks justify them; use normal primary keys internally by default.
