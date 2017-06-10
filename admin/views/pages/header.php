<div class="navbar navbar-inverse navbar-static-top">
 
 <div class="container">
 
 <a href="#" class="navbar-brand">Admin Panel</a> <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse"></button>

      <div class="collapse navbar-collapse navHeaderCollapse">

       <ul class="nav navbar-nav">
              <li ><a href='?controller=pages&action=admin'>Home</a></li>
           
               
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
        
         
          <li><a href="?controller=pages&action=logout">Log Out</a></li>
          

        </ul>



            </li>
        </ul>
   <?php } ?>
   
   
      </div>
    </div>
  </div>