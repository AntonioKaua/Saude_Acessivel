 CREATE DATABASE posto;
USE posto;

CREATE TABLE enderecos(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    cep CHAR(8) NOT NULL,
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
    cpf CHAR(14) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL,
    data_nasc DATE NOT NULL,
    endereco_id INT,
    FOREIGN KEY (endereco_id) REFERENCES enderecos(id)
);

CREATE TABLE usuarios(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    cpf CHAR(14) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL,
    data_nasc DATE NOT NULL,
    telefone CHAR(19) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    endereco_id INT,
    FOREIGN KEY (endereco_id) REFERENCES enderecos(id)
);

CREATE TABLE exames(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255)
);

CREATE TABLE procedimentos(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255)
);
CREATE TABLE especialidades(
	id INT PRIMARY KEY nOT NULL AUTO_INCREMENT,
    nome VARCHAR(255)
);
CREATE TABLE medicos(
    funcionario_id INT,
    especialidade_id INT,
    telefone CHAR(19) NOT NULL,
    cod_de_acesso VARCHAR(255) NOT NULL,
    FOREIGN KEY (funcionario_id) REFERENCES funcionarios(id),
    FOREIGN KEY (especialidade_id) REFERENCES especialidades(id)
);
CREATE TABLE consultas(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	medico_id INT NOT NULL,
    paciente_id INT NOT NULL,
    unidade_id INT NOT NULL,
    exames_id INT NOT NULL,
    procedimentos_id INT NOT NULL,
    especialidadeC_id INT NOT NULL,
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

SELECT*FROM usuarios;
SELECT*FROM unidades;

INSERT INTO enderecos (cep, rua, num, bairro, cidade, estado) VALUES ('CEP1', 'Rua A', 123, 'Bairro A', 'Cidade A', 'Estado A');
INSERT INTO unidades(nome, endereco_id) VALUES ("teste", 1);
INSERT INTO adm(cod_adm, unidade_id) VALUES (123456789, 1);

SELECT adm.id,adm.cod_adm, unidades.nome AS unidade
FROM adm
JOIN unidades ON adm.unidade_id = unidades.id;

SELECT * FROM usuarios AS u JOIN enderecos AS e WHERE u.endereco_id = e.id;

INSERT INTO especialidades (nome) VALUES
('Cardiologia'),
('Dermatologia'),
('Oftalmologia'),
('Ortopedia'),
('Neurologia');

-- Inserir dados na tabela enderecos
INSERT INTO enderecos (cep, rua, num, bairro, cidade, estado) VALUES
('12345678', 'Rua Principal', 123, 'Centro', 'Cidade A', 'Estado A'),
('87654321', 'Avenida Secundária', 456, 'Bairro Norte', 'Cidade B', 'Estado B'),
('11112222', 'Travessa da Esquina', 789, 'Bairro Sul', 'Cidade C', 'Estado C');

-- Inserir dados na tabela funcionarios
INSERT INTO funcionarios (nome, cpf, email, data_nasc, endereco_id) VALUES
('João Silva', '123.456.789-01', 'joao.silva@example.com', '1990-05-15', 1),
('Maria Oliveira', '987.654.321-09', 'maria.oliveira@example.com', '1985-08-22', 2),
('Pedro Santos', '456.789.012-34', 'pedro.santos@example.com', '1992-11-10', 3);

-- Inserir dados na tabela medicos
INSERT INTO medicos (funcionario_id, especialidade_id, telefone, cod_de_acesso) VALUES
(1, 1, '+55 (11) 91234-5678', 'ABC123'),
(2, 2, '+55 (22) 99876-5432', 'XYZ456'),
(3, 3, '+55 (33) 95555-1234', '123ABC');

