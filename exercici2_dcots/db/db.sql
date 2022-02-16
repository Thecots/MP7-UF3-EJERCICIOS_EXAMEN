DROP DATABASE IF EXISTS candidats;
CREATE DATABASE candidats;
USE candidats;

CREATE TABLE estudis(
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(100) NOT NULL
);

CREATE TABLE carrec(
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(100) NOT NULL
);

CREATE TABLE sector(
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(100) NOT NULL
);

CREATE TABLE tb_candidats(
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(20) NOT NULL,
  edat INT NOT NULL,
  anys_experiencia INT NOT NULL,
  estudis INT NOT NULL,
  carrec INT NOT NULL,
  sector INT NOT NULL,
  FOREIGN KEY fk_estudis(estudis) REFERENCES estudis(id),
  FOREIGN KEY fk_carrec(carrec) REFERENCES carrec(id), 
  FOREIGN KEY fk_sector(sector) REFERENCES sector(id) 
);



INSERT INTO carrec VALUES
(null,'Sin cargo'),
(null,'Director'),
(null,'Empleado'),
(null,'Becario'),
(null,'Soporte Tecnico'),
(null,'Administración'),
(null,'En practicas'),
(null,'Servicio al cliente');

INSERT INTO estudis VALUES
(null,'Sin estudios'),
(null,'Grado medio'),
(null,'Grado superior'),
(null,'Universidad'),
(null,'Bootcamp');

INSERT INTO sector VALUES
(null,'Desarrollo web'),
(null,'Desarrollo de software'),
(null,'Tecnología'),
(null,'Educación'),
(null,'Energía'),
(null,'Turismo');

INSERT INTO tb_candidats VALUES
(null,'Juan',18,1,2,3,1),
(null,'Alex',20,2,1,1,2),
(null,'Alejandro',24,5,2,2,5),
(null,'Iona',27,7,3,3,3),
(null,'Juanma',29,15,4,4,5),
(null,'Maria',34,5,5,5,4),
(null,'Anna',37,2,4,6,2),
(null,'Ivan',40,10,3,7,4),
(null,'Roger',45,5,2,8,5),
(null,'Edu',50,3,1,5,1),
(null,'Mar',55,5,2,2,1),
(null,'Laura',60,24,3,1,3),
(null,'John',65,16,4,7,3),
(null,'Thom',34,9,5,1,5);