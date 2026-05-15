import { notFound } from "next/navigation";
import { db } from "@/lib/db";
import { Card } from "@/components/ui/card";

export default async function ProofPage({ params }: { params: Promise<{ token: string }> }) {
  const { token } = await params;
  const approval = await db.approval.findUnique({ where: { token }, include: { customer: true, project: true, file: true } });
  if (!approval) notFound();
  return <main className="mx-auto max-w-3xl p-6"><Card><p className="text-xs uppercase tracking-[0.4em] text-red-300">Texoryx proof</p><h1 className="mt-3 text-4xl font-black">{approval.project.title}</h1><p className="mt-2 text-stone-400">For {approval.customer.name}. Review the production proof, leave revision notes, or approve for production.</p><div className="mt-6 rounded-3xl border border-white/10 bg-black/30 p-8 text-center">{approval.file?.name ?? "Proof artwork attached in shop workflow"}</div><p className="mt-4 text-sm text-stone-500">Current status: {approval.status}</p></Card></main>;
}
