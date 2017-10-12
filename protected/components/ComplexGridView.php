<?php 
Yii::import('zii.widgets.grid.CGridView');

class ComplexGridView extends CGridView{

public $captionLabel= ' ';
public $hideCaption = false;
public $captionCssClass = '';
public $hasFooter = true;

public function renderTableHeader()
{
	
	if(!$this->hideCaption)
	{
		echo '<caption class="'.$this->captionCssClass.'">';
		echo $this->captionLabel;
		echo '</caption>';
	
	}
	
	
    if(!$this->hideHeader)
    {
        echo "<thead>\n";

        if($this->filterPosition===self::FILTER_POS_HEADER)
            $this->renderFilter();

        echo "<tr>\n";
        foreach($this->columns as $column)
            $column->renderHeaderCell();
        echo "</tr>\n";

        if($this->filterPosition===self::FILTER_POS_BODY)
            $this->renderFilter();

        echo "</thead>\n";
    }
    elseif($this->filter!==null && ($this->filterPosition===self::FILTER_POS_HEADER || $this->filterPosition===self::FILTER_POS_BODY))
    {
        echo "<thead>\n";
        $this->renderFilter();
        echo "</thead>\n";
    }
}

public function renderPager()
{
    if(!$this->enablePagination)
        return;

    $pager=array();
    $class='CLinkPager';
    if(is_string($this->pager))
        $class=$this->pager;
    elseif(is_array($this->pager))
    {
        $pager=$this->pager;
        if(isset($pager['class']))
        {
            $class=$pager['class'];
            unset($pager['class']);
        }
    }
    $pager['pages']=$this->dataProvider->getPagination();

    if($pager['pages']->getPageCount()>=1 && $this->hasFooter)
    {
		echo '<div class="row-fluid">';
		echo '<div class="widget-footer">';
		echo '<div class="span12">';
        echo '<div class="'.$this->pagerCssClass.'">';
        $this->widget($class,$pager);
        echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
    }
    else
        $this->widget($class,$pager);
}

}

?>
