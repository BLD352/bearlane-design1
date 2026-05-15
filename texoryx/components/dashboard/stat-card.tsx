import { Card } from "@/components/ui/card";

export function StatCard({ label, value, detail }: { label: string; value: string | number; detail: string }) {
  return (
    <Card>
      <p className="text-sm text-stone-400">{label}</p>
      <p className="mt-3 text-4xl font-black tracking-tight">{value}</p>
      <p className="mt-2 text-sm text-stone-500">{detail}</p>
    </Card>
  );
}
