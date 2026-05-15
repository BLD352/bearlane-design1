import { clsx } from "clsx";
import { ButtonHTMLAttributes } from "react";

export function Button({ className, ...props }: ButtonHTMLAttributes<HTMLButtonElement>) {
  return (
    <button
      className={clsx(
        "rounded-xl bg-red-800 px-4 py-2 text-sm font-semibold text-red-50 shadow-lg shadow-red-950/30 transition hover:bg-red-700 disabled:opacity-50",
        className
      )}
      {...props}
    />
  );
}
