import { Link } from "react-router-dom";
import PercentualInput from "./components/PercentualInput";
import useNewProductType from "./useNewProductType";

export default function NewProductType() {
    const {
        handleSubmit,
        handleNameChange,
        percentages,
        handlePercentualChange,
        handleRemovePercentualInputComponent,
        addPercentualInputComponent
    } = useNewProductType();

    return (
        <div className="flex justify-center items-center">
            <div className="w-full max-w-lg mt-8">
                <h1 className="text-2xl mb-4">Criar Tipo de produto</h1>
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
                            onChange={handleNameChange}
                            className="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:border-blue-500"
                        />
                    </div>

                    {percentages.map((percentual, index) => (
                        <PercentualInput
                            key={index}
                            value={percentual}
                            onChange={(value) => handlePercentualChange(index, value)}
                            onRemove={() => handleRemovePercentualInputComponent(index)}
                        />
                    ))}

                    <button
                        type="button"
                        onClick={addPercentualInputComponent}
                        className="bg-green-500 hover:bg-green-600 focus:outline-none focus:bg-green-600 text-white py-2 rounded mb-4 w-full">
                        Adicionar Novo Percentual
                    </button>

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
        </div>
    )
}
