<?php $thisMonth = date("F Y")?>

<?php foreach($this->posts as $month=>$posts):?>
  <?php $now = ($thisMonth == $month) ? true : false ?>

  <?php $id = str_replace(' ', '_', $month)."_".$this->id?>
  <div class="month" id="span_<?php echo $id; ?>"
       onClick="toggleMonth('<?php echo $id?>');">
       <span><?php echo $month; ?></span><span class="arrow right <?php echo ($now)? 'open' : 'closed'?>"></span>
  </div>
  
  <div class="entry <?php if($now) echo 'now'; ?>" id="<?php echo $id?>">

    <?php foreach($posts as $post):?>
        <div class="sub_entry" id="<?php echo $post['money_id']?>">
		    <div class="item-left left">
		      <span class="value"><?php echo $post['value']; ?> </span><br />
                      <?php if($post['user_id'] !== '') { ?>
                     <div class="edit left" title="Eintrag bearbeiten" onClick="edit(<?php echo $post['money_id']?>); return false;"></div>
		      <div class="delete left" title="Eintrag löschen" onClick="deleteEntry(<?php echo $post['money_id'] ?>); return false;"></div>
                      <?php } ?>
		    </div>
            <span class="comment right"><?php echo ($post['comment'])?> </span>
		    <div class="clear"></div>
                    <div class="sub_entry_line"></div>
          </div>
	  <?php endforeach?>				    
	  <div class="monthly-sum">Summe: €&nbsp;<span style="font-size:16px"><?php echo $this->sums[$month]?></span></div>

  </div>
	

<?php endforeach?>

