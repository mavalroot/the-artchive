# Instrucciones de instalación y despliegue

## En local

Requisitos:
- PHP 7.1.
- PostgreSQL.
- Composer.
- Servidor Apache.
- Una cuenta de correo de gmail.

Pasos:
- Clonar o descargar el proyecto.
- Hacer `composer install`.
- Para las bases de datos, hacer `./db/create.sh` y `./db/load.sh`.
- Cambiar el correo electrónico del administrador en `common/config/params.php`.
- Crear la variable de entorno STMP_PASS con la clave de aplicación del correo electrónico.
- Configurar el servidor apache con un nombre de dominio para frontend (por ejemplo: artchive-front.local) y enlazarlo a frontend/web.
- Configurar el servidor apache con un nombre de dominio para el backend (por ejemplo: artchive-back.local) y enlazarlo a backend/web.
- Entrar en artchive-front.local/podium/install para instalar la base de datos del foro.

## En la nube

Para la instalación de la aplicación en la nube usaremos Heroku, por lo que una cuénta en dicha plataforma será necesaria para continuar.

Con nuestra cuenta de Heroku, realizaremos los siguientes pasos:

- Con nuestra cuenta de Heroku deberemos crear una aplicación. Además, necesitaremos el comando `heroku` para consola y poder así con la consola.

- Añadir la extensión para postgres y cargar la base de datos.

Comandos:
```
heroku login
heroku apps:create nombreAplicacion --region eu
heroku addons:create heroku-postgresql
heroku pg:psql < db/load.sql
heroku pg:psql
create extension pgcrypto;
heroku config:set SMTP_PASS=clave
git push -u heroku master
```
