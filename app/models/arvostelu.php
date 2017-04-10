<?php

class Arvostelu extends BaseModel {

    public function tallenna($id) {
        $query = DB::connection()->prepare('INSERT INTO Vastaus (kurssi_id, vastaus1, vastaus2, vastaus3, vastaus4, vastaus5, vastaus6) VALUES ($id, :vastaus1, :vastaus2, :vastaus3, :vastaus4, :vastaus5, :vastaus6)');
        $query->execute(array('vastaus1' => $this->vastaus1, 'vastaus2' => $this->vastaus2, 'vastaus3' => $this->vastaus3, 'vastaus4' => $this->vastaus4, 'vastaus5' => $this->vastaus5, 'vastaus6' => $this->vastaus6));
    }

}