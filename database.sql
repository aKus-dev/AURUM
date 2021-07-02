DROP DATABASE IF EXISTS aurum;
CREATE DATABASE IF NOT EXISTS aurum;
USE aurum;

SELECT * FROM grupos_docente;
SELECT idDocente FROM grupos_docente WHERE grupo = '1BA';

CREATE TABLE cedulas (
cedula CHAR(8) UNIQUE NOT NULL
);

/* Ingresa a esta tabla una vez es aceptado por el administrador */
CREATE TABLE alumno (
	id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    CI CHAR(8) UNIQUE NOT NULL,
    nombre VARCHAR(25) NOT NULL,
    apellido VARCHAR(25) NOT NULL,
    contrasena VARCHAR(150) NOT NULL,
    imagen VARCHAR(255) NOT NULL,
	primer_login BOOl NOT NULL
);

CREATE TABLE docente (
	id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    CI CHAR(8) UNIQUE NOT NULL,
    nombre VARCHAR(25) NOT NULL,
    apellido VARCHAR(25) NOT NULL,
    contrasena VARCHAR(150) NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    dias_disponible DATE ,
    horarios_Disponible TIME,
    primer_login BOOl NOT NULL
);

CREATE TABLE administrador (
	id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    usuario VARCHAR(25) NOT NULL,
    contrasena VARCHAR(150) NOT NULL,
    imagen VARCHAR(255)
);

/*PARA EL ADMIN Tabla donde se almacenan los alumnos previos a ingresar al sistema */
CREATE TABLE pendiente (
	idAlumno INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	CI CHAR(8) UNIQUE NOT NULL,
    nombre VARCHAR(25) NOT NULL,
    apellido VARCHAR(25) NOT NULL,
    grupo CHAR(3) NOT NULL,
    contrasena VARCHAR(150) NOT NULL,
    imagen VARCHAR(255) NOT NULL
);

/* Esta tabla almacenara los grupos de los docentes*/
CREATE TABLE grupos_docente(
	idDocente INT NOT NULL,
    grupo CHAR (3) NOT NULL,
	CONSTRAINT FK_idDocente_grupo FOREIGN KEY (idDocente) 
    REFERENCES Docente(id)
); 

/* Esta tabla almacenara los Asignaturas de los docentes*/
CREATE TABLE asignaturas_docente (
	idDocente INT NOT NULL,
    asignatura VARCHAR (30) NOT NULL,
	CONSTRAINT FK_idDocente_asignatura FOREIGN KEY (idDocente) 
    REFERENCES Docente(id)
); 

/* Esta tabla almacenara los grupos de los Alumnos*/
CREATE TABLE grupos_alumno (
	idAlumno INT NOT NULL,
    Grupo CHAR (3) NOT NULL,
	CONSTRAINT FK_idAlumno_grupo FOREIGN KEY (idAlumno) 
    REFERENCES alumno(id)
); 

/* Seleccionamos los grupos de 'X' docente */
SELECT idDocente from grupos_docente where grupo = '1BA';
SELECT nombre FROM docente WHERE id = 2;

/* Registrar el administrador */
INSERT INTO Administrador (usuario,contrasena) VALUES (
'Admin','Admin'
);

/* Obtener los docentes de determinado grupo */
SELECT DISTINCT id, nombre, apellido
FROM docente
INNER JOIN grupos_docente as grupo
ON grupo = "1BB" 
AND docente.id = grupo.idDocente;

SELECT id, titulo, descripcion, fecha FROM consulta_docente_recibida Where idDocente = 2;

CREATE TABLE consultas_docente (
	id INT AUTO_INCREMENT NOT NULL,
    idAlumno INT NOT NULL,
    idDocente INT NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    fecha DATE NOT NULL,
    estado VARCHAR (10) NOT NULL,
	PRIMARY KEY (id),
    CONSTRAINT FK_Alumno_idAlumno_consulta FOREIGN KEY (idAlumno) 
    REFERENCES Alumno(id),
    CONSTRAINT FK_Alumno_idDocente_consulta FOREIGN KEY (idDocente) 
    REFERENCES Docente(id)
);

CREATE TABLE consultas_alumno (
	id INT AUTO_INCREMENT NOT NULL,
    idAlumno INT NOT NULL,
    idDocente INT NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    fecha DATE NOT NULL,
    estado VARCHAR (10) NOT NULL,
	PRIMARY KEY (id),
    CONSTRAINT FK_Alumno_idAlumno_consulta2 FOREIGN KEY (idAlumno) 
    REFERENCES Alumno(id),
    CONSTRAINT FK_Alumno_idDocente_consulta2 FOREIGN KEY (idDocente) 
    REFERENCES Docente(id)
);

SELECT id titulo, fecha FROM consultas_docente WHERE estado = 'pendiente' AND idDocente = 1;

SELECT titulo,descripcion,fecha from consultas_docente WHERE id = 1;

use aurum;
SELECT * FROM consultas_alumno;
SELECT * FROM consultas_docente;
SELECT * FROM asignaturas_docente;
SELECT * FROM grupos_alumno;
SELECT * FROM grupos_docente;
SELECT * FROM Alumno;
SELECT * FROM Docente;
SELECT * FROM administrador;
SELECT * FROM Pendientes;
SELECT * FROM Cedulas;


