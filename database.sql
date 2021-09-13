DROP DATABASE IF EXISTS aurum;
CREATE DATABASE IF NOT EXISTS aurum;
USE aurum;

CREATE TABLE usuario (
	id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    CI CHAR(8) UNIQUE NOT NULL,
    nombre VARCHAR(25) NOT NULL,
    apellido VARCHAR(25) NOT NULL,
    email VARCHAR(320) NOT NULL,
    contrasena VARCHAR(150) NOT NULL,
    imagen VARCHAR(50) NOT NULL,
    tipo ENUM('alumno', 'docente', 'admin') NOT NULL,
    primer_login BOOl NOT NULL
);

CREATE TABLE cedulas (
id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
cedula CHAR(8) UNIQUE NOT NULL
);

/* Esta tabla almacenara los grupos de los Alumnos*/
CREATE TABLE grupos_alumno (
	idAlumno INT NOT NULL,
    grupo CHAR (3) NOT NULL,
	CONSTRAINT FK_idAlumno_grupo FOREIGN KEY (idAlumno) 
    REFERENCES usuario(id) ON DELETE CASCADE
); 

CREATE TABLE horarios (
    ciDocente CHAR (8) PRIMARY KEY NOT NULL,
	dia_minimo INT,
    dia_maximo INT,
    hora_minima CHAR(5),
    hora_maxima CHAR(5),
	registro_horarios BOOL NOT NULL,
    CONSTRAINT FK_docente_horarios FOREIGN KEY (ciDocente)
    REFERENCES usuario(CI) ON DELETE CASCADE
);

/* Esta tabla almacenara los grupos de los docentes*/
CREATE TABLE grupos_docente(
	idDocente INT NOT NULL,
    grupo CHAR (3) NOT NULL,
	CONSTRAINT FK_idDocente_grupo FOREIGN KEY (idDocente) 
    REFERENCES usuario(id) ON DELETE CASCADE
); 

/* Esta tabla almacenara los Asignaturas de los docentes*/
CREATE TABLE asignaturas_docente (
	idDocente INT NOT NULL,
    asignatura VARCHAR (30) NOT NULL,
	CONSTRAINT FK_idDocente_asignatura FOREIGN KEY (idDocente) 
    REFERENCES usuario(id) ON DELETE CASCADE
); 

/*PARA EL ADMIN Tabla donde se almacenan los alumnos previos a ingresar al sistema */
CREATE TABLE pendiente (
	idAlumno INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	CI CHAR(8) UNIQUE NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    apellido VARCHAR(30) NOT NULL,
    email VARCHAR(320) NOT NULL,
    grupo CHAR(3) NOT NULL,
    contrasena VARCHAR(150) NOT NULL,
    imagen VARCHAR(50) NOT NULL,
    primer_login BOOL
);

CREATE TABLE grupos_pendiente (
	idAlumno INT NOT NULL,
    grupo CHAR (3) NOT NULL,
	CONSTRAINT FK_idAlumno_grupoPendiente FOREIGN KEY (idAlumno) 
    REFERENCES pendiente(idAlumno) ON DELETE CASCADE
); 

CREATE TABLE consultas (
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    idAlumno INT NOT NULL,
    idDocente INT NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
	respuesta VARCHAR (5000),
    fecha CHAR(10) NOT NULL,
    estado VARCHAR (10) NOT NULL,
    CONSTRAINT FK_Alumno_idAlumno_consulta3 FOREIGN KEY (idAlumno) 
    REFERENCES usuario(id) ON DELETE CASCADE,
    CONSTRAINT FK_Alumno_idDocente_consulta3 FOREIGN KEY (idDocente) 
    REFERENCES usuario(id) ON DELETE CASCADE
);

CREATE TABLE asignaturas (
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(35) NOT NULL,
    grado INT NOT NULL
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

CREATE TABLE chat (
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	ciHost INT NOT NULL,
    emailHost VARCHAR(320) NOT NULL,
    ciDocente INT NOT NULL,
	emailDocente VARCHAR(320) NOT NULL,
	fecha CHAR(10) NOT NULL,
    asignatura VARCHAR(30),
    grupo CHAR(3)
);

CREATE TABLE usuarios_online (
	idChat INT NOT NULL,
    ciUsuario INT NOT NULL,
    isOnline BOOL,
	CONSTRAINT FK_idChat FOREIGN KEY (idChat) 
    REFERENCES chat(id) ON DELETE CASCADE
);

CREATE TABLE mensajes_chat (
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	idChat INT NOT NULL,
    ciUsuario INT NOT NULL,
    nombreUsuario VARCHAR(30) NOT NULL,
    apellidoUsuario VARCHAR(30) NOT NULL,
    mensaje VARCHAR(500) NOT NULL,
    hora CHAR(5) NOT NULL,
	CONSTRAINT FK_idChat2 FOREIGN KEY (idChat) 
    REFERENCES chat(id) ON DELETE CASCADE
);

CREATE TABLE usuarios_chat (
	idChat INT NOT NULL,
	ciUsuario INT,
	nombreUsuario VARCHAR(30),
    apellidoUsuario VARCHAR(30),
	email VARCHAR(320) NOT NULL,
    isOnline BOOL,
    CONSTRAINT FK_idChat3 FOREIGN KEY (idChat) 
    REFERENCES chat(id) ON DELETE CASCADE
);

CREATE TABLE solicitud_chat (
	id INT PRIMARY KEY AUTO_INCREMENT,
    ciDocente CHAR(8),
    ciHost INT,
    nombreHost VARCHAR(25),
    apellidoHost VARCHAR(25),
	emailHost VARCHAR(320) NOT NULL,
    asignatura VARCHAR(30),
    grupo CHAR(3),
    CONSTRAINT FK_solicitud FOREIGN KEY (ciDocente) 
    REFERENCES usuario(CI) ON DELETE CASCADE
);

use aurum;
SELECT * FROM chat;
SELECT * FROM usuarios_online;
SELECT * FROM mensajes_chat;
SELECT * FROM usuarios_chat;
SELECT * FROM solicitud_chat;
SELECT * FROM consultas;
SELECT * FROM asignaturas_docente;
SELECT * FROM grupos_alumno;
SELECT * FROM grupos_docente;
SELECT * FROM pendiente;
SELECT * FROM cedulas;
SELECT * FROM horarios;
select * from consultas;
select * from usuario;







