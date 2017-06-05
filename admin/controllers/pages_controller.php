<?php
  class PagesController {
    public function home() {
      $first_name = 'Abdullah Al';
      $last_name  = 'Shiam';
      require_once('views/pages/home.php');
    }

     public function results() {
      
      require_once('views/pages/results.php');
    }

    
    public function error() {
      require_once('views/pages/error.php');
    }
  }
?>