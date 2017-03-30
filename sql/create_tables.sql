CREATE TABLE Vastuuhenkilo  (
  id SERIAL PRIMARY KEY,
  nimi VARCHAR(50) NOT NULL
);


CREATE TABLE Kurssi (
  id SERIAL PRIMARY KEY,
  nimi VARCHAR(50) NOT NULL,
  aloituspaiva VARCHAR(50),
  kysymys5 VARCHAR(200),
  kysymys6 VARCHAR(200)
);


CREATE TABLE Kurssinvastuu (
  vastuuhenkilo_id INTEGER REFERENCES Vastuuhenkilo(id) ON UPDATE CASCADE ON DELETE CASCADE,
  kurssi_id INTEGER REFERENCES Kurssi(id) ON UPDATE CASCADE
);


CREATE TABLE Vastaus (
  id SERIAL PRIMARY KEY,
  kurssi_id INTEGER REFERENCES Kurssi(id),
  vastaus1 INTEGER NOT NULL,
  vastaus2 INTEGER NOT NULL,
  vastaus3 INTEGER NOT NULL,
  vastaus4 INTEGER NOT NULL,
  vastaus5 VARCHAR(200),
  vastaus6 VARCHAR(200)
)