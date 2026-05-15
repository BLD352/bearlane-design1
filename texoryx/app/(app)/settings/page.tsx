import { Card } from "@/components/ui/card";

export default function SettingsPage() {
  return <div className="space-y-5"><div><h1 className="text-4xl font-black">Settings</h1><p className="text-stone-400">Team roles, Clerk invites, R2 storage, Meilisearch, machines, and production defaults.</p></div><div className="grid gap-4 xl:grid-cols-2"><Card><h2 className="text-xl font-bold">Roles</h2><p className="mt-2 text-stone-400">Owner, manager, production operator, designer, and customer permissions are enforced in API routes.</p></Card><Card><h2 className="text-xl font-bold">Upload pipeline</h2><p className="mt-2 text-stone-400">Browser → temporary signed R2 upload → virus validation → metadata extraction → database write → preview generation.</p></Card></div></div>;
}
