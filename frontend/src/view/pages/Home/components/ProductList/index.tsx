import ProductElement from "../ProductElement";
import useProductList from "./useProductList";

export default function ProductList() {
    const { products } = useProductList();

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