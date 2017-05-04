<?php

class Kayttaja extends BaseModel
{

    public $id, $kayttajanimi, $oikeanimi, $salasana;

    public function __construct($attributes)
    {
        parent::__construct($attributes);
        $this->validators = array('validoi_kayttajanimi', 'validoi_salasana');

    }

    public function authenticate($kayttajanimi, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE kayttajanimi = :kayttajanimi AND salasana = :salasana LIMIT 1');
        $query->execute(array('kayttajanimi' => $kayttajanimi, 'salasana' => $salasana));
        $row = $query->fetch();
        if ($row) {
            $kayttaja = new Kayttaja(array(
                'id' => $row['id'],
                'kayttajanimi' => $row['kayttajanimi'],
                'salasana' => $row['salasana'],
            ));

            return $kayttaja;
        } else {
            return null;
        }


    }

    public static function etsi($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE Kayttaja.id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $kayttaja = new Kayttaja(array(
                'id' => $row['id'],
                'kayttajanimi' => $row['kayttajanimi'],
                'oikeanimi' => $row['oikeanimi'],
                'salasana' => $row['salasana'],
            ));

            return $kayttaja;
        }

        return null;
    }

    public static function naytaKaikki() {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja');
        $query->execute();

        $rows = $query->fetchAll();

        $kayttajat = array();

        foreach ($rows as $row) {
            $kayttajat[] = new Kayttaja(array(
                'id' => $row['id'],
                'kayttajanimi' => $row['kayttajanimi'],
                'oikeanimi' => $row['oikeanimi'],
            ));
        }

        return $kayttajat;
    }

    public static function naytaKaikkiKurssinVastuut($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja 
INNER JOIN Kurssinvastuu ON Kayttaja.id = Kurssinvastuu.kayttaja_id 
INNER JOIN Kurssi ON Kurssi.id = Kurssinvastuu.kayttaja_id WHERE Kurssi.id = :id');
        $query->execute(array('id' => $id));

        $rows = $query->fetchAll();

        $kayttajat = array();

        foreach ($rows as $row) {
            $kayttajat[] = new Kayttaja(array(
                'id' => $row['id'],
                'kayttajanimi' => $row['kayttajanimi'],
                'oikeanimi' => $row['oikeanimi'],
            ));
        }

        return $kayttajat;
    }

    public static function tuhoa($id) {
        $query = DB::connection()->prepare('DELETE FROM Kayttaja WHERE Kayttaja.id = :id');
        $query->execute(array('id' => $id));

    }

    public function edit($id) {
        $query = DB::connection()->prepare('UPDATE Kayttaja SET kayttajanimi = :kayttajanimi,
        oikeanimi = :oikeanimi, 
        salasana = :salasana
        WHERE Kayttaja.id = :id');
        $query->execute(array('id' => $id, 'kayttajanimi' => $this->kayttajanimi, 'oikeanimi' => $this->oikeanimi, 'salasana' => $this->salasana));
    }

    public function tallenna()
    {
        $query = DB::connection()->prepare('INSERT INTO Kayttaja (kayttajanimi, oikeanimi, salasana) VALUES (:kayttajanimi, :oikeanimi, :salasana)');
        $query->execute(array('kayttajanimi' => $this->kayttajanimi, 'oikeanimi' => $this->oikeanimi, 'salasana' => $this->salasana));
    }


    public function validoi_kayttajanimi() {
        $errors = array();
        if ($this->kayttajanimi == '' || $this->kayttajanimi == null) {
            $errors[] = 'Käyttäjänimi ei voi olla tyhjä';
        }
        if(strlen($this->kayttajanimi) < 3) {
            $errors[] = 'Käyttäjänimen pituuden tulee olla vähintään kolme merkkiä';
        }

        return $errors;
    }

    public function validoi_salasana() {
        $errors = array();
        if ($this->salasana == '' || $this->salasana == null) {
            $errors[] = 'Salasana ei saa olla tyhjä';
        }

        return $errors;
    }

}