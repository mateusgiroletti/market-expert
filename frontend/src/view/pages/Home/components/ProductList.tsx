import { useCallback, useEffect, useState } from "react";

import { productService } from "../../../../app/services/products";
import { Product } from "../../../../app/entities/Product";

import ProductElement from "./ProductElement";

export default function ProductList() {
    const [products, setProducts] = useState<Product[]>([]);

    const loadProducts = useCallback(async () => {
        try {
            const productList = await productService.getAll();

            setProducts(productList);
        } catch (error) {
            if (error instanceof DOMException && error.name === "AbortError") {
                return;
            }

            setProducts([]);
        }
    }, []);

    useEffect(() => {
        loadProducts();
    }, [loadProducts]);

    return (
        <div className="container mx-auto py-8">
            <h1 className="text-3xl font-bold mb-4">Lista de Produtos</h1>
            <div className="grid grid-cols-3 gap-4">
                {products.map(product => (
                    <ProductElement
                        key={product.id}
                        product={product}
                    />
                ))}
            </div>
        </div>
    )
}