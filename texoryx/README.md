# Texoryx

Texoryx Sprint 1A is the authenticated dashboard shell for an embroidery and apparel production operating system.

## Sprint 1A only

This app currently includes:

- Clerk-authenticated root/app layout.
- Dark industrial sidebar navigation.
- Topbar with Clerk user controls.
- `/dashboard` route.
- `/api/dashboard` route.
- Dashboard stat cards and empty state backed by workspace-isolated Prisma counts.

The Customer Vault, Upload System, Design Library, Approval Center, Production Queue kanban, R2 storage helpers, and Meilisearch routes are intentionally not implemented until Sprint 1A works.

## Run locally

```bash
npm install
npm run db:generate
npm run db:migrate:deploy
npm run dev
```

## Prisma

```bash
npm run db:generate
npm run db:migrate:dev
```
