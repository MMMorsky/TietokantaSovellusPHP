<?php

class Arvostelu extends BaseModel {

    public $vastaus1, $vastaus2, $vastaus3, $vastaus4, $vastaus5, $vastaus6;

    public function __construct($attributes)
    {
        parent::__construct($attributes);

    }

    public function tallenna($id) {
        $query = DB::connection()->prepare('INSERT INTO Vastaus (kurssi_id, vastaus1, vastaus2, vastaus3, vastaus4, vastaus5, vastaus6) VALUES (:id, :vastaus1, :vastaus2, :vastaus3, :vastaus4, :vastaus5, :vastaus6)');
        $query->execute(array('id' => $id, 'vastaus1' => $this->vastaus1, 'vastaus2' => $this->vastaus2, 'vastaus3' => $this->vastaus3, 'vastaus4' => $this->vastaus4, 'vastaus5' => $this->vastaus5, 'vastaus6' => $this->vastaus6));
    }


    public static function annanumerovastaukset($id, $kysymys) //kesken
    {

        if ($kysymys == 1) {
            $query = DB::connection()->prepare('SELECT Vastaus1 AS arvo, COUNT(vastaus1) AS vastaus FROM Vastaus WHERE kurssi_id = :id GROUP BY Vastaus1');
        } elseif ($kysymys == 2) {
            $query = DB::connection()->prepare('SELECT Vastaus2 AS arvo, COUNT(vastaus2) AS vastaus FROM Vastaus WHERE kurssi_id = :id GROUP BY Vastaus2');
        } elseif ($kysymys == 3) {
            $query = DB::connection()->prepare('SELECT Vastaus3 AS arvo, COUNT(vastaus3) AS vastaus FROM Vastaus WHERE kurssi_id = :id GROUP BY Vastaus3');
        } else {
            $query = DB::connection()->prepare('SELECT Vastaus4 AS arvo, COUNT(vastaus4) AS vastaus FROM Vastaus WHERE kurssi_id = :id GROUP BY Vastaus4');
        }

        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();

        $vastaukset = array(
            'vastaus1' => 0,
            'vastaus2' => 0,
            'vastaus3' => 0,
            'vastaus4' => 0,
            'vastaus5' => 0
        );


        foreach ($rows as $row) {
            if ($row['arvo'] == 1) {
                $vastaukset['vastaus1'] = $row['vastaus'];
            } elseif ($row['arvo'] == 2) {
                $vastaukset['vastaus2'] = $row['vastaus'];
            } elseif ($row['arvo'] == 3) {
                $vastaukset['vastaus3'] = $row['vastaus'];
            } elseif ($row['arvo'] == 4) {
                $vastaukset['vastaus4'] = $row['vastaus'];
            } else {
                $vastaukset['vastaus5'] = $row['vastaus'];
            }

            //$vastaukset[] = $row['vastaus'];
        }

        $arvostelu = new Arvostelu(array(
            'vastaus1' => $vastaukset['vastaus1'],
            'vastaus2' => $vastaukset['vastaus2'],
            'vastaus3' => $vastaukset['vastaus3'],
            'vastaus4' => $vastaukset['vastaus4'],
            'vastaus5' => $vastaukset['vastaus5'],
        ));


        return $arvostelu;
    }

    public static function annatekstivastaukset($id, $kysymys) {
        if ($kysymys == 5) {
            $query = DB::connection()->prepare('SELECT vastaus5 AS vastaus FROM Vastaus WHERE kurssi_id = :id');
        } else {
            $query = DB::connection()->prepare('SELECT vastaus6 AS vastaus FROM Vastaus WHERE kurssi_id = :id');
        }

        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();

        $vastaukset = array();

        foreach ($rows as $row) {

            if ($row['vastaus'] != null) {
                $vastaukset[] = new Arvostelu(array(
                    'vastaus5' => $row['vastaus'],
                ));
            }

        }

        return $vastaukset;



    }

}