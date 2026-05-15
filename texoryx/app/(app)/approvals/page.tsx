import { db } from "@/lib/db";
import { Card } from "@/components/ui/card";

export default async function ApprovalsPage() {
  const approvals = await db.approval.findMany({ orderBy: { createdAt: "desc" }, include: { customer: true, project: true, file: true } });
  return <div className="space-y-5"><div><h1 className="text-4xl font-black">Approval Center</h1><p className="text-stone-400">Shareable proof links, customer decisions, comments, references, and history.</p></div><div className="grid gap-4 xl:grid-cols-3">{approvals.map((approval) => <Card key={approval.id}><span className="status-pill">{approval.status}</span><h2 className="mt-4 text-xl font-bold">{approval.project.title}</h2><p className="text-sm text-stone-400">{approval.customer.email}</p><p className="mt-4 break-all text-xs text-stone-500">/proof/{approval.token}</p></Card>)}</div></div>;
}
