DO $$ 
BEGIN
    IF NOT EXISTS (SELECT FROM pg_database WHERE datname = 'market_expert') THEN
        CREATE DATABASE market_expert;
    END IF;

    CREATE TABLE IF NOT EXISTS product_types (
        id SERIAL PRIMARY KEY,
        name VARCHAR(100) NOT NULL
    );

    CREATE TABLE IF NOT EXISTS product_type_taxes (
        id SERIAL PRIMARY KEY,
        product_type_id INT NOT NULL,
        percentual INT NOT NULL,
        FOREIGN KEY (product_type_id) REFERENCES product_types(id)
    );

    CREATE TABLE IF NOT EXISTS products (
        id SERIAL PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        product_type_id INT NULL,
        price NUMERIC(10, 2) NOT NULL,
        FOREIGN KEY (product_type_id) REFERENCES product_types(id)
    );

    CREATE TABLE IF NOT EXISTS sales (
        id SERIAL PRIMARY KEY,
        total_purchase NUMERIC(10, 2) NOT null,
        total_tax NUMERIC(10, 2) NOT null,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

    CREATE TABLE IF NOT EXISTS sales_products (
        id SERIAL PRIMARY KEY,
        sale_id INT NOT NULL,
        product_id INT NOT NULL,
        amount INT NOT NULL,
        subtotal NUMERIC(10, 2) NOT null,
        total_tax NUMERIC(10, 2) NOT null,
        FOREIGN KEY (sale_id) REFERENCES sales(id),
        FOREIGN KEY (product_id) REFERENCES products(id)
    );
END $$;