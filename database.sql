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

CREATE TABLE consultas_docente (
	id INT AUTO_INCREMENT NOT NULL,
    idAlumno INT NOT NULL,
    idDocente INT NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descripcion VARCHAR(2000) NOT NULL,
    respuesta VARCHAR (1000),
    fecha DATE NOT NULL,
    estado VARCHAR (10) NOT NULL,
	PRIMARY KEY (id),
    CONSTRAINT FK_Alumno_idAlumno_consulta FOREIGN KEY (idAlumno) 
    REFERENCES Alumno(id),
    CONSTRAINT FK_Alumno_idDocente_consulta FOREIGN KEY (idDocente) 
    REFERENCES Docente(id)
);


/*Respuesta */
CREATE TABLE consultas_alumno (
	id INT AUTO_INCREMENT NOT NULL,
    idAlumno INT NOT NULL,
    idDocente INT NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descripcion VARCHAR(2000) NOT NULL,
	respuesta VARCHAR (1000),
    fecha DATE NOT NULL,
    estado VARCHAR (10) NOT NULL,
	PRIMARY KEY (id),
    CONSTRAINT FK_Alumno_idAlumno_consulta2 FOREIGN KEY (idAlumno) 
    REFERENCES Alumno(id),
    CONSTRAINT FK_Alumno_idDocente_consulta2 FOREIGN KEY (idDocente) 
    REFERENCES Docente(id)
);

/* Registrar el administrador */
INSERT INTO Administrador (usuario,contrasena) VALUES (
'Admin','Admin'
);

SELECT DISTINCT nombre, apellido
FROM alumno
INNER JOIN consultas_docente as consulta
ON consulta.estado = 'pendiente' AND alumno.id = 1;

SELECT respuesta from consultas_docente WHERE id = 1;

UPDATE consultas_alumno SET estado = 'recibida' WHERE id = 1;

/* Seleccionar x campo que tenga  'Matematica' ESTO SIRVE PARA HACER UN BUSCADOR */
SELECT titulo, idAlumno FROM consultas_docente WHERE titulo LIKE '%Matematica%';

use aurum;
SELECT * FROM consultas_docente;
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