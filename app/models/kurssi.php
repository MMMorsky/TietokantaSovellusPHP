<?php

class Kurssi extends BaseModel
{

    public $id, $nimi, $aloituspaiva, $vastuuhenkilo, $kysymys5, $kysymys6;

    public function __construct($attributes)
    {
        parent::__construct($attributes);
        $this->validators = array('validoi_nimi', 'validoi_aloituspaiva');
    }

    public static function all()
    {
        $query = DB::connection()->prepare('SELECT Kurssi.id, aloituspaiva, Kurssi.nimi AS nimi FROM Kurssi');
        $query->execute();
        $rows = $query->fetchAll();
        $kurssit = array();

        foreach ($rows as $row) {
            $kurssit[] = new Kurssi(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'aloituspaiva' => $row['aloituspaiva'],
            ));
        }

        return $kurssit;
    }


    public static function find($id)
    {
        $query = DB::connection()->prepare('SELECT Kurssi.id AS id, aloituspaiva, Kurssi.nimi AS nimi, Kayttaja.kayttajanimi AS vastuuhenkilo, Kurssi.kysymys5, Kurssi.kysymys6 FROM Kurssi 
LEFT JOIN Kurssinvastuu ON Kurssi.id=Kurssinvastuu.kurssi_id
LEFT JOIN Kayttaja ON Kayttaja.id=Kurssinvastuu.kayttaja_id WHERE Kurssi.id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $kurssi = new Kurssi(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'aloituspaiva' => $row['aloituspaiva'],
                'kysymys5' => $row['kysymys5'],
                'kysymys6' => $row['kysymys6'],
            ));

            return $kurssi;
        }

        return null;
    }

    public function save()
    {
        $query = DB::connection()->prepare('INSERT INTO Kurssi (nimi, aloituspaiva, kysymys5, kysymys6) VALUES (:nimi, :aloituspaiva, :kysymys5, :kysymys6) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'aloituspaiva' => $this->aloituspaiva, 'kysymys5' => $this->kysymys5, 'kysymys6' => $this->kysymys6));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function tuhoa($id)
    {
        $query = DB::connection()->prepare('DELETE FROM Kurssi WHERE Kurssi.id = :id');
        $query->execute(array('id' => $id));

    }

    public function edit($id)
    {
        $query = DB::connection()->prepare('UPDATE Kurssi SET nimi = :nimi, aloituspaiva = :aloituspaiva, 
        kysymys5 = :kysymys5, kysymys6 = :kysymys6
        WHERE Kurssi.id = :id');
        $query->execute(array('id' => $id, 'nimi' => $this->nimi, 'aloituspaiva' => $this->aloituspaiva, 'kysymys5' => $this->kysymys5, 'kysymys6' => $this->kysymys6));
    }

    public function validoi_nimi()
    {
        $errors = array();
        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Nimi ei voi olla tyhjä';
        }
        if (strlen($this->nimi) < 3) {
            $errors[] = 'Nimen pituuden tulee olla vähintään kolme merkkiä';
        }

        return $errors;
    }

    public function validoi_aloituspaiva()
    {
        $errors = array();
        if ($this->aloituspaiva == '' || $this->aloituspaiva == null) {
            $errors[] = 'Päivämäärä ei saa olla tyhjä';
        }

        return $errors;
    }
}