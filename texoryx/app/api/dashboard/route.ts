import { NextResponse } from "next/server";
import { getDashboardCounts } from "@/lib/dashboard";
import { requireWorkspace } from "@/lib/workspace";

export async function GET() {
  try {
    const { workspaceId } = await requireWorkspace();
    const counts = await getDashboardCounts(workspaceId);

    return NextResponse.json({ counts });
  } catch (error) {
    if (error instanceof Response) {
      return error;
    }

    return NextResponse.json(
      {
        counts: null,
        error: "Dashboard counts are unavailable. Confirm Prisma is generated, migrations are applied, and DATABASE_URL is reachable."
      },
      { status: 503 }
    );
  }
}
