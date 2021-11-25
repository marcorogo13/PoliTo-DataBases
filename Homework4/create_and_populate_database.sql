SET storage_engine=InnoDB;
SET FOREIGN_KEY_CHECKS=1;
CREATE DATABASE if NOT EXISTS multimedia_platform;
use multimedia_platform;

-- drop tables if already exist

DROP TABLE IF EXISTS rating;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS content;

-- tables creation

CREATE TABLE users(
    SSN VARCHAR (255) NOT NULL,
    Name VARCHAR (255) NOT NULL,
    Surname VARCHAR (255) NOT NULL,
    YearOfBirth INT NOT NULL,
  
    PRIMARY KEY(SSN)
);

CREATE TABLE content(
    CodC INT AUTO_INCREMENT,
    Category VARCHAR (255) NOT NULL,
    Duration INT NOT NULL,
    Title VARCHAR (255) NOT NULL,
    Description VARCHAR (255),
  
    PRIMARY KEY (CodC)
    
);

CREATE TABLE rating(
    SSN VARCHAR (255),
    CodC INT, 
    Date DATE,
    Evaluation INT NOT NULL,

    PRIMARY KEY (SSN, CodC, Date),
    
    FOREIGN KEY (SSN)
		REFERENCES users(SSN) 
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (CodC)
		REFERENCES content(CodC) 
		ON DELETE CASCADE
		ON UPDATE CASCADE,
  
    CONSTRAINT chk_eval CHECK (Evaluation>=1 and Evaluation<=10)
);


-- db population

INSERT INTO users(SSN, Name, Surname, YearOfBirth)
VALUES ('SMTPLI90N31B791Z','Paul','Smith', 1988);
INSERT INTO users(SSN, Name, Surname, YearOfBirth)
VALUES ('BBAGGG83E30C447B','Marc','Cipolla', 1928);
INSERT INTO users(SSN, Name, Surname, YearOfBirth)
VALUES ('SZRLLA80N31B791Z','Leti','Train', 1985);
INSERT INTO users(SSN, Name, Surname, YearOfBirth)
VALUES ('ACVBJHA8VT30C478','Jhon','Jesus', 1923);
INSERT INTO users(SSN, Name, Surname, YearOfBirth)
VALUES ('KHNJHA8VT30C455V','Paula','Bianchi', 1912);
INSERT INTO users(SSN, Name, Surname, YearOfBirth)
VALUES ('SMTPLA80N31B791Z','Ric','Martin', 1978);
INSERT INTO users(SSN, Name, Surname, YearOfBirth)
VALUES ('KHNJHN81E30C455Y','Madonna','Fiore', 1913);
INSERT INTO users(SSN, Name, Surname, YearOfBirth)
VALUES ('ZQEPLA80N31B791Z','Giusseppe','Nero', 1942);
INSERT INTO users(SSN, Name, Surname, YearOfBirth)
VALUES ('AAAGGG83E30C445A','Pietro','Bianchi', 1942);
INSERT INTO users(SSN, Name, Surname, YearOfBirth)
VALUES ('ACVPLA80N31B791Y','Maddalena','Rosa', 1954);
INSERT INTO users(SSN, Name, Surname, YearOfBirth)
VALUES ('GHZPLA80N31B79CV','Paul','Ross', 1969);

INSERT INTO content(Category, Duration, Title, Description) -- 1
VALUES ('Animals', 42, 'Cute doge', 'doge barking');
INSERT INTO content(Category, Duration, Title, Description) -- 2
VALUES ('Cooking', 13, 'Tiramisù',null);
INSERT INTO content(Category, Duration, Title, Description) -- 3
VALUES ('Animals', 15, 'Cats', 'cats doing things');
INSERT INTO content(Category, Duration, Title, Description) -- 4
VALUES ('Cooking', 56, 'Homemade pizza',null);
INSERT INTO content(Category, Duration, Title, Description) -- 5
VALUES ('Music', 4, 'Popularsong', 'live from turin');
INSERT INTO content(Category, Duration, Title, Description) -- 6
VALUES ('Music', 3, 'Sadsong', null);
INSERT INTO content(Category, Duration, Title, Description) -- 7
VALUES ('Animals', 14, 'Elephant', 'elephant eating');
INSERT INTO content(Category, Duration, Title, Description) -- 8
VALUES ('Animals', 35, 'Mouse', 'mouse running');
INSERT INTO content(Category, Duration, Title, Description) -- 9
VALUES ('Cooking', 42, 'Ricetta carbonara', 'tradizionale');
INSERT INTO content(Category, Duration, Title, Description) -- 10
VALUES ('Animals', 15, 'OtherCats', null);


INSERT INTO rating(SSN, CodC, Date, Evaluation)
VALUES ('SMTPLI90N31B791Z', 1, '2012-05-30', 10);
INSERT INTO rating(SSN, CodC, Date, Evaluation)
VALUES ('SMTPLI90N31B791Z', 3, '2009-01-12',5);
INSERT INTO rating(SSN, CodC, Date, Evaluation)
VALUES ('GHZPLA80N31B79CV', 2, '2019-02-12', 2);
INSERT INTO rating(SSN, CodC, Date, Evaluation)
VALUES ('KHNJHN81E30C455Y', 1, '2019-02-12', 10);
INSERT INTO rating(SSN, CodC, Date, Evaluation)
VALUES ('KHNJHN81E30C455Y', 8, '2019-06-12', 2);
INSERT INTO rating(SSN, CodC, Date, Evaluation)
VALUES ('ACVBJHA8VT30C478', 3, '2011-12-12', 5);
INSERT INTO rating(SSN, CodC, Date, Evaluation)
VALUES ('ACVBJHA8VT30C478', 9, '2016-11-23', 8);
INSERT INTO rating(SSN, CodC, Date, Evaluation)
VALUES ('ACVBJHA8VT30C478', 7, '2015-12-03', 3);
INSERT INTO rating(SSN, CodC, Date, Evaluation)
VALUES ('SZRLLA80N31B791Z', 5, '2017-11-23', 4);
INSERT INTO rating(SSN, CodC, Date, Evaluation)
VALUES ('BBAGGG83E30C447B', 9, '2013-02-13', 8);
INSERT INTO rating(SSN, CodC, Date, Evaluation)
VALUES ('BBAGGG83E30C447B', 2, '2011-10-23', 2);