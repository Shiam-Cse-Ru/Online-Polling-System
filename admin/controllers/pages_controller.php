<?php
  class PagesController {
    public function home() {
      
      require_once('views/pages/home.php');
    }

     public function admin() {
      
      require_once('views/pages/admin.php');
    }

       public function logout() {
      
      require_once('views/pages/logout.php');
    }

    public function error() {
      require_once('views/pages/error.php');
    }
  }
?>