<?php $thisMonth = date("F Y")?>

<?php foreach($this->posts as $month=>$posts):?>
  <?php $id = str_replace(' ', '_', $month)."_".$this->id?>
  <div class="month" 
       onClick="toggleMonth('<?php echo $id?>');">
       <?php echo $month; ?><span class="arrow">&#62;&#62;</span>
  </div>
  
  <?php $now = ($thisMonth == $month) ? true : false ?>
    <div class="entry <?php if($now) echo 'now'; ?>" id="<?php echo $id?>">

    <?php foreach($posts as $post):?>
		    <div class="item-left">
		      <span class="value"><?php echo $post['value']; ?> </span>
		      <a href="edit/<?php echo $post['money_id']?>" 
		         onClick="edit(<?php echo $post['money_id']?>); return false;">Edith</a>
		    </div>
		    <span class="comment"><?php echo $post['comment']; ?> </span>
		    <div class="clear"></div>
	  <?php endforeach?>				    
	  <div class="monthly-sum">Summe: <?php echo $this->sums[$month]?></div>

  </div>
	

<?php endforeach?>

