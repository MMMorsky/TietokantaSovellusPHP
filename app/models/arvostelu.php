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


    public static function annavastaukset($id) //kesken
    {
        $query = DB::connection()->prepare('SELECT COUNT(vastaus1) AS vastaus1 FROM Vastaus WHERE kurssi_id = :id GROUP BY Vastaus1');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();

        $vastaukset = array();


        foreach ($rows as $row) {
            $vastaukset[] = $row['vastaus1'];
        }




        return $arvostelut;
    }

}