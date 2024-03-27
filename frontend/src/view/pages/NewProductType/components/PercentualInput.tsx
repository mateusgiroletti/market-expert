import { Button } from "../../../components/Button";
import { Input } from "../../../components/Input";

interface PercentualInputProps {
    value: number;
    onChange: (value: number) => void;
    onRemove: () => void;
}

export default function PercentualInput({ value, onChange, onRemove }: PercentualInputProps) {
    return (
        <div className="mb-4" data-testid="percentual-input">
            <label className="block text-gray-700">Porcentagem do imposto:</label>
            <div className="flex">
                <Input
                    type="number"
                    value={value}
                    onChange={(e) => onChange(parseInt(e.target.value))}
                    className="focus:outline-none focus:border-blue-500"
                    data-testid="input-id"
                />
                <Button
                    type="button"
                    variant="red"
                    className="ml-2 px-3 py-2"
                    onClick={onRemove}
                >
                    Remover
                </Button>
            </div>
        </div>
    );
};