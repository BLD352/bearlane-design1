import { NextResponse } from "next/server";
import { Role } from "@prisma/client";
import { requireRole } from "@/lib/auth";
import { db } from "@/lib/db";

export async function GET() {
  await requireRole("PRODUCTION_OPERATOR" as Role);
  const jobs = await db.productionJob.findMany({ orderBy: [{ stage: "asc" }, { sortOrder: "asc" }], include: { project: { include: { customer: true } }, operator: true, machineSetting: true } });
  return NextResponse.json(jobs);
}

export async function PATCH(request: Request) {
  const actor = await requireRole("PRODUCTION_OPERATOR" as Role);
  const body = await request.json() as { id: string; stage?: "READY" | "RUNNING" | "QC" | "COMPLETED"; machineName?: string; operatorId?: string };
  const job = await db.productionJob.update({ where: { id: body.id }, data: { stage: body.stage, machineName: body.machineName, operatorId: body.operatorId } });
  await db.activityLog.create({ data: { actorId: actor.id, projectId: job.projectId, action: "production.updated", metadata: { stage: job.stage } } });
  return NextResponse.json(job);
}
