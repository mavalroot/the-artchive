------------------------
-- DATOS PERSISTENTES --
------------------------

INSERT INTO tipos_usuario (tipo) VALUES
      ('normal')
    , ('mod')
    , ('admin')
;

INSERT INTO tipos_parentezco (tipo) VALUES
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
