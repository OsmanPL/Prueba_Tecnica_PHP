-- Creación de la base de datos
CREATE DATABASE IF NOT EXISTS pruebaTecnicaPHP;

-- Selección de la base de datos
USE pruebaTecnicaPHP;

-- Creación de la tabla User
CREATE TABLE IF NOT EXISTS User (
    UserId INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);