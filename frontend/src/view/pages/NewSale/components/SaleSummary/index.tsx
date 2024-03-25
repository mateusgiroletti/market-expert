import formatToCurrencyBRL from "../../../../../helpers/formatToCurrencyBRL";

interface SaleProductTaxInfo {
    productTaxes: number;
    productTotalWithTax: number;
}

export default function SaleSummary({ items }) {
    const totalSaleValue = items.reduce((acc, product) => acc + product.price * product.quantity, 0);
    const totalTaxes = items.reduce((acc, product) => acc + (product.price * product.quantity * product.totalTaxPercentage) / 100, 0);
    const totalSale = totalSaleValue + totalTaxes;

    function calculateTotalProductWithTaxes(
        price: number,
        quantity: number,
        totalTaxPercentage: number
    ): SaleProductTaxInfo {
        const productValue = (price * quantity);
        const productTaxes = productValue * (totalTaxPercentage / 100);

        const productTotalWithTax = productValue + productTaxes;

        return {
            productTaxes,
            productTotalWithTax
        }
    }

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
                    {items.map((product, index) => {
                        const { productTaxes, productTotalWithTax } = calculateTotalProductWithTaxes(
                            product.price,
                            product.quantity,
                            product.totalTaxPercentage
                        );
                        return (
                            <tr key={index}>
                                <td className="border border-gray-400 px-4 py-2">{product.name}</td>
                                <td className="border border-gray-400 px-4 py-2">{formatToCurrencyBRL(product.price)}</td>
                                <td className="border border-gray-400 px-4 py-2">{product.quantity}</td>
                                <td className="border border-gray-400 px-4 py-2">{formatToCurrencyBRL(productTotalWithTax)}</td>
                                <td className="border border-gray-400 px-4 py-2">{formatToCurrencyBRL(productTaxes)}</td>
                            </tr>
                        )
                    })}
                </tbody>
            </table>
            <p>Total da Compra: {formatToCurrencyBRL(totalSale)}</p>
            <p>Total de Impostos: {formatToCurrencyBRL(totalTaxes)}</p>
        </div>
    );
}
