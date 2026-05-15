import { notFound } from "next/navigation";
import { db } from "@/lib/db";
import { Card } from "@/components/ui/card";

export default async function ProjectDetailPage({ params }: { params: Promise<{ id: string }> }) {
  const { id } = await params;
  const project = await db.project.findUnique({ where: { id }, include: { customer: true, files: true, approvals: true, productionJobs: true, notes: true, activityLogs: { orderBy: { createdAt: "desc" }, take: 20 } } });
  if (!project) notFound();
  return (
    <div className="space-y-5">
      <div className="flex flex-wrap items-start justify-between gap-3">
        <div><span className="status-pill">{project.status.replaceAll("_", " ")}</span><h1 className="mt-3 text-4xl font-black">{project.title}</h1><p className="text-stone-400">{project.customer.name} • {project.orderQuantity} pieces</p></div>
        <p className="rounded-2xl border border-white/10 bg-black/25 px-4 py-3 text-sm">Proof: {project.proofToken ? `/proof/${project.proofToken}` : "Not generated"}</p>
      </div>
      <section className="grid gap-4 xl:grid-cols-[1fr_.8fr]">
        <Card><h2 className="text-xl font-bold">Production notes</h2><p className="mt-3 whitespace-pre-wrap text-stone-300">{project.productionNotes ?? "No notes yet."}</p></Card>
        <Card><h2 className="text-xl font-bold">Machine setup</h2>{project.productionJobs.map((job) => <div key={job.id} className="mt-3 rounded-xl bg-white/5 p-3 text-sm">{job.machineName ?? "Machine unassigned"} • {job.stage} • {job.runQuantity} pcs</div>)}</Card>
      </section>
      <section className="grid gap-4 xl:grid-cols-3"><Card><h2 className="text-xl font-bold">Files</h2>{project.files.map((file) => <p key={file.id} className="mt-2 text-sm text-stone-400">{file.name}</p>)}</Card><Card><h2 className="text-xl font-bold">Approvals</h2>{project.approvals.map((approval) => <p key={approval.id} className="mt-2 text-sm text-stone-400">{approval.status} • {approval.comment ?? "No comment"}</p>)}</Card><Card><h2 className="text-xl font-bold">Timeline</h2>{project.activityLogs.map((log) => <p key={log.id} className="mt-2 text-sm text-stone-400">{log.action}</p>)}</Card></section>
    </div>
  );
}
