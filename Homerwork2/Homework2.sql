--EXERCISE 1

--1a

SELECT SSN, Name, Surname 
FROM TRAINER T  
WHERE SSN IN (SELECT SSN 
			 FROM GROUP_LESSON GL, GYM G
			 WHERE GL.CodG = G.CodG AND G.City = 'Turin'
			 GROUP BY SSN
			 HAVING COUNT(DISTINCT G.CodG) >= 3);     


--1b

SELECT GL1.CodG, SUM(ParticipantsNumber)
FROM GROUP_LESSON GL1, (SELECT CodG  
						FROM GROUP_LESSON GL2, SPECIALTY S
						WHERE GL2.CodS = S.CodS AND S.NameS = 'Karate'
						GROUP BY CodG
						HAVING COUNT(*) >10) AS KARATEGYM
WHERE GL1.CodG = KARATEGYM.CodG
GROUP BY GL1.SSN;


--1c

SELECT Name, Surname, T.City, TEMP.Counter
FROM TRAINER T, GROUP_LESSON GL, GYM G,(SELECT SSN, COUNT(DISTINCT CodS) AS Counter
                                        FROM GROUP_LESSON GL2 
										GROUP BY SSN) AS TEMP
WHERE T.SSN = GL.SSN 
	 AND G.CodG = GL.CodG 
	 AND G.CIty = T.City 
	 AND TEMP.SSN = T.SSN
GROUP BY Name, Surname, City, Counter
HAVING COUNT(DISTINCT GL.CodG) = (SELECT COUNT(*)
								FROM GYM G1
			  					WHERE G1.City = T.City );



--EXERCISE 2

--2a

SELECT UserType, AVG(Evaluation)
FROM EVALUATION E, USER U 
WHERE E.SSN = U.SSN 
	AND codM IN (SELECT codM
				 FROM MOVIE M
				 WHERE MovieStudio = 'Marvel')
GROUP BY UserType; 


--2b

SELECT U.SSN, maxeval
FROM USERS U, (SELECT SSN, MAX(evaluation) AS maxeval
               FROM MOVIE M0, EVALUATION E0
               WHERE M0.codM = E0.codM AND M0.language = 'Italian'
               GROUP BY SSN) AS TEMP
WHERE UserType = 'expert' 
	AND  TEMP.SSN = U.SSN
	AND NOT EXISTS (SELECT *
					FROM EVALUATION E1, MOVIE M1
					WHERE E1.CodM = M1.CodM 
						AND E1.SSN = U.SSN 
						AND M1.genre = 'Horror')
	AND EXISTS (SELECT *
				FROM EVALUATION E2, MOVIE M2
				WHERE E2.CodM = M2.CodM 
					AND E2.SSN = U.SSN 
					AND M2.genre = 'Comedy'
               	GROUP BY E2.SSN
                HAVING COUNT(*) >= 3);