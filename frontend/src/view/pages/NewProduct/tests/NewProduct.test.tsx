import "@testing-library/jest-dom";
import { MemoryRouter } from "react-router-dom";
import { render, screen, fireEvent } from "@testing-library/react";
import { describe, expect, it, vi } from "vitest";
import { createMemoryHistory } from "history";

import NewProduct from "..";
import * as useNewProductHook from "../useNewProduct";


describe("New Product", () => {
    it('renders new product form with inputs and buttons', () => {
        const useNewProductListSpy = vi.spyOn(useNewProductHook, "useNewProduct");

        const mockName = 'Product 1';
        const mockPrice = 10.5;
        const mockHandleNameChange = vi.fn();
        const mockHandlePriceChange = vi.fn();
        const mockHandleSubmit = vi.fn();

        useNewProductListSpy.mockReturnValue({
            handleSubmit: mockHandleSubmit,
            name: mockName,
            handleNameChange: mockHandleNameChange,
            price: mockPrice,
            handlePriceChange: mockHandlePriceChange,
        });

        render(
            <MemoryRouter>
                <NewProduct />
            </MemoryRouter>
        );

        const titleElement = screen.getByText('Criar Produto');
        expect(titleElement).toBeInTheDocument();

        const nameInput = screen.getByLabelText('Nome:');
        expect(nameInput).toBeInTheDocument();
        expect(nameInput).toHaveValue(mockName);

        const priceInput = screen.getByLabelText('Preço:');
        expect(priceInput).toBeInTheDocument();
        expect(priceInput).toHaveValue(mockPrice);

        const backButton = screen.getByText('Voltar');
        expect(backButton).toBeInTheDocument();

        const createButton = screen.getByText('Criar');
        expect(createButton).toBeInTheDocument();
    });

    it('calls handleSubmit when "Criar" button is clicked', () => {
        const useNewProductListSpy = vi.spyOn(useNewProductHook, "useNewProduct");
        const mockHandleSubmit = vi.fn();

        useNewProductListSpy.mockReturnValue({
            handleSubmit: mockHandleSubmit,
            name: '',
            handleNameChange: vi.fn(),
            price: 0,
            handlePriceChange: vi.fn(),
        });

        render(
            <MemoryRouter>
                <NewProduct />
            </MemoryRouter>
        );

        const createButton = screen.getByText('Criar');
        fireEvent.click(createButton);

        expect(mockHandleSubmit).toHaveBeenCalledTimes(1);
    });

    it('navigates to home when "Voltar" button is clicked', () => {
        const history = createMemoryHistory();

        render(
            <MemoryRouter>
                <NewProduct />
            </MemoryRouter>
        );

        const backButton = screen.getByText('Voltar');
        fireEvent.click(backButton);

        expect(history.location.pathname).toBe('/');
    });
})