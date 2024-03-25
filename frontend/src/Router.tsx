import { Routes, Route } from 'react-router-dom';

import Home from './view/pages/Home';
import NewProduct from './view/pages/NewProduct';
import NewProductType from './view/pages/NewProductType';
import NewSale from './view/pages/NewSale';

export default function Router() {
    return (
        <Routes>
            <Route path="/" element={<Home />} />
            <Route path="/new-product" element={<NewProduct />} />
            <Route path="/new-product-type" element={<NewProductType />} />
            <Route path="/new-sale" element={<NewSale />} />
        </Routes>
    );
}