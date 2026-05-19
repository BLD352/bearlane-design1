# Sprint 1 Architecture

## Goal

Deliver a workspace-isolated MVP foundation in three increments:

- Sprint 1A: Dashboard shell
- Sprint 1B: Customer Vault
- Sprint 1C: Upload System

## Core Architecture Principles

1. Workspace isolation by default on all data access paths.
2. Embroidery-first workflows over generic project management abstractions.
3. Fast repeat-order retrieval via search-ready metadata and tags.
4. Clear separation between customer-visible approvals and internal production notes.

## Sprint 1A — Dashboard Shell

### Deliverables

- Auth-protected application layout.
- Workspace-aware dashboard route.
- KPI placeholders:
  - Active projects
  - Pending approvals
  - Recent uploads
  - Production blockers
- Recent activity feed based on `ActivityLog`.

### Technical Notes

- Use Clerk middleware for protected routes.
- Resolve current workspace from user membership context.
- Query data with `workspaceId` constraints.

## Sprint 1B — Customer Vault

### Deliverables

- Customer list with search and tags.
- Customer detail view:
  - Projects
  - File assets
  - Approvals
  - Production notes
- Create/edit customer workflows.

### Technical Notes

- Index searchable fields in PostgreSQL and Meilisearch.
- Enforce role permissions for note visibility and edits.

## Sprint 1C — Upload System

### Deliverables

- File upload entrypoint with validation.
- Virus scan integration hook.
- Cloudflare R2 object storage write.
- Metadata extraction and version registration.
- Preview generation job trigger.

### Upload Pipeline

Browser Upload → Validation → Virus Scan → R2 → Metadata Extraction → DB Write → Preview Generation

## Role Model

- OWNER
- MANAGER
- OPERATOR
- DESIGNER
- CUSTOMER

## Risks and Mitigations

- Large embroidery file handling: use chunked uploads and background processing.
- Cross-workspace leakage: include `workspaceId` in all model-level queries and policies.
- Approval latency: support async status updates and clear queue views.
