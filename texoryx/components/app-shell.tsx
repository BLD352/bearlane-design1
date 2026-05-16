import type { ReactNode } from "react";
import { SidebarNav } from "@/components/sidebar-nav";
import { Topbar } from "@/components/topbar";

export function AppShell({ children }: { children: ReactNode }) {
  return (
    <div className="min-h-screen lg:grid lg:grid-cols-[280px_1fr]">
      <SidebarNav />
      <main className="min-w-0">
        <Topbar />
        <div className="p-6">{children}</div>
      </main>
    </div>
  );
}
