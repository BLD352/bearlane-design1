import { NextResponse } from "next/server";
import { Role } from "@prisma/client";
import { requireRole } from "@/lib/auth";
import { db } from "@/lib/db";
import { customerSchema } from "@/lib/validators";

export async function GET(_: Request, { params }: { params: Promise<{ id: string }> }) {
  await requireRole("PRODUCTION_OPERATOR" as Role);
  const { id } = await params;
  const customer = await db.customer.findUnique({
    where: { id },
    include: { projects: { orderBy: { updatedAt: "desc" } }, files: true, activityLogs: { orderBy: { createdAt: "desc" }, take: 25 } }
  });
  if (!customer) return new Response("Not found", { status: 404 });
  return NextResponse.json(customer);
}

export async function PATCH(request: Request, { params }: { params: Promise<{ id: string }> }) {
  const actor = await requireRole("MANAGER" as Role);
  const { id } = await params;
  const payload = customerSchema.partial().parse(await request.json());
  const customer = await db.customer.update({ where: { id }, data: payload });
  await db.activityLog.create({ data: { actorId: actor.id, customerId: id, action: "customer.updated" } });
  return NextResponse.json(customer);
}
