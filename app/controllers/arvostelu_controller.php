<?php

class ArvosteluController extends BaseController {

    public static function arvostelu($id) {
        $kurssi = Kurssi::find($id);
        View::make('arvostelu.html', array('kurssi' => $kurssi));
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