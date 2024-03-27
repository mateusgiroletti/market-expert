import { ComponentProps } from "react";
import { cn } from "../../helpers/cn";

interface ButtonProps extends ComponentProps<"button"> {
    variant: "blue" | "green"| "red";
}
export function Button({
    className,
    children,
    variant,
    ...props
}: ButtonProps) {
    return (
        <button
            data-testid="button"
            {...props}
            className={cn(
                "focus:outline-none text-white py-2 px-16 rounded",
                variant === "blue" &&
                "bg-blue-500 hover:bg-blue-600 focus:bg-blue-600",
                variant === "green" &&
                "bg-green-500 hover:bg-green-600 focus:bg-green-600",
                variant === "red" &&
                "bg-red-500 hover:bg-red-600 focus:bg-red-600",
                className,
            )}
        >
            {children}
        </button>
    );
}
