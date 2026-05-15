import { z } from "zod";

export const customerSchema = z.object({
  name: z.string().min(2),
  company: z.string().optional(),
  phone: z.string().optional(),
  email: z.string().email(),
  notes: z.string().optional(),
  preferredGarmentTypes: z.array(z.string()).default([]),
  preferredThreadColors: z.array(z.string()).default([])
});

export const projectSchema = z.object({
  customerId: z.string().min(1),
  title: z.string().min(2),
  description: z.string().optional(),
  deadline: z.string().optional(),
  orderQuantity: z.coerce.number().int().positive().default(1),
  priority: z.coerce.number().int().min(1).max(5).default(2),
  productionNotes: z.string().optional()
});

export const approvalResponseSchema = z.object({
  status: z.enum(["APPROVED", "REJECTED"]),
  comment: z.string().optional(),
  referenceUrl: z.string().url().optional()
});
