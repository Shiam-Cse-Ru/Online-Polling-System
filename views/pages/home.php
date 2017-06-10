<?php
//Include and initialize Poll class 

$poll = new Poll;

//Check whether vote is submitted
if(isset($_POST['voteSubmit'])){
    $user_roll=$_POST['roll'];
    $voteData = array(
        'poll_id' => $_POST['pollID'],
        'poll_option_id' => $_POST['voteOpt']
         
    );
    //Submit vote by Poll class
    if (Poll::CheckUserRoll($user_roll)) {
      
      if (Poll::CheckExistingVote($user_roll)) {
          $statusMsg = 'Your vote already had submitted.';
      }

      else{
        $voteSubmit = $poll->vote($voteData);
        $InsertRoll=Poll::InsertUserRoll($user_roll);
        if ($voteSubmit) {
         $success = 'Your vote has been submitted successfully.';

        }
        else{

        $statusMsg = 'An Error Occured.';

        }
      }
    
 
}
else{
     $statusMsg = 'Please Enter Your Valid Roll.';
}
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8" />

</head>
<body>
<?php include 'header.php'; ?>
<div class="container">

    <?php
        //Get poll and options data
        $pollData = $poll->getPolls();
    ?>
<div style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2"> 
  <?php echo !empty($statusMsg)?'<div class="alert alert-danger">
     <a href="" class="close" data-dismiss="alert">×</a>

        <p class="panel-body">'.$statusMsg.'</p>
      </div>':''; ?>
      <?php echo !empty($success)?'<div class="alert alert-success">
   <a href="" class="close" data-dismiss="alert">×</a>

        <p class="panel-body">'.$success.'</p>
      </div>':''; ?>

  <div class="panel panel-info">
                    <div class="panel-heading">
         <div class="panel-title text-center">  
         <h3><?php echo $pollData['poll']['subject']; ?></h3>
         </div>
                        
                    </div> 
        <div style="padding-top:30px" class="panel-body">
  
      
        <form action="" method="post" name="pollFrm">
      <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" class="form-control" name="roll" value="" placeholder="Enter Your Roll" required="">                                        
                                    </div><hr>
        <ul>
            <?php foreach($pollData['options'] as $opt){
                echo '<li><input type="radio" name="voteOpt" required="" value="'.$opt['id'].'" >'.$opt['name'].'</li>';
            } ?>
        </ul><br>
        <input type="hidden" name="pollID" value="<?php echo $pollData['poll']['id']; ?>">
        <input type="submit" name="voteSubmit" class="btn btn-primary" value="Vote">
        <a href="?controller=pages&action=results&pollID=<?php echo $pollData['poll']['id']; ?>" class="btn btn-success">Results</a>
        </form>
    </div>
    </div>
  
    </div>
    </div>

</body>
</html>