USE multimedia_platform;

-- Interrogation of the implemented database:

SELECT Evaluation, Date
FROM rating r, content c
WHERE SSN = 'ACVBJHA8VT30C478' AND Category = 'Animals' AND r.CodC = c.CodC 
ORDER BY date; 

-- Data entry transaction:

START transaction;

INSERT INTO users(SSN, Name, Surname, YearOfBirth)
VALUES ('PROVAI90N31B791Z','Luca','Ward', 1988);

INSERT INTO rating(SSN, CodC, Date, Evaluation)
VALUES ('PROVAI90N31B791Z', 1, '2020-05-30', 10);

COMMIT;