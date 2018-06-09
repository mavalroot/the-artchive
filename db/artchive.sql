---------------------
-- DATOS GENERALES --
---------------------

--------------
-- USUARIOS --
--------------
DROP TABLE IF EXISTS "user" CASCADE;

/**
* Tabla de usuarios, en la que se recogen datos básicos de registro.
*/
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

/**
 * Tipos de usuario.
 * Éstos pueden ser: normal o admin.
 */
CREATE TABLE tipos_usuario (
      id    bigserial       PRIMARY KEY
    , tipo  varchar(255)    UNIQUE NOT NULL
);

CREATE INDEX idx_tipos_usuario_tipo ON tipos_usuario (tipo);

DROP TABLE IF EXISTS usuarios_datos CASCADE;

/**
 * Datos de los usuarios.
 * Accesibles y modificables por el propio usuario.
 */
CREATE TABLE usuarios_datos (
      usuario_id        bigint          PRIMARY KEY REFERENCES "user" (id)
                                        ON DELETE NO ACTION ON UPDATE CASCADE
    , aficiones         varchar(255)
    , tematica_favorita varchar(255)
    , bio        varchar(255)
    , pagina_web        varchar(255)
    , avatar            varchar(255)
);

----------------
-- PERSONAJES --
----------------
DROP TABLE IF EXISTS personajes CASCADE;

/**
 * Tabla de personajes.
 * Se recoge la información básica de éstos.
 */
CREATE TABLE personajes (
      id                    bigserial       PRIMARY KEY
    , usuario_id            bigint          NOT NULL REFERENCES "user" (id)
                                            ON DELETE NO ACTION ON UPDATE CASCADE
    , nombre                varchar(255)    NOT NULL
    , fecha_nac             date
    , historia              text
    , personalidad          text
    , apariencia            text
    , hechos_destacables    text
    , created_at            timestamp(0)    NOT NULL DEFAULT localtimestamp
    , updated_at            timestamp(0)
);

CREATE INDEX idx_personajes_nombre ON personajes (nombre);

-------------------
-- PUBLICACIONES --
-------------------
DROP TABLE IF EXISTS publicaciones CASCADE;

/**
 * Tabla de publicaciones.
 */
CREATE TABLE publicaciones (
      id            bigserial       PRIMARY KEY
    , usuario_id    bigint          NOT NULL REFERENCES "user" (id)
                                    ON DELETE NO ACTION ON UPDATE CASCADE
    , titulo        varchar(255)    NOT NULL
    , contenido     text            NOT NULL
    , created_at    timestamp(0)    NOT NULL DEFAULT localtimestamp
    , updated_at    timestamp(0)
);

CREATE INDEX idx_publicaciones_usuario_id ON publicaciones (usuario_id);

-----------------
-- COMENTARIOS --
-----------------
DROP TABLE IF EXISTS comentarios CASCADE;

/**
 * Tabla de comentarios.
 * Un comentario podría responder a otro o no. Sólo puede responder a un
 * comentario a la vez.
 */
CREATE TABLE comentarios (
      id                bigserial       PRIMARY KEY
    , usuario_id        bigint          NOT NULL REFERENCES "user" (id)
                                        ON DELETE NO ACTION ON UPDATE CASCADE
    , publicacion_id    bigint          NOT NULL REFERENCES publicaciones (id)
                                        ON DELETE CASCADE ON UPDATE CASCADE
    , contenido         varchar(500)    NOT NULL
    , comentario_id     bigint          REFERENCES comentarios (id)
                                        ON DELETE NO ACTION ON UPDATE CASCADE
    , created_at        timestamp(0)    NOT NULL DEFAULT localtimestamp
    , updated_at        timestamp(0)
    , deleted           boolean         DEFAULT FALSE
);

CREATE INDEX idx_comentarios_usuario_id ON comentarios (usuario_id);

CREATE INDEX idx_comentarios_publicacion_id ON comentarios (publicacion_id);

CREATE INDEX idx_comentarios_comentario_id ON comentarios (comentario_id);

-----------------------
-- MENSAJES PRIVADOS --
-----------------------
DROP TABLE IF EXISTS mensajes_privados CASCADE;

/**
 * Tabla de mensajes privados.
 * Se guarda en mensajes enviados y mensajes recibidos, por lo que sólo
 * será eliminado definitivamente cuando ambos campos del_e y del_r sean true,
 * porque eso significará que tanto emisor como receptor lo habrán eliminado
 * de su bandeja de entrada.
 */
CREATE TABLE mensajes_privados (
      id            bigserial       PRIMARY KEY
    , emisor_id     bigint          NOT NULL REFERENCES "user" (id)
                                    ON DELETE NO ACTION ON UPDATE CASCADE
    , receptor_id   bigint          NOT NULL REFERENCES "user" (id)
                                    ON DELETE NO ACTION ON UPDATE CASCADE
    , asunto        varchar(255)    NOT NULL
    , contenido     text            NOT NULL
    , seen         boolean         NOT NULL DEFAULT FALSE
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

/**
 * Tabla de seguidores.
 * usuario_id es al que se sigue, y seguidor_id es quien sigue.
 * Un usuario sólo podrá seguir a otro una vez.
 */
CREATE TABLE seguidores (
      id            bigserial   PRIMARY KEY
    , usuario_id    bigint      NOT NULL REFERENCES "user" (id)
    , seguidor_id   bigint      NOT NULL REFERENCES "user" (id)
    , CONSTRAINT follow_only_once UNIQUE (usuario_id, seguidor_id)
);

--------------------
-- NOTIFICACIONES --
--------------------
DROP TABLE IF EXISTS tipos_notificaciones CASCADE;

/**
 * Tipo de notificaciones.
 *
 * Los tipos deberán ser el nombre de la tabla en minúsculas y con espacio
 * en vez de barra baja (_).
 * Por ejemplo:
 * 'mensajes privados', 'comentarios'.
 */
CREATE TABLE tipos_notificaciones (
      id    bigserial       PRIMARY KEY
    , tipo  varchar(255)    UNIQUE NOT NULL
);

DROP TABLE IF EXISTS notificaciones CASCADE;

/**
 * Tabla de notificaciones.
 * Se considerá que una notificación ha sido vista (seen) cuando se entra a
 * previsualizar las notificaciones.
 */
CREATE TABLE notificaciones (
      id                    bigserial       PRIMARY KEY
    , usuario_id            bigint          NOT NULL REFERENCES "user" (id)
    , url                   varchar(255)
    , tipo_notificacion_id  bigint          NOT NULL REFERENCES tipos_notificaciones (id)
    , seen                  boolean         DEFAULT FALSE
    , created_at            timestamp(0)    DEFAULT localtimestamp
    , created_by            bigint          NOT NULL REFERENCES "user" (id)
);

--------------------------
-- ÁRBOLES GENEALÓGICOS --
--------------------------
DROP TABLE IF EXISTS tipos_relaciones CASCADE;

/**
 * Tipos de relaciones.
 */
CREATE TABLE tipos_relaciones (
      id    bigserial       PRIMARY KEY
    , tipo  varchar(255)    UNIQUE NOT NULL
);

DROP TABLE IF EXISTS relaciones CASCADE;

/**
 * Tabla de relaciones.
 * Un personaje puede tener relaciones con otro personaje ya creado.
 */
CREATE TABLE relaciones (
      id                bigserial       PRIMARY KEY
    , personaje_id      bigint          NOT NULL REFERENCES personajes (id)
                                        ON DELETE CASCADE ON UPDATE CASCADE
    , nombre            varchar(255)
    , referencia        bigint          REFERENCES personajes (id)
                                        ON DELETE CASCADE ON UPDATE CASCADE
    , tipo_relacion_id  bigint          NOT NULL REFERENCES tipos_relaciones (id)
);

DROP TABLE IF EXISTS solicitudes CASCADE;

CREATE TABLE solicitudes (
      id            bigserial       PRIMARY KEY
    , usuario_id    bigint          NOT NULL REFERENCES "user" (id)
    , relacion_id   bigint          UNIQUE REFERENCES relaciones (id)
                                    ON DELETE SET NULL ON UPDATE CASCADE
    , aceptada      boolean         DEFAULT FALSE
    , respondida    boolean         DEFAULT FALSE
);

-------------------------
-- GENERADOR ALEATORIO --
-------------------------
DROP TABLE IF EXISTS tipos_aleatorios CASCADE;

/**
 * Tipos aleatorios.
 */
CREATE TABLE tipos_aleatorios (
      id    bigserial       PRIMARY KEY
    , tipo  varchar(255)    UNIQUE NOT NULL
);
DROP TABLE IF EXISTS caracteristicas_aleatorias CASCADE;

/**
 * Tabla de características aleatorias.
 */
CREATE TABLE caracteristicas_aleatorias (
      id                bigserial   PRIMARY KEY
    , tipo_aleatorio_id bigint      NOT NULL REFERENCES tipos_aleatorios (id)
                                    ON DELETE NO ACTION ON UPDATE CASCADE
    , contenido         text        NOT NULL
);

DROP TABLE IF EXISTS nombres_aleatorios CASCADE;

/**
 * Tabla de nombres aleatorios.
 */
CREATE TABLE nombres_aleatorios (
      id        bigserial       PRIMARY KEY
    , nombre    varchar(255)    NOT NULL UNIQUE
);

DROP TABLE IF EXISTS apellidos_aleatorios CASCADE;

/**
 * Tabla de apellidos aleatorios.
 */
CREATE TABLE apellidos_aleatorios (
      id        bigserial       PRIMARY KEY
    , apellido  varchar(255)    NOT NULL UNIQUE
);

------------------------
-- ACTIVIDAD RECIENTE --
------------------------
DROP TABLE IF EXISTS actividad_reciente CASCADE;

CREATE TABLE actividad_reciente (
      id            bigserial       PRIMARY KEY
    , mensaje       varchar(255)    NOT NULL
    , url           varchar(255)
    , referencia    varchar(255)
    , tipo          varchar(255)
    , created_at    timestamp(0)    NOT NULL DEFAULT localtimestamp
    , created_by    bigint          NOT NULL REFERENCES "user" (id)
);

--------------
-- BLOQUEOS --
--------------
DROP TABLE IF EXISTS bloqueos CASCADE;

/**
 * Tabla de bloqueos.
 */
CREATE TABLE bloqueos (
      id            bigserial   PRIMARY KEY
    , usuario_id    bigint      NOT NULL REFERENCES "user" (id)
    , bloqueado_id  bigint      NOT NULL REFERENCES "user" (id)
    , CONSTRAINT block_only_once UNIQUE (usuario_id, bloqueado_id)
    , CONSTRAINT not_block_yourself CHECK (usuario_id != bloqueado_id)
);

------------------------------
-- SUGERENCIA DE TRADUCCIÓN --
------------------------------
DROP TABLE IF EXISTS reportes CASCADE;

CREATE TABLE reportes (
      id bigserial PRIMARY KEY
    , contenido text NOT NULL
    , tipo varchar(255) NOT NULL
    , referencia varchar(255) NOT NULL
    , estado varchar(255) DEFAULT 'En revisión'
    , respuesta varchar(255)
    , created_by bigint NOT NULL REFERENCES "user" (id)
    , created_at timestamp(0) DEFAULT localtimestamp
);

------------
-- VISTAS --
------------
/**
 * Vista para la visualización completa de usuarios, con su información de
 * registro y sus datos.
 */
CREATE OR REPLACE VIEW usuarios_completo AS
WITH uc as (
    SELECT u.id, u.username, u.email, u.status, u.created_at, u.updated_at, ud.aficiones, ud.tematica_favorita, ud.bio, ud.pagina_web, ud.avatar, tu.tipo
    FROM "user" u
    JOIN usuarios_datos ud ON u.id = ud.usuario_id
    JOIN tipos_usuario tu ON tu.id = u.tipo_usuario
), ucseg as (
    SELECT uc.*, count(seg.id) as seguidores
    FROM uc
    LEFT JOIN seguidores seg ON seg.usuario_id = uc.id
    GROUP BY uc.id, uc.username, uc.email, uc.status, uc.created_at, uc.updated_at, uc.aficiones, uc.tematica_favorita, uc.bio, uc.pagina_web, uc.avatar, uc.tipo
), ucsig as (
    select ucseg.*, count(sig.id) as siguiendo
    FROM ucseg
    LEFT JOIN seguidores sig ON sig.seguidor_id = ucseg.id
    GROUP BY ucseg.id, ucseg.username, ucseg.email, ucseg.status, ucseg.created_at, ucseg.updated_at, ucseg.aficiones, ucseg.tematica_favorita, ucseg.bio, ucseg.pagina_web, ucseg.avatar, ucseg.tipo, ucseg.seguidores
), ucpj as (
    select ucsig.*, count(pj.id) as personajes
    FROM ucsig
    LEFT JOIN personajes pj ON pj.usuario_id = ucsig.id
    GROUP BY ucsig.id, ucsig.username, ucsig.email, ucsig.status, ucsig.created_at, ucsig.updated_at, ucsig.aficiones, ucsig.tematica_favorita, ucsig.bio, ucsig.pagina_web, ucsig.avatar, ucsig.tipo, ucsig.seguidores, ucsig.siguiendo
), ucpb as (
    select ucpj.*, count(pb.id) as publicaciones
    FROM ucpj
    LEFT JOIN publicaciones pb ON pb.usuario_id = ucpj.id
    GROUP BY ucpj.id, ucpj.username, ucpj.email, ucpj.status, ucpj.created_at, ucpj.updated_at, ucpj.aficiones, ucpj.tematica_favorita, ucpj.bio, ucpj.pagina_web, ucpj.avatar, ucpj.tipo, ucpj.seguidores, ucpj.siguiendo, ucpj.personajes
)
SELECT * from ucpb;
