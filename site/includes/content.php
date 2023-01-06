<body>
    <div id="container">
        <main>
            <div class="box-wrapper">
                <article class="single-box">
                    <nav>
                        <?php include("includes/nav.php") ?>
                    </nav>
                    <h2>
                        <?php echo ($title) ?>
                    </h2>
                    <article class="content">
                        <?php echo ($content); ?>
                    </article>
                </article>
            </div>
            <footer>
                <?php include("includes/footer.php"); ?>
            </footer>
        </main>
    </div>
</body>
