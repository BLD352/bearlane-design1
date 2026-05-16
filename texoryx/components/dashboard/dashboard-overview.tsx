import { StatCard } from "@/components/stat-card";
import type { DashboardCounts } from "@/lib/dashboard";

type DashboardOverviewProps = {
  counts: DashboardCounts | null;
};

const emptyCounts = {
  customers: "—",
  activeProjects: "—",
  pendingApprovals: "—",
  productionQueue: "—"
};

export function DashboardOverview({ counts }: DashboardOverviewProps) {
  const values = counts ?? emptyCounts;
  const isEmpty = !counts || Object.values(counts).every((value) => value === 0);

  return (
    <div className="space-y-6">
      <section className="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <StatCard label="Customers" value={values.customers} detail="Customer records in this workspace" />
        <StatCard label="Active Projects" value={values.activeProjects} detail="Projects not completed or archived" />
        <StatCard label="Pending Approvals" value={values.pendingApprovals} detail="Proof decisions awaiting review" />
        <StatCard label="Production Queue" value={values.productionQueue} detail="Ready, running, or QC jobs" />
      </section>

      {isEmpty ? (
        <section className="industrial-card border-dashed p-8 text-center">
          <p className="text-lg font-semibold text-stone-100">No production data yet</p>
          <p className="mx-auto mt-2 max-w-2xl text-sm text-stone-400">
            Sprint 1A only proves the authenticated shell and workspace-isolated dashboard counts. Customer Vault and Upload System setup start after this dashboard is stable.
          </p>
        </section>
      ) : null}
    </div>
  );
}
