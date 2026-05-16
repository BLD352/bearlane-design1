# Texoryx / BearLane Design Workspace

This repository contains the BearLane Design WordPress theme and the new **Texoryx** Next.js application.

## Sprint 1A scope

Sprint 1A implements only the foundation needed before product modules are built:

- Dashboard shell.
- Clerk-authenticated layout.
- Sidebar navigation.
- Dashboard count cards.
- Empty state when the workspace has no production data yet.
- `/api/dashboard` with real Prisma counts scoped to the signed-in workspace.

Customer Vault, file uploads, Approval Center, Production Queue workflows, R2 storage, Meilisearch, and module CRUD APIs are intentionally deferred until Sprint 1A works.

## Repository structure

```text
.
├── MASTER.md                         # Sprint 1A master document
├── README.md                         # Workspace overview
├── docs/
│   ├── BUILD_PROMPT.md               # Sprint 1A continuation prompt
│   └── SPRINT_1_ARCHITECTURE.md      # Sprint 1A architecture
├── prisma/
│   ├── migrations/                   # Root Sprint 1A migration
│   └── schema.prisma                 # Root schema copy
├── .env.example                      # Root environment template
├── texoryx/                          # Runnable Next.js 15 Sprint 1A app
└── bearlane-theme/                   # Existing BearLane WordPress theme
```

## Local development

```bash
cd texoryx
npm install
npm run db:generate
npm run db:migrate:deploy
npm run dev
```

## Root Prisma commands

The repository root includes a minimal Sprint 1A Prisma schema and migration for review/tooling. In an environment where npm can fetch Prisma, these commands can be run from the repository root:

```bash
npx prisma generate
npx prisma migrate dev --name sprint_1a_dashboard_shell
```

## Current status

The active app route is `/dashboard`, with `/api/dashboard` available for the same workspace-isolated counts. Sidebar items for future modules are visible but disabled so navigation structure can be reviewed without prematurely building Customer Vault or Upload System functionality.
