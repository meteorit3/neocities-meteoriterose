<body>
	<div id="container">
		<main>
			<div class="a8out">
				<h2>About Us</h2>
				<article class=content>
					<div>
						<p>hi, welcome to our site! we are the Meteorite system, or just Meteorite for short.
						</p>
					</div>
				</article>
			</div>
			<nav>
				<h2>Navigation</h2>
				<?php include('includes/nav.php') ?>
			</nav>
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
						<a class="button" href="https://tileerror.neocities.org/"><img src="https://tileerror.neocities.org/images/ton.png" alt="tile error" /></a>
						<a class="button" href="https://biene.neocities.org/"><img src="https://biene.neocities.org/images/button.gif" alt="dash" /></a>
						<a class="button" href="https://caseolum.neocities.org"><img src="https://caseolum.neocities.org/Caseolumbutton.png" alt="caseolum" /></a>
						<a class="button" href="https://birbss.neocities.org/"><img src="https://birbss.neocities.org/rubybutton2.png" alt="birbss" /></a>
						<a class="button" href="https://woolie.neocities.org/"><img src="https://woolie.neocities.org/button.png" alt="woolie" /></a>
						<a class="button" href="https://zache.neocities.org/"><img src="https://caseolum.neocities.org/zachbutton.png" alt="zache" /></a>
						<span style="width: 88px; text-align: center;">and us:</span>
						<a class="button" href="https://meteoriterose.neocities.org"><img src="/static/images/8utton.gif" alt="meteorite rose" /></a>
						<textarea class="button" title="button code for copy pasting"><a href="https://meteoriterose.neocities.org"><img src="https://meteoriterose.neocities.org/static/images/8utton.gif"></a></textarea>
					</div>
					<hr>
					MORE BUTTONS AND STAMPS. [SOME OF THEM HAVE LINKS] [SOME OF THE LINKS ARE VIRUSES]
					<div>
						<?php
						function displaybuttons($dir)
						{
							$buttons = scandir($dir);
							foreach ($buttons as $s) {
								if (ltrim($s, ".") != "") {

									/* remove extension */
									$arr = explode("`", $s);
									array_pop($arr);
									array_reverse($arr); //pop is faster
						
									$href = "";
									if (array_pop($arr) == "url") {
										$href = "href=\"https://" . str_replace("!", "/", array_pop($arr)) . "\"";
									}
									$alt = "alt=\"" . str_replace("~", "?", array_pop($arr) . "\"");
									echo ("<a class=\"button\" $href><img $alt src=\"$dir/$s\"></a>");
								}
							}
						}
						displaybuttons("static/images/stampz/home/31");
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
		</main>
		<footer>
			<?php include('includes/footer.php'); ?>
		</footer>
	</div>
</body>