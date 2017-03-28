<?php

class KurssiController extends BaseController {
    public static function index() {
        $kurssit = Kurssi::all();

        View::make('kurssit.html', array('kurssit' => $kurssit));
    }

    public static function esittely($id) {
        $kurssi = Kurssi::find($id);

        
    }
}