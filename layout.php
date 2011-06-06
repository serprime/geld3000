<!DOCTYPE html>
<head>
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

    <?php if($_SESSION['loggedin'] === true):?>
        <a href="?logout">logout</a>
    <?php endif?>

    <div class="flash">
        <?php foreach($this->flash as $msg):?>
            <?php echo $msg?>
        <?php endforeach?>
    </div>

    <div id="wrapper">
        <?php echo $this->content?>
    </div>
</body>
</html>
