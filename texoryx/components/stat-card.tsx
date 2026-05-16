type StatCardProps = {
  label: string;
  value: number | string;
  detail: string;
};

export function StatCard({ label, value, detail }: StatCardProps) {
  return (
    <section className="industrial-card p-5">
      <p className="text-sm text-stone-400">{label}</p>
      <p className="mt-3 text-4xl font-black tracking-tight text-stone-50">{value}</p>
      <p className="mt-2 text-sm text-stone-500">{detail}</p>
    </section>
  );
}
