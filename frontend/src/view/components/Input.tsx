import { ComponentProps } from "react";
import { cn } from "../../helpers/cn";

interface InputProps extends ComponentProps<"input"> {
    variant?: "blue" | "green"| "red";
}

export function Input({
    className,
    variant,
    ...props
}: InputProps) {
    return (
        <input
            data-testid="input"
            {...props}
            className={cn(
                "w-full px-3 py-2 border rounded shadow-sm",
                variant === "blue" &&
                "bg-blue-500 hover:bg-blue-600 focus:bg-blue-600",
                variant === "green" &&
                "bg-green-500 hover:bg-green-600 focus:bg-green-600",
                variant === "red" &&
                "bg-red-500 hover:bg-red-600 focus:bg-red-600",
                className,
            )}
        >
        </input>
    );
}
