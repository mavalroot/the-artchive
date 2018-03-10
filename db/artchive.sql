------------------------------
-- Archivo de base de datos --
------------------------------

DROP TABLE IF EXISTS tipos_usuario CASCADE;

CREATE TABLE tipos_usuario (
      id    bigserial       PRIMARY KEY
    , tipo  varchar(255)    UNIQUE NOT NULL
);

DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios (
      id                bigserial       PRIMARY KEY
    , nickname          varchar(25)     UNIQUE NOT NULL
    , email             varchar(255)    UNIQUE NOT NULL
    , password          varchar(255)    NOT NULL
    , aficiones         varchar(255)
    , tematica_favorita varchar(255)
    , plataforma        varchar(255)
    , pagina_web        varchar(255)
    , avatar            varchar(255)
    , tipo_usuario      bigint          NOT NULL REFERENCES tipos_usuario (id)
                                        ON DELETE NO ACTION ON UPDATE CASCADE
    , auth_key          varchar(255)
    , token_val         varchar(255)    UNIQUE
    , created_at        timestamp(0)    NOT NULL DEFAULT localtimestamp
    , updated_at        timestamp(0)
);

CREATE INDEX idx_usuarios_nickname ON usuarios (nickname);
CREATE INDEX idx_usuarios_email ON usuarios (email);
