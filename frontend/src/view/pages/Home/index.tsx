import { Link } from "react-router-dom";

import ProductList from "./components/ProductList";

export default function Home() {
    return (
        <div className="container mx-auto py-8">
            <div className="flex justify-between">
                <Link
                    to="/new-product"
                    className="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded"
                >
                    Adicionar Novo Produto
                </Link>
                <Link
                    to="/new-sale"
                    className="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded"
                >
                    Nova Venda
                </Link>
            </div>

            <ProductList />
        </div>
    )
}