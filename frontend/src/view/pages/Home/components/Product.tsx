export default function Product({ product }) {
    return (
        <div className="bg-white rounded-lg shadow-md p-4">
            <h2 className="text-xl font-bold mb-2">{product.name}</h2>
            <p className="text-gray-900 font-bold mt-2">${product.price}</p>
        </div>
    );
}