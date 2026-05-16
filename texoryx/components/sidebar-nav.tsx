import Link from "next/link";
import { Boxes, CheckCircle2, FolderKanban, Gauge, Library, Settings, Users } from "lucide-react";

const navItems = [
  { href: "/dashboard", label: "Dashboard", icon: Gauge, enabled: true },
  { href: "/dashboard", label: "Customers", icon: Users, enabled: false },
  { href: "/dashboard", label: "Library", icon: Library, enabled: false },
  { href: "/dashboard", label: "Projects", icon: FolderKanban, enabled: false },
  { href: "/dashboard", label: "Production", icon: Boxes, enabled: false },
  { href: "/dashboard", label: "Approvals", icon: CheckCircle2, enabled: false },
  { href: "/dashboard", label: "Settings", icon: Settings, enabled: false }
];

export function SidebarNav() {
  return (
    <aside className="border-r border-white/10 bg-black/55 p-5 backdrop-blur">
      <div className="mb-8">
        <p className="text-xs uppercase tracking-[0.45em] text-red-300">Texoryx OS</p>
        <h1 className="mt-2 text-3xl font-black tracking-tight">Texoryx</h1>
        <p className="mt-2 text-xs text-stone-500">Sprint 1A dashboard shell</p>
      </div>
      <nav className="space-y-2" aria-label="Primary navigation">
        {navItems.map((item) => (
          <Link
            key={item.label}
            href={item.href}
            aria-disabled={!item.enabled}
            className={`flex items-center justify-between rounded-2xl px-4 py-3 text-sm transition ${
              item.enabled ? "bg-red-950/30 text-white" : "cursor-not-allowed text-stone-600"
            }`}
          >
            <span className="flex items-center gap-3">
              <item.icon className={item.enabled ? "h-4 w-4 text-red-400" : "h-4 w-4 text-stone-700"} />
              {item.label}
            </span>
            {!item.enabled ? <span className="text-[10px] uppercase tracking-widest text-stone-700">Soon</span> : null}
          </Link>
        ))}
      </nav>
    </aside>
  );
}
