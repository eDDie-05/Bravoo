# Roles and permissions

Roles are named bundles of permissions, not authorization rules. Application policies check permissions and record scope on every read/write path, including Livewire actions, API routes, exports, downloads, and notifications. Navigation visibility is only a usability aid.

## Initial role bundles

| Role | Typical permission scope |
| --- | --- |
| Super Administrator | platform configuration and all modules; tightly limited, audited assignment |
| Managing Director | company-wide read dashboards and approvals explicitly delegated by policy |
| Human Resource Manager | employee, department, attendance, leave, performance, HR document workflows |
| IT Manager | IT assets, helpdesk, infrastructure, cybersecurity and related reports |
| IT Technician | assigned tickets, permitted asset/maintenance updates, limited endpoint status |
| Procurement Officer | suppliers, requisitions, purchase orders, delivery workflow |
| Inventory Manager | product, location, stock movement, transfer, and inventory reports |
| Finance Officer (future) | reserved namespace; no initial finance data or permissions |
| Receptionist | visitor registration and visit check-in/out; minimal employee directory lookup |
| Regular Employee | own profile, own leave, own tickets, and explicitly shared company documents |

The initial seeder grants module-view permissions only to the relevant departmental roles. The regular employee role does not receive company-wide `people.view`; self-service employee access must be implemented with an explicit own-record scope before it is granted. HR Managers and Super Administrators can view the current employee directory, and those same roles can create employee records.

## Permission naming

Use module/action names such as `employees.view`, `employees.manage`, `leave.approve`, `assets.assign`, `tickets.assign`, `documents.download`, `purchases.approve`, `inventory.adjust`, `visitors.check-in`, `security.incidents.manage`, and `reports.export`. Add scoped query policies for `own`, `assigned`, `department`, or `company` visibility where needed.

## Account and session controls

Inactive users cannot authenticate. Role grants and revocations are audited. Use Laravel's supported password hashing, reset flow, CSRF protection, secure session cookies in production, login throttling, and session invalidation after account deactivation or credential reset. Login history records only minimized metadata and retention is configurable.

## Sensitive data

HR performance records, employee documents, cybersecurity incidents, endpoint reports, and procurement approvals require explicit policy checks. Never rely on IDs being difficult to guess. REST API authentication will use scoped, revocable tokens only if an integration requires it; browser sessions remain the default for the application.
