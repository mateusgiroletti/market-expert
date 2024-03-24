import { httpClient } from "../httpClient";

export interface CreateProductTypeTaxesParams {
    product_type_id: number;
    percentual: number;
}

export async function create(params: CreateProductTypeTaxesParams) {
    const { data } = await httpClient.post("/product-type-taxes", params);

    return data;
}
