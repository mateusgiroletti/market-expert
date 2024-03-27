--
-- PostgreSQL database dump
--

-- Dumped from database version 16.2 (Debian 16.2-1.pgdg120+2)
-- Dumped by pg_dump version 16.2 (Debian 16.2-1.pgdg120+2)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: product_type_taxes; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.product_type_taxes (
    id integer NOT NULL,
    product_type_id integer NOT NULL,
    percentual integer NOT NULL
);


ALTER TABLE public.product_type_taxes OWNER TO root;

--
-- Name: product_type_taxes_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.product_type_taxes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.product_type_taxes_id_seq OWNER TO root;

--
-- Name: product_type_taxes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.product_type_taxes_id_seq OWNED BY public.product_type_taxes.id;


--
-- Name: product_types; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.product_types (
    id integer NOT NULL,
    name character varying(100) NOT NULL,
    product_id integer NOT NULL
);


ALTER TABLE public.product_types OWNER TO root;

--
-- Name: product_types_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.product_types_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.product_types_id_seq OWNER TO root;

--
-- Name: product_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.product_types_id_seq OWNED BY public.product_types.id;


--
-- Name: products; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.products (
    id integer NOT NULL,
    name character varying(100) NOT NULL,
    price numeric(10,2) NOT NULL
);


ALTER TABLE public.products OWNER TO root;

--
-- Name: products_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.products_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.products_id_seq OWNER TO root;

--
-- Name: products_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.products_id_seq OWNED BY public.products.id;


--
-- Name: sales; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.sales (
    id integer NOT NULL,
    total_purchase numeric(10,2) NOT NULL,
    total_tax numeric(10,2) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.sales OWNER TO root;

--
-- Name: sales_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.sales_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.sales_id_seq OWNER TO root;

--
-- Name: sales_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.sales_id_seq OWNED BY public.sales.id;


--
-- Name: sales_products; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.sales_products (
    id integer NOT NULL,
    sale_id integer NOT NULL,
    product_id integer NOT NULL,
    amount integer NOT NULL,
    subtotal numeric(10,2) NOT NULL,
    total_tax numeric(10,2) NOT NULL
);


ALTER TABLE public.sales_products OWNER TO root;

--
-- Name: sales_products_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.sales_products_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.sales_products_id_seq OWNER TO root;

--
-- Name: sales_products_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.sales_products_id_seq OWNED BY public.sales_products.id;


--
-- Name: product_type_taxes id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.product_type_taxes ALTER COLUMN id SET DEFAULT nextval('public.product_type_taxes_id_seq'::regclass);


--
-- Name: product_types id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.product_types ALTER COLUMN id SET DEFAULT nextval('public.product_types_id_seq'::regclass);


--
-- Name: products id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.products ALTER COLUMN id SET DEFAULT nextval('public.products_id_seq'::regclass);


--
-- Name: sales id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.sales ALTER COLUMN id SET DEFAULT nextval('public.sales_id_seq'::regclass);


--
-- Name: sales_products id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.sales_products ALTER COLUMN id SET DEFAULT nextval('public.sales_products_id_seq'::regclass);


--
-- Data for Name: product_type_taxes; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.product_type_taxes (id, product_type_id, percentual) FROM stdin;
1	1	10
2	1	30
3	3	10
4	3	20
5	3	40
6	3	50
7	11	55
8	12	333
9	12	26
10	12	55
11	13	5
12	47	1
13	14	30
14	48	1
15	48	15
16	48	60
17	49	50
\.


--
-- Data for Name: product_types; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.product_types (id, name, product_id) FROM stdin;
1	Teste 1	1
2	teste 2	1
3	Teste	1
8	Teste	1
9	Teste	1
10	aaaaa	1
11	aaa	1
12	aaa	1
13	etete	3
14	teste	1
47	tete	1
48	teste	7
49	teste do build	11
\.


--
-- Data for Name: products; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.products (id, name, price) FROM stdin;
1	Teste 1	10.99
2	Teste 2	50.00
3	teste	55.00
4	teste	1500.50
5	teste	50.00
6	Teste 3	50.00
7	teste pos factories	65.00
8	Test Product	10.99
9	Test Product	10.99
10	Test Product	10.99
11	tete build	50.00
\.


--
-- Data for Name: sales; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.sales (id, total_purchase, total_tax, created_at) FROM stdin;
1	211.54	17.58	2024-03-24 23:08:40.24381
2	470.47	276.51	2024-03-25 19:55:25.747444
4	80.12	69.13	2024-03-25 20:38:39.141152
5	80.12	69.13	2024-03-25 20:39:48.562909
10	80.12	69.13	2024-03-25 20:54:11.927255
11	80.12	69.13	2024-03-25 20:55:02.237408
12	1905.75	90.75	2024-03-26 00:14:09.127957
13	470.91	276.95	2024-03-26 14:20:51.495267
14	470.91	276.95	2024-03-26 14:24:45.87813
15	484.10	290.14	2024-03-26 17:41:16.640929
16	1673.25	508.25	2024-03-27 18:53:29.05519
\.


--
-- Data for Name: sales_products; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.sales_products (id, sale_id, product_id, amount, subtotal, total_tax) FROM stdin;
1	1	1	4	61.54	17.58
2	1	2	3	150.00	0.00
3	2	1	4	320.47	276.51
4	2	2	3	150.00	0.00
5	4	1	1	80.12	69.13
6	5	1	1	80.12	69.13
7	10	1	1	80.12	69.13
8	11	1	1	80.12	69.13
9	12	3	33	1905.75	90.75
10	13	1	4	320.91	276.95
11	13	2	3	150.00	0.00
12	14	1	4	320.91	276.95
13	14	2	3	150.00	0.00
14	15	1	4	334.10	290.14
15	15	2	3	150.00	0.00
16	16	11	20	1500.00	500.00
17	16	3	3	173.25	8.25
\.


--
-- Name: product_type_taxes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.product_type_taxes_id_seq', 17, true);


--
-- Name: product_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.product_types_id_seq', 49, true);


--
-- Name: products_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.products_id_seq', 11, true);


--
-- Name: sales_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.sales_id_seq', 16, true);


--
-- Name: sales_products_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.sales_products_id_seq', 17, true);


--
-- Name: product_type_taxes product_type_taxes_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.product_type_taxes
    ADD CONSTRAINT product_type_taxes_pkey PRIMARY KEY (id);


--
-- Name: product_types product_types_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.product_types
    ADD CONSTRAINT product_types_pkey PRIMARY KEY (id);


--
-- Name: products products_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (id);


--
-- Name: sales sales_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.sales
    ADD CONSTRAINT sales_pkey PRIMARY KEY (id);


--
-- Name: sales_products sales_products_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.sales_products
    ADD CONSTRAINT sales_products_pkey PRIMARY KEY (id);


--
-- Name: product_type_taxes product_type_taxes_product_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.product_type_taxes
    ADD CONSTRAINT product_type_taxes_product_type_id_fkey FOREIGN KEY (product_type_id) REFERENCES public.product_types(id);


--
-- Name: product_types product_types_product_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.product_types
    ADD CONSTRAINT product_types_product_id_fkey FOREIGN KEY (product_id) REFERENCES public.products(id);


--
-- Name: sales_products sales_products_product_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.sales_products
    ADD CONSTRAINT sales_products_product_id_fkey FOREIGN KEY (product_id) REFERENCES public.products(id);


--
-- Name: sales_products sales_products_sale_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.sales_products
    ADD CONSTRAINT sales_products_sale_id_fkey FOREIGN KEY (sale_id) REFERENCES public.sales(id);


--
-- PostgreSQL database dump complete
--

