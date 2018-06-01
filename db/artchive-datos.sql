------------------------
-- DATOS PERSISTENTES --
------------------------

INSERT INTO tipos_usuario (tipo) VALUES
      ('admin')
    , ('normal')
    , ('mod')
;

INSERT INTO tipos_relaciones (tipo) VALUES
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

INSERT INTO tipos_notificaciones (tipo) VALUES
      ('mensajes privados')
    , ('comentarios')
    , ('relaciones')
    , ('seguidores')
;

---------------------
-- DATOS DE PRUEBA --
---------------------

INSERT INTO "user" (username, auth_key, password_hash, email, tipo_usuario) VALUES
    (
          'Admin'
        , md5(random()::text)
        , crypt('123456', gen_salt('bf', 13))
        , 'admin@prueba.com'
        , 1
    )
    , (
          'Prueba'
        , md5(random()::text)
        , crypt('123456', gen_salt('bf', 13))
        , 'prueba@prueba.com'
        , 2
    )
    ,  (
          'Prueba2'
        , md5(random()::text)
        , crypt('123456', gen_salt('bf', 13))
        , 'prueba2@prueba.com'
        , 2
    )
;

INSERT INTO usuarios_datos (usuario_id) VALUES
      (1)
    , (2)
    , (3)
;
