<?php


class HelloWorldController extends BaseController
{

    public static function index()
    {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('home.html');
    }

    public static function sandbox()
    {
        // Testaa koodiasi täällä
        $tikape = Kurssi::all();
        $kurssit = Kurssi::find(1);

        Kint::dump($kurssit);
        Kint::dump($tikape);
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
