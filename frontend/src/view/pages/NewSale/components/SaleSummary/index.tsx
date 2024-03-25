import { SaleItemProps } from "../SaleItem";

export default function SaleSummary({ items }: SaleItemProps[]) {
    console.log(items);
    // Calcula o valor total da compra somando os valores totais de cada item
    const totalSaleValue = items.reduce((acc, product) => acc + product.price * product.quantity, 0);

    // Calcula o valor total dos impostos somando os valores de impostos de cada product
    const totalTaxAmount = items.reduce((acc, product) => acc + (product.price * product.quantity * product.totalTaxPercentage) / 100, 0);

    return (
        <div className="bg-gray-200 p-4 mb-4 rounded">
            <h2 className="text-lg font-bold mb-2">Resumo da Venda</h2>
            <table className="w-full border-collapse">
                <thead>
                    <tr>
                        <th className="border border-gray-400 px-4 py-2">Item</th>
                        <th className="border border-gray-400 px-4 py-2">Preço Unitário</th>
                        <th className="border border-gray-400 px-4 py-2">Quantidade</th>
                        <th className="border border-gray-400 px-4 py-2">Valor Total</th>
                        <th className="border border-gray-400 px-4 py-2">Imposto</th>
                    </tr>
                </thead>
                <tbody>
                    {items.map((product, index) => (
                        <tr key={index}>
                            <td className="border border-gray-400 px-4 py-2">{product.name}</td>
                            <td className="border border-gray-400 px-4 py-2">${product.price}</td>
                            <td className="border border-gray-400 px-4 py-2">{product.quantity}</td>
                            <td className="border border-gray-400 px-4 py-2">${(product.price * product.quantity).toFixed(2)}</td>
                            <td className="border border-gray-400 px-4 py-2">${((product.price * product.quantity * product.totalTaxPercentage) / 100).toFixed(2)}</td>
                        </tr>
                    ))}
                </tbody>
            </table>
            <p>Total da Compra: ${totalSaleValue.toFixed(2)}</p>
            <p>Total de Impostos: ${totalTaxAmount.toFixed(2)}</p>
        </div>
    );
}
