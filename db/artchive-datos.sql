------------------------
-- DATOS PERSISTENTES --
------------------------

INSERT INTO tipos_usuario (tipo) VALUES
      ('admin')
    , ('normal')
    , ('mod')
;

INSERT INTO tipos_relaciones (tipo_es, tipo_en) VALUES
      ('Padre', 'Father')
    , ('Madre', 'Mother')
    , ('Hijo', 'Son')
    , ('Hija', 'Daughter')
    , ('Hermano/a', 'Sibling')
    , ('Tío', 'Uncle')
    , ('Tía', 'Aunt')
    , ('Primo/a', 'Cousin')
    , ('Abuelo', 'Grandfather')
    , ('Abuela', 'Grandmother')
    , ('Sobrino', 'Nephew')
    , ('Sobrina', 'Niece')
    , ('Esposo', 'Husband')
    , ('Esposa', 'Wife')
    , ('Pareja', 'Partner')
    , ('Cuñado', 'Brother-in-law')
    , ('Cuñada', 'Sister-in-law')
    , ('Otro', 'Other')
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
