import "@testing-library/jest-dom";
import { MemoryRouter } from "react-router-dom";
import { render, screen, fireEvent, waitFor } from "@testing-library/react";
import { beforeAll, describe, expect, it, vi } from "vitest";

import NewSale from "..";
import * as useNewSaleHook from "../useNewSale";

describe("New Sale", () => {
    beforeAll(() => {
        const useNewSaleSpy = vi.spyOn(useNewSaleHook, "useNewSale");

        useNewSaleSpy.mockReturnValue({
            selectedProduct: '1',
            setSelectedProduct: vi.fn(),
            products: [{ id: 1, price: 10, name: 'Product 1' }, { id: 1, price: 20, name: 'Product 2' }],
            quantity: 2,
            setQuantity: vi.fn(),
            handleAddItem: vi.fn(),
            handleNewSale: vi.fn(),
            items: [{ productId: 1, name: 'Product 1', price: 10, quantity: 2, totalTaxPercentage: 10 }]
        });
    });

    it('renders NewSale component correctly', () => {
        render(
            <MemoryRouter>
                <NewSale />
            </MemoryRouter>
        );

        // Verifica se os elementos estão sendo renderizados corretamente
        expect(screen.getByText('Nova Venda')).toBeInTheDocument();
        expect(screen.getByLabelText('Selecione o Produto:')).toBeInTheDocument();
        expect(screen.getByLabelText('Quantidade:')).toBeInTheDocument();
        expect(screen.getByRole('button', { name: 'Adicionar Item' })).toBeInTheDocument();
        expect(screen.getByRole('button', { name: 'Voltar' })).toBeInTheDocument();
        expect(screen.getByRole('button', { name: 'Criar' })).toBeInTheDocument();
        expect(screen.getByTestId('sale-summary')).toBeInTheDocument();
    });

    it('calls setSelectedProduct when select product is changed', async () => {

        render(
            <MemoryRouter>
                <NewSale />
            </MemoryRouter>
        );

        const selectElement = screen.getByTestId('select-product');
        fireEvent.change(selectElement, { target: { value: '2' } });

        waitFor(() => {
            expect(useNewSaleSpy().setSelectedProduct).toHaveBeenCalledWith('2');
        })
    });

    it('calls setQuantity when quantity input is changed', async () => {
        render(
            <MemoryRouter>
                <NewSale />
            </MemoryRouter>
        );

        const quantityInput = screen.getByLabelText('Quantidade:');
        fireEvent.change(quantityInput, { target: { value: '5' } });

        waitFor(() => {
            expect(useNewSaleSpy().setQuantity).toHaveBeenCalledWith(5);
        })
    });
})