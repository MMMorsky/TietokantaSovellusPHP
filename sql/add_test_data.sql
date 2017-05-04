INSERT INTO Kayttaja (kayttajanimi, oikeanimi, salasana) VALUES ('timo','Timo Tamminen', 'raipe');
INSERT INTO Kayttaja (kayttajanimi, oikeanimi, salasana) VALUES ('liisa','Liisa Jokinen', 'raipe');
INSERT INTO Kayttaja (kayttajanimi, oikeanimi, salasana) VALUES ('tiina', 'Tiina Mäkinen' , 'raipe');
INSERT INTO Kurssi (nimi, aloituspaiva, kysymys5, kysymys6) VALUES ('Tietokantojen perusteet', '1.1.2016', 'Mitä pidit SQL kyselyistä?', 'Koitko SQL Syntaxin helppona?');
INSERT INTO Kurssi (nimi, aloituspaiva) VALUES ('Ohjelmoinnin perusteet', '1.3.2016');
INSERT INTO Kurssinvastuu (kayttaja_id, kurssi_id) VALUES (1, 1);
INSERT INTO Vastaus (kurssi_id, vastaus1, vastaus2, vastaus3, vastaus4, vastaus5, vastaus6) VALUES (1, 3, 4, 5, 6, 'Kivoja oli', 'Helppoa oli');

