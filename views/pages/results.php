<?php
//Include and initialize Poll class 

$poll = new Poll;
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8" />
<style type="text/css">
#container { text-align: center; margin: 20px; }
h2 { color: #CCC; }
a { text-decoration: none; color: #EC5C93; }

.bar-main-container {
  margin: 10px auto;
  width: 300px;
  height: 55px;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  font-family: sans-serif;
  font-weight: normal;
  font-size: 0.8em;
  color: #FFF;
}

.wrap { padding: 8px; }

.bar-percentage {
  float: left;
  background: rgba(0,0,0,0.13);
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  padding: 9px 12px;
  width: 18%;
  height: 16px;
  margin-top: -15px;
}
.bar-container {
  float: right;
  -webkit-border-radius: 10px;
  -moz-border-radius: 10px;
  border-radius: 10px;
  height: 10px;
  background: rgba(0,0,0,0.13);
  width: 78%;
  margin: 0px 0px;
  overflow: hidden;
}

.bar-main-container .txt{
    padding-top: 5px;
    font-size: 16px;
    font-weight: bold;
}

.bar {
  float: left;
  background: #FFF;
  height: 100%;
  -webkit-border-radius: 10px 0px 0px 10px;
  -moz-border-radius: 10px 0px 0px 10px;
  border-radius: 10px 0px 0px 10px;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
  filter: alpha(opacity=100);
  -moz-opacity: 1;
  -khtml-opacity: 1;
  opacity: 1;
}

/* COLORS */
.azure   { background: #3FC380; }
.emerald { background: #4ECDC4; }
.violet  { background: #52B3D9; }
.yellow  { background: #EB974E; }
.red     { background: #F89406; }

.h3 {
    font-size: 18px;
    color: #333;
    text-align: center;
    float: left;
    border-bottom: 2px solid #333;
    width: 100%;
    margin: 0 auto;
    padding-bottom: 10px;
}
</style>
</head>
<body>
<div id="container">
  <?php
      //Get poll result data
      $pollResult = $poll->getResult($_GET['pollID']);
    ?>
<div style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2"> 
<div class="panel panel-success">
       <div class="panel-heading">
         <div class="panel-title">  
         <h3> <h3><?php echo $pollResult['poll']; ?></h3></h3>
         </div>
                        
                    </div> 
     <div style="padding-top:30px" class="panel-body">
  
    <p><b>Total Votes:</b> <?php echo $pollResult['total_votes']; ?></p>
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
        <div class="txt"><?php echo $opt; ?></div>
        <div class="wrap">
          <div class="bar-percentage" style="padding-bottom: 20px"><?php echo $votePercent; ?></div>
          <div class="bar-container">
            <div class="bar" style="width: <?php echo $votePercent; ?>;"></div>
          </div>
        </div>
    </div>
    <?php $i++; } } ?>

    <br>
    <a href="index.php" class="btn btn-primary">Back To Poll</a>
 </div>
    </div>
    </div>
</div>
</body>
</html>