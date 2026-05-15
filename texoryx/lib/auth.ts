import { auth } from "@clerk/nextjs/server";
import { Role } from "@prisma/client";
import { db } from "@/lib/db";

const roleRank: Record<Role, number> = {
  CUSTOMER: 0,
  PRODUCTION_OPERATOR: 1,
  DESIGNER: 2,
  MANAGER: 3,
  OWNER: 4
};

export async function currentUserRecord() {
  const { userId } = await auth();
  if (!userId) return null;
  return db.user.findUnique({ where: { clerkId: userId } });
}

export async function requireRole(minimum: Role) {
  const user = await currentUserRecord();
  if (!user || roleRank[user.role] < roleRank[minimum]) {
    throw new Response("Forbidden", { status: 403 });
  }
  return user;
}
