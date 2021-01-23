<!DOCTYPE html>
<html lang="en">
<head>
	<title>Postman Hackathon</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1"><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="typingdna.js" type="text/javascript"></script>
    <script type="text/javascript">
         $(document).ready(function(){
				var tdna  = new TypingDNA();
				try
				{
					document.getElementById("signin").addEventListener("click", myFunction);
                    function myFunction() {
                        var dna_post = document.getElementById("username").value.concat(document.getElementById("password").value);
						var typingPattern = tdna.getTypingPattern({type:1, text:dna_post});
						var isMobile = tdna.isMobile();
						document.getElementById("tp").value = typingPattern;
						document.getElementById("isMobile").value = isMobile;
                    }
				}
				catch(err) {
				}
            });
    </script>
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	
	<div class="container-login100" style="background-image: url('');">
			
		<div class="wrap-login100 p-l-55 p-r-55 p-t-10 p-b-30">

			<div class="flex-c p-b-30">
			</div>
			<div class="container-login100-form-btn" style="justify-content: left;">
				<a   href='./index.html'  style=" color: #0B0080;">Back</a>
			</div>
			<div class="flex-c p-b-20">
			</div>
			<form  action="backend.php" method="post" class="login100-form validate-form">
				<span class="login100-form-title p-b-20">
					<?php
						$login = false;
						if(isset($_GET["message"]))
						{
							if(isset($_GET["auth"]))
							{
								$remainingAuth = 3 - intval($_GET["auth"]);
								if($remainingAuth == 0)
								{
									echo 'Sign In again to test the solution';
									$login = false;
								}
							}
						}
						if($login == false)
						{
							echo "Sign In";
						}
					?>
				</span>

				<div class="text-center p-t-1 p-b-20">
					<span class="txt1">
						<?php
							if(isset($_GET["message"]))
							{
								if(isset($_GET["auth"]))
								{
									echo "<br>";
									$remainingAuth = 3 - intval($_GET["auth"]);
									if($remainingAuth == 1)
									{
										echo "<b>".$_GET["message"]."</b>";
										echo 'Step 2 of 3. ';
										echo "We just need 1 more login to create your profile";
									}
									else if($remainingAuth == 0)
									{
										echo "<b>".$_GET["message"]."</b>";
										echo 'Step 3 of 3. ';
										echo 'User enrolled. Now try to authenticate';
									}
									else if($remainingAuth == 2)
									{
										echo "<b>".$_GET["message"]."</b>";
										echo 'Step 1 of 3. ';
										echo 'We just need 2 more logins to create your profile';
									}
									else if($remainingAuth < 0)
									{
										echo 'The email password combination is incorect';
									}
								}
								else
								{
									echo $_GET["message"];
								}
							}
						?>
					</span>
				</div>

				<div class="wrap-input100 validate-input m-b-20" >
					<input class="input100" type="email" name="username" id="username" placeholder="email" autocomplete="off" oncopy="return false" oncut="return false" onpaste="return false">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input m-b-25" >
					<input class="input100" type="password" name="password" id="password" placeholder="made-up password" autocomplete="off" oncopy="return false" oncut="return false" onpaste="return false">
					<span class="focus-input100"></span>
				</div>

				<input type="hidden" name="tp" id="tp">
				<input type="hidden" name="isMobile" id="isMobile">

				<div class="container-login100-form-btn">
					<button class="login100-form-btn" id="signin">
						Log In
					</button>
				</div>
			</form>

			<div class="flex-c p-b-20">
			</div>
		</div>
	</div>
	
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>