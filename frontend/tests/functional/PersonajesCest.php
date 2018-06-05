<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

/**
 *
 */
class PersonajesCest
{
    public function accederSinLoggear(FunctionalTester $I)
    {
        $I->amOnRoute('personajes/create');
        $I->see('Login', 'h1');
    }

    public function accederLoggeado(FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnRoute('personajes/create');
        $I->see('Crear personaje', 'h1');
    }

    public function noVacio(FunctionalTester $I)
    {
        $this->accederLoggeado($I);
        $I->click('Guardar');
        $I->see('Campo requerido', '.help-block');
    }

    public function crearPersonaje(FunctionalTester $I)
    {
        $this->accederLoggeado($I);
        $I->fillField(['name' => 'Personajes[nombre]'], 'Nombre');
        $I->click('Guardar');
        $I->see('Relaciones', 'h3');
    }
}
