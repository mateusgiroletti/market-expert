import { Link } from "react-router-dom";
import PercentualInput from "./components/PercentualInput";
import { useNewProductType } from "./useNewProductType";
import { Button } from "../../components/Button";
import { Input } from "../../components/Input";

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
                        <Input
                            type="text"
                            id="name"
                            onChange={handleNameChange}
                            className="focus:outline-none focus:border-blue-500"
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

                    <Button
                        type="button"
                        variant="green"
                        className="mb-4 w-full"
                        onClick={addPercentualInputComponent}
                    >
                        Adicionar Novo Percentual
                    </Button>

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
        </div>
    )
}
