<?php

interface iDocente
{
    // Alta y modificacion
    public function crear(array $datos);
    public function modificar(int $id);

    // Consultas
    public function contestarConsulta(string $descripcion, int $idAlumno);

}