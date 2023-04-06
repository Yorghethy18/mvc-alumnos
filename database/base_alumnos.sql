CREATE DATABASE dbalumnos;
USE dbalumnos;

-- --------------------------------------
-- | CREACIÓN DE LA TABLA ALUMNOS (alm) |
-- --------------------------------------
CREATE TABLE alumnos(
	idalumno 					INT AUTO_INCREMENT 		PRIMARY KEY,
	apellidos 					VARCHAR(40)	 				NOT NULL,
	nombres						VARCHAR(40)					NOT NULL,
	dni 							CHAR(8) 						NOT NULL, -- RESTRICCION UNIQUE
	correo 						VARCHAR(50) 				NOT NULL,
	telefono						CHAR(9)						NULL, -- RESTRICCION CHECK
	direccion 					VARCHAR(50) 				NOT NULL,
	nombrecarrera           VARCHAR(40) 				NOT NULL,
	nivelacademico 			INT 							NOT NULL,
	fecha_registro				DATETIME						NOT NULL DEFAULT NOW(),
	fecha_modificacion		DATETIME 					NULL,
	estado						CHAR(1) 						NOT NULL DEFAULT '1',
	CONSTRAINT un_dni 				UNIQUE(dni),
	CONSTRAINT chk_telefono 		CHECK(telefono IS NULL OR LENGTH(telefono) = 9)

)ENGINE = INNODB;

DROP TABLE alumnos;

-- INSERTANDO VALORES
INSERT INTO alumnos (apellidos, nombres, dni, correo, telefono, direccion, nombrecarrera, nivelacademico) VALUES
(
	'Hernandez Yeren',
	'Yorghet Fernanda',
	'72159736',
	'yorghetyauri123@gmail.com',
	'946989937',
	'Av.Centenario M1 10 LT 01 TUPAC AMARU',
	'Ing Software con IA',
	4
);

SELECT * FROM alumnos;

-- ***************************************************
-- * PROCEDIMIENTO ALMACENADOS PARA LA TABLA ALUMNOS *
-- ***************************************************

-- LISTAR ALUMNOS
DELIMITER $$
CREATE PROCEDURE spu_alumnos_listar()
BEGIN 
	SELECT 	idalumno,
				apellidos,
				nombres,
				dni,
				correo,
				telefono,
				direccion,
				nombrecarrera,
				nivelacademico
	FROM alumnos
	WHERE estado = '1'
	ORDER BY idalumno DESC;
END $$
CALL spu_alumnos_listar();


-- REGISTRAR ALUMNOS
DELIMITER $$
CREATE PROCEDURE spu_alumnos_registrar(
	IN apellidos_ 			VARCHAR(40),
	IN nombres_ 			VARCHAR(40),
	IN dni_					CHAR(8),
	IN correo_				VARCHAR(50),
	IN telefono_			CHAR(9),
	IN direccion_ 			VARCHAR(50),
	IN nombrecarrera_		VARCHAR(40),
	IN nivelacademico_ 	INT
)
BEGIN
	INSERT INTO alumnos(apellidos, nombres, dni, correo, telefono, direccion, nombrecarrera, nivelacademico)
	VALUES (apellidos_, nombres_, dni_, correo_, telefono_, direccion_, nombrecarrera_, nivelacademico_);
END $$
CALL spu_alumnos_registrar('Muñoz Quispe','Alonso Enrique','12345678','alonsoM@gmail.com','970526015','Av.Luis Masaro','Adm Industrial',5);
CALL spu_alumnos_listar();


-- ------------------------------------------------------------
-- PROCEDIMIENTO ALMACENADO PARA ELIMINAR ALUMNOS (INHABILITARA)
-- ------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_alumnos_eliminar(IN idalumno_	INT)
BEGIN
	UPDATE alumnos SET estado = '0'
	WHERE idalumno = idalumno_;
END $$




