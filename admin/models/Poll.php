<?php
/*
 * Poll Management Class
 * This class is used to manage the online poll & voting system
 * @author    CodexWorld.com
 * @url       http://www.codexworld.com
 * @license   http://www.codexworld.com/license
 */
class Poll{
    private $dbHost  = 'localhost';
    private $dbUser  = 'root';
    private $dbPwd   = '';
    private $dbName  = 'poll_system';            
    private $db      = false;
    private $pollTbl = 'polls';
    private $optTbl  = 'poll_options';
    private $voteTbl = 'poll_votes';
    
    public function __construct(){
        if(!$this->db){ 
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUser, $this->dbPwd, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
    
   


     public static function checkForUser($username,$password)
  {
    
    $db = mysqli_connect("localhost", "root", "", "poll_system");
    $sql = "SELECT * FROM `admin` WHERE `user_name`='{$username}' AND `password`='{$password}' ";
    $result = mysqli_query($db, $sql);
    if(mysqli_num_rows($result) == 1) {
      mysqli_close($db);
      return true;
    } else {
      mysqli_close($db);
      return false;
    }
  }
     public static function CheckExistingVote($user_roll)
  {
    
    $db = mysqli_connect("localhost", "root", "", "poll_system");
    $sql = "SELECT vote_roll FROM `vote_roll` WHERE `vote_roll`='{$user_roll}'";
    $result = mysqli_query($db, $sql);
    if(mysqli_num_rows($result) == true) {
      mysqli_close($db);
      return true;
    } else {
      mysqli_close($db);
      return false;
    }
  }
    public static function InsertUserRoll($user_roll)
  {

    $db = mysqli_connect("localhost", "root", "", "poll_system");
    $sql = "INSERT INTO `vote_roll` (`vote_roll`) VALUES ('{$user_roll}')";
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    if($result) {
      return true;
    } else {
      return false;
    }
  }
}