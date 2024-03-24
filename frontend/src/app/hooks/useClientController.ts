import { useState } from 'react';
import { z, ZodError } from 'zod';
import { Client } from '../entities/Product';
import { clientService } from '../services/products';

const clientSchema = z.object({
    name: z.string().min(1, 'O campo Nome é obrigatório').max(255, 'Limite de 255 caracteres execido'),
    email: z.string().email('O campo Email é inválido').max(150, 'Limite de 150 caracteres execido'),
    phone: z.string().min(1, 'O telefone é obrigatório').max(20, 'Limite de 20 caracteres execido'),
    coordinate_x: z.string().min(1, 'A coordenada X é obrigatória').max(11, 'Limite de 11 caracteres execido'),
    coordinate_y: z.string().min(1, 'A coordenada Y é obrigatória').max(11, 'Limite de 11 caracteres execido'),
});

interface UseClientControllerProps {
    onClientCreated: () => void;
}

export function useClientController({ onClientCreated }: UseClientControllerProps) {
    const [newClient, setNewClient] = useState({
        name: '',
        email: '',
        phone: '',
        coordinate_x: '',
        coordinate_y: '',
    });
    const [clients, setClients] = useState<Client[]>([]);
    const [validationError, setValidationError] = useState<ZodError | null>(null);
    const [clientsSortedByBestRoute, setClientsSortedByBestRoute] = useState<Client[]>([]);
    const [showModal, setShowModal] = useState(false);

    function handleInputChange(field: string, value: string) {
        setNewClient({ ...newClient, [field]: value });
    };

    async function createClient() {
        try {
            const validatedClient = clientSchema.parse(newClient);

            await clientService.create(validatedClient);

            setValidationError(null);
            onClientCreated();
            setNewClient({
                name: '',
                email: '',
                phone: '',
                coordinate_x: '',
                coordinate_y: '',
            });
        } catch (error) {
            if (error instanceof z.ZodError) {
                setValidationError(error);
            } else {
                console.error('Erro ao cadastrar cliente:', error);
            }
        }
    };

    async function loadClients() {
        try {
            const { clients } = await clientService.getAll();
            setClients(clients);
        } catch (error) {
            console.error('Erro ao carregar clients:', error);
        }
    };

    async function findBestRoute() {
        try {
            const { clients } = await clientService.bestRoute();
            setClientsSortedByBestRoute(clients);
            setShowModal(true);
        } catch (error) {
            console.error('Erro ao carregar melhor rota:', error);
        }
    }

    return {
        newClient,
        handleInputChange,
        createClient,
        clients,
        loadClients,
        validationError,
        clientsSortedByBestRoute,
        findBestRoute,
        showModal,
        setShowModal
    };
}