<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

/**
 *
 */
class PublicacionesCest
{

    /**
     * Comprueba que no se puede acceder sin loggear.
     * @param  FunctionalTester $I
     */
    public function accederSinLoggear(FunctionalTester $I)
    {
        $I->amOnRoute('publicaciones/create');
        $I->see('Conectarse', 'h1');
    }

    /**
     * Comprueba que se puede acceder loggeado.
     * @param  FunctionalTester $I
     */
    public function accederLoggeado(FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnRoute('publicaciones/create');
        $I->see('Crear publicación', 'h1');
    }

    /**
     * Comprueba que no se puede crear una publicación vacía.
     * @param  FunctionalTester $I
     */
    public function noVacio(FunctionalTester $I)
    {
        $this->accederLoggeado($I);
        $I->click('Guardar');
        $I->see('Campo requerido', '.help-block');
    }

    /**
     * Comprueba que se crea una publicación correctamente.
     * @param  FunctionalTester $I
     */
    public function crearPublicacion(FunctionalTester $I)
    {
        $this->accederLoggeado($I);
        $I->fillField(['name' => 'Publicaciones[titulo]'], 'Titulo');
        $I->fillField(['name' => 'Publicaciones[contenido]'], 'Contenido');
        $I->click('Guardar');
        $I->see('Comentarios', 'h3');
    }
}
