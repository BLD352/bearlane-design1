import { auth, currentUser } from "@clerk/nextjs/server";
import { db } from "@/lib/db";

export type WorkspaceContext = {
  clerkUserId: string;
  workspaceId: string;
};

export async function requireWorkspace(): Promise<WorkspaceContext> {
  const { userId, orgId } = await auth();

  if (!userId) {
    throw new Response("Unauthorized", { status: 401 });
  }

  const user = await currentUser();
  const email = user?.primaryEmailAddress?.emailAddress ?? `${userId}@texoryx.local`;
  const name = user?.fullName ?? user?.username ?? "Texoryx User";
  const imageUrl = user?.imageUrl;

  const workspace = orgId
    ? await db.workspace.upsert({
        where: { clerkOrgId: orgId },
        create: { clerkOrgId: orgId, name: "Texoryx Workspace" },
        update: {}
      })
    : await db.workspace.upsert({
        where: { ownerClerkId: userId },
        create: { ownerClerkId: userId, name: "Personal Workspace" },
        update: {}
      });

  await db.user.upsert({
    where: { clerkId: userId },
    create: {
      clerkId: userId,
      workspaceId: workspace.id,
      email,
      name,
      imageUrl,
      role: "OWNER"
    },
    update: {
      workspaceId: workspace.id,
      email,
      name,
      imageUrl
    }
  });

  return { clerkUserId: userId, workspaceId: workspace.id };
}
