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
  const { orgId } = await auth();

  const [activeProjects, pendingApprovals, recentUploads, recentActivity] = await Promise.all([
    db.project.count({ where: { status: { notIn: ["COMPLETED", "ARCHIVED"] } } }),
    db.approval.count({ where: { status: "PENDING" } }),
    db.fileAsset.count({ where: { createdAt: { gte: new Date(Date.now() - 1000 * 60 * 60 * 24) } } }),
    db.activityLog.findMany({
      orderBy: { createdAt: "desc" },
      take: 8,
      include: { customer: true, project: true }
    })
  ]);

  return (
    <div className="space-y-6">
      <div>
        <h1 className="text-3xl font-black tracking-tight">Dashboard Shell</h1>
        <p className="text-stone-400">
          Sprint 1A foundation for approvals, uploads, and production activity.
          {orgId ? ` Workspace: ${orgId}` : " Workspace: personal context"}.
        </p>
      </div>

      <section className="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <StatCard label="Active Projects" value={activeProjects} detail="Projects in progress" />
        <StatCard label="Pending Approvals" value={pendingApprovals} detail="Awaiting customer decision" />
        <StatCard label="Recent Uploads" value={recentUploads} detail="Files uploaded in last 24h" />
        <StatCard label="Production Blockers" value="—" detail="Placeholder for 1B/1C production logic" />
      </section>

      <Card>
        <h2 className="mb-4 text-xl font-bold">Recent activity</h2>
        <div className="space-y-3">
          {recentActivity.length === 0 ? (
            <p className="text-sm text-stone-400">No activity yet for this workspace.</p>
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
