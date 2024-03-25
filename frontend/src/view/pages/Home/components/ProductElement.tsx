import { Link } from "react-router-dom";
import { Product } from "../../../../app/entities/Product";
import { PlusCircle } from "@phosphor-icons/react";

interface Productprops {
    product: Product
}

export default function ProductElement({ product }: Productprops) {
    return (
        <div className="bg-white rounded-lg shadow-md p-4 flex justify-between items-center">
            <div>
                <h2 className="text-xl font-bold mb-2">{product.name}</h2>
                <p className="text-gray-900 font-bold mt-2">${product.price}</p>
            </div>
            <Link to={`/new-product-type?productId=${product.id}`}>
                <PlusCircle className="h-8 w-8 text-blue-500 cursor-pointer" />
            </Link>
        </div>
    );
}