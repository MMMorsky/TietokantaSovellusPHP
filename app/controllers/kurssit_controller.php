<?php

class KurssiController extends BaseController {
    public static function index() {
        $kurssit = Kurssi::all();

        View::make('kurssit', array('kurssit' => $kurssit));

    }
}