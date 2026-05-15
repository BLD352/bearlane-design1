import crypto from "node:crypto";
import { NextResponse } from "next/server";
import { Role } from "@prisma/client";
import { requireRole } from "@/lib/auth";
import { db } from "@/lib/db";

export async function GET() {
  await requireRole("PRODUCTION_OPERATOR" as Role);
  const approvals = await db.approval.findMany({ orderBy: { createdAt: "desc" }, include: { customer: true, project: true, file: true } });
  return NextResponse.json(approvals);
}

export async function POST(request: Request) {
  const actor = await requireRole("MANAGER" as Role);
  const body = await request.json() as { customerId: string; projectId: string; fileId?: string; expiresAt?: string };
  const approval = await db.approval.create({
    data: { ...body, token: crypto.randomBytes(24).toString("hex"), expiresAt: body.expiresAt ? new Date(body.expiresAt) : undefined },
    include: { project: true, customer: true }
  });
  await db.project.update({ where: { id: body.projectId }, data: { status: "PROOF_SENT" } });
  await db.activityLog.create({ data: { actorId: actor.id, customerId: body.customerId, projectId: body.projectId, action: "approval.sent", metadata: { token: approval.token } } });
  return NextResponse.json({ ...approval, shareUrl: `${process.env.NEXT_PUBLIC_APP_URL}/proof/${approval.token}` }, { status: 201 });
}
