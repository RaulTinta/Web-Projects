<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>ComputerCorner</title>
		<link
			rel="stylesheet"
			href="https://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.min.css"
		/>
		<!-- Insert this within your head tag and after foundation.css -->
		<link
			rel="stylesheet"
			href="https://cdn.jsdelivr.net/npm/motion-ui@1.2.3/dist/motion-ui.min.css"
		/>

		<style>
			/* Stilizare personalizată pentru tab-bar */
			.top-bar {
				background-color: #333;
				height: 60px;
			}

			.top-bar .menu li {
				background-color: #333;
			}

			.top-bar .menu li a {
				padding: 10px 15px;
			}

			.top-bar .menu li a:hover {
				background-color: black;
			}
		</style>
	</head>

	<body>
		<!--Top Bar - Admin -->
		<?php include '../MeniuDashboard.php' ?>
		
		<?php

			// Verifică dacă utilizatorul este autentificat și are drepturi de admin
			if (!isset($_SESSION['user_drepturi']) || $_SESSION['user_drepturi'] != 'admin') {
					header("Location: ../Autentificare/Login_tab.html");
					session_unset(); // Elimină toate variabilele de sesiune
					session_destroy(); // Distrugerea sesiunii
					exit;
			}
		?>	

		<br /><br /><br /><br />

		<p style="text-align: center; font-size: 50px">Acesta este dashboardul pentru admin</p>

		<script src="js/vendor/jquery.js"></script>
		<script src="js/vendor/what-input.js"></script>
		<script src="js/vendor/foundation.js"></script>
		<script src="js/app.js"></script>
	</body>
</html>
