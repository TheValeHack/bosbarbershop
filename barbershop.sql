CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    member_number VARCHAR(10) UNIQUE NOT NULL
);

CREATE TABLE invoices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    invoice_date DATE NOT NULL,
    service VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE cities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE locations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    city_id INT NOT NULL,
    FOREIGN KEY (city_id) REFERENCES cities(id)
);

CREATE TABLE barbershops (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL
);

CREATE TABLE job_vacancies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    barbershop_id INT NOT NULL,
    location_id INT NOT NULL,
    job_id INT NOT NULL,
    max_applicants INT NOT NULL,
    FOREIGN KEY (barbershop_id) REFERENCES barbershops(id),
    FOREIGN KEY (location_id) REFERENCES locations(id),
    FOREIGN KEY (job_id) REFERENCES jobs(id)
);
CREATE TABLE job_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_vacancy_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    birth_place VARCHAR(255) NOT NULL,
    birth_date DATE NOT NULL,
    age INT NOT NULL,
    gender ENUM('laki-laki', 'perempuan') NOT NULL,
    address TEXT NOT NULL,
    document_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (job_vacancy_id) REFERENCES job_vacancies(id) ON DELETE CASCADE
);

INSERT INTO cities (name) VALUES ('Yogyakarta'), ('Sleman'), ('Bantul');

INSERT INTO locations (name, city_id) VALUES 
('Condongcatur', 2),
('Kaliurang', 2),
('Malioboro', 1),
('Parangtritis', 3),
('Seturan', 2),
('Gejayan', 2),
('Kotabaru', 1),
('Gondokusuman', 1),
('Sedayu', 3),
('Banguntapan', 3),
('Prawirotaman', 1),
('Umbulharjo', 1),
('Kasihan', 3),
('Godean', 2),
('Berbah', 2);

INSERT INTO barbershops (name) VALUES ('Bos Barbershop');

INSERT INTO jobs (title) VALUES ('Hairstylist'), ('Receptionist'), ('Cashier'), ('Cleaner'), ('Manager'), ('Assistant Manager'), ('Barber'), ('Customer Service'), ('Marketing Specialist'), ('Security');

INSERT INTO job_vacancies (barbershop_id, location_id, job_id, max_applicants) VALUES 
(1, 1, 1, 99),
(1, 2, 1, 99),
(1, 3, 2, 99),
(1, 4, 2, 99),
(1, 5, 1, 99),
(1, 6, 1, 99),
(1, 7, 2, 99),
(1, 8, 2, 99),
(1, 9, 1, 99),
(1, 10, 2, 99),
(1, 11, 1, 99),
(1, 12, 2, 99),
(1, 13, 1, 99),
(1, 14, 2, 99),
(1, 15, 1, 99),
(1, 1, 3, 99),
(1, 2, 4, 99),
(1, 3, 5, 99),
(1, 4, 6, 99),
(1, 5, 7, 99),
(1, 6, 8, 99),
(1, 7, 9, 99),
(1, 8, 10, 99);

INSERT INTO users (name, email, password, phone_number, member_number) VALUES 
('John Doe', 'john@example.com', 'hashedpassword1', '081234567890', '1234567890'),
('Jane Smith', 'jane@example.com', 'hashedpassword2', '081234567891', '0987654321');

INSERT INTO invoices (user_id, invoice_date, service) VALUES 
(1, '2024-12-30', 'Creambath'),
(1, '2024-12-31', 'Haircut'),
(2, '2024-12-30', 'Haircut');
