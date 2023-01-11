<head>
	<meta charset="UTF-8">
	<link href="/static/css/fonts.css" rel="stylesheet" type="text/css" />
	<link href="/static/css/main.css" rel="stylesheet" type="text/css" />
	<title>
		<?php echo ($title); ?>
	</title>
	<?php if ($_SERVER['HTTP_HOST'] == "localhost:8000") {
		echo ('<script async data-id="five-server" src="http://localhost:5500/fiveserver.js"></script>');
	} ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>