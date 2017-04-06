<?php

class Kayttaja extends BaseModel
{

    public $id, $kayttajanimi, $salasana;

    public function __construct($attributes)
    {
        parent::__construct($attributes);
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

    public function etsi($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE Kayttaja.id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $kayttaja = new Kayttaja(array(
                'id' => $row['id'],
                'kayttajanimi' => $row['kayttajanimi'],
                'salasana' => $row['salasana'],
            ));

            return $kayttaja;
        }

        return null;
    }


}