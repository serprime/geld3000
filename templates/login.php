<div id="login-container">
    <div id="head_wrap">
<div class="message error">
           <?php foreach($this->flash_error as $msg):?>
              <?php echo $msg?>
          <?php endforeach?>
 </div>
</div>

	<div id="login-form" class="form right" >
		<form method="post" action="?" class="right" autocomplete="off">
			<label for="email" class="login">Benutzername</label>
			<input class="right" type="text" name="login-name" />
			<div class="clear"></div>
			<label for="passwort" class="login">Passwort</label>
			<input class="right" type="password" name="login-password" />
			<div class="clear"></div>
			<input type="submit" name="login-submit" class="right bold login" value="" />
		</form>
	</div>
</div>
