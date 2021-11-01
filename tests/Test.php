<?php

require './vendor/autoload.php'; 
require './config/db.php';
require './clases/Sistema.php';
require './clases/Administrador.php';
require './clases/Alumno.php';


use PHPUnit\Framework\TestCase;


class Test extends TestCase
{

    /** @test */
    public function testRevisarCedulaAdmin()
    {
        $db = conectarDb();
        $resultado = Sistema::revisarCedula('11111111', $db);

        // Debería de haber encontrado la cedula, ya que es la del administrador
        $this->assertEquals(true, $resultado);
    }

     /** @test */
     public function testEliminarUsuario()
     {
         $db = conectarDb();

         $cedulaAdmin = '11111111';
         $resultado = Administrador::eliminarUsuario($cedulaAdmin, $db);
 
         // Se espera que sea falso, ya que no se puede eliminar al administrador
         $this->assertEquals(false, $resultado);
     }

     /** @test */
     public function testRevisarEmail() {
        $db = conectarDb();

        $email = "usuario@gmail.com";
        $resultado = Sistema::revisarMail($email, $db);

        // Se espera que sea el resultado sea un valor booleano
        $this->assertIsBool($resultado); 
        
     }

      /** @test */
      public function testGetDatosAlumno() {
        $db = conectarDb();

        $idAlumno = 4;
        $datos = Alumno::getDatos($idAlumno, $db);

        // Nos debería de retornar un array asociativo iterable
        $this->assertIsIterable($datos); 
        
     }

     public function testGetHorarios() {
         $db = conectarDb();

         $ciDocente = '';
         $resultado = Docente::getHorarios($ciDocente, $db);
         $this->assertEquals(false, $resultado);


         $ciDocente = '22222222';
         $resultado = Docente::getHorarios($ciDocente, $db);
         $this->assertIsArray($resultado);

     }

}
