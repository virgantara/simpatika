<ul class="breadcrumb">
    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
     <li><a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Beranda</a> <span class="divider"><?php echo $this->delimiter; ?></span></li>
    <?php 
	
    foreach($this->links as $crumb) {
		$next = false;
		if(next($this->links)){
			echo '<li>';
			$next = true;
		} else{
			echo '<li class="active">';
		}
		if(isset($crumb['url'])) {
            echo CHtml::link($crumb['name'], $crumb['url']);
        } else {
            echo $crumb['name'];
        }
        if($next) {
            echo '<span class="divider">'.$this->delimiter.'</span>';
        }
		echo '</li>';
    }
    ?>
   
</ul>
