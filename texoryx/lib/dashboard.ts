import { db } from "@/lib/db";

export type DashboardCounts = {
  customers: number;
  activeProjects: number;
  pendingApprovals: number;
  productionQueue: number;
};

export async function getDashboardCounts(workspaceId: string): Promise<DashboardCounts> {
  const [customers, activeProjects, pendingApprovals, productionQueue] = await Promise.all([
    db.customer.count({ where: { workspaceId } }),
    db.project.count({ where: { workspaceId, status: { notIn: ["COMPLETED", "ARCHIVED"] } } }),
    db.approval.count({ where: { workspaceId, status: "PENDING" } }),
    db.productionJob.count({ where: { workspaceId, stage: { in: ["READY", "RUNNING", "QC"] } } })
  ]);

  return { customers, activeProjects, pendingApprovals, productionQueue };
}
