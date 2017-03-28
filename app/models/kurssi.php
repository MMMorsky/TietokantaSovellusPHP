<?php

class Kurssi extends BaseModel {

    public $id, $laitos_id, $nimi, $aloituspaiva, $laitos, $vastuuhenkilo;

    public function __construct($attributes){
        parent::__construct($attributes);
    }

    public static function all(){
        $query = DB::connection()->prepare('SELECT Kurssi.id, aloituspaiva, Kurssi.nimi AS nimi, Laitos.nimi AS laitos, Vastuuhenkilo.nimi AS vastuuhenkilo FROM Kurssi 
INNER JOIN Laitos ON Kurssi.laitos_id=Laitos.id 
INNER JOIN Kurssinvastuu ON Kurssi.id=Kurssinvastuu.kurssi_id
INNER JOIN Vastuuhenkilo ON Vastuuhenkilo.id=Kurssinvastuu.vastuuhenkilo_id');
        $query->execute();
        $rows = $query->fetchAll();
        $kurssit = array();

        foreach($rows as $row){
            $kurssit[] = new Kurssi(array(
                'id' => $row['id'],
                'laitos' => $row['laitos'],
                'nimi' => $row['nimi'],
                'aloituspaiva' => $row['aloituspaiva'],
                'vastuuhenkilo' => $row['vastuuhenkilo'],
            ));
        }

        return $kurssit;
    }

    public static function find($id){
        $query = DB::connection()->prepare('SELECT Kurssi.id, aloituspaiva, Kurssi.nimi AS nimi, Laitos.nimi AS laitos, Vastuuhenkilo.nimi AS vastuuhenkilo FROM Kurssi 
INNER JOIN Laitos ON Kurssi.laitos_id=Laitos.id 
INNER JOIN Kurssinvastuu ON Kurssi.id=Kurssinvastuu.kurssi_id
INNER JOIN Vastuuhenkilo ON Vastuuhenkilo.id=Kurssinvastuu.vastuuhenkilo_id WHERE Kurssi.id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row){
            $kurssi = new Kurssi(array(
                'id' => $row['id'],
                'laitos' => $row['laitos'],
                'nimi' => $row['nimi'],
                'aloituspaiva' => $row['aloituspaiva'],
                'vastuuhenkilo' => $row['vastuuhenkilo'],
            ));

            return $kurssi;
        }

        return null;
    }
}