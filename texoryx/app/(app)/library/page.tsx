import { db } from "@/lib/db";
import { UploadPanel } from "@/components/library/upload-panel";
import { Card } from "@/components/ui/card";

export default async function LibraryPage() {
  const files = await db.fileAsset.findMany({ orderBy: { updatedAt: "desc" }, include: { customer: true, tags: { include: { tag: true } } } });
  return (
    <div className="space-y-5">
      <div><h1 className="text-4xl font-black">Design Library</h1><p className="text-stone-400">Versioned embroidery files, art files, production metadata, tags, and favorites.</p></div>
      <UploadPanel />
      <div className="grid gap-4 lg:grid-cols-3">
        {files.map((file) => (
          <Card key={file.id}>
            <div className="flex items-start justify-between"><h2 className="text-lg font-bold">{file.name}</h2><span className="status-pill">{file.extension.toUpperCase()}</span></div>
            <p className="mt-2 text-sm text-stone-400">{file.customer?.name ?? "Shared library"}</p>
            <p className="mt-4 text-sm text-stone-500">{file.stitchCount ? `${file.stitchCount.toLocaleString()} stitches` : "Metadata extraction pending"}</p>
            <div className="mt-3 flex flex-wrap gap-2">{file.threadColors.map((color) => <span key={color} className="rounded-full bg-white/5 px-2 py-1 text-xs">{color}</span>)}</div>
          </Card>
        ))}
      </div>
    </div>
  );
}
