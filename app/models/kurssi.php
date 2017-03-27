<?php

class Kurssi extends BaseModel {

    public $id, $laitos_id, $nimi, $aloituspaiva;

    public function __construct($attributes){
        parent::__construct($attributes);
    }

    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Kurssi');
        $query->execute();
        $rows = $query->fetchAll();
        $kurssit = array();

        foreach($rows as $row){
            $kurssit[] = new Kurssi(array(
                'id' => $row['id'],
                'laitos_id' => $row['laitos_id'],
                'nimi' => $row['nimi'],
                'aloituspaiva' => $row['aloituspaiva'],
            ));
        }

        return $kurssit;
    }

    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Kurssi WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row){
            $kurssi = new Game(array(
                'id' => $row['id'],
                'laitos_id' => $row['laitos_id'],
                'nimi' => $row['nimi'],
                'aloituspaiva' => $row['aloituspaiva'],
            ));

            return $kurssi;
        }

        return null;
    }
}