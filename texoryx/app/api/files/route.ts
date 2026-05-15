import crypto from "node:crypto";
import { NextResponse } from "next/server";
import { Role } from "@prisma/client";
import { requireRole } from "@/lib/auth";
import { db } from "@/lib/db";
import { assertSupportedUpload, createUploadUrl } from "@/lib/storage";
import { indexFile } from "@/lib/search";

export async function GET() {
  await requireRole("PRODUCTION_OPERATOR" as Role);
  const files = await db.fileAsset.findMany({ orderBy: { updatedAt: "desc" }, include: { customer: true, project: true, tags: { include: { tag: true } } } });
  return NextResponse.json(files);
}

export async function POST(request: Request) {
  const actor = await requireRole("DESIGNER" as Role);
  const body = await request.json() as { name: string; sizeBytes: number; mimeType?: string; customerId?: string; projectId?: string };
  const extension = assertSupportedUpload(body.name);
  const key = `incoming/${crypto.randomUUID()}.${extension}`;
  const uploadUrl = await createUploadUrl(key, body.mimeType ?? "application/octet-stream");
  const file = await db.fileAsset.create({
    data: {
      name: body.name,
      extension,
      mimeType: body.mimeType,
      sizeBytes: body.sizeBytes,
      r2Key: key,
      customerId: body.customerId,
      projectId: body.projectId,
      kind: ["dst", "pes", "exp", "vp3", "xxx", "jef"].includes(extension) ? "EMBROIDERY" : "ARTWORK",
      versions: { create: { version: 1, r2Key: key, sizeBytes: body.sizeBytes } }
    }
  });
  await db.activityLog.create({ data: { actorId: actor.id, customerId: body.customerId, projectId: body.projectId, action: "file.upload.requested", metadata: { key, name: body.name } } });
  await indexFile({ id: file.id, name: file.name, extension, stitchCount: file.stitchCount, threadColors: file.threadColors });
  return NextResponse.json({ file, uploadUrl }, { status: 201 });
}
