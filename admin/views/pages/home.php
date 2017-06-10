
<?php session_start(); ?>
<?php 

 if (isset($_POST['submit'])) {
                            if (trim($_POST['user_name'])=='' || trim($_POST['password'])=='') {
                                $message = "Please fill all the fields with valid data.";
                            } else {
                                $user_name = trim($_POST['user_name']);
                                $password = trim($_POST['password']);
                             

                                $user = Model::checkForUser($user_name, $password);

                                if ($user == null) {
                                    $message = "Wrong \"username\" or \"password\". Please try again.";
                                     echo"<script>alert('wrong username or password ')</script>";

                                } else {
                                    
                                    $_SESSION['user_name'] = $user_name;
                                    $successmessage = "Logging-in successful.";
                                     echo"<script>window.open('?controller=pages&action=admin','_self')</script>";
                                }
                            }
                            
                        }





 ?>



<?php include 'header.php'; ?>
<div class="container" style="padding-top: 30px">

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
 <div class="well">
            <div class="panel panel-info">
                <div class="panel-heading">Administrator Login</div>
                <div class="panel-body">
        
                        <form role="form" method="POST" action="?controller=pages&action=home">
                        

                            <div class="form-group">
                                <label class=" control-label">User Name</label>
                                <input type="text" class="form-control" name="user_name" value="" required="">

                                
                            </div>

                            <div class="form-group">
                                <label class=" control-label">Password</label>
                                <input type="password" class="form-control" name="password"
                                required="">

                               
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>
                                </input>

                                <a class="btn btn-link" href="">Forgot Your Password?</a>
                            </div>
                        </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>


