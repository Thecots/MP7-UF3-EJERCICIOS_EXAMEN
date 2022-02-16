DROP DATABASE IF EXISTS borsa;
CREATE DATABASE borsa;
USE borsa;

CREATE TABLE tb_accions (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(50) NOT NULL,
  preu FLOAT NOT NULL
);

CREATE TABLE tb_moviment(
  id INT PRIMARY KEY AUTO_INCREMENT,
  data TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  accio INT NOT NULL,
  quantitat INT NOT NULL,
  preu FLOAT NOT NULL
);

CREATE TABLE tb_cartera(
  id INT PRIMARY KEY AUTO_INCREMENT,
  accio INT NOT NULL,
  quantitat INT
);

INSERT INTO tb_accions VALUES
(null,'ACCIONA',143.60),
(null,'ACERINOX',22.79),
(null,'ACS',22.65),
(null,'AENA',154.60),
(null,'ALMIRALL',10.57),
(null,'AMADEUS',63.26),
(null,'ARCELORMIT',27.65),
(null,'B.SANTANDER',3.44),
(null,'BA.SABADELL',0.93),
(null,'BANKINTER',5.87),
(null,'BBVA',5.89),
(null,'CAIXABANK',3.32),
(null,'CELLNEX',39.03);