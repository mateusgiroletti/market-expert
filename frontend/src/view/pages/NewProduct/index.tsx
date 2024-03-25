import { Link } from "react-router-dom";
import useNewProduct from "./useNewProduct";

export default function NewProduct() {
    const { handleSubmit, name, handleNameChange, price, handlePriceChange } = useNewProduct();

    return (
        <div className="flex justify-center items-center">
            <div className="w-full max-w-lg mt-8">
                <h1 className="text-2xl mb-4">Criar Produto</h1>
                <form onSubmit={handleSubmit}>
                    <div className="mb-4">
                        <label
                            htmlFor="name"
                            className="block text-gray-700"
                        >
                            Nome:
                        </label>
                        <input
                            type="text"
                            id="name"
                            value={name}
                            onChange={handleNameChange}
                            className="w-full px-3 py-2 border rounded shadow-sm"
                        />
                    </div>
                    <div className="mb-4">
                        <label
                            htmlFor="price"
                            className="block text-gray-700">
                            Preço:
                        </label>
                        <input
                            type="number"
                            id="price"
                            value={price}
                            onChange={handlePriceChange}
                            className="w-full px-3 py-2 border rounded shadow-sm"
                        />
                    </div>
                    <div className="flex justify-around">
                        <Link
                            to="/"
                            className="bg-blue-500 hover:bg-blue-600 focus:outline-none focus:bg-blue-600 text-white py-2 px-16 rounded">
                            Voltar
                        </Link>
                        <button
                            type="submit"
                            className="bg-green-500 hover:bg-green-600 focus:outline-none focus:bg-green-600 text-white py-2 px-16 rounded">
                            Criar
                        </button>
                    </div>
                </form>
            </div>
        </div >
    )
}