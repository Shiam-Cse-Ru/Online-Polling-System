<?php
  class PagesController {
    public function home() {
    
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