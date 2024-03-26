interface SaleProductTaxInfo {
    productTaxes: number;
    productTotalWithTax: number;
}

export default function useSaleSummary(itens) {
    console.log(itens);
    const totalSaleValue = itens.reduce((acc, product) => acc + product.price * product.quantity, 0);
    const totalTaxes = itens.reduce((acc, product) => acc + (product.price * product.quantity * product.totalTaxPercentage) / 100, 0);
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

    return {
        calculateTotalProductWithTaxes,
        totalSale,
        totalTaxes
    }
}