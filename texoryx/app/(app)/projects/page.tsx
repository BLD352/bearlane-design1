import Link from "next/link";
import { db } from "@/lib/db";
import { Card } from "@/components/ui/card";

export default async function ProjectsPage() {
  const projects = await db.project.findMany({ orderBy: [{ deadline: "asc" }, { updatedAt: "desc" }], include: { customer: true, approvals: true, productionJobs: true } });
  return (
    <div className="space-y-5">
      <div><h1 className="text-4xl font-black">Projects + Orders</h1><p className="text-stone-400">Drafts, proof links, revision loops, approved production work, QC, and repeats.</p></div>
      <div className="grid gap-4 xl:grid-cols-3">
        {projects.map((project) => (
          <Link key={project.id} href={`/projects/${project.id}`}>
            <Card className="h-full transition hover:border-red-900/70">
              <div className="flex items-center justify-between"><span className="status-pill">{project.status.replaceAll("_", " ")}</span><span className="text-sm text-stone-500">Qty {project.orderQuantity}</span></div>
              <h2 className="mt-4 text-2xl font-bold">{project.title}</h2>
              <p className="text-sm text-stone-400">{project.customer.company ?? project.customer.name}</p>
              <p className="mt-4 text-sm text-stone-500">Deadline: {project.deadline?.toLocaleDateString() ?? "Not scheduled"}</p>
            </Card>
          </Link>
        ))}
      </div>
    </div>
  );
}
