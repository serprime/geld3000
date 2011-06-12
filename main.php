
<nav>
    <header>
        <div class="header_logout"><a href="?logout">logout</a></div>
        <div class="header_title"><img src="images/woohi.png" alt="woohi" /></div>
    </header>
</nav>
<div class="main">
    <div class="content_header">
        <div class="info_box">
            <span class="info_box_top"></span>
            <div class="info_box_content">
                <p>Immer schön benutzen damit die Arbeit nicht umsonst war!</p>
                <p class="box_line_height">Rechts kannst du einen <span>neuen Eintrag</span> machen!</p><br />
            </div>
            <span class="info_box_bottom"></span>
        </div>
        <div id="eintrag_form">
          <form method="post" action="?">
              <label for="betrag" class="eintrag_form_label left">Betrag</label>
              <input class="left" type="text" name="value" /><span class="euro left">€</span><br /><div class="clear"></div>
              <label for="notes" class="eintrag_form_label left">Notes</label>
            <textarea class="left" name="notes"></textarea><br />
            <input type="submit" class="right" value="" />
          </form>
        </div>
    </div>
    <div class="clear"></div>
  <div id="diff">
      <div class="diff_box">
          <div class="diff_name"><?php echo $this->diffUsername?></div>
           <div class="diff_value">€&nbsp;<?php echo $this->diffAmount?></div>
       
      </div>
  </div>

  <div class="content_box left">
      <div class="content_box_top left">
           <h2>Vielieb</h2>
      </div>
      <div class="content_box_schrage left"></div> 
      <div class="clear"></div>
      <div class="content_box_contentWrapper"><?php echo $this->pcol?></div>
  </div>
   
  <div class="content_box right">
      <div class="content_box_top right">
           <h2>Sarah</h2>
      </div>
      <div class="content_box_schrage right"></div>
       <div class="clear"></div>
       <div class="content_box_contentWrapper"><?php echo $this->scol?></div>
  </div>
 <div class="clear"></div>
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
