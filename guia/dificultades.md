# Dificultades encontradas

1. A la hora de desplegar la aplicación en Heroku, y usando la plantilla avanzada, comenzó a presentar grandes problemas de configuración, que finalmente fueron solventados con el paquete de composer `purrweb/yii2-heroku` ([link](https://github.com/PurrWeb/yii2-heroku)), que automatiza todo el proceso y deja los entornos preparados para el despliegue. 

2. Para implementar el elemento de innovación de Foro, hubieron dificultades en cuanto a la elección de un módulo que se adecuara a las necesidades de la aplicación. Finalmente se optó por implementar `bizley/yii2-podium` ([link](https://github.com/bizley/yii2-podium)).

3. Para implementar el elemento de innovación de Multi idioma, de nuevo se presentó el problema de la plantilla avanzada. Se implementó además `gugglegum/yii2-cookie-language-selector`([link](https://github.com/gugglegum/yii2-cookie-language-selector)) para posteriormente manejar los idiomas.

4. Una vez más, la plantilla avanzada dio algunos problemas a la hora de implementar los test funcionales con Codeception, pero gracias a alguna que otra guia en internet pudo ser configurado y utilizado correctamente.

5. Para generar la documentación, y al no haber estado utilizando la plantilla facilitada por el profesor, hubo que hacer unos ligeros cambios, tomando como referencia la plantilla básica. El problema pudo ser solucionado gracias a un PR ([#140](https://github.com/mavalroot/the-artchive/pull/130)), y algunos cambios posteriores para reflejar la actualización desde la plantilla básica custom.
