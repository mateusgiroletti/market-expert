import "@testing-library/jest-dom";
import { MemoryRouter } from "react-router-dom";
import { render, screen } from "@testing-library/react";
import { describe, expect, it } from "vitest";
import Home from "..";

describe("Home Page", () => {
    it("should be able render Home component", () => {
        render(
            <MemoryRouter>
                <Home />
            </MemoryRouter>
        );
    });

    it("renders 'Nova venda' link", () => {
        render(
            <MemoryRouter>
                <Home />
            </MemoryRouter>
        );

        const novaVendaLink = screen.getByText('Nova Venda');
        expect(novaVendaLink).toBeInTheDocument();
        expect(novaVendaLink.getAttribute('href')).toBe('/new-sale');
    })

    it('renders ProductList component', () => {
        render(
            <MemoryRouter>
                <Home />
            </MemoryRouter>
        );

        const productList = screen.getByTestId('product-list');
        expect(productList).toBeInTheDocument();
    });
})