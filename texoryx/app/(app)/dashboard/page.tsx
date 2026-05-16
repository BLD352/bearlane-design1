import { DashboardOverview } from "@/components/dashboard/dashboard-overview";
import { getDashboardCounts, type DashboardCounts } from "@/lib/dashboard";
import { requireWorkspace } from "@/lib/workspace";

export const dynamic = "force-dynamic";

async function loadCounts(): Promise<DashboardCounts | null> {
  try {
    const { workspaceId } = await requireWorkspace();
    return getDashboardCounts(workspaceId);
  } catch {
    return null;
  }
}

export default async function DashboardPage() {
  const counts = await loadCounts();

  return (
    <div className="space-y-6">
      <section className="industrial-card overflow-hidden p-8">
        <p className="text-xs uppercase tracking-[0.45em] text-red-300">Sprint 1A</p>
        <h1 className="mt-3 text-4xl font-black tracking-tight text-stone-50">Texoryx dashboard shell</h1>
        <p className="mt-3 max-w-2xl text-stone-400">
          Authenticated layout, sidebar navigation, topbar, workspace-isolated dashboard API, and stat cards are the only active scope in Sprint 1A.
          Customer Vault and Upload System stay disabled until this shell is stable.
        </p>
      </section>

      <DashboardOverview counts={counts} />
    </div>
  );
}
