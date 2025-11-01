CREATE DATABASE todo;

USE todo;

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO tasks (title, description, status) VALUES
('Купить продукты', 'Молоко, хлеб, сыр', 'В процессе'),
('Сделать домашку', 'Математика и физика', 'В процессе'),
('Позвонить другу', 'Обсудить проект', 'В процессе'),
('Прочитать книгу', 'Глава 1–3', 'В процессе'),
('Сделать сайт', 'CRUD на PHP + PDO', 'В процессе');
