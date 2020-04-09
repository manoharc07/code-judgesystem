<?php
  session_start();
  if(isset($_SESSION['UID']))
  {
    header("Location:dashboard.php");
  }
?>
<html >
  <head>
    <link href="CSS\login.css" rel="stylesheet">
    <title>Project Title</title>
  </head>
  <body>
    <div class="container" id="container">
      <div class="form-container sign-up-container">
          <!-- Sign Up form code -->
          <form  action="includes\signup.php" method="post">
            <h1>Create Account</h1>
            <span>Enter details to Sign Up</span>
            <div class="signup-feedback" id="signup-result"></div>
            <input type="text" name="name" placeholder="Full Name" required="required">
            <input type="email" name="email" placeholder="Email" required="required">
            <input type="text" name="username" placeholder="Username" required="required">
            <input type="number" name="mob_no" placeholder="Mobile number" required="required">
            <input type="password" name="pwd" placeholder="Password" required="required">
            <button type="submit" >sign up </button>
          </form>
      </div>
      <div class="form-container sign-in-container">
          <!-- Sign In form code -->
          <div class="signin-feedback" id="signin-result"></div>
          <form action="includes\login.php" method="post">
            <h1>Sign In</h1>
            <span class="feedback">

              <?php
              if(isset($_GET['feedback'])){
                $mssg=$_GET['feedback'];
                if($mssg=="success"){
                  echo "Account created successfully. Login to continue.";
                }
                if($mssg=="exist"){
                  echo "Account already exists. Please Sign in.";
                }
                if($mssg=="null"){
                  echo "Oops you are not registered.";
                }
                if($mssg=="invalid"){
                  echo "Oops password is incorrect.";
                }
                if($mssg=="signout"){
                  echo "Successfully Logged out.";
                }
                if($mssg=="user"){
                  echo "Login as Admin";
                }
              }
              ?>
            </span>
            <input  type="text" name="id" required="required" placeholder="Username or Email">
            <input  type="password" name="pwd" required="required" placeholder="Password">
            <input type="submit" value="sign in">
          </form>
      </div>
      <div class="overlay-container">
    		<div class="overlay">
    			<div class="overlay-panel overlay-left">
    				<h1>Already a User?</h1>
    				<p>Continue your coding journey sign in with your email address.</p>
    				<button class="ghost" id="signIn">Sign In</button>
    			</div>
    			<div class="overlay-panel overlay-right">
    				<h1>Don't have an account?</h1>
    				<p>Dive into the world of coding right now by creating a account.</p>
    				<button class="ghost" id="signUp">Sign Up</button>
    			</div>
    		</div>
    	</div>
    </div>
  </body>
  <script type="text/javascript">
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
      container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
      container.classList.remove("right-panel-active");
    });
  </script>

</html>
