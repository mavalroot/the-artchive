------------------------------
-- Archivo de base de datos --
------------------------------

DROP TABLE IF EXISTS tipos_usuario CASCADE;

CREATE TABLE tipos_usuario (
      id    bigserial       PRIMARY KEY
    , tipo  varchar(255)    UNIQUE NOT NULL
);

DROP TABLE IF EXISTS usuarios CASCADE;

CREATE INDEX idx_tipos_usuario_tipo ON tipos_usuario (tipo);

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

DROP TABLE IF EXISTS personajes CASCADE;

CREATE TABLE personajes (
      id                    bigserial       PRIMARY KEY
    , usuario_id            bigint          NOT NULL REFERENCES usuarios (id)
                                            ON DELETE NO ACTION ON UPDATE CASCADE
    , nombre                varchar(255)    NOT NULL
    , fecha_nac             timestamp(0)
    , raza                  varchar(255)
    , historia              text
    , personalidad          text
    , apariencia            text
    , hechos_destacables    text
    , created_at            timestamp(0)    NOT NULL DEFAULT localtimestamp
    , updated_at            timestamp(0)
);

CREATE INDEX idx_personajes_nombre ON personajes (nombre);

DROP TABLE IF EXISTS publicaciones CASCADE;

CREATE TABLE publicaciones (
      id            bigserial       PRIMARY KEY
    , usuario_id    bigint          NOT NULL REFERENCES usuarios (id)
                                    ON DELETE NO ACTION ON UPDATE CASCADE
    , contenido     text
    , created_at    timestamp(0)    NOT NULL DEFAULT localtimestamp
    , updated_at    timestamp(0)
);

CREATE INDEX idx_publicaciones_usuario_id ON publicaciones (usuario_id);

DROP TABLE IF EXISTS comentarios CASCADE;

CREATE TABLE comentarios (
      id                bigserial       PRIMARY KEY
    , usuario_id        bigint          NOT NULL REFERENCES usuarios (id)
                                        ON DELETE NO ACTION ON UPDATE CASCADE
    , publicacion_id    bigint          NOT NULL REFERENCES publicaciones (id)
    , contenido         text            NOT NULL
    , comentario_id     bigint          REFERENCES comentarios (id)
                                        ON DELETE NO ACTION ON UPDATE CASCADE
    , created_at        timestamp(0)    NOT NULL DEFAULT localtimestamp
    , updated_at        timestamp(0)
);

CREATE INDEX idx_comentarios_usuario_id ON comentarios (usuario_id);

CREATE INDEX idx_comentarios_publicacion_id ON comentarios (publicacion_id);

CREATE INDEX idx_comentarios_comentario_id ON comentarios (comentario_id);

DROP TABLE IF EXISTS mensajes_privados CASCADE;

CREATE TABLE mensajes_privados (
      id            bigserial       PRIMARY KEY
    , emisor_id     bigint          NOT NULL REFERENCES usuarios (id)
                                    ON DELETE NO ACTION ON UPDATE CASCADE
    , receptor_id   bigint          NOT NULL REFERENCES usuarios (id)
                                    ON DELETE NO ACTION ON UPDATE CASCADE
    , asunto        varchar(255)    NOT NULL
    , contenido     text            NOT NULL
    , created_at    timestamp(0)    NOT NULL DEFAULT localtimestamp
);

CREATE INDEX idx_mensajes_privados_emisor_id ON mensajes_privados (emisor_id);

CREATE INDEX idx_mensajes_privados_receptor_id ON mensajes_privados (receptor_id);

DROP TABLE IF EXISTS arboles_genealogicos CASCADE;

CREATE TABLE arboles_genealogicos (
      id            bigserial   PRIMARY KEY
    , personaje_id  bigint      NOT NULL REFERENCES usuarios (id)
                                ON DELETE NO ACTION ON UPDATE CASCADE
);

DROP TABLE IF EXISTS tipos_parentezco CASCADE;

CREATE TABLE tipos_parentezco (
    id bigserial PRIMARY KEY
    , tipo varchar(255) UNIQUE NOT NULL
);

DROP TABLE IF EXISTS parentezcos CASCADE;

CREATE TABLE parentezcos (
      arbol_genealogico_id  bigint          NOT NULL REFERENCES arboles_genealogicos (id)
                                            ON DELETE NO ACTION ON UPDATE CASCADE
    , nombre                varchar(255)    NOT NULL
    , personaje_id          bigint          REFERENCES personajes (id)
                                            ON DELETE NO ACTION ON UPDATE CASCADE
    , tipo_parentezco_id    bigint          REFERENCES tipos_parentezco (id)
                                            ON DELETE NO ACTION ON UPDATE CASCADE
    , CONSTRAINT pk_parentezcos PRIMARY KEY (arbol_genealogico_id, nombre, personaje_id)
);
