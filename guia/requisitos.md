
# Catálogo de requisitos

| **R01**     | **Incidencias en Github**           |
| --------------: | :------------------- |
| **Descripción** | Requisitos perfectamente definidos y convertidos en incidencias (Issues) de Github.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [1](https://github.com/mavalroot/the-artchive/issues/1) |

| **R02**     | **Código fuente en Github**           |
| --------------: | :------------------- |
| **Descripción** | Código fuente publicado en Github.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [2](https://github.com/mavalroot/the-artchive/issues/2) |

| **R03**     | **Estilo del código según Yii**           |
| --------------: | :------------------- |
| **Descripción** | Estilo del código según las normas internas de Yii2 para el código y para las plantillas.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [3](https://github.com/mavalroot/the-artchive/issues/3) |

| **R04**     | **Tres lanzamientos**           |
| --------------: | :------------------- |
| **Descripción** | Tres lanzamientos (releases) etiquetados en el repositorio como v1, v2 y v3.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [4](https://github.com/mavalroot/the-artchive/issues/4) |

| **R05**     | **README en el directorio raíz**           |
| --------------: | :------------------- |
| **Descripción** | README.md en el directorio raíz con la descripción principal del proyecto.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [5](https://github.com/mavalroot/the-artchive/issues/5) |

| **R06**     | **Documentación en Github Pages**           |
| --------------: | :------------------- |
| **Descripción** | Documentación generada con yii2-apidoc y publicada en Github Pages a partir del contenido del directorio /docs:  a. Contenido:    i. Guía general    ii. API  b. Formato: Github flavored Markdown (fuente) y HTML (resultado).  c. Usar script publicar_doc.sh contenido en la raíz del proyecto.  d. Opciona: conversión a PDF             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Media         |
| **Entrega**     | v1             |
| **Incidencia**  | [6](https://github.com/mavalroot/the-artchive/issues/6) |

| **R07**     | **Solucionar todas las incidencias**           |
| --------------: | :------------------- |
| **Descripción** | Administración y resolución de todas las incidencias notificadas en Github.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [7](https://github.com/mavalroot/the-artchive/issues/7) |

| **R08**     | **Usar etiquetas e hitos**           |
| --------------: | :------------------- |
| **Descripción** | Usar etiquetas e hitos:  a. Etiquetas: mínimo, importante, opcional (además de las ya existentes).  b. Hitos: v1, v2, v3 (con fechas de entrega aproximadas).             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [8](https://github.com/mavalroot/the-artchive/issues/8) |

| **R09**     | **Versión más estable en la rama master**           |
| --------------: | :------------------- |
| **Descripción** | La rama master debe reflejar en todo momento el estado más estable de la aplicación, de manera que:  a. La rama master no debe contener bugs conocidos.  b. El desarrollo deberá hacerse en otras ramas creadas a tal efecto (una distinta por cada funcionalidad) y se irán combinando con la master una vez que se haya implementado la funcionalidad correspondiente.  c. Cada rama debe ir asociada con una incidencia. El nombre de la rama debe empezar por el número de la incidencia correspondiente (p. ej. 17-login).  d. La release actual en Heroku corresponderá siempre con el último commit de la rama master (usar los deploys automáticos de Heroku conectando la aplicación de Heroku con la rama master de Github).             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Media         |
| **Entrega**     | v3             |
| **Incidencia**  | [9](https://github.com/mavalroot/the-artchive/issues/9) |

| **R10**     | **Usar Waffle**           |
| --------------: | :------------------- |
| **Descripción** | Usar Waffle para la gestión general del proyecto.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [10](https://github.com/mavalroot/the-artchive/issues/10) |

| **R11**     | **Iteraciones**           |
| --------------: | :------------------- |
| **Descripción** | Al final de cada iteración:  a. Se realiza el lanzamiento que toque (v1, v2 o v3), etiquetando el commit correspondiente con el hito adecuado.  b. Se actualiza y publica la documentación.  c. Al final del Proyecto, se tiene que cumplir lo siguiente:    i. Todas las incidencias cerradas con su debida justificación.    ii. En el backlog sólo pueden quedar tarjetas con prioridad opcional.    iii. El lanzamiento v3 desplegado en la nube.    iv. La documentación correctamente actualizada y publicada.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [11](https://github.com/mavalroot/the-artchive/issues/11) |

| **R12**     | **Validación de formularios**           |
| --------------: | :------------------- |
| **Descripción** | Validación de los campos de los formularios usando JavaScript.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v2             |
| **Incidencia**  | [12](https://github.com/mavalroot/the-artchive/issues/12) |

| **R13**     | **Gestión de ventanas**           |
| --------------: | :------------------- |
| **Descripción** | Gestión de la apariencia de las ventanas. Creación de nuevas ventanas y comunicación entre ventanas.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Media         |
| **Entrega**     | v2             |
| **Incidencia**  | [13](https://github.com/mavalroot/the-artchive/issues/13) |

| **R14**     | **Manejo de eventos**           |
| --------------: | :------------------- |
| **Descripción** | Interactividad a través de mecanismo de manejo de eventos intuitivos y eficaces.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v3             |
| **Incidencia**  | [14](https://github.com/mavalroot/the-artchive/issues/14) |

| **R15**     | **Uso del DOM**           |
| --------------: | :------------------- |
| **Descripción** | Uso y manipulación de las características del modelo de objetos del documento (DOM).             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v3             |
| **Incidencia**  | [15](https://github.com/mavalroot/the-artchive/issues/15) |

| **R16**     | **Uso de mecanismos de almacenamiento**           |
| --------------: | :------------------- |
| **Descripción** | Uso de mecanismos de almacenamiento en el lado del cliente.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v2             |
| **Incidencia**  | [16](https://github.com/mavalroot/the-artchive/issues/16) |

| **R17**     | **Jquery**           |
| --------------: | :------------------- |
| **Descripción** | Uso de la librería Jquery.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v2             |
| **Incidencia**  | [17](https://github.com/mavalroot/the-artchive/issues/17) |

| **R18**     | **Plugins**           |
| --------------: | :------------------- |
| **Descripción** | Incluir al menos un plugin no trabajado en clase.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v2             |
| **Incidencia**  | [18](https://github.com/mavalroot/the-artchive/issues/18) |

| **R19**     | **Uso de AJAX**           |
| --------------: | :------------------- |
| **Descripción** | Utilización de mecanismos de comunicación asíncrona: AJAX.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Media         |
| **Entrega**     | v2             |
| **Incidencia**  | [19](https://github.com/mavalroot/the-artchive/issues/19) |

| **R20**     | **PHP 7.1**           |
| --------------: | :------------------- |
| **Descripción** | Usar PHP 7.1             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [20](https://github.com/mavalroot/the-artchive/issues/20) |

| **R21**     | **Yii2 Framework**           |
| --------------: | :------------------- |
| **Descripción** | Usar Yii2 Framework versión 2.0.10 o superior.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [21](https://github.com/mavalroot/the-artchive/issues/21) |

| **R22**     | **PostgreSQL**           |
| --------------: | :------------------- |
| **Descripción** | Usar PostgreSQL versión 9.6 o superior.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [22](https://github.com/mavalroot/the-artchive/issues/22) |

| **R23**     | **Uso de Heroku**           |
| --------------: | :------------------- |
| **Descripción** | Despliegue de la apliación en la bio Heroku.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Media         |
| **Entrega**     | v3             |
| **Incidencia**  | [23](https://github.com/mavalroot/the-artchive/issues/23) |

| **R24**     | **Uso de Codeception**           |
| --------------: | :------------------- |
| **Descripción** | Pruebas funcionales con Codeception.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Media         |
| **Entrega**     | v1             |
| **Incidencia**  | [24](https://github.com/mavalroot/the-artchive/issues/24) |

| **R25**     | **Uso de Code Climate**           |
| --------------: | :------------------- |
| **Descripción** | Estilo y mantenibilidad del código fuente validados por Code Climate.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Media         |
| **Entrega**     | v1             |
| **Incidencia**  | [25](https://github.com/mavalroot/the-artchive/issues/25) |

| **R26**     | **Escalabilidad de la aplicación**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación ha de ser escalable             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Media         |
| **Entrega**     | v3             |
| **Incidencia**  | [26](https://github.com/mavalroot/the-artchive/issues/26) |

| **R27**     | **Estructura en HTML5**           |
| --------------: | :------------------- |
| **Descripción** | Para estructurar el contenido se utilizarán las etiquetas semánticas de HTML5.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v2             |
| **Incidencia**  | [27](https://github.com/mavalroot/the-artchive/issues/27) |

| **R28**     | **Presentación con CSS3**           |
| --------------: | :------------------- |
| **Descripción** | Todo lo relacionado con la presentación se trabajará mediante CSS3.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Fácil         |
| **Entrega**     | v3             |
| **Incidencia**  | [28](https://github.com/mavalroot/the-artchive/issues/28) |

| **R29**     | **Diseño flexible**           |
| --------------: | :------------------- |
| **Descripción** | El diseño será flexible             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Media         |
| **Entrega**     | v3             |
| **Incidencia**  | [29](https://github.com/mavalroot/the-artchive/issues/29) |

| **R30**     | **Incluir Animaciones**           |
| --------------: | :------------------- |
| **Descripción** | Existirán transiciones, transformaciones, animaciones y contenido multimedia.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Media         |
| **Entrega**     | v3             |
| **Incidencia**  | [30](https://github.com/mavalroot/the-artchive/issues/30) |

| **R31**     | **Incluir Microdatos**           |
| --------------: | :------------------- |
| **Descripción** | Uso de microdatos.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [31](https://github.com/mavalroot/the-artchive/issues/31) |

| **R32**     | **Superar pruebas de HTML5 y CSS3**           |
| --------------: | :------------------- |
| **Descripción** | Se deberá comprobar que el código supera:  a. Validador para HTML5, CSS3.  b. Nivel de accesibilidad AA.  c. Prueba del seis.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Media         |
| **Entrega**     | v3             |
| **Incidencia**  | [32](https://github.com/mavalroot/the-artchive/issues/32) |

| **R33**     | **Diseño apto para diferentes resoluciones**           |
| --------------: | :------------------- |
| **Descripción** | Implementar el diseño para resoluciones grandes y pequeñas.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [33](https://github.com/mavalroot/the-artchive/issues/33) |

| **R34**     | **Diseño apto para diferentes navegadores**           |
| --------------: | :------------------- |
| **Descripción** | Comprobar que el diseño es correcto en: Internet Explorer, Chrome, Mozilla Firefox, Opera.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [34](https://github.com/mavalroot/the-artchive/issues/34) |

| **R35**     | **Despliegue en Host**           |
| --------------: | :------------------- |
| **Descripción** | Realizar el despliegue en un Host:   a. Utilizando algún servicio gratuito de hosting como los vistos en clase.  b. Instalar / configurar o solicitar el software necesario para desplegar el proyecto.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [35](https://github.com/mavalroot/the-artchive/issues/35) |

| **R36**     | **Despliegue en local**           |
| --------------: | :------------------- |
| **Descripción** | Realizar un despliegue en un servidor local usando y configurando tres máquinas virtuales para:  a. Crear un servicio de Nombres de dominio.  b. Gestionar y administrar el servidor Apache tanto en Windows como en Linux.    i. Instalar el servidor y configurarlo.    ii. Configurar directivas.    iii. Usar directorios virtuales y redireccionamientos.    iv. Usar diferentes módulos estáticos y dinámicos.    v. Usar autenticaciones.    vi. Usar ficheros de configuración personalizada de directorios.    vii. Usar HTTPS y certificados Digitales.              |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Técnico                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [36](https://github.com/mavalroot/the-artchive/issues/36) |

| **R37**     | **Registro de usuario**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá el registro de usuarios.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [37](https://github.com/mavalroot/the-artchive/issues/37) |

| **R38**     | **Correo de confirmación**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación enviará un correo de confirmación tras el registro para poder confirmar éste.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v1             |
| **Incidencia**  | [38](https://github.com/mavalroot/the-artchive/issues/38) |

| **R39**     | **Moderar usuarios**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá que un administrador borre, banee o modifique los usuarios.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v3             |
| **Incidencia**  | [39](https://github.com/mavalroot/the-artchive/issues/39) |

| **R40**     | **Baja de usuario**           |
| --------------: | :------------------- |
| **Descripción** | Un usuario podrá darse de baja. Al darse de baja podrá elegir si permite que queden contenidos de su autoría, o si por el contrario desea que todos sean eliminados.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v1             |
| **Incidencia**  | [40](https://github.com/mavalroot/the-artchive/issues/40) |

| **R41**     | **Modificar el perfil**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá gestionar el propio perfil de usuario.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [41](https://github.com/mavalroot/the-artchive/issues/41) |

| **R42**     | **Subir avatar**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá subir una imagen de avatar para el perfil.             |
| **Prioridad**   | Opcional           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v1             |
| **Incidencia**  | [42](https://github.com/mavalroot/the-artchive/issues/42) |

| **R43**     | **Ver usuarios**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá ver una lista con todos los usuarios.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [43](https://github.com/mavalroot/the-artchive/issues/43) |

| **R44**     | **Ver perfil de usuario**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá visualizar los perfiles de usuario.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [44](https://github.com/mavalroot/the-artchive/issues/44) |

| **R45**     | **Vincular creaciones a un usuario**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá vincular todas las creaciones a un usuario, de modo que éstas aparecerán de forma ordenada en su perfil.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [45](https://github.com/mavalroot/the-artchive/issues/45) |

| **R46**     | **Recuperar contraseña**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá recuperar la contraseña de un usuario mediante el envío de un correo electrónico de recuperación.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v1             |
| **Incidencia**  | [46](https://github.com/mavalroot/the-artchive/issues/46) |

| **R47**     | **Iniciar sesión**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá iniciar sesión facilitando el nombre de usuario y contraseña.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [47](https://github.com/mavalroot/the-artchive/issues/47) |

| **R48**     | **Cerrar sesión**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá cerrar sesión.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [48](https://github.com/mavalroot/the-artchive/issues/48) |

| **R49**     | **Moderación**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá a administradores y moderadores editar o eliminar todo o parte del contenido de la aplicación.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v1             |
| **Incidencia**  | [49](https://github.com/mavalroot/the-artchive/issues/49) |

| **R50**     | **Conceder permisos**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá dar permisos de moderador o administrador a otros usuarios.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v1             |
| **Incidencia**  | [50](https://github.com/mavalroot/the-artchive/issues/50) |

| **R51**     | **Quitar permisos**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá quitar permisos de moderador o administrador a otros usuarios.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v1             |
| **Incidencia**  | [51](https://github.com/mavalroot/the-artchive/issues/51) |

| **R52**     | **Seguir a un usuario**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá seguir a otros usuarios.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v2             |
| **Incidencia**  | [52](https://github.com/mavalroot/the-artchive/issues/52) |

| **R53**     | **Dejar de seguir a un usuario**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá dejar de seguir a otros usuarios.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v2             |
| **Incidencia**  | [53](https://github.com/mavalroot/the-artchive/issues/53) |

| **R54**     | **Ver a quién sigues**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá al usuario ver sus propia lista de siguiendo y las de los demás.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [54](https://github.com/mavalroot/the-artchive/issues/54) |

| **R55**     | **Ver seguidores**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá al usuario ver sus propios seguidores y los de los demás.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [55](https://github.com/mavalroot/the-artchive/issues/55) |

| **R56**     | **Ver bandeja de entrada**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá acceder a una bandeja de entrada donde recibiremos o enviaremos mensajes privados.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v1             |
| **Incidencia**  | [56](https://github.com/mavalroot/the-artchive/issues/56) |

| **R57**     | **Enviar mensaje privado**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá enviar mensajes privados a otros usuarios.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v1             |
| **Incidencia**  | [57](https://github.com/mavalroot/the-artchive/issues/57) |

| **R58**     | **Recibir mensaje privado**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá recibir mensajes privados de otros usuarios.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v1             |
| **Incidencia**  | [58](https://github.com/mavalroot/the-artchive/issues/58) |

| **R59**     | **Eliminar mensaje privado**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá eliminar los mensajes privados recibidos.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v1             |
| **Incidencia**  | [59](https://github.com/mavalroot/the-artchive/issues/59) |

| **R60**     | **Bloquear un usuario**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá bloquear a un usuario, de modo que éste no podrá enviarnos mensajes privados ni veremos su actividad.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v1             |
| **Incidencia**  | [60](https://github.com/mavalroot/the-artchive/issues/60) |

| **R61**     | **Ver notificaciones**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá ver todas las notificaciones que se hayan recibido.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Difícil         |
| **Entrega**     | v1             |
| **Incidencia**  | [61](https://github.com/mavalroot/the-artchive/issues/61) |

| **R62**     | **Recibir notificación por nuevo seguidor**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá recibir notificaciones cuando un usuario haya empezado a seguirnos.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Difícil         |
| **Entrega**     | v2             |
| **Incidencia**  | [62](https://github.com/mavalroot/the-artchive/issues/62) |

| **R63**     | **Recibir notificación por mensaje privado**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá recibir una notificación cuando se reciba un mensaje privado enviado por otro usuario.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Difícil         |
| **Entrega**     | v2             |
| **Incidencia**  | [63](https://github.com/mavalroot/the-artchive/issues/63) |

| **R64**     | **Crear personaje**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá crear un personaje, y al hacerlo se indicará la privacidad de éste (público, privado, sólo para seguidores...).             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [64](https://github.com/mavalroot/the-artchive/issues/64) |

| **R65**     | **Modificar personaje**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá modificar un personaje propio.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [65](https://github.com/mavalroot/the-artchive/issues/65) |

| **R66**     | **Eliminar personaje**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá eliminar un personaje propio.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [66](https://github.com/mavalroot/the-artchive/issues/66) |

| **R67**     | **Ver personajes**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá visualizar nuestros propios personajes.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [67](https://github.com/mavalroot/the-artchive/issues/67) |

| **R68**     | **Buscar un usuario**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá buscar a otros usuarios con diferentes filtros de búsqueda.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v1             |
| **Incidencia**  | [68](https://github.com/mavalroot/the-artchive/issues/68) |

| **R69**     | **Buscar un personaje**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá buscar a otros personajes con diferentes filtros de búsqueda.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v1             |
| **Incidencia**  | [69](https://github.com/mavalroot/the-artchive/issues/69) |

| **R70**     | **Publicar un comentario**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá publicar comentarios en publicaciones o personajes (si éstos lo permiten).             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v2             |
| **Incidencia**  | [70](https://github.com/mavalroot/the-artchive/issues/70) |

| **R71**     | **Editar comentario**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá modificar los propios comentarios.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v2             |
| **Incidencia**  | [71](https://github.com/mavalroot/the-artchive/issues/71) |

| **R72**     | **Borrar comentario**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá borrar los propios comentarios durante los primeros quince minutos tras su publicación.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Difícil         |
| **Entrega**     | v2             |
| **Incidencia**  | [72](https://github.com/mavalroot/the-artchive/issues/72) |

| **R73**     | **Crear publicaciones**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá crear publicaciones, que serán propias de cada usuario y se visualizarán en los perfiles de éstos. Además también se podrá definir su privacidad (pública, privada, sólo para seguidores…).             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v2             |
| **Incidencia**  | [73](https://github.com/mavalroot/the-artchive/issues/73) |

| **R74**     | **Editar publicaciones**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá modificar las propias publicaciones.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v2             |
| **Incidencia**  | [74](https://github.com/mavalroot/the-artchive/issues/74) |

| **R75**     | **Borrar publicaciones**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá borrar las propias publicaciones.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v2             |
| **Incidencia**  | [75](https://github.com/mavalroot/the-artchive/issues/75) |

| **R76**     | **Ver publicaciones**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá ver las publicaciones de un usuario.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v2             |
| **Incidencia**  | [76](https://github.com/mavalroot/the-artchive/issues/76) |

| **R77**     | **Crear un árbol genealógico**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá a los usuarios crear árboles genealógicos para sus personajes y vincularlos con otros personajes ya creados.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [77](https://github.com/mavalroot/the-artchive/issues/77) |

| **R78**     | **Editar un árbol genealógico**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá a los usuarios editar sus propios árboles genealógicos.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [78](https://github.com/mavalroot/the-artchive/issues/78) |

| **R79**     | **Solicitar adhesión a un árbol genealógico**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá solicitar la adhesión a un árbol genealógico ajeno.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [79](https://github.com/mavalroot/the-artchive/issues/79) |

| **R80**     | **Notificación de solicitud de árbol genealógico**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación nos notificará cuando se solicite añadir un personaje a un árbol genealógico.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [80](https://github.com/mavalroot/the-artchive/issues/80) |

| **R81**     | **Aceptar solicitud de árbol genealógico**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá aceptar solicitudes referentes a los árboles genealógicos.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [81](https://github.com/mavalroot/the-artchive/issues/81) |

| **R82**     | **Rechazar solicitud de árbol genealógico**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá rechazar solicitudes referentes a los árboles genealógicos.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [82](https://github.com/mavalroot/the-artchive/issues/82) |

| **R83**     | **Eliminar un árbol genealógico**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá a los usuarios borrar sus propios árboles genealógicos. Si hay otros personajes implicados sólo podrá borrarlos el creador.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v3             |
| **Incidencia**  | [83](https://github.com/mavalroot/the-artchive/issues/83) |

| **R84**     | **Vincular árbol genealógico y personajes**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá vincular un árbol genealógico con un personaje o personajes, de modo que se podrán visualizar desde la información de éstos.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v3             |
| **Incidencia**  | [84](https://github.com/mavalroot/the-artchive/issues/84) |

| **R85**     | **Generar árbol genealógico visual**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá generar un árbol genealógico visual y exportarlo en formato HTML.             |
| **Prioridad**   | Opcional           |
| **Tipo**        | Funcional                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [85](https://github.com/mavalroot/the-artchive/issues/85) |

| **R86**     | **Generar personaje aleatorio**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá generar un personaje de forma aleatoria.             |
| **Prioridad**   | Opcional           |
| **Tipo**        | Funcional                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [86](https://github.com/mavalroot/the-artchive/issues/86) |

| **R87**     | **Elegir idioma**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación estará disponible en inglés y en español.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Funcional                |
| **Complejidad** | Difícil         |
| **Entrega**     | v3             |
| **Incidencia**  | [87](https://github.com/mavalroot/the-artchive/issues/87) |

| **R88**     | **Sugerir traducción**           |
| --------------: | :------------------- |
| **Descripción** | La aplicación permitirá enviar sugerencias de traducciones, o correcciones de traducciones ya existentes a través de un formulario.             |
| **Prioridad**   | Mínimo           |
| **Tipo**        | Funcional                |
| **Complejidad** | Fácil         |
| **Entrega**     | v3             |
| **Incidencia**  | [88](https://github.com/mavalroot/the-artchive/issues/88) |

| **R89**     | **Uso de Amazon S3**           |
| --------------: | :------------------- |
| **Descripción** | Se investigará el uso de Amazon S3 para usarla para subir archivos.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Funcional                |
| **Complejidad** | Media         |
| **Entrega**     | v2             |
| **Incidencia**  | [89](https://github.com/mavalroot/the-artchive/issues/89) |

| **R90**     | **Info. Registro de Usuario**           |
| --------------: | :------------------- |
| **Descripción** | Para efectuar el registro de usuario, se almacenará como mínimo un nombre de usuario único e irrepetible, una dirección de correo válida e irrepetible, y una contraseña.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Información                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [90](https://github.com/mavalroot/the-artchive/issues/90) |

| **R91**     | **Info. Datos de Usuario**           |
| --------------: | :------------------- |
| **Descripción** | Adicionalmente, al completar el perfil, se almacenará de un usuario, cómo mínimo: aficiones, temática favorita, bios, web, avatar…             |
| **Prioridad**   | Importante           |
| **Tipo**        | Información                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [91](https://github.com/mavalroot/the-artchive/issues/91) |

| **R92**     | **Info. Mensajes Privados**           |
| --------------: | :------------------- |
| **Descripción** | Se almacenará el emisor, el receptor, el contenido y la fecha.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Información                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [92](https://github.com/mavalroot/the-artchive/issues/92) |

| **R93**     | **Info. Personajes**           |
| --------------: | :------------------- |
| **Descripción** | Se almacenará, como mínimo: nombre, edad, historia y otros datos.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Información                |
| **Complejidad** | Fácil         |
| **Entrega**     | v1             |
| **Incidencia**  | [93](https://github.com/mavalroot/the-artchive/issues/93) |

| **R94**     | **Info. Comentarios**           |
| --------------: | :------------------- |
| **Descripción** | Se almacenará el nombre del emisor, si se trata de un comentario a una publicación o personaje, el id de dicha publicación o personaje, el contenido, la fecha y comentario al que responde (si lo hubiera).             |
| **Prioridad**   | Importante           |
| **Tipo**        | Información                |
| **Complejidad** | Fácil         |
| **Entrega**     | v2             |
| **Incidencia**  | [94](https://github.com/mavalroot/the-artchive/issues/94) |

| **R95**     | **Info. Publicaciones**           |
| --------------: | :------------------- |
| **Descripción** | Se almacenará el autor, el contenido y la fecha.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Información                |
| **Complejidad** | Fácil         |
| **Entrega**     | v2             |
| **Incidencia**  | [95](https://github.com/mavalroot/the-artchive/issues/95) |

| **R96**     | **Info. Árbol genealógico**           |
| --------------: | :------------------- |
| **Descripción** | Se almacenará, como mínimo: el personaje para el que fue creado, y las relaciones personaje-familiar.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Información                |
| **Complejidad** | Fácil         |
| **Entrega**     | v3             |
| **Incidencia**  | [96](https://github.com/mavalroot/the-artchive/issues/96) |

| **R97**     | **Info. Sugerencias de traducción**           |
| --------------: | :------------------- |
| **Descripción** | Se almacenará, como mínimo: el nombre del emisor, el contenido y  la fecha.             |
| **Prioridad**   | Importante           |
| **Tipo**        | Información                |
| **Complejidad** | Fácil         |
| **Entrega**     | v3             |
| **Incidencia**  | [97](https://github.com/mavalroot/the-artchive/issues/97) |


## Cuadro resumen

| **Requisito** | **Prioridad** | **Tipo** | **Complejidad** | **Entrega** | **Incidencia** |
| :------------ | :-----------: | :------: | :-------------: | :---------: | :------------: |
| (**R01**) Incidencias en Github | Mínimo | Técnico | Fácil | v1 | [1](https://github.com/mavalroot/the-artchive/issues/1) |
| (**R02**) Código fuente en Github | Mínimo | Técnico | Fácil | v1 | [2](https://github.com/mavalroot/the-artchive/issues/2) |
| (**R03**) Estilo del código según Yii | Mínimo | Técnico | Fácil | v1 | [3](https://github.com/mavalroot/the-artchive/issues/3) |
| (**R04**) Tres lanzamientos | Mínimo | Técnico | Fácil | v1 | [4](https://github.com/mavalroot/the-artchive/issues/4) |
| (**R05**) README en el directorio raíz | Mínimo | Técnico | Fácil | v1 | [5](https://github.com/mavalroot/the-artchive/issues/5) |
| (**R06**) Documentación en Github Pages | Mínimo | Técnico | Media | v1 | [6](https://github.com/mavalroot/the-artchive/issues/6) |
| (**R07**) Solucionar todas las incidencias | Mínimo | Técnico | Difícil | v3 | [7](https://github.com/mavalroot/the-artchive/issues/7) |
| (**R08**) Usar etiquetas e hitos | Mínimo | Técnico | Fácil | v1 | [8](https://github.com/mavalroot/the-artchive/issues/8) |
| (**R09**) Versión más estable en la rama master | Mínimo | Técnico | Media | v3 | [9](https://github.com/mavalroot/the-artchive/issues/9) |
| (**R10**) Usar Waffle | Mínimo | Técnico | Fácil | v1 | [10](https://github.com/mavalroot/the-artchive/issues/10) |
| (**R11**) Iteraciones | Mínimo | Técnico | Difícil | v3 | [11](https://github.com/mavalroot/the-artchive/issues/11) |
| (**R12**) Validación de formularios | Mínimo | Técnico | Fácil | v2 | [12](https://github.com/mavalroot/the-artchive/issues/12) |
| (**R13**) Gestión de ventanas | Mínimo | Técnico | Media | v2 | [13](https://github.com/mavalroot/the-artchive/issues/13) |
| (**R14**) Manejo de eventos | Mínimo | Técnico | Fácil | v3 | [14](https://github.com/mavalroot/the-artchive/issues/14) |
| (**R15**) Uso del DOM | Mínimo | Técnico | Fácil | v3 | [15](https://github.com/mavalroot/the-artchive/issues/15) |
| (**R16**) Uso de mecanismos de almacenamiento | Mínimo | Técnico | Fácil | v2 | [16](https://github.com/mavalroot/the-artchive/issues/16) |
| (**R17**) Jquery | Mínimo | Técnico | Fácil | v2 | [17](https://github.com/mavalroot/the-artchive/issues/17) |
| (**R18**) Plugins | Mínimo | Técnico | Fácil | v2 | [18](https://github.com/mavalroot/the-artchive/issues/18) |
| (**R19**) Uso de AJAX | Mínimo | Técnico | Media | v2 | [19](https://github.com/mavalroot/the-artchive/issues/19) |
| (**R20**) PHP 7.1 | Mínimo | Técnico | Fácil | v1 | [20](https://github.com/mavalroot/the-artchive/issues/20) |
| (**R21**) Yii2 Framework | Mínimo | Técnico | Fácil | v1 | [21](https://github.com/mavalroot/the-artchive/issues/21) |
| (**R22**) PostgreSQL | Mínimo | Técnico | Fácil | v1 | [22](https://github.com/mavalroot/the-artchive/issues/22) |
| (**R23**) Uso de Heroku | Mínimo | Técnico | Media | v3 | [23](https://github.com/mavalroot/the-artchive/issues/23) |
| (**R24**) Uso de Codeception | Mínimo | Técnico | Media | v1 | [24](https://github.com/mavalroot/the-artchive/issues/24) |
| (**R25**) Uso de Code Climate | Mínimo | Técnico | Media | v1 | [25](https://github.com/mavalroot/the-artchive/issues/25) |
| (**R26**) Escalabilidad de la aplicación | Mínimo | Técnico | Media | v3 | [26](https://github.com/mavalroot/the-artchive/issues/26) |
| (**R27**) Estructura en HTML5 | Mínimo | Técnico | Fácil | v2 | [27](https://github.com/mavalroot/the-artchive/issues/27) |
| (**R28**) Presentación con CSS3 | Mínimo | Técnico | Fácil | v3 | [28](https://github.com/mavalroot/the-artchive/issues/28) |
| (**R29**) Diseño flexible | Mínimo | Técnico | Media | v3 | [29](https://github.com/mavalroot/the-artchive/issues/29) |
| (**R30**) Incluir Animaciones | Mínimo | Técnico | Media | v3 | [30](https://github.com/mavalroot/the-artchive/issues/30) |
| (**R31**) Incluir Microdatos | Mínimo | Técnico | Difícil | v3 | [31](https://github.com/mavalroot/the-artchive/issues/31) |
| (**R32**) Superar pruebas de HTML5 y CSS3 | Mínimo | Técnico | Media | v3 | [32](https://github.com/mavalroot/the-artchive/issues/32) |
| (**R33**) Diseño apto para diferentes resoluciones | Mínimo | Técnico | Difícil | v3 | [33](https://github.com/mavalroot/the-artchive/issues/33) |
| (**R34**) Diseño apto para diferentes navegadores | Mínimo | Técnico | Difícil | v3 | [34](https://github.com/mavalroot/the-artchive/issues/34) |
| (**R35**) Despliegue en Host | Mínimo | Técnico | Difícil | v3 | [35](https://github.com/mavalroot/the-artchive/issues/35) |
| (**R36**) Despliegue en local | Mínimo | Técnico | Difícil | v3 | [36](https://github.com/mavalroot/the-artchive/issues/36) |
| (**R37**) Registro de usuario | Mínimo | Funcional | Fácil | v1 | [37](https://github.com/mavalroot/the-artchive/issues/37) |
| (**R38**) Correo de confirmación | Importante | Funcional | Media | v1 | [38](https://github.com/mavalroot/the-artchive/issues/38) |
| (**R39**) Moderar usuarios | Importante | Funcional | Media | v3 | [39](https://github.com/mavalroot/the-artchive/issues/39) |
| (**R40**) Baja de usuario | Mínimo | Funcional | Media | v1 | [40](https://github.com/mavalroot/the-artchive/issues/40) |
| (**R41**) Modificar el perfil | Mínimo | Funcional | Fácil | v1 | [41](https://github.com/mavalroot/the-artchive/issues/41) |
| (**R42**) Subir avatar | Opcional | Funcional | Media | v1 | [42](https://github.com/mavalroot/the-artchive/issues/42) |
| (**R43**) Ver usuarios | Mínimo | Funcional | Fácil | v1 | [43](https://github.com/mavalroot/the-artchive/issues/43) |
| (**R44**) Ver perfil de usuario | Mínimo | Funcional | Fácil | v1 | [44](https://github.com/mavalroot/the-artchive/issues/44) |
| (**R45**) Vincular creaciones a un usuario | Mínimo | Funcional | Fácil | v1 | [45](https://github.com/mavalroot/the-artchive/issues/45) |
| (**R46**) Recuperar contraseña | Importante | Funcional | Media | v1 | [46](https://github.com/mavalroot/the-artchive/issues/46) |
| (**R47**) Iniciar sesión | Mínimo | Funcional | Fácil | v1 | [47](https://github.com/mavalroot/the-artchive/issues/47) |
| (**R48**) Cerrar sesión | Mínimo | Funcional | Fácil | v1 | [48](https://github.com/mavalroot/the-artchive/issues/48) |
| (**R49**) Moderación | Importante | Funcional | Media | v1 | [49](https://github.com/mavalroot/the-artchive/issues/49) |
| (**R50**) Conceder permisos | Importante | Funcional | Media | v1 | [50](https://github.com/mavalroot/the-artchive/issues/50) |
| (**R51**) Quitar permisos | Importante | Funcional | Media | v1 | [51](https://github.com/mavalroot/the-artchive/issues/51) |
| (**R52**) Seguir a un usuario | Importante | Funcional | Media | v2 | [52](https://github.com/mavalroot/the-artchive/issues/52) |
| (**R53**) Dejar de seguir a un usuario | Importante | Funcional | Media | v2 | [53](https://github.com/mavalroot/the-artchive/issues/53) |
| (**R54**) Ver a quién sigues | Importante | Funcional | Fácil | v1 | [54](https://github.com/mavalroot/the-artchive/issues/54) |
| (**R55**) Ver seguidores | Importante | Funcional | Fácil | v1 | [55](https://github.com/mavalroot/the-artchive/issues/55) |
| (**R56**) Ver bandeja de entrada | Importante | Funcional | Media | v1 | [56](https://github.com/mavalroot/the-artchive/issues/56) |
| (**R57**) Enviar mensaje privado | Importante | Funcional | Media | v1 | [57](https://github.com/mavalroot/the-artchive/issues/57) |
| (**R58**) Recibir mensaje privado | Importante | Funcional | Media | v1 | [58](https://github.com/mavalroot/the-artchive/issues/58) |
| (**R59**) Eliminar mensaje privado | Importante | Funcional | Media | v1 | [59](https://github.com/mavalroot/the-artchive/issues/59) |
| (**R60**) Bloquear un usuario | Importante | Funcional | Media | v1 | [60](https://github.com/mavalroot/the-artchive/issues/60) |
| (**R61**) Ver notificaciones | Importante | Funcional | Difícil | v1 | [61](https://github.com/mavalroot/the-artchive/issues/61) |
| (**R62**) Recibir notificación por nuevo seguidor | Importante | Funcional | Difícil | v2 | [62](https://github.com/mavalroot/the-artchive/issues/62) |
| (**R63**) Recibir notificación por mensaje privado | Importante | Funcional | Difícil | v2 | [63](https://github.com/mavalroot/the-artchive/issues/63) |
| (**R64**) Crear personaje | Mínimo | Funcional | Fácil | v1 | [64](https://github.com/mavalroot/the-artchive/issues/64) |
| (**R65**) Modificar personaje | Mínimo | Funcional | Fácil | v1 | [65](https://github.com/mavalroot/the-artchive/issues/65) |
| (**R66**) Eliminar personaje | Mínimo | Funcional | Fácil | v1 | [66](https://github.com/mavalroot/the-artchive/issues/66) |
| (**R67**) Ver personajes | Mínimo | Funcional | Fácil | v1 | [67](https://github.com/mavalroot/the-artchive/issues/67) |
| (**R68**) Buscar un usuario | Mínimo | Funcional | Media | v1 | [68](https://github.com/mavalroot/the-artchive/issues/68) |
| (**R69**) Buscar un personaje | Mínimo | Funcional | Media | v1 | [69](https://github.com/mavalroot/the-artchive/issues/69) |
| (**R70**) Publicar un comentario | Importante | Funcional | Media | v2 | [70](https://github.com/mavalroot/the-artchive/issues/70) |
| (**R71**) Editar comentario | Importante | Funcional | Media | v2 | [71](https://github.com/mavalroot/the-artchive/issues/71) |
| (**R72**) Borrar comentario | Importante | Funcional | Difícil | v2 | [72](https://github.com/mavalroot/the-artchive/issues/72) |
| (**R73**) Crear publicaciones | Importante | Funcional | Media | v2 | [73](https://github.com/mavalroot/the-artchive/issues/73) |
| (**R74**) Editar publicaciones | Importante | Funcional | Media | v2 | [74](https://github.com/mavalroot/the-artchive/issues/74) |
| (**R75**) Borrar publicaciones | Importante | Funcional | Media | v2 | [75](https://github.com/mavalroot/the-artchive/issues/75) |
| (**R76**) Ver publicaciones | Importante | Funcional | Media | v2 | [76](https://github.com/mavalroot/the-artchive/issues/76) |
| (**R77**) Crear un árbol genealógico | Importante | Funcional | Difícil | v3 | [77](https://github.com/mavalroot/the-artchive/issues/77) |
| (**R78**) Editar un árbol genealógico | Importante | Funcional | Difícil | v3 | [78](https://github.com/mavalroot/the-artchive/issues/78) |
| (**R79**) Solicitar adhesión a un árbol genealógico | Importante | Funcional | Difícil | v3 | [79](https://github.com/mavalroot/the-artchive/issues/79) |
| (**R80**) Notificación de solicitud de árbol genealógico | Importante | Funcional | Difícil | v3 | [80](https://github.com/mavalroot/the-artchive/issues/80) |
| (**R81**) Aceptar solicitud de árbol genealógico | Importante | Funcional | Difícil | v3 | [81](https://github.com/mavalroot/the-artchive/issues/81) |
| (**R82**) Rechazar solicitud de árbol genealógico | Importante | Funcional | Difícil | v3 | [82](https://github.com/mavalroot/the-artchive/issues/82) |
| (**R83**) Eliminar un árbol genealógico | Importante | Funcional | Media | v3 | [83](https://github.com/mavalroot/the-artchive/issues/83) |
| (**R84**) Vincular árbol genealógico y personajes | Importante | Funcional | Media | v3 | [84](https://github.com/mavalroot/the-artchive/issues/84) |
| (**R85**) Generar árbol genealógico visual | Opcional | Funcional | Difícil | v3 | [85](https://github.com/mavalroot/the-artchive/issues/85) |
| (**R86**) Generar personaje aleatorio | Opcional | Funcional | Difícil | v3 | [86](https://github.com/mavalroot/the-artchive/issues/86) |
| (**R87**) Elegir idioma | Mínimo | Funcional | Difícil | v3 | [87](https://github.com/mavalroot/the-artchive/issues/87) |
| (**R88**) Sugerir traducción | Mínimo | Funcional | Fácil | v3 | [88](https://github.com/mavalroot/the-artchive/issues/88) |
| (**R89**) Uso de Amazon S3 | Importante | Funcional | Media | v2 | [89](https://github.com/mavalroot/the-artchive/issues/89) |
| (**R90**) Info. Registro de Usuario | Importante | Información | Fácil | v1 | [90](https://github.com/mavalroot/the-artchive/issues/90) |
| (**R91**) Info. Datos de Usuario | Importante | Información | Fácil | v1 | [91](https://github.com/mavalroot/the-artchive/issues/91) |
| (**R92**) Info. Mensajes Privados | Importante | Información | Fácil | v1 | [92](https://github.com/mavalroot/the-artchive/issues/92) |
| (**R93**) Info. Personajes | Importante | Información | Fácil | v1 | [93](https://github.com/mavalroot/the-artchive/issues/93) |
| (**R94**) Info. Comentarios | Importante | Información | Fácil | v2 | [94](https://github.com/mavalroot/the-artchive/issues/94) |
| (**R95**) Info. Publicaciones | Importante | Información | Fácil | v2 | [95](https://github.com/mavalroot/the-artchive/issues/95) |
| (**R96**) Info. Árbol genealógico | Importante | Información | Fácil | v3 | [96](https://github.com/mavalroot/the-artchive/issues/96) |
| (**R97**) Info. Sugerencias de traducción | Importante | Información | Fácil | v3 | [97](https://github.com/mavalroot/the-artchive/issues/97) |
