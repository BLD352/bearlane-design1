import { auth } from "@clerk/nextjs/server";
import { db } from "@/lib/db";
import { StatCard } from "@/components/dashboard/stat-card";
import { Card } from "@/components/ui/card";

function formatActionLabel(action: string) {
  return action
    .toLowerCase()
    .replaceAll("_", " ")
    .replace(/\b\w/g, (match) => match.toUpperCase());
}

export default async function DashboardPage() {
  const { userId } = await auth();

  const user = userId
    ? await db.user.findUnique({
        where: { clerkId: userId },
        select: { id: true, role: true, name: true }
      })
    : null;

  if (!user) {
    return (
      <div className="space-y-6">
        <div>
          <h1 className="text-3xl font-black tracking-tight">Dashboard Shell</h1>
          <p className="text-stone-400">Sign in to view your production workspace snapshot.</p>
        </div>
      </div>
    );
  }

  const since = new Date(Date.now() - 1000 * 60 * 60 * 24);

  const [activeProjects, pendingApprovals, recentUploads, productionBlockers, recentActivity] = await Promise.all([
    db.project.count({
      where: {
        status: { notIn: ["COMPLETED", "ARCHIVED"] },
        OR: [{ approvals: { some: { reviewerId: user.id } } }, { productionJobs: { some: { operatorId: user.id } } }]
      }
    }),
    db.approval.count({ where: { status: "PENDING", reviewerId: user.id } }),
    db.fileAsset.count({
      where: {
        createdAt: { gte: since },
        project: { approvals: { some: { reviewerId: user.id } } }
      }
    }),
    db.project.count({
      where: {
        status: "REVISION_REQUESTED",
        approvals: { some: { reviewerId: user.id } }
      }
    }),
    db.activityLog.findMany({
      where: { actorId: user.id },
      orderBy: { createdAt: "desc" },
      take: 8,
      include: { customer: true, project: true }
    })
  ]);

  return (
    <div className="space-y-6">
      <div>
        <h1 className="text-3xl font-black tracking-tight">Dashboard Shell</h1>
        <p className="text-stone-400">Sprint 1A production snapshot for {user.name ?? "your account"}.</p>
      </div>

      <section className="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <StatCard label="Active Projects" value={activeProjects} detail="Projects tied to your queue" />
        <StatCard label="Pending Approvals" value={pendingApprovals} detail="Proof responses waiting" />
        <StatCard label="Recent Uploads" value={recentUploads} detail="Files uploaded in last 24h" />
        <StatCard label="Production Blockers" value={productionBlockers} detail="Revision-requested jobs" />
      </section>

      <Card>
        <h2 className="mb-4 text-xl font-bold">Recent activity</h2>
        <div className="space-y-3">
          {recentActivity.length === 0 ? (
            <p className="text-sm text-stone-400">No activity recorded yet.</p>
          ) : (
            recentActivity.map((item) => (
              <div key={item.id} className="rounded-xl border border-white/10 bg-black/20 p-3 text-sm text-stone-300">
                <p className="font-medium text-white">{formatActionLabel(item.action)}</p>
                <p className="text-stone-400">
                  {item.project?.title ?? "No project"}
                  {item.customer?.name ? ` • ${item.customer.name}` : ""}
                </p>
              </div>
            ))
          )}
        </div>
      </Card>
    </div>
  );
}
