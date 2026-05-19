# THREADVAULT MASTER
Version: v0.1.0
System: ThreadVault
Sprint: Sprint 1
Status: ACTIVE

## Purpose

ThreadVault is an embroidery and apparel production operating system designed for custom apparel businesses like BearLane Design.

Centralize:

- embroidery files
- customer assets
- approvals
- machine settings
- artwork
- production notes
- repeat orders
- workflow tracking

ThreadVault is NOT generic project management software.

ThreadVault IS:

Print workflow + embroidery file management + customer vault + production OS

## Current Sprint Goal

Build MVP:

1. Authentication
2. Dashboard
3. Customer Vault
4. Upload Library
5. Production foundation

## Tech Stack

Frontend:
- Next.js 15
- TypeScript
- Tailwind
- shadcn/ui

Backend:
- Next API routes
- Prisma

Database:
- PostgreSQL

Authentication:
- Clerk

Storage:
- Cloudflare R2

Search:
- Meilisearch

Hosting:
- Vercel

## User Roles

OWNER
MANAGER
OPERATOR
DESIGNER
CUSTOMER

## Database Models

Workspace
User
Customer
Project
FileAsset
FileVersion
Approval
MachineSetting
ProductionNote
Tag
ActivityLog

## Upload Flow

Browser Upload
↓
Validation
↓
Virus Scan
↓
Cloudflare R2
↓
Metadata Extraction
↓
Database Write
↓
Preview Generation

## Non-Negotiables

Do not copy StitchVault code, branding, UI, or proprietary structure.

Optimize for embroidery production workflow.

Prioritize repeat-order speed.

Desktop-first.

Mobile optimized.

Use workspace isolation.

## Build Order

Sprint 1A:
Dashboard shell

Sprint 1B:
Customer Vault

Sprint 1C:
Upload System
