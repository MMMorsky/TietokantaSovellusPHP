<?php

class KayttajaController extends BaseController {
    public static function login() {
        View::make('kirjaudu.html');
    }

    public static function kirjauduulos(){
        $_SESSION['kayttaja'] = null;
        Redirect::to('/', array('message' => 'Olet kirjautunut ulos!'));
    }

    public static function kasittele_kirjautuminen() {
        $params = $_POST;

        $kayttaja = Kayttaja::authenticate($params['kayttajanimi'], $params['salasana']);

        if(!$kayttaja) {
            View::make('kirjaudu.html', array('error' => 'Väärä käyttäjätunnus tai salasana', 'username' => $params['kayttajanimi']));
        } else {
            $_SESSION['kayttaja'] = $kayttaja->id;

            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $kayttaja->kayttajanimi . '!'));
        }
    }

    public static function naytaKaikki() {
        $kayttajat = Kayttaja::naytaKaikki();


        View::make('/yleiset/kayttajat.html', array('kayttajat' => $kayttajat));

    }

    public static function tuhoa($id) {
        self::check_logged_in();
        $kayttaja = new Kayttaja(array('id' => $id));

        $kayttaja->tuhoa($id);

        Redirect::to('/kurssit', array('message' => 'Käyttäjä poistettu!'));
    }

    public static function muokkaus($id) {
        self::check_logged_in();
        $kayttaja = Kayttaja::etsi($id);
        View::make('/yleiset/muokkaus.html', array('attributes' => $kayttaja));
    }

    public static function paivitys($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'kayttajanimi' => $params['kayttajanimi'],
            'oikeanimi' => $params['oikeanimi'],
            'salasana' => $params['salasana'],
        );

        $kayttaja = new Kayttaja($attributes);
        $errors = $kayttaja->errors();

        if (count($errors) > 0) {
            View::make('/yleiset/muokkaus.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $kayttaja->edit();

            Redirect::to('/kurssit/' . $kayttaja->id, array('message' => 'Käyttäjää muokattu onnistuneesti!'));
        }
    }

    public static function luonti() {
        self::check_logged_in();
        View::make('/yleiset/uusikayttaja.html');

    }

    public static function tallennus(){
        $params = $_POST;
        $attributes = new Kayttaja(array(
            'kayttajanimi' => $params['kayttajanimi'],
            'oikeanimi' => $params['oikeanimi'],
            'salasana' => $params['salasana'],
        ));

        $kayttaja = new Kayttaja($attributes);
        $errors = $kayttaja->errors();

        if (count($errors) == 0) {
            $kayttaja->tallenna();
            Redirect::to('/', array('message' => 'Kayttäjä lisätty!'));
        } else {
            View::make('/yleiset/uusikayttaja.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

}