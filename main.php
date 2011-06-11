  <header>
    <div class="header_logout"><a href="?logout">logout</a></div>
    <div class="header_title"><img src="images/woohi.png" alt="woohi" /></div>
  </header>
<div class="main">


  <div class="content-header">
  </div> 

  <div class="logout">
     
  </div>

  <form method="post" action="?">
    <input type="text" name="v_value" /><br />
    <textarea name="v_text"></textarea><br />
    <input type="submit" value="hinzu" />
  </form>

  <div id="diff">
    <?php echo $this->diffUsername?> <?php echo $this->diffAmount?>
  </div>

  <div id="vielieb">
    <h2>Vielieb</h2>
    <?php echo $this->pcol?>
  </div>

  <div id="sarah">
    <h2>Sarah</h2>
    <?php echo $this->scol?>
  </div>
  <div class="clear"></div>
</div>
