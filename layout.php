<!DOCTYPE html>
<head>
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <div id="wrapper">
    <div id="header"><h3>Wooohiii</h3></div>
      <div class="flash">
        <?php foreach($this->flash as $msg):?>
          <?php echo $msg?>
        <?php endforeach?>
      </div>
	    <div id="content">
		    <div class="content-header">
			    <div id="vielieb">
			
				    <h2>Vielieb</h2>

				    <form method="post" action="">
					    <input type="text" name="vielieb" /><br />
					    <textarea name="v_text"></textarea><br />
					    <input type="submit" value="hinzu" />
				    </form>

				    <div class="line long"></div>
				
				    <?php echo $this->pcontent?>

				</div>

		    <div id="sarah">
				    <h2>Sarah</h2>

				    <form method="post" action="">
					    <input type="text" name="vielieb" /><br />
					    <textarea name="v_text"></textarea><br />
					    <input type="submit" value="hinzu" />
				    </form>

				    <div class="line long"></div>
				
				    <?php echo $this->scontent?>

			    <div class="clear"></div>
		    </div>
	    </div>
  </div>
</body>
</html>
