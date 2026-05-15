import { NextResponse } from "next/server";
import { Role } from "@prisma/client";
import { requireRole } from "@/lib/auth";
import { db } from "@/lib/db";
import { customerSchema } from "@/lib/validators";

export async function GET() {
  await requireRole("PRODUCTION_OPERATOR" as Role);
  const customers = await db.customer.findMany({ orderBy: { updatedAt: "desc" }, include: { _count: { select: { projects: true, files: true } } } });
  return NextResponse.json(customers);
}

export async function POST(request: Request) {
  const actor = await requireRole("MANAGER" as Role);
  const payload = customerSchema.parse(await request.json());
  const customer = await db.customer.create({ data: payload });
  await db.activityLog.create({ data: { actorId: actor.id, customerId: customer.id, action: "customer.created", metadata: { email: customer.email } } });
  return NextResponse.json(customer, { status: 201 });
}
