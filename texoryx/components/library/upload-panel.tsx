"use client";

import { useState } from "react";
import { Button } from "@/components/ui/button";

export function UploadPanel() {
  const [status, setStatus] = useState("Ready for DST, PES, EXP, VP3, XXX, JEF, SVG, PNG, JPG, and PDF.");

  async function upload(file: File) {
    setStatus("Creating secure R2 upload URL...");
    const response = await fetch("/api/files", {
      method: "POST",
      headers: { "content-type": "application/json" },
      body: JSON.stringify({ name: file.name, sizeBytes: file.size, mimeType: file.type || "application/octet-stream" })
    });
    if (!response.ok) throw new Error(await response.text());
    const { uploadUrl } = await response.json();
    setStatus("Uploading to Cloudflare R2...");
    await fetch(uploadUrl, { method: "PUT", body: file, headers: { "content-type": file.type || "application/octet-stream" } });
    setStatus("Uploaded. Virus validation, metadata extraction, and preview generation are queued.");
  }

  return (
    <div className="industrial-card border-dashed p-8 text-center">
      <p className="text-lg font-semibold">Drop production art or embroidery files</p>
      <p className="mt-2 text-sm text-stone-400">{status}</p>
      <label className="mt-5 inline-block">
        <input className="hidden" type="file" onChange={(event) => event.target.files?.[0] && upload(event.target.files[0])} />
        <Button type="button">Select file</Button>
      </label>
    </div>
  );
}
