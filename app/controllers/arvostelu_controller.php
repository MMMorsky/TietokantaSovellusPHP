<?php

class ArvosteluController extends BaseController {

    public static function arvostelu($id) {
        $kurssi = Kurssi::find($id);
        View::make('arvostelu.html', array('kurssi' => $kurssi));
    }

    public static function etsi($id)
    {
        $query = DB::connection()->prepare('SELECT AVG(vastaus1) AS vastaus1, AVG(vastaus2) AS vastaus2,
 AVG(vastaus3) AS vastaus3, AVG(vastaus4) AS vastaus4 FROM Vastaus');
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

    public static function tallennus($id){
        $params = $_POST;

        $attributes = new Arvostelu(array(
            'vastaus1' => $params['vastaus1'],
            'vastaus2' => $params['vastaus2'],
            'vastaus3' => $params['vastaus3'],
            'vastaus4' => $params['vastaus4'],
            'vastaus5' => $params['vastaus5'],
            'vastaus6' => $params['vastaus6'],
        ));


        $arvostelu = new Arvostelu($attributes);
        $arvostelu->tallenna($id);
        Redirect::to('/', array('message' => 'Arvostelu lisätty onnistuneesti!'));


/*        $errors = $arvostelu->errors();

        if (count($errors) == 0) {
            $arvostelu->save();
            Redirect::to('/', array('message' => 'Arvostelu lisätty onnistuneesti!'));
        } else {
            View::make('uusikurssi.html', array('errors' => $errors, 'attributes' => $attributes));
        }*/
    }
}