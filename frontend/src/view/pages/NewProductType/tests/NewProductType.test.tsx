import "@testing-library/jest-dom";
import { MemoryRouter } from "react-router-dom";
import { render, screen, fireEvent } from "@testing-library/react";
import { describe, expect, it, vi } from "vitest";
import { createMemoryHistory } from "history";

import NewProductType from "..";
import * as useNewProductTypeHook from "../useNewProductType";

describe("New Product Type", () => {
    it('renders form with inputs and buttons', () => {
        const useNewProductTypeSpy = vi.spyOn(useNewProductTypeHook, "useNewProductType");

        useNewProductTypeSpy.mockReturnValue({
            handleSubmit: vi.fn(),
            handleNameChange: vi.fn(),
            percentages: [],
            handlePercentualChange: vi.fn(),
            handleRemovePercentualInputComponent: vi.fn(),
            addPercentualInputComponent: vi.fn(),
        });

        render(
            <MemoryRouter>
                <NewProductType />
            </MemoryRouter>
        );

        expect(screen.getByText('Criar Tipo de produto')).toBeInTheDocument();
        expect(screen.getByLabelText('Nome:')).toBeInTheDocument();
        expect(screen.getByText('Adicionar Novo Percentual')).toBeInTheDocument();
        expect(screen.getByText('Voltar')).toBeInTheDocument();
        expect(screen.getByText('Criar')).toBeInTheDocument();
    });

    it('calls handleSubmit when "Criar" button is clicked', () => {
        const useNewProductTypeSpy = vi.spyOn(useNewProductTypeHook, "useNewProductType");

        const mockHandleSubmit = vi.fn();

        useNewProductTypeSpy.mockReturnValue({
            handleSubmit: mockHandleSubmit,
            handleNameChange: vi.fn(),
            percentages: [],
            handlePercentualChange: vi.fn(),
            handleRemovePercentualInputComponent: vi.fn(),
            addPercentualInputComponent: vi.fn(),
        });

        render(
            <MemoryRouter>
                <NewProductType />
            </MemoryRouter>
        );

        fireEvent.click(screen.getByText('Criar'));

        expect(mockHandleSubmit).toHaveBeenCalledTimes(1);
    });

    it('navigates to home when "Voltar" button is clicked', () => {
        const history = createMemoryHistory();

        render(
            <MemoryRouter>
                <NewProductType />
            </MemoryRouter>
        );

        const backButton = screen.getByText('Voltar');
        fireEvent.click(backButton);

        expect(history.location.pathname).toBe('/');
    });
})