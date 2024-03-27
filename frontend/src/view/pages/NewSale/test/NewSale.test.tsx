import "@testing-library/jest-dom";
import { MemoryRouter } from "react-router-dom";
import { render, screen } from "@testing-library/react";
import { describe, expect, it } from "vitest";

import NewSale from "..";

describe("New Sale", () => {
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
})