<?php session_start(); ?>
<?php 
if (isset($_POST['publish'])) {
  $publishresut=Model::PublishResult();
  if ($publishresut) {
    $success="Results has Published";
    $_SESSION['success']=$success;
  }
}
if (!isset($_SESSION['user_name'])) {
   echo"<script>window.open('?controller=pages&action=home','_self')</script>";
}
if (isset($_POST['option_submit'])) {
   if (trim($_POST['poll1'])=='' || trim($_POST['poll2'])=='' || trim($_POST['poll3'])=='' || trim($_POST['poll4'])=='') {
                                $message = "Please fill all the fields with valid data.";
                            } else {
                              $polldata=array();
                                $polldata[] = trim($_POST['poll1']);
                                $polldata[]= trim($_POST['poll2']);
                                $polldata[]= trim($_POST['poll3']);
                                $polldata[]= trim($_POST['poll4']);
                              
                                $SetPoll = Model::SetPollOptions($polldata);
                              
                                if ($SetPoll) {
                                   
                                    $message = "Poll Options Successfully Addded.";
                                     echo"<script>alert('Poll Options Successfully Addded')</script>";

                                } else {
                                    
                                
                                    $message = "Poll Options is not Addded.";
                                     echo"<script>alert('Poll Options is not Addded')</script>";
                                }
                            }
}

 ?>
 <?php include 'header.php'; ?>
<div class="container">
 

<div class="row">
<div class="col-md-8 col-md-offset-2">
<?php echo !empty($_SESSION['success'])?'<div class="flash alert-success">
        <p class="panel-body">'.$_SESSION['success'].'</p>
      </div>':''; unset($_SESSION['success']);?>
<div class="panel panel-info">
  <div class="panel-body">
<ul class="nav nav-tabs">
  
<li class="active"> <a href="#tab1" data-toggle="tab">Set Poll Options</a></li>
<li ><a href="#tab2" data-toggle="tab">Set Duration</a></li>
<li ><a href="#tab3" data-toggle="tab">Percentage Of Poll</a></li>
</ul>

<div class="tab-content">
  
<div class="tab-pane active" id="tab1">

<h2>Add Poll Options</h2><hr>
 <div class="panel panel-info">
    <?php
       
        $poll = new Model;
        $pollData = $poll->getPolls();
    ?>
                <div class="panel-heading"> 
                <h3><?php echo $pollData['poll']['subject']; ?></h3>
                </div>
                <div class="panel-body">
        
                        <form role="form" method="POST" action="?controller=pages&action=admin">
                        

                            <div class="form-group">
                                <label class=" control-label"></label>
                                <input type="text" class="form-control" name="poll1" value="" required="" placeholder="Option 1">

                                
                            </div>

                            <div class="form-group">
                                <label class=" control-label"></label>
                                <input type="text" class="form-control" name="poll2" value="" required="" placeholder="Option 2">

                                
                            </div>
                            <div class="form-group">
                                <label class=" control-label"></label>
                                <input type="text" class="form-control" name="poll3" value="" required="" placeholder="Option 3">

                                
                            </div>
                            <div class="form-group">
                                <label class=" control-label"></label>
                                <input type="text" class="form-control" name="poll4" value="" required="" placeholder="Option 4">

                                
                            </div>
                           

                            <div class="form-group">
                                <input type="submit" name="option_submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>
                                </input>

                            </div>
                        </form>
                </div>
            </div>
</div>
<div class="tab-pane " id="tab2">

  <p><h3>Set Duration for Poll</h3></p>

</div>
<div class="tab-pane " id="tab3">

<?php
      //Get poll result data
      $pollResult = $poll->getResult(1);
    ?>
    <h3 class="text-center"><?php echo $pollResult['poll']; ?></h3>
    <p class="text-center"><b>Total Votes:</b> <?php echo $pollResult['total_votes']; ?></p>
    <?php
    if(!empty($pollResult['options'])){ $i=0;
      //Option bar color class array
      $barColorArr = array('azure','emerald','violet','yellow','red');
      //Generate option bars with votes count
      foreach($pollResult['options'] as $opt=>$vote){
        //Calculate vote percent
        $votePercent = round(($vote/$pollResult['total_votes'])*100);
        $votePercent = !empty($votePercent)?$votePercent.'%':'0%';
        //Define bar color class
        if(!array_key_exists($i, $barColorArr)){
            $i=0;
        }
        $barColor = $barColorArr[$i];
    ?>
    <div class="bar-main-container <?php echo $barColor; ?>">
        <div class="txt" style="padding-left: 120px"><?php echo $opt; ?></div>
        <div class="wrap">
          <div class="bar-percentage" style="padding-bottom: 20px"><?php echo $votePercent; ?></div>
          <div class="bar-container">
            <div class="bar" style="width: <?php echo $votePercent; ?>;"></div>
          </div>
        </div>
    </div>
    <?php $i++; } } ?>
    <br>
 <form method="post" action="">
      <div class="text-center">
   <input type="submit" name="publish" class="btn btn-primary" value="Publish">
    </div>
    </form>
</div>


</div>

</div>
</div>
</div>
   </div>
   </div>

