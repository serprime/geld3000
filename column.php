<?php $thisMonth = date("F")?>
<?php foreach($this->posts as $month=>$posts):?>
  <div class="month" 
       onClick="toggleMonth(<?php echo $month; ?>);">
       <?php echo $month; ?><span class="arrow">&#62;&#62;</span>
  </div>
  <?php $now = ($thisMonth == $month) ? true : false ?>
  <?php foreach($posts as $post):?>
    <div class="entry <?php if($now) echo "now"; ?>" id="<?php echo $month; ?>">
		  <span class="value"><?php echo $post['value']; ?> </span>
		  <span class="comment"><?php echo $post['comment']; ?> </span>
		  <div class="clear"></div>
		</div>
	<?php endforeach?>				    
<?php endforeach?>
