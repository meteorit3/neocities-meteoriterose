<body>
	<div id="container">
		<header>
		</header>
		<main>
			<div id="box-wrapper">
				<div class="box-one scroll">
					<h2>Heading</h2>
					<article class="content">
						<p><strong>Layout Features</strong></p>
						
					</article>
				</div>
				<div class="box-two scroll">
					<h2>Navigation</h2>
					<nav>
						<?php include('includes/nav.php') ?>
					</nav>
				</div>
			</div>
			<div id="box-wrapper">
				<div class="box-three scroll">
					<h2>Heading</h2>
					<article class="content">
						<?php include($content); ?>
					</article>
				</div>
				<div class="box-four scroll">
					<h2>Heading</h2>
					<article class="content">
						<p>The great thing about this is that you can write as much as you like, and it just adds a
							scrollbar. Just keep writing until you can write no more!</p>
					</article>
				</div>
			</div>
		</main>
		<footer>
			<?php include('includes/footer.php'); ?>
		</footer>
</body>