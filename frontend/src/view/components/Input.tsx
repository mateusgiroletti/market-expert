import { ComponentProps } from "react";
import { cn } from "../../helpers/cn";

export function Input({
    className,
    ...props
}: ComponentProps<"input">) {
    return (
        <input
            data-testid="input"
            {...props}
            className={cn(
                "w-full px-3 py-2 border rounded shadow-sm",
                className,
            )}
        >
        </input>
    );
}
