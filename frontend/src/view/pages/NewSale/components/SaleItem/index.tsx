export interface SaleItemProps {
    product: {
        productId: number;
        name: string;
        price: number;
        quantity: number;
        totalTaxPercentage: number;
    }
}

export default function SaleItem({ product }: SaleItemProps) {
    // Calcula o preço total do item (preço x quantidade)
    const itemTotal = product.price * product.quantity;

    // Calcula o valor do imposto para este item (preço total x percentual de imposto)
    const taxAmount = (itemTotal * product.totalTaxPercentage) / 100;

    return (
        <div className="flex justify-between mb-2">
            <div>
                <p>{product.name}</p>
                <p>Preço Unitário: ${product.price}</p>
                <p>Quantidade: {product.quantity}</p>
                <p>Valor Total: ${itemTotal.toFixed(2)}</p>
                <p>Imposto: ${taxAmount.toFixed(2)}</p>
            </div>
        </div>
    );
};
