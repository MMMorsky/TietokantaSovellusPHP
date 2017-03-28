INSERT INTO Vastuuhenkilo (nimi) VALUES ('Mikko Mallikas');
INSERT INTO Laitos (nimi) VALUES ('TKTL');
INSERT INTO Kurssi (laitos_id, nimi, aloituspaiva) VALUES (1, 'Tietokantojen perusteet', '1.1.2016');
INSERT INTO Kurssinvastuu (vastuuhenkilo_id, kurssi_id) VALUES (1, 1);
INSERT INTO Kysely (kurssi_id, kysymys5, kysymys6) VALUES (1, 'Mitä pidit SQL kyselyistä?', 'Koitko SQL Syntaxin helppona?');
INSERT INTO Vastaus (kysely_id, vastaus1, vastaus2, vastaus3, vastaus4, vastaus5, vastaus6) VALUES (1, 3, 4, 5, 6, 'Kivoja oli', 'Helppoa oli');