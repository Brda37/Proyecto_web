CREATE DATABASE proyecto_web;
use proyecto_web;

CREATE TABLE tbl_empleados (
  id int(11) NOT NULL,
  nombres varchar(255) NOT NULL,
  primerapellido varchar(255) NOT NULL,
  segundoapellido varchar(255) NOT NULL,
  foto varchar(255) NOT NULL,
  cv varchar(255) NOT NULL,
  idpuesto int(11) NOT NULL,
  fechaingreso date NOT NULL
);

CREATE TABLE tbl_puestos (
  id int(11) NOT NULL,
  nombredelpuesto varchar(255) NOT NULL
);

CREATE TABLE tbl_usuarios (
  id int(11) NOT NULL,
  usuario varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  correo varchar(255) NOT NULL
);

ALTER TABLE tbl_empleados
  ADD PRIMARY KEY (id),
  ADD KEY idpuesto (idpuesto);

ALTER TABLE tbl_puestos
  ADD PRIMARY KEY (id);

ALTER TABLE tbl_usuarios
  ADD PRIMARY KEY (id);

ALTER TABLE tbl_empleados
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE tbl_puestos
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE tbl_usuarios
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE tbl_empleados
  ADD CONSTRAINT tbl_empleados_ibfk_1 FOREIGN KEY (idpuesto) REFERENCES tbl_puestos (id);