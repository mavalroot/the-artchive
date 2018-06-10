<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

/**
 *
 */
class PersonajesCest
{
    /**
     * Comprueba que no se puede acceder sin loggear.
     * @param  FunctionalTester $I
     */
    public function accederSinLoggear(FunctionalTester $I)
    {
        $I->amOnRoute('personajes/create');
        $I->see('Conectarse', 'h1');
    }

    /**
     * Comprueba que se puede acceder loggeado.
     * @param  FunctionalTester $I
     */
    public function accederLoggeado(FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnRoute('personajes/create');
        $I->see('Crear personaje', 'h1');
    }

    /**
     * Comprueba que no se puede crear un personaje vacío.
     * @param  FunctionalTester $I
     */
    public function noVacio(FunctionalTester $I)
    {
        $this->accederLoggeado($I);
        $I->click('Guardar');
        $I->see('Campo requerido', '.help-block');
    }

    /**
     * Comprueba que se crea un personaje correctamente.
     * @param  FunctionalTester $I
     */
    public function crearPersonaje(FunctionalTester $I)
    {
        $this->accederLoggeado($I);
        $I->fillField(['name' => 'Personajes[nombre]'], 'Nombre');
        $I->click('Guardar');
        $I->see('Relaciones', 'h3');
    }
}
