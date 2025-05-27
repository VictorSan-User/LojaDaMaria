-- Criação do banco de dados se ainda não existir
CREATE DATABASE IF NOT EXISTS tb_agendamentos CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE tb_agendamentos;

-- Criação da tabela agendamentos
CREATE TABLE IF NOT EXISTS tb_agendamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data_inicial DATE NOT NULL,
    data_final DATE NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT NOT NULL,
    cliente VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;