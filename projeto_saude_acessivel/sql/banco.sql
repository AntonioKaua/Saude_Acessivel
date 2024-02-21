CREATE DATABASE posto;
USE posto;

CREATE TABLE enderecos(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    cep CHAR(8),
    rua VARCHAR(255) NOT NULL,
    bairro VARCHAR(255) NOT NULL,
    cidade VARCHAR(255) NOT NULL,
    estado VARCHAR(255) NOT NULL
);

CREATE TABLE unidades(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    endereco_id INT,
    FOREIGN KEY (endereco_id) REFERENCES enderecos(id)
);

CREATE TABLE adm(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    cod_adm INT(11) NOT NULL,
    unidade_id INT,
    FOREIGN KEY (unidade_id) REFERENCES unidades(id)
);
INSERT INTO adm(cod_adm, unidade) VALUES(
	1234567891, "teste");
    
CREATE TABLE medicamentos(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    miligramagem INT(255) NOT NULL,
    quantidade INT NOT NULL,
    unidade VARCHAR(255) NOT NULL
);

CREATE TABLE funcionarios(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    cpf CHAR(11) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL,
    data_nasc DATE NOT NULL,
    cargo VARCHAR(255) NOT NULL,
    endereco_id INT,
    FOREIGN KEY (endereco_id) REFERENCES enderecos(id)
);

CREATE TABLE usuarios(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    cpf CHAR(11) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL,
    data_nasc DATE NOT NULL,
    telefone INT(11) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    endereco_id INT,
    FOREIGN KEY (endereco_id) REFERENCES enderecos(id)
);

CREATE TABLE medicos(
    funcionario_id INT,
    telefone INT(11) NOT NULL,
    area_de_atuacao VARCHAR(255),
    cod_de_acesso VARCHAR(255) NOT NULL,
    FOREIGN KEY (funcionario_id) REFERENCES funcionarios(id)
);






	

