import { Link } from "react-router-dom";
import SaleSummary from "./components/SaleSummary";
import { useNewSale } from "./useNewSale";

export default function NewSale() {
    const {
        selectedProduct,
        setSelectedProduct,
        products,
        quantity,
        setQuantity,
        handleAddItem,
        handleNewSale,
        items
    } = useNewSale();

    return (
        <div className="flex-col justify-center items-center">
            <div className="flex justify-center items-center">
                <div className="w-full max-w-lg mt-8">
                    <h1 className="text-2xl mb-4">Nova Venda</h1>
                    <div className="mb-4">
                        <label
                            htmlFor="product"
                            className="block text-gray-700"
                        >
                            Selecione o Produto:
                        </label>
                        <select
                            id="product"
                            value={selectedProduct}
                            onChange={(e) => setSelectedProduct(e.target.value)}
                            className="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:border-blue-500"
                        >
                            <option value="">Selecione um produto</option>
                            {products.map(product => (
                                <option key={product.id} value={product.id}>{product.name}</option>
                            ))}
                        </select>
                    </div>
                    <div className="mb-4">
                        <label
                            htmlFor="quantity"
                            className="block text-gray-700"
                        >Quantidade:
                        </label>
                        <input
                            type="number"
                            id="quantity"
                            value={quantity}
                            onChange={(e) => setQuantity(parseInt(e.target.value))}
                            className="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:border-blue-500"
                        />
                    </div>
                    <button
                        onClick={handleAddItem}
                        className="mb-4 w-full bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 focus:outline-none focus:bg-green-600">
                        Adicionar Item
                    </button>
                    <div className="flex justify-around">
                        <Link
                            to="/"
                            className="bg-blue-500 hover:bg-blue-600 focus:outline-none focus:bg-blue-600 text-white py-2 px-16 rounded">
                            Voltar
                        </Link>
                        <button
                            onClick={handleNewSale}

                            className="bg-green-500 hover:bg-green-600 focus:outline-none focus:bg-green-600 text-white py-2 px-16 rounded">
                            Criar
                        </button>
                    </div>
                </div>
            </div>
            <div className="container mx-auto py-8">
                <SaleSummary
                    itens={items}
                />
            </div>
        </div>
    );
}