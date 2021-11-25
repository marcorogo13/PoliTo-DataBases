-- create an empty database. Name of the database: 
SET storage_engine=InnoDB;
SET FOREIGN_KEY_CHECKS=1;
CREATE DATABASE IF NOT EXISTS Gym;

-- use GYM 
use Gym;


-- drop tables if they already exist
DROP TABLE IF EXISTS Schedule;
DROP TABLE IF EXISTS Course;
DROP TABLE IF EXISTS Trainer;

-- create tables

CREATE TABLE Trainer (
	SSN CHAR(20) ,
	Name CHAR(50) NOT NULL ,
	Surname CHAR(50) NOT NULL ,
	DateOfBirth DATE NOT NULL ,
	Email CHAR(50) NOT NULL ,
	PhoneNo CHAR(20) NULL ,
	PRIMARY KEY (SSN)
);

CREATE TABLE Course (
	CId CHAR(10) ,
	Name CHAR(50) NOT NULL ,
	CType CHAR(50) NOT NULL ,
	CLevel SMALLINT NOT NULL,
	PRIMARY KEY (CId),
	CONSTRAINT chk_Lvl CHECK (CLevel>=1 and CLevel<=4)
);

CREATE TABLE Schedule (
	SSN CHAR(20) NOT NULL ,
	WeekDay CHAR(15) NOT NULL ,
	StartTime TIME NOT NULL ,
	Duration SMALLINT NOT NULL ,
	GymRoom CHAR(5) NOT NULL,
	CId CHAR(10) NOT NULL,
	PRIMARY KEY (SSN,WeekDay,StartTime),
	FOREIGN KEY (SSN)
		REFERENCES Trainer(SSN) 
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (CId)
		REFERENCES Course(CId) 
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

