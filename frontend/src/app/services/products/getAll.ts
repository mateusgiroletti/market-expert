import { Product } from "../../entities/Product";
import { httpClient } from "../httpClient";

export interface ProductResponse {
    clients: Product[];
};

export async function getAll() {
    const { data } = await httpClient.get<ProductResponse>("/products");

    return data;
}
