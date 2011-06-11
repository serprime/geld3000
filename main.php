<div class="main">
  <div id="header">
    <h3>Wooohiii</h3>
  </div>

  <div class="content-header">
  </div> 

  <div class="logout">
      <a href="?logout">logout</a>
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

<div id="edit-form" style="display: none;">
  <div class="dialog-frame">
    <div class="dialog-header">
      <span>Eintrag bearbeiten</span><a href="../" onClick="closeEditDialog(); return false;">X</a>
    </div>
    <div class="dialog-body">
      <form method="post" action="?">
        <input type="hidden" value="" name="v_id" />
        <input type="text" name="v_value" /><br />
        <textarea name="v_text"></textarea><br />
        <input type="submit" onClick="editEntry(); return false;" value="hinzu" />
      </form>
    </div>
  </div>
</div>
