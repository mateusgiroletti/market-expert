import "@testing-library/jest-dom";
import { MemoryRouter } from "react-router-dom";
import { render, screen } from "@testing-library/react";
import { describe, expect, it } from "vitest";

import SaleSummary from "../components/SaleSummary";

import { saleItenInterface } from "../useNewSale";

const mockItens: saleItenInterface[] = [
    { productId: 1, name: 'Product 1', price: 10, quantity: 2, totalTaxPercentage: 10 },
    { productId: 1, name: 'Product 2', price: 20, quantity: 1, totalTaxPercentage: 15 }
];

describe("SaleSummary Component", () => {
    it('renders sale summary correctly', () => {
        render(
            <MemoryRouter>
                <SaleSummary itens={mockItens} />
            </MemoryRouter>
        );

        expect(screen.getByText('Product 1')).toBeInTheDocument();
        expect(screen.getByText('R$ 10,00')).toBeInTheDocument();
        expect(screen.getByText('2')).toBeInTheDocument();
        expect(screen.getByText('R$ 22,00')).toBeInTheDocument();
        expect(screen.getByText('R$ 2,00')).toBeInTheDocument();

        expect(screen.getByText('Product 2')).toBeInTheDocument();
        expect(screen.getByText('R$ 20,00')).toBeInTheDocument();
        expect(screen.getByText('1')).toBeInTheDocument();
        expect(screen.getByText('R$ 23,00')).toBeInTheDocument();
        expect(screen.getByText('R$ 3,00')).toBeInTheDocument();

        expect(screen.getByText('Total da Compra:')).toBeInTheDocument();
        expect(screen.getByText('R$ 45,00')).toBeInTheDocument();

        expect(screen.getByText('Total de Impostos:')).toBeInTheDocument();
        expect(screen.getByText('R$ 5,00')).toBeInTheDocument();
    });
})