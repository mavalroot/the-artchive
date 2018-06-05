<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

/**
 *
 */
class HomeCest
{
    public function homeParaGuest(FunctionalTester $I)
    {
        $I->amOnRoute('site/index');
        $I->see('Crea contenido', 'li');
        $I->see('Conecta con la gente', 'li');
        $I->see('Comparte tus creaciones', 'li');
    }

    public function homeParaLogged(FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnRoute('site/index');
        $I->see('Inicio', 'a');
        $I->see('Notificaciones', 'a');
        $I->see('Mensajes', 'a');
    }

    public function loginDesdeHomeFallido(FunctionalTester $I)
    {
        $I->amOnRoute('site/index');
        $I->fillField(['name' => 'LoginForm[username]'], 'No existo');
        $I->fillField(['name' => 'LoginForm[password]'], 'No existo');
        $I->click('Conectarte');
        $I->see('Login', 'h1');
        // $I->see('Nombre de usuario o contraseña incorrecta', '.help-block');
    }

    public function loginDesdeHomeExitoso(FunctionalTester $I)
    {
        $I->amOnRoute('site/index');
        $I->fillField(['name' => 'LoginForm[username]'], 'Admin');
        $I->fillField(['name' => 'LoginForm[password]'], '123456');
        $I->click('Conectarte');
        $I->see('Inicio', 'a');
        $I->see('Notificaciones', 'a');
        $I->see('Mensajes', 'a');
    }

    public function irALogin(FunctionalTester $I)
    {
        $I->amOnRoute('site/index');
        $I->click('Conectarse');
        $I->see('Login', 'h1');
    }

    public function irASignUp(FunctionalTester $I)
    {
        $I->amOnRoute('site/index');
        $I->click('Registrarse');
        $I->see('Signup', 'h1');
    }
}
