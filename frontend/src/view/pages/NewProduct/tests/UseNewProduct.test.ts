import "@testing-library/jest-dom";
import { renderHook, act } from "@testing-library/react";
import { beforeAll, describe, expect, it, vi } from "vitest";

import { useNewProduct } from '../useNewProduct';
import { useNavigate } from 'react-router-dom';
import { productService } from "../../../../app/services/products";

vi.mock('react-router-dom', () => ({
    useNavigate: vi.fn()
}));

vi.mock('../../../../app/services/products', () => ({
    productService: {
        create: vi.fn()
    }
}));

describe('useNewProduct hook', () => {
    beforeAll(() => {
        (useNavigate).mockReset();
        (productService.create).mockReset();
    });

    it('updates name state correctly', () => {
        const { result } = renderHook(() => useNewProduct());

        act(() => {
            result.current.handleNameChange({ target: { value: 'New Product' } } as React.ChangeEvent<HTMLInputElement>);
        });

        expect(result.current.name).toBe('New Product');
    });

    it('updates price state correctly', () => {
        const { result } = renderHook(() => useNewProduct());

        act(() => {
            result.current.handlePriceChange({ target: { value: '20' } } as React.ChangeEvent<HTMLInputElement>);
        });

        expect(result.current.price).toBe(20);
    });


    it('submits form correctly with valid data', async () => {
        const { result } = renderHook(() => useNewProduct());
        const navigateMock = vi.fn();

        (useNavigate).mockReturnValue(navigateMock);

        act(() => {
            result.current.handleNameChange({ target: { value: 'New Product' } } as unknown as React.ChangeEvent<HTMLInputElement>);
        });
        act(() => {
            result.current.handlePriceChange({ target: { value: '20' } } as unknown as React.ChangeEvent<HTMLInputElement>);
        });

        await act(async () => {
            await result.current.handleSubmit({ preventDefault: vi.fn() } as unknown as React.FormEvent<HTMLFormElement>);
        });

        expect(productService.create).toHaveBeenCalledWith({ name: 'New Product', price: 20 });
        expect(navigateMock).toHaveBeenCalledWith('/');
    });


    it('handles form submission correctly with invalid data', async () => {
        const { result } = renderHook(() => useNewProduct());
        const alertMock = vi.spyOn(window, 'alert').mockImplementation();
        (productService.create as SpyInstanceFn).mockRejectedValueOnce(new Error('Validation error'));

        await act(async () => {
            await result.current.handleSubmit({ preventDefault: vi.fn() } as unknown as React.FormEvent<HTMLFormElement>);
        });

        expect(alertMock).toHaveBeenCalledWith('Erro nos campos');
    });
});
