<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

/**
 *
 */
class PublicacionesCest
{
    public function accederSinLoggear(FunctionalTester $I)
    {
        $I->amOnRoute('publicaciones/create');
        $I->see('Conectarse', 'h1');
    }

    public function accederLoggeado(FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnRoute('publicaciones/create');
        $I->see('Crear publicación', 'h1');
    }

    public function noVacio(FunctionalTester $I)
    {
        $this->accederLoggeado($I);
        $I->click('Guardar');
        $I->see('Campo requerido', '.help-block');
    }

    public function crearPublicacion(FunctionalTester $I)
    {
        $this->accederLoggeado($I);
        $I->fillField(['name' => 'Publicaciones[titulo]'], 'Titulo');
        $I->fillField(['name' => 'Publicaciones[contenido]'], 'Contenido');
        $I->click('Guardar');
        $I->see('Comentarios', 'h3');
    }
}
