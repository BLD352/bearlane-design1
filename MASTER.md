# Texoryx Master Build Document

Texoryx is the production operating system for embroidery, DTF, and custom apparel shops. Sprint 1A is intentionally narrow: prove the authenticated app shell before building deeper customer, file, approval, or production workflows.

## Canonical Sprint 1A scope

Build **Sprint 1A only**:

1. Dashboard shell.
2. Clerk-authenticated app layout.
3. Sidebar navigation.
4. Dashboard count cards.
5. Topbar.
6. `/api/dashboard` route with real Prisma counts.

Do **not** build Customer Vault, Design Library upload flows, Approval Center workflows, Production Queue boards, search, or storage automation until Sprint 1A works.

## Canonical project files

- `README.md` — repository overview and Sprint 1A setup.
- `docs/SPRINT_1_ARCHITECTURE.md` — Sprint 1A architecture and implementation map.
- `docs/BUILD_PROMPT.md` — continuation prompt that preserves Sprint 1A boundaries.
- `prisma/schema.prisma` — root copy of the minimal Sprint 1A Prisma schema.
- `prisma/migrations/20260516152000_sprint_1a_dashboard_shell/` — root Sprint 1A migration.
- `.env.example` — root environment template.
- `texoryx/` — runnable Next.js 15 Sprint 1A app.

## Sprint 1A implementation status

- Next.js 15 app-router scaffold in `texoryx/`.
- Clerk provider, middleware, and authenticated `(app)` layout.
- Dark industrial sidebar shell with future modules disabled and labeled `Soon`.
- Topbar with Clerk user controls.
- Dashboard count cards for customers, active projects, pending approvals, and production queue jobs.
- `/api/dashboard` returns real Prisma counts scoped to the current Clerk workspace.
- Minimal Prisma/PostgreSQL schema with only the tables required to support workspace-isolated dashboard counts.
- No Customer Vault pages, upload system, R2 helpers, Meilisearch routes, or module CRUD APIs in this sprint.

## Next sprint gate

Only start Sprint 1B after Sprint 1A can install, authenticate, render `/dashboard`, and read count cards from the configured database.
