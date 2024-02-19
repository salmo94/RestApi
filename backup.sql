--
-- PostgreSQL database dump
--

-- Dumped from database version 13.2 (Debian 13.2-1.pgdg100+1)
-- Dumped by pg_dump version 13.13 (Debian 13.13-0+deb11u1)

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
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: goods
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO goods;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: goods
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.failed_jobs_id_seq OWNER TO goods;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: goods
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: goods; Type: TABLE; Schema: public; Owner: goods
--

CREATE TABLE public.goods (
    id bigint NOT NULL,
    title character varying(255) NOT NULL,
    price double precision NOT NULL,
    description text NOT NULL,
    image_path character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.goods OWNER TO goods;

--
-- Name: goods_id_seq; Type: SEQUENCE; Schema: public; Owner: goods
--

CREATE SEQUENCE public.goods_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.goods_id_seq OWNER TO goods;

--
-- Name: goods_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: goods
--

ALTER SEQUENCE public.goods_id_seq OWNED BY public.goods.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: goods
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO goods;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: goods
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO goods;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: goods
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: goods
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO goods;

--
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: goods
--

CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.personal_access_tokens OWNER TO goods;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: goods
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personal_access_tokens_id_seq OWNER TO goods;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: goods
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: goods
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO goods;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: goods
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO goods;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: goods
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: goods
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: goods id; Type: DEFAULT; Schema: public; Owner: goods
--

ALTER TABLE ONLY public.goods ALTER COLUMN id SET DEFAULT nextval('public.goods_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: goods
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: goods
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: goods
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: goods
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: goods; Type: TABLE DATA; Schema: public; Owner: goods
--

COPY public.goods (id, title, price, description, image_path, created_at, updated_at) FROM stdin;
6	Набір бармена для приготування коктейлів Cobbler 750 з дерев'яною підставкою 12 в 1 (LB-18407)	1320	Набір виготовлено з високоякісної нержавіючої сталі. Безпечно для посудомийної машини і схвалено FDA - ніяких шкідливих хімічних речовин або токсинів. Не темніє, довговічний. Ідеально підходить для домашнього або професійного використання.	images/image_test_6.jpg	2023-12-07 11:46:44	2023-12-07 11:46:45
5	USB Флешка 4в1 512GB Type-C/Micro/Lightning/USB для телефону, комп'ютера iPhone/Android Чорний	1470	Флешку з 4 роз'ємами USB / Type-C / Micro / Lightning, можна підключити до комп'ютера або ноутбука, так і до смартфону або планшету на Android, що підтримує функцію OTG.	images/image_test_5.jpg	2023-12-07 11:46:44	2023-12-07 11:46:45
1	Каска шолом тактичний захист FAST NIJ IIIA балістичний шолом кевларовий UKRDEF мультикам\n	9990	Балістичний шолом FAST Helmet NIJ IIIA 0106.01	images/image_test_1.jpg	2023-12-07 11:45:36	2023-12-07 11:45:41
3	Настільний декоративний LED світильник-нічник, декоративна 3D лампа, дитячий нічник, дитяча нічна лампа, дитячий подарунок з LED ефектом 10*18 см Z-584	299	Практичний яскравий кухоль від Lefard виготовлений з фарфору. Ця чашка стане приємним та незамінним аксесуаром на будь-якій кухні. Виріб не виділяє небезпечних речовин при використанні, не вбирає запахи та легко миється. Зробить чаювання зимовими вечорами краще, а також підкреслить гарний смак господарів будинку.	images/image_test_3.jpg	2023-12-07 11:46:39	2023-12-07 11:46:40
4	Кухоль Lefard Christmas Collection 300 мл (986-111)	327	Декоративний нічник у формі кролика на місяць.\n3D нічник створює атмосферу казки та чаклунства. Чудова ідея для подарунка як для дорослих, так і для дітей.	images/image_test_4.jpg	2023-12-07 11:46:41	2023-12-07 11:46:43
2	Пневматичний пістолет Umarex Legends Makarov (5.8152)	3276	Напівавтоматичний пістолет Макарова, названий на честь його конструктора, був прийнятий на озброєння збройних сил колишнього Радянського Союзу 1951 року	images/image_test_2.jpg	2023-12-07 11:46:36	2023-12-07 11:46:37
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: goods
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	2014_10_12_000000_create_users_table	1
2	2014_10_12_100000_create_password_reset_tokens_table	1
3	2019_08_19_000000_create_failed_jobs_table	1
4	2019_12_14_000001_create_personal_access_tokens_table	1
5	2023_12_06_153948_goods_table	1
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: goods
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: goods
--

COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, expires_at, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: goods
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
\.


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: goods
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: goods_id_seq; Type: SEQUENCE SET; Schema: public; Owner: goods
--

SELECT pg_catalog.setval('public.goods_id_seq', 1, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: goods
--

SELECT pg_catalog.setval('public.migrations_id_seq', 5, true);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: goods
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: goods
--

SELECT pg_catalog.setval('public.users_id_seq', 1, false);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: goods
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: goods
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: goods goods_pkey; Type: CONSTRAINT; Schema: public; Owner: goods
--

ALTER TABLE ONLY public.goods
    ADD CONSTRAINT goods_pkey PRIMARY KEY (id);


--
-- Name: goods goods_title_unique; Type: CONSTRAINT; Schema: public; Owner: goods
--

ALTER TABLE ONLY public.goods
    ADD CONSTRAINT goods_title_unique UNIQUE (title);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: goods
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: goods
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: goods
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: goods
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: goods
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: goods
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: goods
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- PostgreSQL database dump complete
--

