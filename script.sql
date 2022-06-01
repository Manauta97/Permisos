drop schema if exists permisos;
create schema permisos;
use permisos;

-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema permisos
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `permisos`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `permisos`.`roles` (
  `id_rol` INT NOT NULL AUTO_INCREMENT,
  `rol` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_rol`))
ENGINE = InnoDB;

insert into roles values
(1, 'Administrador'),
(2, 'Jefe Estudios'),
(3, 'Profesor');


-- -----------------------------------------------------
-- Table `permisos`.`estados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `permisos`.`estados` (
  `id_estado` INT NOT NULL AUTO_INCREMENT,
  `nombreEstado` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_estado`))
ENGINE = InnoDB;

insert into estados values 
(1, 'Aceptado'),
(2, 'Denegado'),
(3, 'Pediente');
-- -----------------------------------------------------
-- Table `permisos`.`tipoPermiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `permisos`.`tipoPermiso` (
  `idTipoPermiso` INT NOT NULL AUTO_INCREMENT,
  `descripcionPermiso` VARCHAR(350) NOT NULL,
  `codTipoPermiso` VARCHAR(3) NOT NULL,
  PRIMARY KEY (`idTipoPermiso`))
ENGINE = InnoDB;

insert into tipoPermiso values 
(1,'Lactancia de hijo menor de 12 meses - 1 hora o fraccionada','A01'),
(2,'Fallecimiento de familiar de primer grado','A03'),
(3,'Formación continua','A06');
-- -----------------------------------------------------
-- Table `permisos`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `permisos`.`usuarios` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `apellidos` VARCHAR(45) NOT NULL,
  `dni` VARCHAR(9) NOT NULL,
  `centro` VARCHAR(200) NULL,
  `especialidad` VARCHAR(100) NULL,
  `nrp` VARCHAR(45) NOT NULL,
  `localidad` VARCHAR(100) NOT NULL,
  `id_rol` INT NOT NULL,
  PRIMARY KEY (`id_usuario`),
  INDEX `fk_usuario_roles_idx` (`id_rol` ASC) VISIBLE,
  CONSTRAINT `fk_usuario_roles`
    FOREIGN KEY (`id_rol`)
    REFERENCES `permisos`.`roles` (`id_rol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
insert into usuarios values
(1, 'Marta', 'Garcia', '21748821E', 'CPIFP Bajo Aragón', 'Informatica', '222', 'Alcañiz', 2),
(2, 'Fede', 'Perez', '21748821F', 'CPIFP Bajo Aragón', 'Informatica', '333', 'Alcañiz', 3),
(3, 'Jonatan', 'Segurana', '21577214G', 'CPIFP Bajo Aragón', 'Informatica', '254', 'Alcañiz', 1);

-- -----------------------------------------------------
-- Table `permisos`.`documento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `permisos`.`documento` (
  `nombreDocumento` VARCHAR(300) NOT NULL,
  `ruta` VARCHAR(350) NOT NULL,
  PRIMARY KEY (`nombreDocumento`))
ENGINE = InnoDB;

insert into documento values 
('doc1','ruta/doc/1'),
('doc2','ruta/doc/2'),
('doc3','ruta/doc/3');

-- -----------------------------------------------------
-- Table `permisos`.`tipoPermiso_has_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `permisos`.`tipoPermiso_has_usuario` (
  `idTipoPermiso` INT NOT NULL,
  `id_usuario` INT NOT NULL,
  `id_estado` INT NOT NULL,
  `nombreDocumento` VARCHAR(300) NOT NULL,
  `fechaInicio` DATE NULL,
  `fechaFin` DATE NULL,
  PRIMARY KEY (`idTipoPermiso`, `id_usuario`),
  INDEX `fk_tipoPermiso_has_usuario_usuario1_idx` (`id_usuario` ASC) VISIBLE,
  INDEX `fk_tipoPermiso_has_usuario_tipoPermiso1_idx` (`idTipoPermiso` ASC) VISIBLE,
  INDEX `fk_tipoPermiso_has_usuario_estados1_idx` (`id_estado` ASC) VISIBLE,
  INDEX `fk_tipoPermiso_has_usuario_documento1_idx` (`nombreDocumento` ASC) VISIBLE,
  CONSTRAINT `fk_tipoPermiso_has_usuario_tipoPermiso1`
    FOREIGN KEY (`idTipoPermiso`)
    REFERENCES `permisos`.`tipoPermiso` (`idTipoPermiso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipoPermiso_has_usuario_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `permisos`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipoPermiso_has_usuario_estados1`
    FOREIGN KEY (`id_estado`)
    REFERENCES `permisos`.`estados` (`id_estado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipoPermiso_has_usuario_documento1`
    FOREIGN KEY (`nombreDocumento`)
    REFERENCES `permisos`.`documento` (`nombreDocumento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

insert into tipoPermiso_has_usuario values 
(1,2,3,'doc1','2022-05-31','2022-06-05'),
(2,2,3,'doc2','2022-05-15','2022-05-31');

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
