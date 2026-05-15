import { db } from "@/lib/db";
import { Card } from "@/components/ui/card";

export default async function CustomersPage() {
  const customers = await db.customer.findMany({ orderBy: { updatedAt: "desc" }, include: { _count: { select: { projects: true, files: true, approvals: true } } } });
  return (
    <div className="space-y-5">
      <div><h1 className="text-4xl font-black">Customer Vault</h1><p className="text-stone-400">Profiles, logo assets, repeat orders, preferred garments, and thread palettes.</p></div>
      <div className="grid gap-4 xl:grid-cols-3">
        {customers.map((customer) => (
          <Card key={customer.id}>
            <p className="text-xs uppercase tracking-widest text-red-300">{customer.company ?? "Individual"}</p>
            <h2 className="mt-2 text-2xl font-bold">{customer.name}</h2>
            <p className="text-sm text-stone-400">{customer.email} {customer.phone ? `• ${customer.phone}` : ""}</p>
            <div className="mt-5 grid grid-cols-3 gap-2 text-center text-sm">
              <span className="rounded-xl bg-white/5 p-2">{customer._count.projects} projects</span>
              <span className="rounded-xl bg-white/5 p-2">{customer._count.files} files</span>
              <span className="rounded-xl bg-white/5 p-2">{customer._count.approvals} proofs</span>
            </div>
          </Card>
        ))}
      </div>
    </div>
  );
}
