import { useState } from "react";
import { useLocation, useNavigate } from "react-router-dom";
import { z } from "zod";

import { productTypeService } from "../../../app/services/productTypes";

export default function useNewProductType() {

    const productTypeSchema = z.object({
        name: z.string().min(1, 'O campo Nome é obrigatório').max(100, 'Limite de 100 caracteres excedido!')
    });

    const location = useLocation();
    const searchParams = new URLSearchParams(location.search);
    const productId = searchParams.get("productId");

    const [name, setName] = useState<string>('');
    const [percentages, setPercentages] = useState<number[]>([]);

    const navigate = useNavigate();

    function addPercentualInputComponent() {
        setPercentages([...percentages, 0]);
    }

    function handleNameChange(event: React.ChangeEvent<HTMLInputElement>) {
        setName(event.target.value);
    };

    function handlePercentualChange(index: number, value: number) {
        const newPercentuais = [...percentages];
        newPercentuais[index] = value;
        setPercentages(newPercentuais);
    };

    function handleRemovePercentualInputComponent(index: number) {
        const newPercentuais = [...percentages];
        newPercentuais.splice(index, 1);
        setPercentages(newPercentuais);
    }

    async function handleSubmit(event: React.FormEvent<HTMLFormElement>) {
        event.preventDefault();

        const hasZeroPercentage = percentages.some(percentual => percentual === 0);

        if (hasZeroPercentage) {
            alert('Por favor, preencha todos os campos de porcentagem com valores diferentes de zero.');
            return;
        }

        try {
            const validatedProductType = productTypeSchema.parse({
                name,
            });

            await productTypeService.create({
                name: validatedProductType.name,
                product_id: parseInt(String(productId)),
                percentages: percentages
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

    return {
        handleSubmit,
        handleNameChange,
        percentages,
        handlePercentualChange,
        handleRemovePercentualInputComponent,
        addPercentualInputComponent
    }
}