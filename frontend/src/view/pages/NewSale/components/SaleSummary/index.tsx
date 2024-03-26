import formatToCurrencyBRL from "../../../../../helpers/formatToCurrencyBRL";
import { saleItenInterface } from "../../useNewSale";
import useSaleSummary from "./useSaleSummary";

export interface itensSaleSummaryInterface {
    itens: saleItenInterface[]
}

export default function SaleSummary({ itens }: itensSaleSummaryInterface) {
    const {
        calculateTotalProductWithTaxes,
        totalSale,
        totalTaxes
    } = useSaleSummary(itens);

    return (
        <div className="p-4 mb-4 rounded">
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
                    {itens.map((product, index) => {
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
            <p>Total da Compra: <b>{formatToCurrencyBRL(totalSale)}</b></p>
            <p>Total de Impostos: <b>{formatToCurrencyBRL(totalTaxes)}</b></p>
        </div>
    );
}
