import { useCallback, useEffect, useState } from "react";
import { Product } from "../../../../../app/entities/Product";
import { productService } from "../../../../../app/services/products";

export default function useProductList() {
    const [products, setProducts] = useState<Product[]>([]);

    const loadProducts = useCallback(async () => {
        try {
            const productList = await productService.getAll();

            setProducts(productList);
        } catch (error) {
            setProducts([]);
        }
    }, []);

    useEffect(() => {
        loadProducts();
    }, [loadProducts]);

    return { products }
}