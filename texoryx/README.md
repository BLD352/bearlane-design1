# Texoryx

Texoryx is a Next.js 15 operating system for embroidery, DTF, and custom apparel shops. It centralizes customer vaults, design files, proof approvals, repeat orders, production notes, machine settings, and queue status.

## 1. Folder structure

- `app/(app)`: authenticated dashboard, customers, library, projects, production, approvals, and settings pages.
- `app/(public)/proof/[token]`: customer-facing proof review route.
- `app/api`: route handlers for customers, projects, files, approvals, production, search, and Clerk webhooks.
- `components`: layout, dashboard, library, production, and UI primitives.
- `lib`: Prisma, Clerk authorization, Cloudflare R2 uploads, Meilisearch, and Zod validators.
- `prisma/schema.prisma`: PostgreSQL schema for Texoryx domain models.
- `store`: Zustand UI state.

## 2. Database schema

The Prisma schema includes users, customers, projects, orders, files, file versions, approvals, machine settings, production jobs, production notes, activity logs, tags, and file-tag relationships.

## 3. API routes

- `GET/POST /api/customers`
- `GET/PATCH /api/customers/[id]`
- `GET/POST /api/projects`
- `GET /api/projects/[id]`
- `GET/POST /api/files`
- `GET/POST /api/approvals`
- `GET/PATCH /api/approvals/[token]`
- `GET/PATCH /api/production`
- `GET /api/search?q=`
- `POST /api/webhooks/clerk`

## 4. Components

Texoryx uses dark industrial cards, a Clerk-powered app shell, production stat cards, a kanban queue board, and a direct-R2 upload panel.

## 5. Page layouts

The app ships desktop-first pages for dashboard, customer vault, design library, project list/detail, production queue, approval center, settings, and public proof review.

## 6. Implementation code

Run locally after configuring `.env` from `.env.example`:

```bash
npm install
npm run prisma:generate
npm run dev
```

## 7. Next build step

Wire a worker or queue consumer for post-upload virus validation, embroidery metadata extraction, and preview generation. The signed upload route already records metadata needed for that asynchronous pipeline.
