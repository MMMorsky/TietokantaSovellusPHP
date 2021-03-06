<?php

  class BaseController{

    public static function get_user_logged_in(){
      // Toteuta kirjautuneen käyttäjän haku tähän
      if(isset($_SESSION['kayttaja'])) {
          $kayttaja_id = $_SESSION['kayttaja'];

          $kayttaja = Kayttaja::etsi($kayttaja_id);

          return $kayttaja;
      }

      return null;
    }

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).

        if(!isset($_SESSION['kayttaja'])) {
            Redirect::to('/kirjaudu', array('message' => 'Kirjaudu ensin sisään!'));
        }
    }

      public static function get_check_permission($id){
        if(isset($_SESSION['kayttaja'])) {
            $kayttaja_id = $_SESSION['kayttaja'];

            $kayttaja = Kayttaja::etsiOikeus($kayttaja_id, $id);

            if ($kayttaja) {
                return $kayttaja;
            }
            
            return null;
        }

      }
  }

