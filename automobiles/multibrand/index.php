<!DOCTYPE HTML>
<!--
	Full Motion by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Concesionario Multimarca</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body id="top">

			<!-- Banner -->
			<!--
				To use a video as your background, set data-video to the name of your video without
				its extension (eg. images/banner). Your video must be available in both .mp4 and .webm
				formats to work correctly.
			-->
				<section id="banner" data-video="images/banner">
					<div class="inner">
						<header>
							<h1>Concesionario Multimarca</h1>
<p>Somos un Concesionario Multimarca Líder en su sector.</p><p>Calidad y Precio garantizado</p>
							
						</header>
						<a href="#main" class="more">Learn More</a>
					</div>
				</section>

			<!-- Main -->
				<div id="main">
					<div class="inner">
					<!-- Boxes -->
						<div class="thumbnails">
                            <?php
                            require_once "client.php";
                            $client = new Client();
                            $brands = $client->getBrandsUrl();
                            foreach ($brands as $brand ) {
                            ?>
							<div class="box">
								<a href="<?= $brand['url'] ?>" class="image fit" title="ver video"><img src="images/<?= strtolower($brand['marca'] ) ?>.png" alt="logo <?= $brand['marca'] ?>" /></a>
								<div class="inner">
                                   <h3><a href="models.php?brand=<?= $brand['id'] ?>" data-poptrox="ajax,800x600">Modelos <?= $brand['marca'] ?></a></h3>
									<a href="<?= $brand['url'] ?>" class="button style2 fit" data-poptrox="youtube,800x400">Ver video <?= $brand['marca']  ?></a>
								</div>
							</div>
                            <?php
                            }
                            ?>
						</div>
					</div>
				</div>

			<!-- Footer -->
				<footer id="footer">
					<div class="inner">
						<h2>Sigue nuestras redes sociales</h2>
						<p>A responsive video gallery template with a functional lightbox<br />
							designed by <a href="https://templated.co/">Templated</a> and released under the Creative Commons License.</p>

						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon fa-envelope"><span class="label">Email</span></a></li>
						</ul>
						<p class="copyright">&copy; Untitled. Design: <a href="https://templated.co">TEMPLATED</a>. Images: <a href="https://unsplash.com/">Unsplash</a>. Videos: <a href="http://coverr.co/">Coverr</a>.</p>
					</div>
				</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.poptrox.min.js"></script>
            <script src="assets/js/bootstrap.bundle.min.js"></script>
           	<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
    </body>
</html>
