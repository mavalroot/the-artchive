---------------------
-- DATOS GENERALES --
---------------------

DROP TABLE IF EXISTS "user" CASCADE;

CREATE TABLE "user" (
      id                    bigserial       PRIMARY KEY
    , username              varchar(255)    NOT NULL UNIQUE
    , auth_key              varchar(32)     NOT NULL
    , password_hash         varchar(255)    NOT NULL
    , password_reset_token  varchar(255)    UNIQUE
    , email                 varchar(255)    UNIQUE
    , status                smallint        DEFAULT 10 NOT NULL
    , created_at            integer         NOT NULL DEFAULT extract('epoch' from localtimestamp)::int
    , updated_at            integer         NOT NULL DEFAULT extract('epoch' from localtimestamp)::int
    , tipo_usuario          bigint          DEFAULT 1 NOT NULL REFERENCES tipos_usuario (id)
                                            ON DELETE NO ACTION ON UPDATE CASCADE
);

DROP TABLE IF EXISTS tipos_usuario CASCADE;

CREATE TABLE tipos_usuario (
      id    bigserial       PRIMARY KEY
    , tipo  varchar(255)    UNIQUE NOT NULL
);

CREATE INDEX idx_tipos_usuario_tipo ON tipos_usuario (tipo);

DROP TABLE IF EXISTS usuarios_datos CASCADE;

CREATE TABLE usuarios_datos (
      user_id           bigint          PRIMARY KEY REFERENCES "user" (id)
                                        ON DELETE NO ACTION ON UPDATE CASCADE
    , aficiones         varchar(255)
    , tematica_favorita varchar(255)
    , plataforma        varchar(255)
    , pagina_web        varchar(255)
    , avatar            varchar(255)
);

/* CREATE OR REPLACE VIEW usuarios_completo AS
SELECT u.username, u.email, ud.aficiones, ud.tematica_favorita, ud.plataforma, ud.pagina_web, ud.avatar, ud.tipo_usuario, u.created_at, u.updated_at
FROM "user" u LEFT JOIN usuarios_datos ud ON u.id = ud.user_id; */

DROP TABLE IF EXISTS personajes CASCADE;

CREATE TABLE personajes (
      id                    bigserial       PRIMARY KEY
    , usuario_id            bigint          NOT NULL REFERENCES "user" (id)
                                            ON DELETE NO ACTION ON UPDATE CASCADE
    , nombre                varchar(255)    NOT NULL
    , fecha_nac             timestamp(0)
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
    , usuario_id    bigint          NOT NULL REFERENCES "user" (id)
                                    ON DELETE NO ACTION ON UPDATE CASCADE
    , titulo        varchar(255)    NOT NULL
    , contenido     text
    , created_at    timestamp(0)    NOT NULL DEFAULT localtimestamp
    , updated_at    timestamp(0)
);

CREATE INDEX idx_publicaciones_usuario_id ON publicaciones (usuario_id);

DROP TABLE IF EXISTS comentarios CASCADE;

CREATE TABLE comentarios (
      id                bigserial       PRIMARY KEY
    , usuario_id        bigint          NOT NULL REFERENCES "user" (id)
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

-----------------------
-- MENSAJES PRIVADOS --
-----------------------

DROP TABLE IF EXISTS mensajes_privados CASCADE;

CREATE TABLE mensajes_privados (
      id            bigserial       PRIMARY KEY
    , emisor_id     bigint          NOT NULL REFERENCES "user" (id)
                                    ON DELETE NO ACTION ON UPDATE CASCADE
    , receptor_id   bigint          NOT NULL REFERENCES "user" (id)
                                    ON DELETE NO ACTION ON UPDATE CASCADE
    , asunto        varchar(255)    NOT NULL
    , contenido     text            NOT NULL
    , leido         boolean         NOT NULL DEFAULT FALSE
    , del_e         boolean         NOT NULL DEFAULT FALSE
    , del_r         boolean         NOT NULL DEFAULT FALSE
    , created_at    timestamp(0)    NOT NULL DEFAULT localtimestamp
);

CREATE INDEX idx_mensajes_privados_emisor_id ON mensajes_privados (emisor_id);

CREATE INDEX idx_mensajes_privados_receptor_id ON mensajes_privados (receptor_id);

----------------
-- SEGUIDORES --
----------------

DROP TABLE IF EXISTS seguidores CASCADE;

CREATE TABLE seguidores (
      id            bigserial   PRIMARY KEY
    , user_id       bigint      NOT NULL REFERENCES "user" (id)
    , seguidor_id   bigint      NOT NULL REFERENCES "user" (id)
    , CONSTRAINT follow_only_once UNIQUE (user_id, seguidor_id)
);

--------------------
-- NOTIFICACIONES --
--------------------

DROP TABLE IF EXISTS tipos_notificaciones CASCADE;

CREATE TABLE tipos_notificaciones (
      id    bigserial       PRIMARY KEY
    , tipo  varchar(255)    UNIQUE NOT NULL
);

DROP TABLE IF EXISTS notificaciones CASCADE;

CREATE TABLE notificaciones (
      id                    bigserial       PRIMARY KEY
    , user_id               bigint          NOT NULL REFERENCES "user" (id)
    , notificacion          varchar(255)
    , tipo_notificacion_id  bigint          NOT NULL REFERENCES tipos_notificaciones (id)
    , created_at            timestamp(0)    NOT NULL DEFAULT localtimestamp
);

--------------------------
-- ÁRBOLES GENEALÓGICOS --
--------------------------

DROP TABLE IF EXISTS tipos_parentesco CASCADE;

CREATE TABLE tipos_parentesco (
      id    bigserial       PRIMARY KEY
    , tipo  varchar(255)    UNIQUE NOT NULL
);

DROP TABLE IF EXISTS parentescos CASCADE;

CREATE TABLE parentescos (
      propietario_id        bigint          NOT NULL REFERENCES personajes (id)
                                            ON DELETE NO ACTION ON UPDATE CASCADE
    , nombre                varchar(255)    NOT NULL
    , familiar_id           bigint          REFERENCES personajes (id)
                                            ON DELETE NO ACTION ON UPDATE CASCADE
    , tipo_parentesco_id    bigint          REFERENCES tipos_parentesco (id)
                                            ON DELETE NO ACTION ON UPDATE CASCADE
    , CONSTRAINT pk_parentescos PRIMARY KEY (propietario_id, nombre, tipo_parentesco_id)
);

-------------------------
-- GENERADOR ALEATORIO --
-------------------------

DROP TABLE IF EXISTS tipos_aleatorios CASCADE;

CREATE TABLE tipos_aleatorios (
      id    bigserial       PRIMARY KEY
    , tipo  varchar(255)    UNIQUE NOT NULL
);
DROP TABLE IF EXISTS caracteristicas_aleatorias CASCADE;

CREATE TABLE caracteristicas_aleatorias (
      id                bigserial   PRIMARY KEY
    , tipo_aleatorio_id bigint      NOT NULL REFERENCES tipos_aleatorios (id)
                                    ON DELETE NO ACTION ON UPDATE CASCADE
    , contenido         text        NOT NULL
);

DROP TABLE IF EXISTS nombres_aleatorios CASCADE;

CREATE TABLE nombres_aleatorios (
      id bigserial PRIMARY KEY
    , nombre varchar(255) NOT NULL UNIQUE
);

DROP TABLE IF EXISTS apellidos_aleatorios CASCADE;

CREATE TABLE apellidos_aleatorios (
      id bigserial PRIMARY KEY
    , apellido varchar(255) NOT NULL UNIQUE
);

------------
-- VISTAS --
------------

CREATE OR REPLACE VIEW usuarios_completo AS
SELECT u.id, u.username, u.email, ud.aficiones, ud.tematica_favorita, ud.plataforma, ud.pagina_web, ud.avatar, tu.tipo, count(seg.id) as seguidores, count(sig.id) as siguiendo, u.created_at, u.updated_at, u.status
FROM "user" u
LEFT JOIN usuarios_datos ud ON u.id = ud.user_id
LEFT JOIN seguidores seg ON seg.user_id = u.id
LEFT JOIN seguidores sig ON sig.seguidor_id = u.id
LEFT JOIN tipos_usuario tu ON tu.id = u.tipo_usuario
GROUP BY u.id, ud.user_id, tu.id;
