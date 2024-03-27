import "@testing-library/jest-dom";
import { render, screen, waitFor, renderHook } from "@testing-library/react";
import { describe, expect, it, vi, beforeAll, afterAll } from "vitest";
import { MemoryRouter } from "react-router-dom";

import ProductList from "../components/ProductList";
import * as useProductListHook from "../components/ProductList/useProductList";

describe('ProductList Component', () => {
    it('renders product list with products', async () => {
        const useProductListSpy = vi.spyOn(useProductListHook, "useProductList");

        useProductListSpy.mockReturnValue({
            products: [
                { id: 1, name: 'Product 1', price: 10 },
            ]
        });

        const { result } = renderHook(() => useProductListHook.useProductList());

        render(
            <MemoryRouter>
                <ProductList />
            </MemoryRouter>
        );

        const titleElement = screen.getByText('Lista de Produtos');
        expect(titleElement).toBeInTheDocument();

        const productListElement = screen.getByTestId('product-list-component');
        expect(productListElement).toBeInTheDocument();

        await waitFor(() => {
            expect(result.current.products.length).toEqual(1);

            result.current.products.forEach(product => {
                const productElement = screen.getByText(product.name);
                expect(productElement).toBeInTheDocument();
            });
        });
    });
});
