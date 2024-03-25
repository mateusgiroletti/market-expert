import { useState } from "react";
import { z } from "zod";
import { useNavigate } from "react-router-dom";
import PercentualInput from "./components/PercentualInput";

const productTypeSchema = z.object({
    name: z.string().min(1, 'O campo Nome é obrigatório').max(100, 'Limite de 100 caracteres excedido!'),
    percentual: z.array(z.number().positive('O campo percentual precisa ser positivo')).min(1, 'É necessário ao menos um percentual'),
});

export default function NewProductType() {
    const [name, setName] = useState<string>('');
    const [percentuais, setPercentuais] = useState<number[]>([0]);

    const navigate = useNavigate();

    function handleNameChange(event: React.ChangeEvent<HTMLInputElement>) {
        setName(event.target.value);
    };

    function handlePriceChange(index: number, value: number) {
        const newPercentuais = [...percentuais];
        newPercentuais[index] = value;
        setPercentuais(newPercentuais);
    };

    function addPercentual() {
        setPercentuais([...percentuais, 0]);
    }

    function removePercentual(index: number) {
        const newPercentuais = [...percentuais];
        newPercentuais.splice(index, 1);
        setPercentuais(newPercentuais);
    }

    async function handleSubmit(event: React.FormEvent<HTMLFormElement>) {
        event.preventDefault();

        try {
            const validatedProductType = productTypeSchema.parse({
                name,
                percentual: percentuais,
            });

            // await productTypeService.create(validatedProductType);

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
                        onChange={(value) => handlePriceChange(index, value)}
                        onRemove={() => removePercentual(index)}
                    />
                ))}
                <button type="button" onClick={addPercentual} className="mb-4 w-full bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 focus:outline-none focus:bg-green-600">Adicionar Novo Percentual</button>
                <button type="submit" className="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Criar</button>
            </form>
        </div>
    )
}
