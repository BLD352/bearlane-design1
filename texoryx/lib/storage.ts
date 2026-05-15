import { PutObjectCommand, S3Client } from "@aws-sdk/client-s3";
import { getSignedUrl } from "@aws-sdk/s3-request-presigner";

export const r2 = new S3Client({
  region: "auto",
  endpoint: `https://${process.env.R2_ACCOUNT_ID}.r2.cloudflarestorage.com`,
  credentials: {
    accessKeyId: process.env.R2_ACCESS_KEY_ID ?? "",
    secretAccessKey: process.env.R2_SECRET_ACCESS_KEY ?? ""
  }
});

export function assertSupportedUpload(filename: string) {
  const extension = filename.split(".").pop()?.toLowerCase();
  const supported = ["dst", "pes", "exp", "vp3", "xxx", "jef", "svg", "png", "jpg", "jpeg", "pdf"];
  if (!extension || !supported.includes(extension)) throw new Error("Unsupported Texoryx file type");
  return extension;
}

export async function createUploadUrl(key: string, contentType: string) {
  const command = new PutObjectCommand({
    Bucket: process.env.R2_BUCKET,
    Key: key,
    ContentType: contentType,
    Metadata: { pipeline: "temporary-virus-scan-metadata-preview" }
  });
  return getSignedUrl(r2, command, { expiresIn: 300 });
}
