import { Webhook } from "svix";
import { headers } from "next/headers";
import { NextResponse } from "next/server";
import { db } from "@/lib/db";

type ClerkUserEvent = {
  type: "user.created" | "user.updated";
  data: { id: string; email_addresses: { email_address: string; id: string }[]; primary_email_address_id: string; first_name?: string; last_name?: string; image_url?: string };
};

export async function POST(request: Request) {
  const secret = process.env.CLERK_WEBHOOK_SECRET;
  if (!secret) return new Response("Missing webhook secret", { status: 500 });
  const headerStore = await headers();
  const payload = await request.text();
  const webhook = new Webhook(secret);
  const event = webhook.verify(payload, {
    "svix-id": headerStore.get("svix-id") ?? "",
    "svix-timestamp": headerStore.get("svix-timestamp") ?? "",
    "svix-signature": headerStore.get("svix-signature") ?? ""
  }) as ClerkUserEvent;

  if (["user.created", "user.updated"].includes(event.type)) {
    const email = event.data.email_addresses.find((item) => item.id === event.data.primary_email_address_id)?.email_address ?? event.data.email_addresses[0]?.email_address;
    await db.user.upsert({
      where: { clerkId: event.data.id },
      create: { clerkId: event.data.id, email, name: [event.data.first_name, event.data.last_name].filter(Boolean).join(" "), imageUrl: event.data.image_url, role: "CUSTOMER" },
      update: { email, name: [event.data.first_name, event.data.last_name].filter(Boolean).join(" "), imageUrl: event.data.image_url }
    });
  }

  return NextResponse.json({ ok: true });
}
