CREATE DATABASE MedicalPlatform;

USE MedicalPlatform;

CREATE TABLE Patients (
     patientID INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
   lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    citynameP VARCHAR(255)
    profilePic BLOB,
);

CREATE TABLE Doctors (
     doctorID INT AUTO_INCREMENT PRIMARY KEY,
  fullname VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  phone VARCHAR(20) NOT NULL,
  password VARCHAR(255) NOT NULL,
    specialty INT NOT NULL,
 citynameD VARCHAR(255) NOT NULL,
    imageD MEDIUMBLOB null ,
  localisation TEXT 
);

CREATE TABLE Cabinets (
    cabinetID INT AUTO_INCREMENT,
    doctorID INT,
    name VARCHAR(255),
    address VARCHAR(255),
    websiteLink VARCHAR(255),
    PRIMARY KEY (cabinetID),
    FOREIGN KEY (doctorID) REFERENCES Doctors(doctorID)
);

CREATE TABLE Reviews (
    reviewID INT AUTO_INCREMENT,
    parent_id INT,
    doctorID INT,
    comment VARCHAR(200),
    sender VARCHAR(200),
   date timestamp CURRENT_TIMESTAMP,
);
CREATE TABLE Admins (
    adminID INT AUTO_INCREMENT,
    firstName VARCHAR(255),
    lastName VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    PRIMARY KEY (adminID)
);