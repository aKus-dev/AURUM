<?php

interface iAlumno 
{
    // Alta y modificacion
    public function crear(array $datos);
    public function modificar(int $id);

    // Consultas
    public function realizarConsulta(string $titulo, string $descripcion, int $idProfesor);

}