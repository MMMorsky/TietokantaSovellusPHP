INSERT INTO Vastuuhenkilo (nimi) VALUES ('Mikko Mallikas');
INSERT INTO Laitos (nimi) VALUES ('TKTL');
INSERT INTO Kurssinvastuu (kurssi_id, vastuuhenkilo_id) VALUES (1, 1);
INSERT INTO Kurssi (kurssinvastuu_id, laitos_id, nimi) VALUES (1, 1, 'Tietokantojen perusteet');
INSERT INTO Kysely (kurssi_id, kysymys5, kysymys5) VALUES (1, 'Mitä pidit SQL kyselyistä?', 'Koitko SQL Syntaxin helppona?');
INSERT INTO Vastaus (kysely_id, vastaus1, vastaus2, vastaus3, vastaus4, vastaus5, vastaus6) VALUES (1, 3, 4, 5, 6, 'Kivoja oli', 'Helppoa oli');

