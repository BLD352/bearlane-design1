import { UserButton } from "@clerk/nextjs";

export function Topbar() {
  return (
    <header className="flex items-center justify-between border-b border-white/10 bg-black/30 px-6 py-4 backdrop-blur">
      <div>
        <p className="text-sm text-stone-400">Embroidery • DTF • Apparel production</p>
        <h2 className="text-xl font-semibold">Dashboard</h2>
      </div>
      <UserButton />
    </header>
  );
}
