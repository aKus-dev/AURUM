<?php

interface iAdministrador
{
    // Métodos para gestionar alumnos
    public function crearAlumno(array $datos);  
    public function eliminarAlumno(string $cedula); 
    public function modificarAlumno(string $cedula);

    // Métodos para gestionar docentes
    public function crearDocente(array $datos); 
    public function eliminarDocente(string $cedula); 
    public function modificarDocente(string $cedula);

    // Métodos para gestionar asignaturas
    public function crearAsignatura(string $orientacion, string $grupo, string $asignatura); 
    public function eliminarAsignatura(string $asingatura, string $grupo); 
    public function modificarAsignatura(string $orientacion, string $grupo, string $nuevoNombre);

    // Métodos para crear grupos y orientaciones
    public function crearGrupo(string $nombre);
    public function crearOrientacion(string $orientacion);

    // Métodos para gestionar alumnos pendientes
    public function aceptarPendiente(int $id);
    public function rechazarPendiente(int $id);
}