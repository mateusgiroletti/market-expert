DO $$ 
BEGIN
    IF NOT EXISTS (SELECT FROM pg_database WHERE datname = 'market_express') THEN
        CREATE DATABASE market_express;
    END IF;
END $$;