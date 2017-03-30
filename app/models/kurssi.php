<?php

class Kurssi extends BaseModel {

    public $id, $nimi, $aloituspaiva, $vastuuhenkilo, $kysymys5, $kysymys6;

    public function __construct($attributes){
        parent::__construct($attributes);
    }

    public static function all(){
        $query = DB::connection()->prepare('SELECT Kurssi.id, aloituspaiva, Kurssi.nimi AS nimi, Vastuuhenkilo.nimi AS vastuuhenkilo FROM Kurssi 
LEFT JOIN Kurssinvastuu ON Kurssi.id=Kurssinvastuu.kurssi_id
LEFT JOIN Vastuuhenkilo ON Vastuuhenkilo.id=Kurssinvastuu.vastuuhenkilo_id');
        $query->execute();
        $rows = $query->fetchAll();
        $kurssit = array();

        foreach($rows as $row){
            $kurssit[] = new Kurssi(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'aloituspaiva' => $row['aloituspaiva'],
                'vastuuhenkilo' => $row['vastuuhenkilo'],
            ));
        }

        return $kurssit;
    }

    public static function find($id){
        $query = DB::connection()->prepare('SELECT Kurssi.id, aloituspaiva, Kurssi.nimi AS nimi, Vastuuhenkilo.nimi AS vastuuhenkilo FROM Kurssi 
LEFT JOIN Kurssinvastuu ON Kurssi.id=Kurssinvastuu.kurssi_id
LEFT JOIN Vastuuhenkilo ON Vastuuhenkilo.id=Kurssinvastuu.vastuuhenkilo_id WHERE Kurssi.id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row){
            $kurssi = new Kurssi(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'aloituspaiva' => $row['aloituspaiva'],
                'vastuuhenkilo' => $row['vastuuhenkilo'],
            ));

            return $kurssi;
        }

        return null;
    }

    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Kurssi (nimi, aloituspaiva, kysymys5, kysymys6) VALUES (:nimi, :aloituspaiva, :kysymys5, :kysymys6) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'aloituspaiva' => $this->aloituspaiva, 'kysymys5' => $this->kysymys5, 'kysymys6' => $this->kysymys6));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
}