import { useEffect, useState } from "react";
import { z } from "zod";
import { useLocation, useNavigate } from "react-router-dom";
import PercentualInput from "./components/PercentualInput";
import { productTypeService } from "../../../app/services/productTypes";

const productTypeSchema = z.object({
    name: z.string().min(1, 'O campo Nome é obrigatório').max(100, 'Limite de 100 caracteres excedido!')
});

export default function NewProductType() {
    const location = useLocation();
    const searchParams = new URLSearchParams(location.search);
    const productId = searchParams.get("productId");

    const [name, setName] = useState<string>('');
    const [percentuais, setPercentuais] = useState<number[]>([0]);


    const navigate = useNavigate();

    function addPercentualInputComponent() {
        setPercentuais([...percentuais, 0]);
    }

    function handleNameChange(event: React.ChangeEvent<HTMLInputElement>) {
        setName(event.target.value);
    };

    function handlePercentualChange(index: number, value: number) {
        const newPercentuais = [...percentuais];
        newPercentuais[index] = value;
        setPercentuais(newPercentuais);
    };

    function handleRemovePercentualInputComponent(index: number) {
        const newPercentuais = [...percentuais];
        newPercentuais.splice(index, 1);
        setPercentuais(newPercentuais);
    }

    async function handleSubmit(event: React.FormEvent<HTMLFormElement>) {
        event.preventDefault();

        try {
            const validatedProductType = productTypeSchema.parse({
                name,
            });

            await productTypeService.create({
                name: validatedProductType.name,
                product_id: parseInt(String(productId)),
                percentages: percentuais
            });

            navigate("/");
        } catch (error) {
            if (error instanceof z.ZodError) {
                alert('Erro nos campos');
            } else {
                console.error('Erro ao cadastrar tipo de produto:', error);
            }
        }
    };

    return (
        <div className="max-w-md mx-auto mt-8 bg-white p-8 rounded shadow-md">
            <h1 className="text-2xl mb-4">Criar Tipo de produto</h1>
            <form onSubmit={handleSubmit}>
                <div className="mb-4">
                    <label htmlFor="name" className="block text-gray-700">Nome:</label>
                    <input type="text" id="name" onChange={handleNameChange} className="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:border-blue-500" />
                </div>
                {percentuais.map((percentual, index) => (
                    <PercentualInput
                        key={index}
                        value={percentual}
                        onChange={(value) => handlePercentualChange(index, value)}
                        onRemove={() => handleRemovePercentualInputComponent(index)}
                    />
                ))}
                <button type="button" onClick={addPercentualInputComponent} className="mb-4 w-full bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 focus:outline-none focus:bg-green-600">Adicionar Novo Percentual</button>
                <button type="submit" className="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Criar</button>
            </form>
        </div>
    )
}
