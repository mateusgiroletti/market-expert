import { httpClient } from "../httpClient";

interface ProductResponse {
    id: number;
    price: number;
    name: string;
    total_percentage_tax: number;
}

export async function getById(productId: number) {
    const { data } = await httpClient.get<ProductResponse>(`/productsById?product_id=${productId}`);

    return data;
}
