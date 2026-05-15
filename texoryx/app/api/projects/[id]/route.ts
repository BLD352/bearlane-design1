import { NextResponse } from "next/server";
import { Role } from "@prisma/client";
import { requireRole } from "@/lib/auth";
import { db } from "@/lib/db";

export async function GET(_: Request, { params }: { params: Promise<{ id: string }> }) {
  await requireRole("PRODUCTION_OPERATOR" as Role);
  const { id } = await params;
  const project = await db.project.findUnique({
    where: { id },
    include: { customer: true, files: { include: { tags: { include: { tag: true } } } }, approvals: true, productionJobs: true, notes: true, activityLogs: { orderBy: { createdAt: "desc" } } }
  });
  if (!project) return new Response("Not found", { status: 404 });
  return NextResponse.json(project);
}
