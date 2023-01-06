<body>
	<div id="container">
		<header>
		</header>
		<main>
			<div class="box-wrapper">
				<div class="a8out">
					<h2>About Us</h2>
					<article class="content">
						<div>
							button :3
							<a href="https://meteoriterose.neocities.org" title="button"><img src="/static/images/8utton.gif" alt="an animation of a shooting star falling into the ocean, framed by pink roses"></a>
							<textarea
								class="button" title="button code for copy pasting"><a href="https://meteoriterose.neocities.org"><img src="https://meteoriterose.neocities.org/static/images/8utton.gif"></a></textarea>
						</div>
						this site is completely js free :)<br>
						the uh algkjalk
						end of sentenct
					</article>
					<div>
					</div>
				</div>
				<nav>
					<h2>Navigation</h2>
					<?php include('includes/nav.php') ?>
				</nav>
			</div>
			<div class="box-wrapper">
				<div class="recent">
					<h2>Recent Blog Posts</h2>
					<article class="content">
						<?php
						$list = new Posts;
						$list->recent(5);
						foreach ($list->list as $post) {
							echo ($post->display_info());
						}
						?>
					</article>
				</div>
				<div class="stampz scroll">
					<h2>Stampz</h2>
					<article class="content">
					</article>
				</div>
			</div>
		</main>
		<footer>
			<?php include('includes/footer.php'); ?>
		</footer>
	</div>
</body>