\connect "einstein";

DROP TABLE IF EXISTS "complex";
CREATE SEQUENCE complex_id_seq START 1;

CREATE TABLE "public"."complex" (
    "id" integer DEFAULT nextval('complex_id_seq') NOT NULL,
    "meta_title" character varying(250) NOT NULL,
    "meta_description" character varying(250) NOT NULL,
    "complex_description" text NOT NULL,
    "slug" character varying(250) NOT NULL,
    CONSTRAINT "complex_id" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "content";
CREATE SEQUENCE content_id_seq START 1;

CREATE TABLE "public"."content" (
    "id" integer DEFAULT nextval('content_id_seq') NOT NULL,
    "meta_title" character varying(250) NOT NULL,
    "meta_description" character varying(250) NOT NULL,
    "content" text NOT NULL,
    "slug" character varying(250) NOT NULL,
    CONSTRAINT "content_id" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "knowledge";
CREATE SEQUENCE knowledge_id_seq START 1;

CREATE TABLE "public"."knowledge" (
    "id" integer DEFAULT nextval('knowledge_id_seq') NOT NULL,
    "meta_title" character varying(250) NOT NULL,
    "meta_description" character varying(250) NOT NULL,
    "content" text NOT NULL,
    "slug" character varying(250) NOT NULL,
    CONSTRAINT "knowledge_id" PRIMARY KEY ("id")
) WITH (oids = false);