# Texoryx Sprint 1A Architecture

## Goal

Sprint 1A proves the Texoryx application shell only. It must render an authenticated dashboard with sidebar navigation and count cards before any deeper product module is implemented.

## In scope

- Next.js 15 app router.
- Clerk provider and protected app layout.
- Sidebar navigation with future modules shown as disabled `Soon` items.
- Topbar with Clerk user controls.
- Dashboard count cards backed by Prisma count queries.
- Empty state for new workspaces.
- `/api/dashboard` route with real Prisma counts.
- Minimal PostgreSQL schema for workspace-isolated count-card tables.

## Out of scope

- Customer Vault pages or CRUD.
- Design Library pages or upload flows.
- Cloudflare R2 upload helpers.
- UploadThing integration.
- Approval Center workflows.
- Production Queue kanban boards.
- Meilisearch indexing/search routes.
- Module API routes beyond what the dashboard shell needs.

## Sprint 1A app structure

```text
texoryx/
├── app/
│   ├── (app)/
│   │   ├── dashboard/page.tsx        # Count cards and Sprint 1A hero
│   │   └── layout.tsx                # Authenticated AppShell wrapper
│   ├── api/dashboard/route.ts        # Workspace-isolated count API
│   ├── globals.css                   # Dark industrial visual system
│   ├── layout.tsx                    # ClerkProvider root layout
│   └── page.tsx                      # Redirects to /dashboard
├── components/
│   ├── app-shell.tsx
│   ├── sidebar-nav.tsx
│   ├── topbar.tsx
│   ├── stat-card.tsx
│   ├── dashboard/dashboard-overview.tsx
├── lib/
│   ├── dashboard.ts
│   ├── db.ts
│   └── workspace.ts
└── prisma/
    ├── schema.prisma
    └── migrations/20260516152000_sprint_1a_dashboard_shell/
```

## Dashboard count cards

The dashboard page and `/api/dashboard` read four workspace-isolated counts:

1. Customers.
2. Active projects where status is not `COMPLETED` or `ARCHIVED`.
3. Pending approvals.
4. Production jobs in `READY`, `RUNNING`, or `QC`.

If the database is unavailable during early setup, the dashboard renders an em dash instead of crashing the shell, and `/api/dashboard` returns a 503 JSON response with `counts: null`.

## Minimal data model

Sprint 1A keeps only these models:

- `Workspace`
- `User`
- `Customer`
- `Project`
- `Approval`
- `FileAsset`
- `ProductionJob`

Every counted model includes `workspaceId`, and all count queries filter by the current Clerk organization workspace or personal workspace. These tables support dashboard counts while preserving the domain direction for future sprints.

## Sprint 1B gate

Do not begin Customer Vault or Upload System work until Sprint 1A can:

1. Install dependencies.
2. Generate Prisma client.
3. Apply the Sprint 1A migration.
4. Authenticate with Clerk.
5. Render `/dashboard` with sidebar navigation and count cards.
