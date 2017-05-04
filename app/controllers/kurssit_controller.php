<?php

class KurssiController extends BaseController {
    public static function index() {
        $kurssit = Kurssi::all();


        View::make('/kurssit/kurssit.html', array('kurssit' => $kurssit));
    }

    public static function esittely($id) {
        self::check_logged_in();
        $kurssi = Kurssi::find($id);

        $arvostelu = Arvostelu::annanumerovastaukset($id, 1);
        $arvostelu2 = Arvostelu::annanumerovastaukset($id, 2);
        $arvostelu3 = Arvostelu::annanumerovastaukset($id, 3);
        $arvostelu4 = Arvostelu::annanumerovastaukset($id, 4);

        $arvostelu5 = Arvostelu::annatekstivastaukset($id, 5);
        $arvostelu6 = Arvostelu::annatekstivastaukset($id, 6);

        $vastuut = Kayttaja::naytaKaikkiKurssinVastuut($id);



        View::make('/kurssit/esittely.html', array('kurssi' => $kurssi,
            'arvostelu' => $arvostelu, 'arvostelu2' => $arvostelu2,
            'arvostelu3' => $arvostelu3, 'arvostelu4' => $arvostelu4,
            'arvostelu5' => $arvostelu5, 'arvostelu6' => $arvostelu6, 'vastuut' => $vastuut));

    }

    public static function luonti() {
        self::check_logged_in();
        View::make('/kurssit/uusikurssi.html');

    }

    public static function tallennus(){
        $params = $_POST;
        $attributes = new Kurssi(array(
            'nimi' => $params['nimi'],
            'aloituspaiva' => $params['aloituspaiva'],
            'kysymys5' => $params['kysymys5'],
            'kysymys6' => $params['kysymys6']
        ));

        $kurssi = new Kurssi($attributes);
        $errors = $kurssi->errors();

        if (count($errors) == 0) {
            $kurssi->save();
            Redirect::to('/kurssit/' . $kurssi->id, array('message' => 'Kurssi lisätty!'));
        } else {
            View::make('/kurssit/uusikurssi.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function muokkaus($id) {
        self::check_logged_in();
        $kurssi = Kurssi::find($id);
        $kayttajat = Kayttaja::naytaKaikki();
        View::make('/kurssit/muokkaus.html', array('attributes' => $kurssi, 'kayttajat' => $kayttajat));
    }

    public static function paivitys($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'aloituspaiva' => $params['aloituspaiva'],
            'kysymys5' => $params['kysymys5'],
            'kysymys6' => $params['kysymys6']
        );

        $kurssi = new Kurssi($attributes);
        $errors = $kurssi->errors();

        if (count($errors) > 0) {
            View::make('/kurssit/muokkaus.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $kurssi->edit($id);

            Redirect::to('/kurssit/' . $kurssi->id, array('message' => 'Kurssia muokattu onnistuneesti!'));
        }
    }

    public static function tuhoa($id) {
        self::check_logged_in();
        $kurssi = new Kurssi(array('id' => $id));

        $kurssi->tuhoa($id);

        Redirect::to('/kurssit', array('message' => 'Kurssi poistettu!'));
    }
}