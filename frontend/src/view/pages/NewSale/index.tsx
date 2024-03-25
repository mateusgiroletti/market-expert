import { useCallback, useEffect, useState } from "react";
import { productService } from "../../../app/services/products";
import { Product } from "../../../app/entities/Product";
import SaleSummary from "./components/SaleSummary";
import { saleService } from "../../../app/services/sales";

export default function NewSale() {
    const [products, setProducts] = useState<Product[]>([]);
    const [selectedProduct, setSelectedProduct] = useState('');
    const [quantity, setQuantity] = useState(1);
    const [items, setItems] = useState([]);

    // Função para buscar os produtos no servidor
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

            if(items.length === 0){
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

    return (
        <div className="container mx-auto py-8">
            <h1 className="text-3xl font-bold mb-4">Nova Venda</h1>
            <div>
                <div className="mb-4">
                    <label htmlFor="product" className="block text-gray-700">Selecione o Produto:</label>
                    <select id="product" value={selectedProduct} onChange={(e) => setSelectedProduct(e.target.value)} className="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:border-blue-500">
                        <option value="">Selecione um produto</option>
                        {products.map(product => (
                            <option key={product.id} value={product.id}>{product.name}</option>
                        ))}
                    </select>
                </div>
                <div className="mb-4">
                    <label htmlFor="quantity" className="block text-gray-700">Quantidade:</label>
                    <input type="number" id="quantity" value={quantity} onChange={(e) => setQuantity(parseInt(e.target.value))} className="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:border-blue-500" />
                </div>
                <button onClick={handleAddItem} className="mb-4 w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Adicionar Item</button>
                <button onClick={handleNewSale} className="mb-4 w-full bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 focus:outline-none focus:bg-green-600">Salvar Venda</button>
                <SaleSummary items={items} />
            </div>
        </div>
    );
}