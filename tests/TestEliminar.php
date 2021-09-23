<?php

require './vendor/autoload.php';

use PHPUnit\Framework\TestCase;

// ./vendor/bin/phpunit tests/TestEliminar.php

class TestEliminar extends TestCase
{

    /** @test */
    public function revisar_cedula_admi()
    {
        require './config/db.php';
        require './clases/Sistema.php';

        $db = conectarDb();
        $resultado = Sistema::revisarCedula('11111111', $db);

        // Debería de haber encontrado la cedula, ya que es la del administrador
        $this->assertEquals(true, $resultado);
    }
}
