import { Link } from "react-router-dom";
import { useNewProduct } from "./useNewProduct";
import { Button } from "../../components/Button";
import { Input } from "../../components/Input";

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

                        <Input
                            type="text"
                            id="name"
                            value={name}
                            onChange={handleNameChange}
                        />

                    </div>
                    <div className="mb-4">
                        <label
                            htmlFor="price"
                            className="block text-gray-700">
                            Preço:
                        </label>
                        <Input
                            type="number"
                            id="price"
                            value={price}
                            onChange={handlePriceChange}
                        />
                    </div>
                    <div className="flex justify-around">
                        <Link to="/">
                            <Button
                                type="submit"
                                variant="blue"
                            >
                                Voltar
                            </Button>
                        </Link>

                        <Button
                            type="submit"
                            variant="green"
                        >
                            Criar
                        </Button>
                    </div>
                </form>
            </div>
        </div >
    )
}