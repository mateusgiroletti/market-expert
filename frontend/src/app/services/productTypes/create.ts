import { httpClient } from "../httpClient";

export interface CreateProductTypesParams {
    name: string;
    product_id: number;
    percentual: array;
}

export async function create(params: CreateProductTypesParams) {
    const { data } = await httpClient.post("/product-types", params);

    return data;
}
