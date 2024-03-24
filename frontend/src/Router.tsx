import { Routes, Route } from 'react-router-dom';

import Home from './view/pages/Home';
import NewProduct from './view/pages/NewProduct';

export default function Router() {
    return (
        <Routes>
            <Route path="/" element={<Home />} />
            <Route path="/new-product" element={<NewProduct />} />
        </Routes>
    );
}