<body>
    <div id="container">
        <main>
            <div id="box-wrapper">
                <article class="single-box">
                    <nav>
                        <?php include("includes/nav.php") ?>
                    </nav>
                    <h2>
                        <?php echo ($title) ?>
                    </h2>
                    <div class="content">
                        <?php echo ($content); ?>
                    </div>
                    <footer>
                        <?php include("includes/footer.php"); ?>
                    </footer>
                </article>
            </div>
        </main>
    </div>
</body>