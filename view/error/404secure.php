<!doctype html>
<html lang="en">
	

<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Meta -->
		<meta name="description" content="Page not found">
		<meta name="author" content="404">
		<link rel="shortcut icon" href="img/fav.png" />

		<!-- Title -->
		<title>Nasel  - 404</title>
		

		<!-- Font for coming soon page -->
		<link href="https://fonts.googleapis.com/css?family=Erica+One&amp;display=swap" rel="stylesheet">

		<!-- *************
			************ Common Css Files *************
		************ -->
		<!-- Bootstrap css -->
		<link rel="stylesheet" href="../static/secure/css/bootstrap.min.css">
		<!-- Icomoon Font Icons css -->
		<link rel="stylesheet" href="../static/secure/fonts/style.css">
		<!-- Main css -->
		<link rel="stylesheet" href="../static/secure/css/main.css">

		<!-- *************
			************ Vendor Css Files *************
		************ -->
		<!-- Particles CSS -->		
		<link rel="stylesheet" href="../static/secure/vendor/particles/particles.css">

	</head>

	<body class="countdown">

		<div id="particles-js"></div>
		<div class="countdown-bg"></div>
        <div class="page-wrapper">

		<div class="error-screen">
			<h1>404</h1>
			<h5>We're sorry! The page you have<br/>requested cannot be found.</h5>
            <?php if(!empty($_SESSION['auth_user'])){ ?>
			<a onclick="goBack()" class="btn">Go back to Dashboard</a>
            <?php }else{ ?>
                <a href="../login/" class="btn">Go back to Login</a>
            <?php }?>


		</div>
            </div>
		<!--**************************
			**************************
				**************************
							Required JavaScript Files
				**************************
			**************************
		**************************-->
		<!-- Required jQuery first, then Bootstrap Bundle JS -->
		<script src="../static/secure/js/jquery.min.js"></script>
		<script src="../static/secure/js/bootstrap.bundle.min.js"></script>
		<script src="../static/secure/js/moment.js"></script>

		<!-- *************
			************ Vendor Js Files *************
		************* -->
		<!-- Particles JS -->		
		<script src="../static/secure/vendor/particles/particles.min.js"></script>
		<script src="../static/secure/vendor/particles/particles-custom-error.js"></script>
        <script>
function goBack(){
      window.history.back();
  }

</script>

	</body>


</html>