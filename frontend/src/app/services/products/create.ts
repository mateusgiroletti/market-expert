import { httpClient } from "../httpClient";

export interface CreateProductsParams {
    name: string;
    price: number;
}

export async function create(params: CreateProductsParams) {
    const { data } = await httpClient.post("/products", params);

    return data;
}
