import "@testing-library/jest-dom";
import { render, screen, fireEvent } from "@testing-library/react";
import { describe, expect, it, vi } from "vitest";

import PercentualInput from "../components/PercentualInput";

describe("PercentualInput component", () => {
    it('renders input with correct value', () => {
        const value = 10;
        const onChange = vi.fn();
        const onRemove = vi.fn();

        render(
            <PercentualInput
                value={value}
                onChange={onChange}
                onRemove={onRemove}
            />
        );

        const inputElement = screen.getByTestId('percentual-input');
        expect(inputElement).toBeInTheDocument();

        const inputValueElement = screen.getByTestId('input-id');
        expect(inputValueElement).toHaveValue(value);

    });

    it('calls onChange with new value when input changes', () => {
        const value = 10;
        const onChange = vi.fn();
        const onRemove = vi.fn();

        render(
            <PercentualInput
                value={value}
                onChange={onChange}
                onRemove={onRemove}
            />
        );

        const inputElement = screen.getByTestId('input-id');
        fireEvent.change(inputElement, { target: { value: '15' } });

        expect(onChange).toHaveBeenCalledWith(15);
    });

    it('calls onRemove when remove button is clicked', () => {
        const value = 10;
        const onChange = vi.fn();
        const onRemove = vi.fn();

        render(
            <PercentualInput
                value={value}
                onChange={onChange}
                onRemove={onRemove}
            />
        );

        const removeButton = screen.getByRole('button', { name: 'Remover' });
        fireEvent.click(removeButton);

        expect(onRemove).toHaveBeenCalled();
    });
})