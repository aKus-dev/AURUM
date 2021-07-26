DROP DATABASE IF EXISTS aurum;
CREATE DATABASE IF NOT EXISTS aurum;
USE aurum;

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
    imagen VARCHAR(50) NOT NULL,
	primer_login BOOl NOT NULL
);

/* Esta tabla almacenara los grupos de los Alumnos*/
CREATE TABLE grupos_alumno (
	idAlumno INT NOT NULL,
    Grupo CHAR (3) NOT NULL,
	CONSTRAINT FK_idAlumno_grupo FOREIGN KEY (idAlumno) 
    REFERENCES alumno(id) ON DELETE CASCADE
); 


CREATE TABLE docente (
	id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    CI CHAR(8) UNIQUE NOT NULL,
    nombre VARCHAR(25) NOT NULL,
    apellido VARCHAR(25) NOT NULL,
    contrasena VARCHAR(150) NOT NULL,
    imagen VARCHAR(50) NOT NULL,
    dia_minimo INT,
    dia_maximo INT,
    hora_minima CHAR(5),
    hora_maxima CHAR(5),
    primer_login BOOl NOT NULL
);

/* Esta tabla almacenara los grupos de los docentes*/
CREATE TABLE grupos_docente(
	idDocente INT NOT NULL,
    grupo CHAR (3) NOT NULL,
	CONSTRAINT FK_idDocente_grupo FOREIGN KEY (idDocente) 
    REFERENCES Docente(id) ON DELETE CASCADE
); 

/* Esta tabla almacenara los Asignaturas de los docentes*/
CREATE TABLE asignaturas_docente (
	idDocente INT NOT NULL,
    asignatura VARCHAR (30) NOT NULL,
	CONSTRAINT FK_idDocente_asignatura FOREIGN KEY (idDocente) 
    REFERENCES Docente(id) ON DELETE CASCADE
); 

CREATE TABLE administrador (
	id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    usuario VARCHAR(25) NOT NULL,
    contrasena VARCHAR(150) NOT NULL,
    imagen VARCHAR(50) NOT NULL
);

/*PARA EL ADMIN Tabla donde se almacenan los alumnos previos a ingresar al sistema */
CREATE TABLE pendiente (
	idAlumno INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	CI CHAR(8) UNIQUE NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    apellido VARCHAR(30) NOT NULL,
    grupo CHAR(3) NOT NULL,
    contrasena VARCHAR(150) NOT NULL,
    imagen VARCHAR(50) NOT NULL,
    primer_login BOOL
);

CREATE TABLE grupos_pendiente (
	idAlumno INT NOT NULL,
    Grupo CHAR (3) NOT NULL,
	CONSTRAINT FK_idAlumno_grupo2 FOREIGN KEY (idAlumno) 
    REFERENCES pendiente(id) ON DELETE CASCADE
); 


CREATE TABLE consultas_docente (
	id INT AUTO_INCREMENT NOT NULL,
    idAlumno INT NOT NULL,
    idDocente INT NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    respuesta VARCHAR (5000),
    fecha DATE NOT NULL,
    estado VARCHAR (10) NOT NULL,
	PRIMARY KEY (id),
    CONSTRAINT FK_Alumno_idAlumno_consulta FOREIGN KEY (idAlumno) 
    REFERENCES Alumno(id) ON DELETE CASCADE,
    CONSTRAINT FK_Alumno_idDocente_consulta FOREIGN KEY (idDocente) 
    REFERENCES Docente(id) ON DELETE CASCADE
);


/*Respuesta */
CREATE TABLE consultas_alumno (
	id INT AUTO_INCREMENT NOT NULL,
    idAlumno INT NOT NULL,
    idDocente INT NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
	respuesta VARCHAR (5000),
    fecha DATE NOT NULL,
    estado VARCHAR (10) NOT NULL,
	PRIMARY KEY (id),
    CONSTRAINT FK_Alumno_idAlumno_consulta2 FOREIGN KEY (idAlumno) 
    REFERENCES Alumno(id) ON DELETE CASCADE,
    CONSTRAINT FK_Alumno_idDocente_consulta2 FOREIGN KEY (idDocente) 
    REFERENCES Docente(id) ON DELETE CASCADE
);

/* TEMPORAL (esto va a estar hasta que este el app del admin) */
INSERT INTO asignaturas (nombre, grado)  VALUES 
('A.D.A', 3),
('Fisica I', 1),
('Fisica II', 2),
('Historia', 1),
('Economia', 2),
('Sociologia', 3),
('Proyecto', 3),
('Filosofia', 3),
('Matematicas I', 1),
('Matematicas II', 2),
('Matematicas III', 3),
('Base de datos I', 2),
('Programacion I', 1),
('Programacion II', 2),
('Programacion III', 3),
('Programacion Web', 3),
('Sistemas Operativos I', 1),
('Sistemas Operativos II', 2),
('Sistemas Operativos III', 3);


/* Registrar el administrador */
INSERT INTO Administrador (usuario,contrasena) VALUES (
'admin','esibuceo'
);


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

SELECT dia_minimo, dia_maximo, hora_minima, hora_maxima FROM docente WHERE id = 1;

