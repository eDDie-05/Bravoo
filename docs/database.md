# Database relationships

PostgreSQL is the source of truth. Tables use primary keys, UTC timestamps, foreign keys, and indexes on lookup, ownership, status, and date-filter columns. Use soft deletion only for business records that need recoverability; retain audit history independently. Constraint and retention details are finalized alongside each migration.

## Identity and organization

- `users` holds authentication credentials and activation state. It has a nullable one-to-one link to `employees` in the employee table, not a duplicated employee profile.
- `roles`, `permissions`, `role_user`, `permission_role` provide RBAC. Add `model_has_roles` only if non-user principals become necessary.
- `departments` has many employees and jobs. `jobs` belongs to a department; employees reference department and job with nullable foreign keys for historical records.
- `login_histories` references users and records time, outcome, and limited request metadata; never persist credentials or session secrets.
- `audit_logs` references the actor when known and stores action, subject type/id, timestamp, and a minimized structured diff.
- `notifications` uses Laravel's notification schema and user recipient morph relation.

## HR

- `employees` belongs to departments and jobs, has a unique employee number, and may link to one user.
- `attendances` belongs to an employee; index employee and work date and prevent duplicate daily records according to the attendance policy.
- `leave_applications` belongs to applicant employee and optionally an approver employee/user; status transitions and approval history are auditable.
- `employee_documents` belongs to an employee and document metadata record; protected storage and authorization remain in the document module.
- `performance_reviews` belongs to an employee and reviewer; access is restricted to HR and permitted management roles.

## IT and operations

- `assets` has a unique asset tag and optional current custodian employee. `asset_assignments` records each historical assignment, assigning/returning actor, and dates. `maintenance_records` belongs to an asset.
- `tickets` belongs to a requester employee and category, and optionally an assignee employee. `ticket_comments` belongs to a ticket and author; attachments use private document/file metadata. Resolution and status history are retained.
- `network_devices` may reference an asset. `monitoring_samples`, `infrastructure_incidents`, and `network_maintenance_records` reference their device and include observed/occurred times. Samples should be retention-managed.
- `endpoint_devices` ties an authorized agent identity to an asset or employee. `endpoint_reports` stores explicit agent-reported status and timestamps. `security_policies`, `security_incidents`, and `security_alerts` record policy metadata and actionable events, not arbitrary surveillance payloads.

## Procurement and inventory

- `suppliers` has many requisitions and purchase orders.
- `purchase_requests` belongs to requester employee and supplier optionally; `purchase_request_items` references products optionally and records quantity and requested description. `purchase_approvals` records ordered decisions by approver and time.
- `purchase_orders` belongs to a supplier and optionally a request. `purchase_order_items` record ordered lines; deliveries are tracked separately.
- `products` belongs to a category and has a unique SKU. `stock_locations` describes stores/warehouses. `inventory_balances` is keyed uniquely by product and location and updated only through transactions.
- `stock_movements` records immutable stock-in, stock-out, and transfer legs with quantity, actor, reference type/id, and effective time. Transfers create linked out/in movements in one transaction. Valuation method is configurable and must be chosen before valuation reports are treated as accounting-grade.

## Documents and visitors

- `documents` stores owner/department/category, classification, current version pointer, and metadata. `document_versions` belongs to a document and stores private storage key, checksum, uploader, and creation time.
- `document_approvals` records workflow decisions. `document_access_logs` records authorized access events without exposing document contents.
- `visitors` stores minimum necessary identity data. `visits` references visitor and host employee, purpose, check-in and check-out times, and receptionist actor.

## Integrity and reporting

Foreign keys use restrictive deletion for historical and financial-adjacent records; archival/deactivation is preferred. Unique constraints cover employee number, asset tag, SKU, and other business identifiers. Reporting uses permission-scoped query services over operational data initially; denormalized aggregates are introduced only when measured load requires them.
