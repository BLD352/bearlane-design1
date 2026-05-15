import Link from "next/link";
import { db } from "@/lib/db";
import { StatCard } from "@/components/dashboard/stat-card";
import { Card } from "@/components/ui/card";
import { Button } from "@/components/ui/button";

export default async function DashboardPage() {
  const today = new Date();
  today.setHours(23, 59, 59, 999);
  const [todaysJobs, pendingApprovals, recentUploads, productionQueue, activeProjects, activity] = await Promise.all([
    db.project.count({ where: { deadline: { lte: today }, status: { in: ["APPROVED", "PRODUCTION", "QC"] } } }),
    db.approval.count({ where: { status: "PENDING" } }),
    db.fileAsset.findMany({ orderBy: { createdAt: "desc" }, take: 5 }),
    db.productionJob.findMany({ where: { stage: { in: ["READY", "RUNNING"] } }, take: 6, include: { project: { include: { customer: true } } } }),
    db.project.count({ where: { status: { notIn: ["COMPLETED", "ARCHIVED"] } } }),
    db.activityLog.findMany({ orderBy: { createdAt: "desc" }, take: 8, include: { customer: true, project: true } })
  ]);

  return (
    <div className="space-y-6">
      <div className="flex flex-wrap items-center justify-between gap-3">
        <div>
          <h1 className="text-4xl font-black tracking-tight">Today&apos;s floor</h1>
          <p className="text-stone-400">Approvals, repeats, machine queue, and customer activity in one place.</p>
        </div>
        <div className="flex gap-2">
          <Link href="/customers"><Button>Quick add customer</Button></Link>
          <Link href="/library"><Button className="bg-stone-800 hover:bg-stone-700">Upload file</Button></Link>
        </div>
      </div>
      <section className="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <StatCard label="Today's Jobs" value={todaysJobs} detail="Due or active on the production floor" />
        <StatCard label="Pending Approvals" value={pendingApprovals} detail="Customer proof decisions outstanding" />
        <StatCard label="Production Queue" value={productionQueue.length} detail="Ready or running machine jobs" />
        <StatCard label="Active Projects" value={activeProjects} detail="Open jobs excluding completed archives" />
      </section>
      <section className="grid gap-4 xl:grid-cols-[1.2fr_.8fr]">
        <Card>
          <h2 className="mb-4 text-xl font-bold">Machine queue</h2>
          <div className="space-y-3">
            {productionQueue.map((job) => (
              <div key={job.id} className="flex items-center justify-between rounded-2xl border border-white/10 bg-black/25 p-4">
                <div><p className="font-semibold">{job.project.title}</p><p className="text-sm text-stone-400">{job.project.customer.company ?? job.project.customer.name}</p></div>
                <span className="status-pill">{job.stage}</span>
              </div>
            ))}
          </div>
        </Card>
        <Card>
          <h2 className="mb-4 text-xl font-bold">Recent uploads</h2>
          <div className="space-y-3">
            {recentUploads.map((file) => <p key={file.id} className="rounded-xl bg-white/5 p-3 text-sm">{file.name}</p>)}
          </div>
        </Card>
      </section>
      <Card>
        <h2 className="mb-4 text-xl font-bold">Customer activity</h2>
        <div className="grid gap-2 md:grid-cols-2">
          {activity.map((item) => <p key={item.id} className="text-sm text-stone-400">{item.action} {item.project?.title ? `• ${item.project.title}` : ""}</p>)}
        </div>
      </Card>
    </div>
  );
}
