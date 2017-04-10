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

}