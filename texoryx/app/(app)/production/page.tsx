import { db } from "@/lib/db";
import { QueueBoard } from "@/components/production/queue-board";

export default async function ProductionPage() {
  const jobs = await db.productionJob.findMany({ orderBy: [{ stage: "asc" }, { sortOrder: "asc" }], include: { project: { include: { customer: true } } } });
  return <div className="space-y-5"><div><h1 className="text-4xl font-black">Production Queue</h1><p className="text-stone-400">Ready, running, QC, and completed machine workflow with hoop and needle settings.</p></div><QueueBoard jobs={jobs} /></div>;
}
