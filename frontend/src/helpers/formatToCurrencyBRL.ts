export default function formatToCurrencyBRL(currency: number): string {
    return currency.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
}