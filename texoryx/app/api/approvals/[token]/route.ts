import { NextResponse } from "next/server";
import { db } from "@/lib/db";
import { approvalResponseSchema } from "@/lib/validators";

export async function GET(_: Request, { params }: { params: Promise<{ token: string }> }) {
  const { token } = await params;
  const approval = await db.approval.findUnique({ where: { token }, include: { customer: true, project: true, file: true } });
  if (!approval) return new Response("Not found", { status: 404 });
  return NextResponse.json(approval);
}

export async function PATCH(request: Request, { params }: { params: Promise<{ token: string }> }) {
  const { token } = await params;
  const payload = approvalResponseSchema.parse(await request.json());
  const approval = await db.approval.update({ where: { token }, data: { ...payload, respondedAt: new Date() }, include: { project: true } });
  await db.project.update({ where: { id: approval.projectId }, data: { status: payload.status === "APPROVED" ? "APPROVED" : "REVISION_REQUESTED" } });
  await db.activityLog.create({ data: { customerId: approval.customerId, projectId: approval.projectId, action: `approval.${payload.status.toLowerCase()}`, metadata: { comment: payload.comment } } });
  return NextResponse.json(approval);
}
