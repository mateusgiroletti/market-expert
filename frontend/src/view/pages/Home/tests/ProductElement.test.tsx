import "@testing-library/jest-dom";
import { render, screen } from "@testing-library/react";
import { describe, expect, it, } from "vitest";
import { MemoryRouter } from "react-router-dom";
import ProductElement from "../components/ProductElement";

describe('ProductElement Component', () => {
    it('renders product element with correct data', () => {
        const product = {
            id: 1,
            name: 'Product 1',
            price: 20,
        };

        render(
            <MemoryRouter>
                <ProductElement product={product} />
            </MemoryRouter>
        );

        const productNameElement = screen.getByText('Product 1');
        expect(productNameElement).toBeInTheDocument();

        const productPriceElement = screen.getByText('R$ 20,00');
        expect(productPriceElement).toBeInTheDocument();

        const addProductTypeButton = screen.getByText('Adicionar Tipo de produto');
        expect(addProductTypeButton).toBeInTheDocument();

        expect(addProductTypeButton.closest('a')).toHaveAttribute('href', '/new-product-type?productId=1');
    });
});
