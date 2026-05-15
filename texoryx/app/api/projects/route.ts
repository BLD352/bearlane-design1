import crypto from "node:crypto";
import { NextResponse } from "next/server";
import { Role } from "@prisma/client";
import { requireRole } from "@/lib/auth";
import { db } from "@/lib/db";
import { indexProject } from "@/lib/search";
import { projectSchema } from "@/lib/validators";

export async function GET() {
  await requireRole("PRODUCTION_OPERATOR" as Role);
  const projects = await db.project.findMany({ orderBy: [{ deadline: "asc" }, { updatedAt: "desc" }], include: { customer: true, productionJobs: true, approvals: true } });
  return NextResponse.json(projects);
}

export async function POST(request: Request) {
  const actor = await requireRole("MANAGER" as Role);
  const payload = projectSchema.parse(await request.json());
  const project = await db.project.create({
    data: {
      ...payload,
      deadline: payload.deadline ? new Date(payload.deadline) : undefined,
      proofToken: crypto.randomBytes(24).toString("hex"),
      productionJobs: { create: { runQuantity: payload.orderQuantity, estimatedMinutes: 30 } }
    },
    include: { customer: true }
  });
  await db.activityLog.create({ data: { actorId: actor.id, customerId: project.customerId, projectId: project.id, action: "project.created" } });
  await indexProject({ id: project.id, title: project.title, customer: project.customer.name, status: project.status, notes: project.productionNotes });
  return NextResponse.json(project, { status: 201 });
}
