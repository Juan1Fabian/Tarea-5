-- Active: 1744589492521@@127.0.0.1@3306@cursos
CREATE DATABASE Cursos;
use Cursos;
-- tabla Categoria
CREATE TABLE Categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categoria VARCHAR(50) NOT NULL
);

-- tabla Cursos
CREATE TABLE Cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idcategoria INT NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    duracionHoras INT NOT NULL,
    nivel ENUM('Basico', 'Intermedio', 'Avanzado') NOT NULL,
    precio DECIMAL(7,2) NOT NULL,
    fechaInicio DATE NOT NULL,
    CONSTRAINT fk_idcategoria FOREIGN KEY (idcategoria) REFERENCES Categorias(id)
);

-- Inserciones para la tabla Categoria
INSERT INTO Categorias (categoria) VALUES 
    ('Matematicas'),
    ('Literatura'),
    ('Informatica');

SELECT*FROM Cursos;
