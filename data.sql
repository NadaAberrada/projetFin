-- Create database
CREATE DATABASE IF NOT EXISTS appointment_system;

-- Use database
USE appointment_system;

-- Doctors table
CREATE TABLE doctors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  phone VARCHAR(20) NOT NULL,
  password VARCHAR(255) NOT NULL,
    specialty_id INT NOT NULL,
  cabinet VARCHAR(100) NOT NULL,
 citynameD VARCHAR(255) NOT NULL,
    imageD MEDIUMBLOB null ,
  schedule TEXT NOT NULL
);

-- Patients table
CREATE TABLE patients (
   id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
   prénom VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    citynameP VARCHAR(255),
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

