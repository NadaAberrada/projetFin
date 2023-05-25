-- Create database
CREATE DATABASE IF NOT EXISTS appointment_system;

-- Use database
USE appointment_system;

-- Doctors table
CREATE TABLE doctors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fullname VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  phone VARCHAR(20) NOT NULL,
  password VARCHAR(255) NOT NULL,
    specialty INT NOT NULL,
  cabinet VARCHAR(100) NOT NULL,
 citynameD VARCHAR(255) NOT NULL,
    imageD MEDIUMBLOB null ,
  localisation TEXT 
);

-- Patients table
CREATE TABLE patients (
   id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
   lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    citynameP VARCHAR(255)
);

-- Appointments table
CREATE TABLE appointments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  doctor_id INT NOT NULL,
  patient_id INT NOT NULL,
  appointment_date DATETIME NOT NULL,
  additional_info TEXT,
  FOREIGN KEY (doctor_id) REFERENCES doctors(id),
  FOREIGN KEY (patient_id) REFERENCES patients(id)
);

-- Patient logs table
CREATE TABLE patient_logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  patient_id INT NOT NULL,
  doctor_id INT NOT NULL,
  visit_date DATETIME NOT NULL,
  notes TEXT,
  attachments TEXT,
  FOREIGN KEY (patient_id) REFERENCES patients(id),
  FOREIGN KEY (doctor_id) REFERENCES doctors(id)
);

-- Doctor logs table
CREATE TABLE doctor_logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  doctor_id INT NOT NULL,
  patient_id INT NOT NULL,
  log_date DATETIME NOT NULL,
  notes TEXT,
  FOREIGN KEY (doctor_id) REFERENCES doctors(id),
  FOREIGN KEY (patient_id) REFERENCES patients(id)
);

-- Insert example data for doctors
INSERT INTO doctors (fullname, email, phone, password, specialty_id, cabinet, citynam eD, schedule)
VALUES ('Dr. Fatima Zahra', 'fatima.zahra@example.com', '+212600000001', '2c68c7155ea84c0a056bb40d405dcb26', 1, 'Cabinet A', 'Casablanca');

-- Insert example data for patients
INSERT INTO patients (nome, prénom, email, password_hash, phone, citynameP)
VALUES ('Mohammed', 'Amine', 'mohammed.amine@example.com', '2c68c7155ea84c0a056bb40d405dcb26', '+212600000002', 'Casablanca');

-- Insert example data for appointments
INSERT INTO appointments (doctor_id, patient_id, appointment_date, additional_info)
VALUES (1, 1, '2023-05-01 10:00:00', 'Première consultation');

-- Insert example data for patient_logs
INSERT INTO patient_logs (patient_id, doctor_id, visit_date, notes, attachments)
VALUES (1, 1, '2023-05-01 10:00:00', 'Consultation initiale', 'path/to/attachments');

-- Insert example data for doctor_logs
INSERT INTO doctor_logs (doctor_id, patient_id, log_date, notes)
VALUES (1, 1, '2023-05-01 10:00:00', 'Le patient a une toux légère');




-- Insert another example data for doctors
INSERT INTO doctors (fullname, email, phone, password, specialty_id, cabinet, citynameD, schedule)
VALUES ('Dr. Youssef El Kaddioui', 'youssef.kaddioui@example.com', '+212600000003', '2c68c7155ea84c0a056bb40d405dcb26', 2, 'Cabinet B', 'Marrakech');

-- Insert another example data for patients
INSERT INTO patients (nome, prénom, email, password_hash, phone, citynameP)
VALUES ('Nadia', 'Berrada', 'nadia.berrada@example.com', '2c68c7155ea84c0a056bb40d405dcb26', '+212600000004', 'Rabat');

-- Insert another example data for appointments
INSERT INTO appointments (doctor_id, patient_id, appointment_date, additional_info)
VALUES (2, 2, '2023-05-10 14:00:00', 'Consultation de suivi');

-- Insert another example data for patient_logs
INSERT INTO patient_logs (patient_id, doctor_id, visit_date, notes, attachments)
VALUES (2, 2, '2023-05-10 14:00:00', 'Contrôle de la tension artérielle', 'path/to/attachments');

-- Insert another example data fsxsor doctor_logs
INSERT INTO doctor_logs (doctor_id, patient_id, log_date, notes)
VALUES (2, 2, '2023-05-10 14:00:00', 'La tension artérielle du patient est normale');




-- Insert another example data for doctors
INSERT INTO doctors (fullname, email, phone, password, specialty_id, cabinet, citynameD, schedule)
VALUES ('Dr. Leila Benjelloun', 'leila.benjelloun@example.com', '+212600000005', '2c68c7155ea84c0a056bb40d405dcb26', 3, 'Cabinet C', 'Fes');

-- Insert another example data for patients
INSERT INTO patients (nome, prénom, email, password_hash, phone, citynameP)
VALUES ('Omar', 'Rachidi', 'omar.rachidi@example.com', '2c68c7155ea84c0a056bb40d405dcb26', '+212600000006', 'Tangier');

-- Insert another example data for appointments
INSERT INTO appointments (doctor_id, patient_id, appointment_date, additional_info)
VALUES (3, 3, '2023-05-15 11:00:00', 'Consultation pour douleurs abdominales');

-- Insert another example data for patient_logs
INSERT INTO patient_logs (patient_id, doctor_id, visit_date, notes, attachments)
VALUES (3, 3, '2023-05-15 11:00:00', 'Examen abdominal', 'path/to/attachments');

-- Insert another example data for doctor_logs
INSERT INTO doctor_logs (doctor_id, patient_id, log_date, notes)
VALUES (3, 3, '2023-05-15 11:00:00', 'Le patient présente des douleurs abdominales légères');
