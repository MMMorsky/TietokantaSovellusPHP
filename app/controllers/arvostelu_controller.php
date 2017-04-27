<?php

class ArvosteluController extends BaseController
{

    public function arvostelu($id)
    {
        $kurssi = Kurssi::find($id);
        View::make('/arvostelu/arvostelu.html', array('kurssi' => $kurssi));
    }


    public function tallennus($id)
    {
        $params = $_POST;

        if (!isset($_POST['vastaus1']) || !isset($_POST['vastaus2']) || !isset($_POST['vastaus3']) || !isset($_POST['vastaus4']) || !isset($_POST['vastaus5'])) {
            Redirect::to('/arvostelu/' . $id, array('error' => 'Kaikkiin valinnaisiin kysymyksiin on vastattava!'));
        }

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
    }
}