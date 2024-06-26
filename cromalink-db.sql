CREATE DATABASE IF NOT EXISTS cromalink_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE cromalink_db;

-- Tabla Usuario
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    biography TEXT,
    phone VARCHAR(20),
    date_of_birth DATE,
    country VARCHAR(255),
    picture VARCHAR(255),
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP,
    active BOOLEAN DEFAULT TRUE,
    staff BOOLEAN DEFAULT FALSE
);

-- Tabla Seguidores
CREATE TABLE users_followers (
    follower_id INT,
    followed_id INT,
    PRIMARY KEY (follower_id, followed_id),
    FOREIGN KEY (follower_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (followed_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabla Mensajes
CREATE TABLE users_messages (
    sender_id INT,
    recipient_id INT,
    content TEXT,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (sender_id, recipient_id, timestamp),
    FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (recipient_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabla Publicaciones
CREATE TABLE publications (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by INT,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabla Reacciones
CREATE TABLE reactions (
    publication_id INT,
    reaction_by INT,
    type ENUM('me gusta', 'no me gusta') NOT NULL,
    PRIMARY KEY (publication_id, reaction_by, type),
    FOREIGN KEY (publication_id) REFERENCES publications(id) ON DELETE CASCADE,
    FOREIGN KEY (reaction_by) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabla Eventos Sociales
CREATE TABLE social_events (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    publication_id INT,
    datetime_start DATETIME,
    datetime_end DATETIME,
    country VARCHAR(255),
    longitude DECIMAL(9,6),
    latitude DECIMAL(8,6),
    FOREIGN KEY (publication_id) REFERENCES publications(id) ON DELETE CASCADE
);

-- Tabla Participantes de Eventos Sociales
CREATE TABLE social_event_participants (
    social_event_id INT,
    participant_id INT,
    PRIMARY KEY (social_event_id, participant_id),
    FOREIGN KEY (social_event_id) REFERENCES social_events(id) ON DELETE CASCADE,
    FOREIGN KEY (participant_id) REFERENCES users(id) ON DELETE CASCADE
);


-- Restricción de dominio para email
ALTER TABLE users
ADD CONSTRAINT check_email CHECK (email REGEXP '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$'); 
