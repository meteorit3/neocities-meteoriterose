<body>
	<div id="container">
		<header>
		</header>
		<main>
			<div id="box-wrapper">
				<div id="a8out">
					<h2>About Us</h2>
					<article class="content">
						<div>
							the
						</div>
						<div>
							<a href="https://meteoriterose.neocities.org"><img src="/static/images/8utton.gif"></a>
							<textarea class="button" style="width:88px;height:55px;resize:none;background-color:var(--pink1);color:var(--8lack);border:2px solid var(--pink2);text-size:5px"><a href="https://meteoriterose.neocities.org"><img src="https://meteoriterose.neocities.org/static/images/8utton.gif"></a></textarea>
						</div>
					</article>
				</div>
				<nav>
					<h2>Navigation</h2>
					<?php include('includes/nav.php') ?>
				</nav>
			</div>
			<div id="box-wrapper">
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
	</div>
</body>