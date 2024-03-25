import { Link } from "react-router-dom";
import { Product } from "../../../../../app/entities/Product";
import formatToCurrencyBRL from "../../../../../helpers/formatToCurrencyBRL";

interface Productprops {
    product: Product
}

export default function ProductElement({ product }: Productprops) {
    return (
        <div className="bg-white rounded-lg shadow-md p-4 flex justify-between items-center">
            <div>
                <h2 className="text-xl font-bold mb-2">{product.name}</h2>
                <p className="text-gray-900 font-bold mt-2">{formatToCurrencyBRL(product.price)}</p>
            </div>
            <Link
                to={`/new-product-type?productId=${product.id}`}
                className="bg-blue-500 hover:bg-blue-600 focus:outline-none focus:bg-blue-600 text-white py-2 px-4 rounded"
            >
                Adicionar Tipo de produto
            </Link>
        </div>
    );
}