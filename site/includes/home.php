<body>
	<div id="container">
		<header></header>
		<main>
			<div class="box-wrapper">
				<div class="a8out">
					<h2>About Us</h2>
					<article class="content">
						<div>
							button :3
						</div>
						this site is completely js free :)<br />
						the uh algkjalk end of sentenct
					</article>
					<div></div>
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
						} ?>
					</article>
				</div>
				<div class="stampz">
					<h2>Buttons + Stamps +swageever</h2>
					<article class="content">
						COOL FRIENDS AND COOL SITES
						<div>
							<a href="https://tileerror.neocities.org/"><img src="https://tileerror.neocities.org/images/ton.png" alt="TILE ERROR" /></a>
							<a href="https://biene.neocities.org/"><img src="https://biene.neocities.org/images/button.gif" alt="DASH" /></a>
							<a href="https://caseolum.neocities.org"><img src="https://caseolum.neocities.org/Caseolumbutton.png" alt="CASEOLUM" /></a>
							<a href="https://birbss.neocities.org/" target="_blank"><img src="https://birbss.neocities.org/rubybutton.png" alt="BIRBSS" /></a>
							<a href="https://woolie.neocities.org/" target="_blank"><img src="https://woolie.neocities.org/button.png" alt="WOOLIE" /></a>
							<a href="https://zache.neocities.org/" target="_blank"><img src="https://caseolum.neocities.org/zachbutton.png" alt="ZACHE" /></a>
							<span style="width: 88px; text-align: center;">and us:</span>
							<a href="https://meteoriterose.neocities.org" title="button"><img class="button" src="/static/images/8utton.gif" alt="an animation of a shooting star falling into the ocean, framed by pink roses" /></a>
							<textarea class="button" title="button code for copy pasting"><a href="https://meteoriterose.neocities.org"><img src="https://meteoriterose.neocities.org/static/images/8utton.gif"></a></textarea>
						</div>
						<hr>
						<div>
							<?php
							function displaybuttons($dir)
							{
								$buttons = scandir($dir);
								foreach ($buttons as $s) {
									if (ltrim($s, ".") != "") {

										/* remove extension */
										$arr = explode(".", $s);
										array_pop($arr);
										array_shift($arr); //beginning of files is only for sorting alphabetically
										//check if the filename is a url
										$href = "";
										if (array_shift($arr) == "url") {
											$url = implode(".", $arr);
											$url = str_replace("!", "/", $url);
											$href = "href=https://" . $url;
										} //files with names that start with url. will automatically link the url on the page
							
										echo ("<a $href><img class=button src=$dir/$s></a>");
									}
								}
							}
							displaybuttons("static/images/stampz/31");
							?>
						</div>
						<div>
							<?php
							displayButtons("static/images/stampz/56");
							?>
						</div>
						<div>
							<?php
							displaybuttons("static/images/stampz/20");
							?>
					</article>
				</div>
			</div>
		</main>
		<footer>
			<?php include('includes/footer.php'); ?>
		</footer>
	</div>
</body>