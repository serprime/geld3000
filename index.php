<?php
include('db_connect.php');

$vielieb = 1;
$sarah = 2;


?>

<!DOCTYPE html>
<head>
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	
	<div id="wrapper">
	<?php
		if(isset($_POST) && !empty($_POST)) {
			$user = ($_POST['vielieb']) ? $vielieb : $sarah;
			$val = ($_POST['vielieb']) ? $_POST['vielieb'] : $_POST['sarah'];
			$comment = ($_POST['v_text']) ? $_POST['v_text'] : $_POST['s_text'];
			$val = (str_replace(',', '.', $val));
			if(is_numeric($val)){
			
			//mysql_query("INSERT INTO money (user_id, value, comment) VALUES (".$user.", ".$val.")");
			} else {
				?>
				<div class="error"> 
					He du Oasch, des war jetzt aber ka Zahl!
				</div>
				<?php
			}
		}
		print_r($_POST);
	?>
		<div id="header"><h3>Wooohiii</h3></div>
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
						<?php
						$q = "SELECT * from money WHERE user_id='1' ORDER by date";
						$res = mysql_query($q);
						$month = '';
						$betrag = 0;
						while($row = mysql_fetch_array($res)){
							$month2 = date("F", strtotime ($row['date']));	
							if($month2 == $month) {							
							} else {
								$month = $month2;
								$betrag = 0;
								
								?>
								<div class="month" onClick="toggleMonth(<?php echo $month; ?>);"><?php echo $month; ?><span class="arrow">&#62;&#62;</span></div>		
								<?php
							}
							$thisMonth = date("F");
							$now = ($thisMonth == $month) ? true : false;
							$betrag = $betrag + $row['value'];
							?>
								<div class="entry <?php if($now) echo "now"; ?>" id="<?php echo $month; ?>">
								<span class="value"><?php echo $row['value']; ?> </span>
								<span class="comment"><?php echo $row['comment']; ?> </span>
								<div class="clear"></div>
								</div>
							<?php
						}
						?>
					</div>
					
					<div id="sarah">
						<h2>Sarah</h2>
						<form method="post" action="">
							<input type="text" name="sarah" /><br />
							<textarea name="s_text"></textarea><br />
							<input type="submit" value="hinzu" />
						</form>
						<div class="line"></div>
						<?php
						$q = "SELECT * from money WHERE user_id='2' ORDER by date";
						$res = mysql_query($q);
						$month = '';
						while($row = mysql_fetch_array($res)){
							$month2 = date("F", strtotime ($row['date']));	
							if($month2 == $month) {
							
							} else {
								$month = $month2;
								?>
								<div class="month"><?php echo $month; ?><span class="arrow">&#62;&#62;</span></div>
								
								<?php
							}
							?>
								<div class="entry">
								<span class="value"><?php echo $row['value']; ?> </span>
								<span class="comment"><?php echo $row['comment']; ?> </span>
								<div class="clear"></div>
								</div>
							<?php
						}
						?>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		
	
	</div>

</body>