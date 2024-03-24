import { httpClient } from "../httpClient";

interface Product {
    product_id: number;
    amount: number;
}

export interface CreateSalesParams {
    products: Product[];
}

export async function create(params: CreateSalesParams) {
    const { data } = await httpClient.post("/sales", params);

    return data;
}
