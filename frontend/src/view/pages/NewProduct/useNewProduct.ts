import { useState } from "react";
import { useNavigate } from "react-router-dom";
import { z } from "zod";
import { productService } from "../../../app/services/products";

export default function useNewProduct() {
    const productSchema = z.object({
        name: z.string().min(1, 'O campo Nome é obrigatório').max(100, 'Limite de 100 caracteres excedido!'),
        price: z.number().positive('O campo preço precisa ser positivo'),
    });

    const [name, setName] = useState<string>('');
    const [price, setPrice] = useState<number>();

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

            alert('Produto cadastrado com sucesso!');

            navigate("/");
        } catch (error) {
            if (error instanceof z.ZodError) {
                alert('Erro nos campos');
            } else {
                console.error('Erro ao cadastrar produto:', error);
            }
        }
    };

    return {
        handleSubmit,
        name,
        handleNameChange,
        price,
        handlePriceChange
    }
}