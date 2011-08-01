<div id="head_wrap">

<?php if(count($this->flash_error)>0):?>
  <div class="message error" style="display:block">
<?php else:?>
  <div class="message error">
<?php endif?>
  <?php foreach($this->flash_error as $x):?>
    <?php echo $x?>
  <?php endforeach?>
</div>
  
<?php if(count($this->flash_success)>0):?>
  <div class="message success" style="display:block">
<?php else:?>
  <div class="message success">
<?php endif?>
  <?php foreach($this->flash_success as $x):?>
    <?php echo $x?>
  <?php endforeach?>
</div>
<nav>
    <header>
        <div class="header_logout"><a href="?logout">logout</a></div>
        <div class="header_title"><img src="images/woohi.png" alt="woohi" /></div>
    </header>
</nav>
</div>
<div class="main">
    <div class="content_header">
        <div class="info_box">
            <span class="info_box_top"></span>
            <div class="info_box_content">
                <p>Immer sch&ouml;n benutzen damit die Arbeit nicht umsonst war!</p>
                <p class="box_line_height">Rechts kannst du einen <span>neuen Eintrag</span> machen!</p><br />
            </div>
            <span class="info_box_bottom"></span>
        </div>
        <div id="eintrag_form">
          <form method="post" action="#">
            <label for="betrag" class="eintrag_form_label left">Betrag</label>
            <input id="addValue" class="left" type="text" name="value" />
            <span class="euro left">&euro;</span><br />
            <div class="clear"></div>
            
            <label for="both" class="eintrag_form_label left">Beide?</label>
            <input id="both" class="left" type="checkbox" value="on" name="both" checked="checked" /><br />

            <div class="clear"></div>
            
            <label for="notes" class="eintrag_form_label left">Notes</label>
            <textarea class="left" id="addNote" name="notes"></textarea><br />
            <input type="submit" onClick="addEntry();return false;" class="right" value="" />
          </form>
        </div>
    </div>
    <div class="clear"></div>
  <div id="diff">
      <div class="diff_box">
          <div class="diff_name"><?php echo $this->diffUsername?></div>
           <div class="diff_value">&euro;&nbsp;<?php echo $this->diffAmount?></div>
       
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
</div>
