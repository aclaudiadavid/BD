-- Qual o local publico onde estao registadas mais anomalias?
SELECT nome
FROM Incidencia
    NATURAL JOIN Item
    NATURAL JOIN LocalPublico
GROUP BY nome
HAVING COUNT(nome) >= ALL (
    SELECT COUNT(nome)
    FROM Incidencia 
        NATURAL JOIN Item 
        NATURAL JOIN LocalPublico 
    GROUP BY nome);

-- Qual o utilizador regular que registou mais anomalias de traducao no primeiro semestre de 2019?
SELECT Incidencia.email
FROM AnomaliaTraducao 
    NATURAL JOIN Anomalia 
    NATURAL JOIN Incidencia
    INNER JOIN UtilizadorRegular ON Incidencia.email = UtilizadorRegular.email
WHERE ts BETWEEN '2019-01-01 00:00:00' AND '2019-06-30 23:59:59'
GROUP BY Incidencia.email
HAVING COUNT(Incidencia.email) >= ALL (
    SELECT COUNT(Incidencia.email) 
    FROM AnomaliaTraducao 
        NATURAL JOIN Anomalia 
        NATURAL JOIN Incidencia 
        INNER JOIN UtilizadorRegular ON Incidencia.email = UtilizadorRegular.email
    WHERE ts BETWEEN '2019-01-01 00:00:00' AND '2019-06-30 23:59:59'
    GROUP BY Incidencia.email);

/* Quais sao os utilizadores que registaram em 2019 incidencias em todos os locais publicos
situados a norte de Rio Maior (Portugal) (coordenadas de Rio Maior: 39.336775, -8.936379 */
SELECT email
FROM Incidencia 
    NATURAL JOIN Item 
    FULL JOIN Anomalia ON Incidencia.idAnomalia = Anomalia.idAnomalia
WHERE ts BETWEEN '2019-01-01 00:00:00' AND '2019-12-31 23:59:59' 
    AND latitude > 39.336775
GROUP BY email
HAVING COUNT(DISTINCT (latitude, longitude)) = (
    SELECT COUNT(*)
    FROM LocalPublico
    WHERE latitude > 39.336775
);

/* Quais sao os utilizadores qualificados que nao apresentaram uma proposta de correcao para
cada uma das incidencias por eles registadas em locais publicos a sul de Rio Maior no ano
corrente. */
SELECT Incidencia.email
FROM Incidencia 
    NATURAL JOIN Item
    FULL JOIN Anomalia ON Incidencia.idAnomalia = Anomalia.idAnomalia
    INNER JOIN UtilizadorQualificado ON Incidencia.email = UtilizadorQualificado.email
WHERE (Incidencia.email NOT IN (
    SELECT Incidencia.email 
    FROM Incidencia 
        INNER JOIN Correcao ON Incidencia.idAnomalia = Correcao.idAnomalia
    WHERE Incidencia.email = Correcao.email))
    AND ts BETWEEN '2019-01-01 00:00:00' AND '2019-12-31 23:59:59' 
    AND latitude < 39.336775;
