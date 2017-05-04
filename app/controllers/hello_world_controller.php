<?php


class HelloWorldController extends BaseController
{

    public static function index()
    {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('/yleiset/home.html');
    }

    public static function sandbox()
    {
        // Testaa koodiasi täällä
        $kurssi = new Kurssi(array(
           'nimi' => 'ab',
            'aloituspaiva' => ''
        ));

        $errors = $kurssi->errors();

        Kint::dump($errors);
    }

    public static function kurssit()
    {
        View::make('kurssit.html');
    }


    public static function muokkaus()
    {
        View::make('muokkaus.html');
    }

    public static function esittely()
    {
        View::make('esittely.html');
    }
}
