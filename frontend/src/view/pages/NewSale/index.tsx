import { Link } from "react-router-dom";
import SaleSummary from "./components/SaleSummary";
import { useNewSale } from "./useNewSale";
import { Button } from "../../components/Button";
import { Input } from "../../components/Input";

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
                            data-testid="select-product"
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
                        <Input
                            type="number"
                            id="quantity"
                            value={quantity}
                            onChange={(e) => setQuantity(parseInt(e.target.value))}
                            className="focus:outline-none focus:border-blue-500"
                        />
                    </div>
                    <Button
                        variant="green"
                        onClick={handleAddItem}
                        className="mb-4 w-full"
                    >
                        Adicionar Item
                    </Button>
                    <div className="flex justify-around">
                        <Link to="/">
                            <Button
                                variant="blue"
                            >
                                Voltar
                            </Button>
                        </Link>

                        <Button
                            variant="green"
                            onClick={handleNewSale}
                        >
                            Criar
                        </Button>
                    </div>
                </div>
            </div>
            <div className="container mx-auto py-8" data-testid="sale-summary">
                <SaleSummary
                    itens={items}
                />
            </div>
        </div>
    );
}