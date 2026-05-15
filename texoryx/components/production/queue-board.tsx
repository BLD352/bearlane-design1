import { ProductionStage } from "@prisma/client";
import { Card } from "@/components/ui/card";

type QueueJob = {
  id: string;
  stage: ProductionStage;
  machineName: string | null;
  runQuantity: number;
  estimatedMinutes: number;
  project: { title: string; customer: { name: string; company: string | null } };
};

const stages: ProductionStage[] = ["READY", "RUNNING", "QC", "COMPLETED"];

export function QueueBoard({ jobs }: { jobs: QueueJob[] }) {
  return (
    <div className="grid gap-4 xl:grid-cols-4">
      {stages.map((stage) => (
        <Card key={stage} className="min-h-96">
          <div className="mb-4 flex items-center justify-between">
            <h3 className="font-bold">{stage.replace("_", " ")}</h3>
            <span className="status-pill">{jobs.filter((job) => job.stage === stage).length}</span>
          </div>
          <div className="space-y-3">
            {jobs.filter((job) => job.stage === stage).map((job) => (
              <div key={job.id} className="rounded-2xl border border-white/10 bg-black/30 p-4">
                <p className="font-semibold">{job.project.title}</p>
                <p className="text-sm text-stone-400">{job.project.customer.company ?? job.project.customer.name}</p>
                <div className="mt-3 flex justify-between text-xs text-stone-500">
                  <span>{job.machineName ?? "Unassigned machine"}</span>
                  <span>{job.runQuantity} pcs • {job.estimatedMinutes}m</span>
                </div>
              </div>
            ))}
          </div>
        </Card>
      ))}
    </div>
  );
}
