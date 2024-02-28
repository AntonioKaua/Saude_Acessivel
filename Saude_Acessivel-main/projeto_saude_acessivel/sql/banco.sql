CREATE DATABASE posto;
USE posto;

CREATE TABLE enderecos(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    cep CHAR(8),
    rua VARCHAR(255) NOT NULL,
    num INT NOT NULL,
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

CREATE TABLE exames(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255)
);

CREATE TABLE procedimentos(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255)
);

CREATE TABLE consultas(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	medico_id INT NOT NULL,
    paciente_id INT NOT NULL,
    unidade_id INT NOT NULL,
    exames_id INT NOT NULL,
    procedimentos_id INT NOT NULL,
    area VARCHAR(255),
    data_hora DATETIME NOT NULL,
    tipo_de_atendimento VARCHAR(255) NOT NULL,
    FOREIGN KEY (medico_id) REFERENCES medicos(funcionario_id),
    FOREIGN KEY (paciente_id) REFERENCES usuarios(id),
    FOREIGN KEY (unidade_id) REFERENCES unidades(id),
    FOREIGN KEY (exames_id) REFERENCES exames(id),
    FOREIGN KEY (procedimentos_id) REFERENCES procedimentos(id)
);

CREATE TABLE resultados_exames(
	id_exame INT NOT NULL,
    id_consulta INT NOT NULL,
    resultado VARCHAR(400)
);
    
