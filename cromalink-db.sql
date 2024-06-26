-- Tabla Usuario
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
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

-- Tabla Perfil de Usuario
CREATE TABLE user_profile (
    user_id INT PRIMARY KEY,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    biography TEXT,
    date_of_birth DATE,
    country VARCHAR(255),
    picture VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabla Intereses
CREATE TABLE interests (
    name VARCHAR(255) PRIMARY KEY
);

-- Tabla Usuario - Intereses
CREATE TABLE users_interests (
    user_id INT,
    interest_name VARCHAR(255),
    PRIMARY KEY (user_id, interest_name),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (interest_name) REFERENCES interests(name) ON DELETE CASCADE
);

-- Tabla Grupos
CREATE TABLE groups (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    tag_name VARCHAR(255),
    cover_photo VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    private BOOLEAN DEFAULT FALSE
);

-- Tabla Usuario - Grupos
CREATE TABLE users_groups (
    group_id INT,
    user_id INT,
    role ENUM('Miembro', 'Administrador') DEFAULT 'Miembro',
    PRIMARY KEY (group_id, user_id),
    FOREIGN KEY (group_id) REFERENCES groups(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabla Grupo - Intereses
CREATE TABLE groups_interests (
    group_id INT,
    interest_name VARCHAR(255),
    PRIMARY KEY (group_id, interest_name),
    FOREIGN KEY (group_id) REFERENCES groups(id) ON DELETE CASCADE,
    FOREIGN KEY (interest_name) REFERENCES interests(name) ON DELETE CASCADE
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

-- Tabla Etiquetas
CREATE TABLE labels (
    name VARCHAR(255) PRIMARY KEY,
    interest_name VARCHAR(255),
    FOREIGN KEY (interest_name) REFERENCES interests(name) ON DELETE CASCADE
);

-- Tabla Publicación - Etiquetas
CREATE TABLE publication_labels (
    label_name VARCHAR(255),
    publication_id INT,
    PRIMARY KEY (label_name, publication_id),
    FOREIGN KEY (label_name) REFERENCES labels(name) ON DELETE CASCADE,
    FOREIGN KEY (publication_id) REFERENCES publications(id) ON DELETE CASCADE
);

-- Tabla Recursos
CREATE TABLE resources (
    id INT PRIMARY KEY AUTO_INCREMENT,
    publication_id INT,
    type ENUM('foto', 'video', 'articulo') NOT NULL,
    url VARCHAR(255),
    FOREIGN KEY (publication_id) REFERENCES publications(id) ON DELETE CASCADE
);

-- Tabla Publicación - Grupos
CREATE TABLE group_publications (
    publication_id INT,
    group_id INT,
    PRIMARY KEY (publication_id, group_id),
    FOREIGN KEY (publication_id) REFERENCES publications(id) ON DELETE CASCADE,
    FOREIGN KEY (group_id) REFERENCES groups(id) ON DELETE CASCADE
);

-- Tabla Comentarios
CREATE TABLE users_publications_comment (
    id INT PRIMARY KEY AUTO_INCREMENT,
    publication_id INT,
    created_by INT,
    content TEXT,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (publication_id) REFERENCES publications(id) ON DELETE CASCADE,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabla Reacciones
CREATE TABLE reactions (
    publication_id INT,
    created_by INT,
    type ENUM('me gusta', 'no me gusta') NOT NULL,
    PRIMARY KEY (publication_id, created_by, type),
    FOREIGN KEY (publication_id) REFERENCES publications(id) ON DELETE CASCADE,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabla Eventos Sociales
CREATE TABLE social_events (
    name VARCHAR(255),
    publication_id INT,
    datetime_start DATETIME,
    datetime_end DATETIME,
    country VARCHAR(255),
    longitude DECIMAL(9,6),
    latitude DECIMAL(8,6),
    PRIMARY KEY (name, publication_id),
    FOREIGN KEY (publication_id) REFERENCES publications(id) ON DELETE CASCADE
);

-- Tabla Participantes de Eventos Sociales
CREATE TABLE social_event_participants (
    social_event_id INT,
    participant_id INT,
    PRIMARY KEY (social_event_id, participant_id),
    FOREIGN KEY (social_event_id) REFERENCES social_events(name) ON DELETE CASCADE,
    FOREIGN KEY (participant_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabla Notificaciones
CREATE TABLE notifications (
    number INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    content TEXT,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);



-- Restricción de dominio para email
ALTER TABLE users
ADD CONSTRAINT check_email CHECK (email REGEXP '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$'); 
