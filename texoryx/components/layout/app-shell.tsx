import Link from "next/link";
import { UserButton } from "@clerk/nextjs";
import { Gauge, Users, Library } from "lucide-react";

const nav = [
  { href: "/dashboard", label: "Dashboard", icon: Gauge },
  { href: "/customers", label: "Customer Vault", icon: Users },
  { href: "/library", label: "Upload Library", icon: Library }
];

export function AppShell({ children }: { children: React.ReactNode }) {
  return (
    <div className="min-h-screen lg:grid lg:grid-cols-[280px_1fr]">
      <aside className="border-r border-white/10 bg-black/55 p-5 backdrop-blur">
        <div className="mb-8">
          <p className="text-xs uppercase tracking-[0.45em] text-red-300">ThreadVault OS</p>
          <h1 className="mt-2 text-3xl font-black tracking-tight">ThreadVault</h1>
        </div>
        <nav className="space-y-2">
          {nav.map((item) => (
            <Link key={item.href} href={item.href} className="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm text-stone-300 transition hover:bg-white/8 hover:text-white">
              <item.icon className="h-4 w-4 text-red-400" />
              {item.label}
            </Link>
          ))}
        </nav>
      </aside>
      <main className="min-w-0">
        <header className="flex items-center justify-between border-b border-white/10 bg-black/30 px-6 py-4 backdrop-blur">
          <div>
            <p className="text-sm text-stone-400">Embroidery workflow + customer vault + production OS</p>
            <h2 className="text-xl font-semibold">Sprint 1A Dashboard Shell</h2>
          </div>
          <UserButton />
        </header>
        <div className="p-6">{children}</div>
      </main>
    </div>
  );
}
