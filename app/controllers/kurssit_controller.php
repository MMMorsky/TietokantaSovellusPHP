<?php

class KurssiController extends BaseController {
    public static function index() {
        $kurssit = Kurssi::all();

        View::make('kurssit.html', array('kurssit' => $kurssit));
    }

    public static function esittely($id) {
        $kurssi = Kurssi::find($id);

        View::make('esittely.html', array('kurssi' => $kurssi));

    }

    public static function luonti() {
        View::make('uusikurssi.html');

    }

    public static function tallennus(){
        $params = $_POST;
        $kurssi = new Kurssi(array(
            'nimi' => $params['nimi'],
            'aloituspaiva' => $params['aloituspaiva'],
            'kysymys5' => $params['kysymys5'],
            'kysymys6' => $params['kysymys6']
        ));

        $kurssi->save();

        Redirect::to('/kurssit/' . $kurssi->id, array('message' => 'Kurssi lisätty!'));
    }
}