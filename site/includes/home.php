		<header>
		</header>
		<main>
			<div id="box-wrapper">
				<div id="a8out">
					<h2>About Us</h2>
					<article class="content">
						<a href="meteoriterose.neocities.org"><img src="/static/images/8utton.gif"></a>
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
						displayRecentPosts(5);
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