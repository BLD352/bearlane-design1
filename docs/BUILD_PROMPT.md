# Texoryx Sprint 1A Build Prompt

Act as a principal full-stack engineer, SaaS architect, embroidery production expert, and product designer.

Continue building **Texoryx**, but stay within Sprint 1A only until the dashboard shell works.

## Sprint 1A scope

Build and stabilize:

1. Dashboard shell.
2. Authenticated layout using Clerk.
3. Sidebar navigation.
4. Dashboard count cards.
5. Empty states.
6. `/api/dashboard` with real Prisma counts and workspace isolation.

## Explicitly out of scope until Sprint 1A works

Do not build:

- Customer Vault pages or CRUD.
- Upload System, UploadThing, or Cloudflare R2 flows.
- Design Library pages.
- Approval Center workflows.
- Production Queue kanban boards.
- Meilisearch search routes.
- Full module API routes.

## Current anchors

- App root: `texoryx/`.
- Master plan: `MASTER.md`.
- Sprint architecture: `docs/SPRINT_1_ARCHITECTURE.md`.
- Minimal schema: `prisma/schema.prisma` and `texoryx/prisma/schema.prisma`.

## Future response order

1. Folder structure.
2. Schema changes, if any.
3. Auth/layout changes.
4. Sidebar/topbar/dashboard components.
5. Dashboard page and API layout.
6. Validation/testing.
7. Next Sprint 1A step.
