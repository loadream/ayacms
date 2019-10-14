<?php
defined('IN_AYA') or exit('Access Denied');

class page{
	private $each_disNums;
	private $nums;
	private $current_page;
	private $sub_pages;
	private $subPage_link;
	private $subPage_type;
	private $page_array=array ();
	private $pageNums;
	private $classname;
	public $pages;
	function __construct($each_disNums,$nums,$current_page,$sub_pages,$subPage_link,$subPage_type,$ajax=false,$classname){
		$this->each_disNums=intval($each_disNums);
		$this->nums=intval($nums);
		if(!$current_page){
			$this->current_page=1;
		}else{
			$this->current_page=intval($current_page);
		}
		$this->sub_pages=intval($sub_pages);
		$this->pageNums=ceil($nums/$each_disNums);
		$this->subPage_link=$subPage_link;
		$this->subPage_type=$subPage_type;
		$this->ajax=$ajax;
		$this->classname=$classname;
		$this->subPageCss();
	}
	function initArray(){
		for($i=0;$i<$this->sub_pages;$i++){
			$this->page_array[$i]=$i;
		}
		return $this->page_array;
	}
	function construct_num_Page(){
		if($this->pageNums<$this->sub_pages){
			$current_array=array ();
			for($i=0;$i<$this->pageNums;$i++){
				$current_array[$i]=$i+1;
			}
		}else{
			$current_array=$this->initArray();
			if($this->current_page<=3){
				for($i=0;$i<count($current_array);$i++){
					$current_array[$i]=$i+1;
				}
			}elseif($this->current_page<=$this->pageNums&&$this->current_page>$this->pageNums-$this->sub_pages+1){
				for($i=0;$i<count($current_array);$i++){
					$current_array[$i]=($this->pageNums)-($this->sub_pages)+1+$i;
				}
			}else{
				for($i=0;$i<count($current_array);$i++){
					$current_array[$i]=$this->current_page-2+$i;
				}
			}
		}
		return $current_array;
	}
	function subPageCss(){
		$subPageStr='';
		$target=$this->ajax?'target="ajax" ':'';
		if($this->current_page>1){
			$firstPageUrl=$this->urlreplace($this->subPage_link,'1');
			$prewPageUrl=$this->urlreplace($this->subPage_link,$this->current_page-1);
			$subPageStr.='<li class="previous"><a '.$target.'href="'.$prewPageUrl.'">&laquo;</a></li>';
		}else{
			$subPageStr.='<li class="previous disabled"><a>&laquo;</a></li>';
		}
		$a=$this->construct_num_Page();
		for($i=0;$i<count($a);$i++){
			$s=$a[$i];
			if($s==$this->current_page){
				$subPageStr.='<li class="active "><a>'.$s.'</a></li>';
			}else{
				$url=$this->urlreplace($this->subPage_link,$s);
				$subPageStr.='<li><a '.$target.'href="'.$url.'">'.$s.'</a></li>';
			}
		}
		if($this->current_page<$this->pageNums){
			$lastPageUrl=$this->urlreplace($this->subPage_link,$this->pageNums);
			$nextPageUrl=$this->urlreplace($this->subPage_link,$this->current_page+1);
			$subPageStr.=(!$this->subPage_type&&$this->current_page!=$this->pageNums)?'...':'';
			$subPageStr.=$this->pageNums>$s?'...'.($this->subPage_type?'<li><a '.$target.'href="'.url($lastPageUrl).'">'.$this->pageNums.'</a></li>':''):'';
			$subPageStr.='<li class="next"><a '.$target.'href="'.$nextPageUrl.'">&raquo;</a></li>';
		}else{
			$subPageStr.='<li class="next disabled"><a>&raquo;</a></li>';
		}
		
		$this->pages='<ul class="pager '.$this->classname.'">'.$subPageStr.'</ul><div class="clearfix"></div>';
	}
	function urlreplace($url,$arg){
		return str_replace('(*)',$arg,$url);
	}
}
