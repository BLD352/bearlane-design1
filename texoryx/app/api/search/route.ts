import { NextResponse } from "next/server";
import { Role } from "@prisma/client";
import { requireRole } from "@/lib/auth";
import { searchClient } from "@/lib/search";

export async function GET(request: Request) {
  await requireRole("PRODUCTION_OPERATOR" as Role);
  const { searchParams } = new URL(request.url);
  const q = searchParams.get("q") ?? "";
  const [projects, files] = await Promise.all([
    searchClient.index("texoryx_projects").search(q, { limit: 8 }),
    searchClient.index("texoryx_files").search(q, { limit: 8 })
  ]);
  return NextResponse.json({ projects: projects.hits, files: files.hits });
}
