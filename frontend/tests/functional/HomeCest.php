<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

/**
 *
 */
class HomeCest
{
    /**
     * Comprueba el Inicio para invitados.
     * @param  FunctionalTester $I
     */
    public function homeParaGuest(FunctionalTester $I)
    {
        $I->amOnRoute('site/index');
        $I->see('Crea contenido', 'li');
        $I->see('Conecta con la gente', 'li');
        $I->see('Comparte tus creaciones', 'li');
    }

    /**
     * Comprueba el Inicio para conectados.
     * @param  FunctionalTester $I
     */
    public function homeParaLogged(FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnRoute('site/index');
        $I->see('Inicio', 'a');
        $I->see('Notificaciones', 'a');
        $I->see('Mensajes', 'a');
    }

    /**
     * Comprueba un login fallido desde home (campos no correctos).
     * @param  FunctionalTester $I
     */
    public function loginDesdeHomeFallido(FunctionalTester $I)
    {
        $I->amOnRoute('site/index');
        $I->fillField(['name' => 'LoginForm[username]'], 'No existo');
        $I->fillField(['name' => 'LoginForm[password]'], 'No existo');
        $I->click('Conectarte');
        $I->see('Conectarse', 'h1');
        $I->see('Nombre de usuario o contraseña incorrecta', '.help-block');
    }

    /**
     * Comprueba un login exitoso desde home.
     * @param  FunctionalTester $I
     */
    public function loginDesdeHomeExitoso(FunctionalTester $I)
    {
        $I->amOnRoute('site/index');
        $I->fillField(['name' => 'LoginForm[username]'], 'Prueba');
        $I->fillField(['name' => 'LoginForm[password]'], '123456');
        $I->click('Conectarte');
        $I->see('Inicio', 'a');
        $I->see('Notificaciones', 'a');
        $I->see('Mensajes', 'a');
    }

    /**
     * Comprueba que funciona correctamente el link a login desde el inicio.
     * @param  FunctionalTester $I
     */
    public function irALogin(FunctionalTester $I)
    {
        $I->amOnRoute('site/index');
        $I->click('Conectarse');
        $I->see('Conectarse', 'h1');
    }

    /**
     * Comprueba que funciona correctamente el link a signup desde el inicio.
     * @param  FunctionalTester $I
     */
    public function irASignUp(FunctionalTester $I)
    {
        $I->amOnRoute('site/index');
        $I->click('Registrarse');
        $I->see('Registrarse', 'h1');
    }

    /**
     * Comprueba que funciona correctamente el link para recuperar contraseña
     * desde el inicio.
     * @param  FunctionalTester $I
     */
    public function irARecuperarContraseña(FunctionalTester $I)
    {
        $I->amOnRoute('site/index');
        $I->click('¿Has olvidado tu contraseña?');
        $I->see('Recuperar contraseña', 'h1');
    }
}
