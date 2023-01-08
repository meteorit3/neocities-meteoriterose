<body>
    <div id="container">
        <main>
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
        </main>
        <footer>
            <?php include("includes/footer.php"); ?>
        </footer>
    </div>
</body>