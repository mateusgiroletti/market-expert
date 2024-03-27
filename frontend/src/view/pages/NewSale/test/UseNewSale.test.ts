import "@testing-library/jest-dom";
import { renderHook, act, waitFor } from "@testing-library/react";
import { beforeAll, describe, expect, it, vi } from "vitest";

import { productService } from "../../../../app/services/products";
import { useNewSale } from "../useNewSale";

vi.mock('../../../../app/services/products', () => ({
    productService: {
        getAll: vi.fn(),
        getById: vi.fn()
    }
}));

describe('UseNewSale hook', () => {
    beforeAll(() => {
        vi.clearAllMocks();
    });

    it('loads products on mount', async () => {
        (productService.getAll).mockResolvedValue([{ id: 1, name: 'Product 1', price: 10 }]);
        const { result } = renderHook(() => useNewSale());


        await waitFor(() => {
            expect(result.current.products).toHaveLength(1);
            expect(result.current.products[0].name).toBe('Product 1');
        })
    });

    it('adds item to items list when handleAddItem is called', async () => {
        (productService.getById).mockResolvedValue({ id: 1, name: 'Product 1', price: 10, total_percentage_tax: 5 });
        const { result } = renderHook(() => useNewSale());

        await waitFor(() => {
            act(() => {
                result.current.setSelectedProduct('1');
                result.current.setQuantity(2);
                result.current.handleAddItem();
            })

            expect(result.current.items).toHaveLength(1);
            expect(result.current.items[0].name).toBe('Product 1');
            expect(result.current.items[0].quantity).toBe(2);
            expect(result.current.items[0].totalTaxPercentage).toBe(5);
        })
    });
});
