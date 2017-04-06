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
            View::make('uusikurssi.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function muokkaus($id) {
        $kurssi = Kurssi::find($id);
        View::make('muokkaus.html', array('attributes' => $kurssi));
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
            View::make('muokkaus.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $kurssi->edit($id);

            Redirect::to('/kurssit/' . $kurssi->id, array('message' => 'Kurssia muokattu onnistuneesti!'));
        }
    }

    public static function tuhoa($id) {
        $kurssi = new Kurssi(array('id' => $id));

        $kurssi->tuhoa($id);

        Redirect::to('/kurssit', array('message' => 'Kurssi poistettu!'));
    }
}