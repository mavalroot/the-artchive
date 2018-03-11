------------------------
-- DATOS PERSISTENTES --
------------------------

INSERT INTO tipos_usuario (tipo) VALUES
      ('normal')
    , ('mod')
    , ('admin')
;

INSERT INTO tipos_parentesco (tipo) VALUES
      ('Padre')
    , ('Madre')
    , ('Hijo/a')
    , ('Hermano/a')
    , ('Tío')
    , ('Tía')
    , ('Primo/a')
    , ('Abuelo')
    , ('Abuela')
    , ('Sobrino')
    , ('Sobrina')
    , ('Esposo')
    , ('Esposa')
    , ('Pareja')
    , ('Cuñado')
    , ('Cuñada')
    , ('Otro')
;

INSERT INTO tipos_aleatorios (tipo) VALUES
      ('Historia')
    , ('Apariencia')
;

INSERT INTO caracteristicas_aleatorias (tipo_aleatorio_id, contenido) VALUES
      (
          1
        , 'Historia aleatoria 1'
      )

    , (
          2
        , 'Apariencia aleatoria 1'
      )
    , (
          1
        , 'Historia aleatoria 2'
      )
    , (
          2
        , 'Apariencia aleatoria 2'
      )
;

INSERT INTO nombres_aleatorios (nombre) VALUES
      ('Felipe')
    , ('Gloria')
    , ('John')
    , ('Mariano')
;

INSERT INTO apellidos_aleatorios (apellido) VALUES
      ('Gonzalez')
    , ('Diaz')
    , ('Smith')
    , ('Rajoy')
;

---------------------
-- DATOS DE PRUEBA --
---------------------

INSERT INTO "user" (username, auth_key, password_hash, email) VALUES
      (
          'Prueba'
        , md5(random()::text)
        , crypt('123456', gen_salt('bf', 13))
        , 'prueba@prueba.com'
    )
    ,  (
          'Prueba2'
        , md5(random()::text)
        , crypt('123456', gen_salt('bf', 13))
        , 'prueba2@prueba.com'
    )
;
/*
INSERT INTO personajes (usuario_id, nombre) VALUES
    (
        1
      , 'Superman de humanes'
    )
    , (
        4
      , 'El gran Gatsbee'
    )
    , (
        3
      , 'Bomboman'
    )
    , (
        2
      , 'John Smith'
    )
    , (
        1
      , 'Mary Smith'
    )
;

INSERT INTO publicaciones (usuario_id, contenido) VALUES
    (
        1
      , 'Contenido'
    )
    , (
        4
      , 'Contenido'
    )
    , (
        3
      , 'Contenido'
    )
    , (
        2
      , 'Contenido'
    )
    , (
        1
      , 'Contenido'
    )
;

INSERT INTO comentarios (usuario_id, publicacion_id, contenido) VALUES
    (
        1
      , 1
      , 'Comentario'
    )
    , (
        4
      , 2
      , 'Comentario'
    )
    , (
        3
      , 2
      , 'Comentario'
    )
    , (
        2
      , 3
      , 'Comentario'
    )
    , (
        1
      , 1
      , 'Comentario'
    )
;

INSERT INTO comentarios (usuario_id, publicacion_id, comentario_id, contenido) VALUES
    (
        1
      , 1
      , 1
      , 'Respuesta'
    )
    , (
        1
      , 1
      , 1
      , 'Respuesta'
    )
    , (
        3
      , 2
      , 3
      , 'Respuesta'
    )
    , (
        2
      , 3
      , 4
      , 'Respuesta'
    )
    , (
        1
      , 1
      , 5
      , 'Respuesta'
    )
;

INSERT INTO mensajes_privados (emisor_id, receptor_id, asunto, contenido) VALUES
    (
        1
      , 2
      , 'Asunto'
      , 'Contenido'
    )
    , (
        4
      , 2
      , 'Asunto'
      , 'Contenido'
    )
    , (
        3
      , 2
      , 'Asunto'
      , 'Contenido'
    )
    , (
        2
      , 3
      , 'Asunto'
      , 'Contenido'
    )
    , (
        2
      , 1
      , 'Asunto'
      , 'Contenido'
    )
;

INSERT INTO parentezcos (propietario_id, nombre, tipo_parentezco_id) VALUES
      (
        1
      , 'Padre'
      , 1
    )
    , (
        1
      , 'Madre'
      , 2
    )
    , (
        2
      , 'Padre'
      , 1
    )
    , (
        2
      , 'Madre'
      , 1
    )
;

INSERT INTO parentezcos (propietario_id, nombre, tipo_parentezco_id, familiar_id) VALUES
      (
        1
      , 'Hermano'
      , 3
      , 3
    )
    , (
        1
      , 'Hermana'
      , 3
      , 4
    )
    , (
        2
      , 'Hermano'
      , 3
      , 5
    )
; */
