<?php $thisMonth = date("F Y")?>

<?php foreach($this->posts as $month=>$posts):?>
  <?php $id = str_replace(' ', '_', $month)."_".$this->id?>
  <div class="month" id="span_<?php echo $id; ?>"
       onClick="toggleMonth('<?php echo $id?>'); changeArrow(this);">
       <span><?php echo $month; ?></span><span class="arrow right closed"></span>
  </div>
  
  <?php $now = ($thisMonth == $month) ? true : false ?>
    <div class="entry <?php if($now) echo 'now'; ?>" id="<?php echo $id?>">

    <?php foreach($posts as $post):?>
        <div class="sub_entry">
		    <div class="item-left left">
		      <span class="value"><?php echo $post['value']; ?> </span><br />
		      <a href="edit/<?php echo $post['money_id']?>" 
		         onClick="edit(<?php echo $post['money_id']?>); return false;">Edith</a>
		    </div>
        <span class="comment right"><?php echo htmlspecialchars($post['comment'])?> </span>
		    <div class="clear"></div>
          </div>
	  <?php endforeach?>				    
	  <div class="monthly-sum">Summe: <?php echo $this->sums[$month]?></div>

  </div>
	

<?php endforeach?>

