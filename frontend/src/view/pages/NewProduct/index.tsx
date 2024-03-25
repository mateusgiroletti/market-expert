import { useState } from "react";
import { productService } from "../../../app/services/products";
import { z } from "zod";
import { useNavigate } from "react-router-dom";

const productSchema = z.object({
    name: z.string().min(1, 'O campo Nome é obrigatório').max(100, 'Limite de 100 caracteres excedido!'),
    price: z.number().positive('O campo preço precisa ser positivo'),
});

export default function NewProduct() {
    const [name, setName] = useState<string>('');
    const [price, setPrice] = useState<number>(0);

    const navigate = useNavigate();


    function handleNameChange(event: React.ChangeEvent<HTMLInputElement>) {
        setName(event.target.value);
    };

    function handlePriceChange(event: React.ChangeEvent<HTMLInputElement>) {
        setPrice(parseFloat(event.target.value));
    };

    async function handleSubmit(event: React.FormEvent<HTMLFormElement>) {
        event.preventDefault();

        try {
            const validatedProduct = productSchema.parse({
                name,
                price,
            });

            await productService.create(validatedProduct);

            navigate("/");
        } catch (error) {
            if (error instanceof z.ZodError) {
                alert('Erro nos campos');
            } else {
                console.error('Erro ao cadastrar produto:', error);
            }
        }
    };

    return (
        <div className="max-w-md mx-auto mt-8 bg-white p-8 rounded shadow-md">
            <h1 className="text-2xl mb-4">Criar Produto</h1>
            <form onSubmit={handleSubmit}>
                <div className="mb-4">
                    <label htmlFor="name" className="block text-gray-700">Nome:</label>
                    <input type="text" id="name" value={name} onChange={handleNameChange} className="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:border-blue-500" />
                </div>
                <div className="mb-4">
                    <label htmlFor="price" className="block text-gray-700">Preço:</label>
                    <input type="number" id="price" value={price} onChange={handlePriceChange} className="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:border-blue-500" />
                </div>
                <button type="submit" className="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Criar</button>
            </form>
        </div>
    )
}