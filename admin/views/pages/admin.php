<?php session_start(); ?>
<?php 

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
<div class="container">
  <div class="row">
  
  <div class="navbar navbar-default navbar-inverse"  role="navigation">
  
    <div class="nav-header">

      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
  
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>

      </button>
  
      <a href="#" class="navbar-brand">Administrator</a>

    </div>
  
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
              <li ><a href='?controller=pages&action=admin'>Home</a></li>
            <li class="active "><a href='?controller=pages&action=index'>Blog</a></li>
           
               
         </ul>
         <?php if (isset($_SESSION['user_name'])) {
            
             $user_name=$_SESSION['user_name'];
           ?>
         <ul class="nav navbar-nav navbar-right">
         <ul class="nav navbar-nav">
            
            <li class="active "><a>Welcome</a></li>
    
         </ul>
         <li class="dropdown"> 

          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php 
          
          echo $user_name;
           ?><b class="caret"></b></a>

        <ul class="dropdown-menu">
        
         <li ><a href="?controller=pages&action=create_post">Add New Post</a></li>
          <li><a href="?controller=posts&action=my_post">My Posts</a></li>
          <li><a href="?controller=pages&action=profile">My Profile</a></li>
          <li><a href="?controller=pages&action=logout">Log Out</a></li>
          

        </ul>



            </li>
        </ul>
   <?php } ?>
   



      </div>

</div>
  </div>



<div class="row">
<div class="col-md-8 col-md-offset-2">
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
                                <label class=" control-label">Option 1</label>
                                <input type="text" class="form-control" name="poll1" value="" required="" placeholder="Option 1">

                                
                            </div>

                            <div class="form-group">
                                <label class=" control-label">Option 2</label>
                                <input type="text" class="form-control" name="poll2" value="" required="" placeholder="Option 2">

                                
                            </div>
                            <div class="form-group">
                                <label class=" control-label">Option 3</label>
                                <input type="text" class="form-control" name="poll3" value="" required="" placeholder="Option 3">

                                
                            </div>
                            <div class="form-group">
                                <label class=" control-label">Option 4</label>
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

  <p><img src="img/chase.jpg" class="pull-left img-responsive"> Dr. Chase spends much of her free time helping the local bunny rescue organization find homes for bunnies, such as Kibbles. This cuddly Dalmatian bunny is part of the large Chase household, which also includes two dogs, three cats, and a turtle.</p>

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
    <p class="text-center"><a href="index.php" class="btn btn-success">Publish</a></p>

</div>


</div>

</div>
</div>
</div>
   </div>
   </div>