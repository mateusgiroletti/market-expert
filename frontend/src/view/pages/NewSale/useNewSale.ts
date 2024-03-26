import { useCallback, useEffect, useState } from "react";
import { Product } from "../../../app/entities/Product";
import { productService } from "../../../app/services/products";
import { saleService } from "../../../app/services/sales";

export interface saleItenInterface {
    productId: number;
    name: string;
    price: number;
    quantity: number;
    totalTaxPercentage: number;
}

export default function useNewSale() {
    const [products, setProducts] = useState<Product[]>([]);
    const [selectedProduct, setSelectedProduct] = useState('');
    const [quantity, setQuantity] = useState(1);
    const [items, setItems] = useState<saleItenInterface[]>([]);

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

    async function handleAddItem() {
        if (selectedProduct) {
            const productResponse = await productService.getById(parseInt(selectedProduct));

            if (productResponse) {
                const product = {
                    productId: productResponse.id,
                    name: productResponse.name,
                    price: productResponse.price,
                    quantity,
                    totalTaxPercentage: productResponse.total_percentage_tax
                }

                setItems([...items, product]);
            }
        }
    };

    async function handleNewSale() {
        try {

            if (items.length === 0) {
                alert('Favor inserir ao mínimo um item a venda!');
                return;
            }

            const createSalesParams = {
                products: items.map(item => ({
                    product_id: item.productId,
                    amount: item.quantity
                })),
            };

            await saleService.create(createSalesParams);

            alert('Venda cadastrada com sucesso!');
        } catch (error) {
            alert('Erro ao cadastrar venda!');
            console.log(error);
        }
    }

    return {
        selectedProduct,
        setSelectedProduct,
        products,
        quantity,
        setQuantity,
        handleAddItem,
        handleNewSale,
        items
    }
}