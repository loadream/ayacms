<link href="<?php echo AYA_TURL?>theme/index.css" rel="stylesheet">
<script src="<?php echo AYA_TURL?>theme/index.js"></script>
<script type="text/javascript">
var T_theme_css="<?php echo $T['theme_css']?>";
var T_body="<?php echo $T['body']?>";
var T_container="<?php echo $T['container']?>"; 
<?php if(IN_PHP){?> 
$(function(){
	 if($.fn.boards) $('.boards').boards();
	 });
<?php }?>	 
</script>

<div id="switcher-handle" style="left:<?php echo $_COOKIE['fix_diynavbar']?'-212':'0'?>px">
	<a id="handle" href="javascript:void(0)"
		class="<?php echo $_COOKIE['fix_diynavbar']?'':'out'?>"></a>
	<div id="style-switcher">
		<div id="switcher-header">
			<p>风格配置</p>
		</div>
		<div id="switcher-body">

			<p>
				<strong>布局风格</strong>
			</p>
			<select>
				<option value="boxed">盒装</option>
				<option value="wide"
					<?php echo $T['container']?'selected="selected"':''?>>满屏</option>
			</select>

			<div class="clearfix"></div>
			<div class="mt-10"></div>
			<p>
				<strong>颜色方案</strong>
			</p>
			<div class="colors-holder">
				<a href="#" class="color-box" data-rel="0e8fab"></a> <a href="#"
					class="color-box" data-rel="e7402f"></a> <a href="#"
					class="color-box" data-rel="44cfc8"></a> <a href="#"
					class="color-box" data-rel="9dc500"></a> <a href="#"
					class="color-box" data-rel="76719a"></a> <a href="#"
					class="color-box" data-rel="f2a020"></a>
			</div>

			<div class="clearfix"></div>
			<div class="mt-10"></div>
			<p>
				<strong>背景模式 (for 盒装)</strong>
			</p>
			<div class="colors-holder">
				<a data-rel="" class="bg-box" href="#"><span
					class="icon-check-empty"></span></a> <a data-rel="1" class="bg-box"
					href="#"></a> <a data-rel="2" class="bg-box" href="#"></a> <a
					data-rel="3" class="bg-box" href="#"></a> <a data-rel="4"
					class="bg-box" href="#"></a> <a data-rel="5" class="bg-box"
					href="#"></a> <a data-rel="6" class="bg-box" href="#"></a> <a
					data-rel="7" class="bg-box" href="#"></a> <a data-rel="8"
					class="bg-box" href="#"></a> <a data-rel="9" class="bg-box"
					href="#"></a> <a data-rel="10" class="bg-box" href="#"></a> <a
					data-rel="11" class="bg-box" href="#"></a> <a data-rel="12"
					class="bg-box" href="#"></a> <a data-rel="13" class="bg-box"
					href="#"></a>
			</div>

			<div class="clearfix"></div>
			<div class="mt-10"></div>
			<p>
				<strong>背景图片 (for 盒装)</strong>
			</p>
			<div class="colors-holder">
				<a data-rel="" class="bgimg-box" href="#"><span
					class="icon-check-empty"></span></a> <a data-rel="pic1"
					class="bgimg-box" href="#"></a> <a data-rel="pic2"
					class="bgimg-box" href="#"></a> <a data-rel="pic3"
					class="bgimg-box" href="#"></a> <a data-rel="pic4"
					class="bgimg-box" href="#"></a> <a data-rel="pic5"
					class="bgimg-box" href="#"></a> <a data-rel="pic6"
					class="bgimg-box" href="#"></a>
			</div>

			<div class="clearfix"></div>
			<div class="mt-10"></div>
			<div class="pull-right">
				<button
					onclick="aya_get('<?php echo AYA_URL?>ajax.php?fun=save_theme&theme=<?php echo TEMPLATE?>&theme_css='+encodeURIComponent(T_theme_css)+'&body='+encodeURIComponent(T_body)+'&container='+encodeURIComponent(T_container))"
					class="btn btn-mini btn-primary">保存</button>
			</div>
			<div class="mt-10"></div>
			<div class="clearfix"></div>
			<div class="switcher-divider"></div>
			<p>
				<strong>可视编辑</strong>
			</p>
			<div class="btn-group">
				<button
					onclick="aya_get('<?php echo AYA_URL?>ajax.php?fun=diy&in_diy=0')"
					type="button"
					class="btn btn-mini <?php if(!IN_DIY){?>btn-primary active<?php }?>"
					data-toggle="button">关</button>
				<button
					onclick="aya_get('<?php echo AYA_URL?>ajax.php?fun=diy&in_diy=1')"
					type="button"
					class="btn btn-mini <?php if(IN_DIY==1){?>btn-primary active<?php }?>"
					data-toggle="button">布局(父)</button>
				<button
					onclick="aya_get('<?php echo AYA_URL?>ajax.php?fun=diy&in_diy=2')"
					type="button"
					class="btn btn-mini <?php if(IN_DIY==2){?>btn-primary active<?php }?>"
					data-toggle="button">布局(子)</button>
				<button
					onclick="aya_get('<?php echo AYA_URL?>ajax.php?fun=diy&in_diy=3')"
					type="button"
					class="btn btn-mini <?php if(IN_DIY==3){?>btn-primary active<?php }?>"
					data-toggle="button">标签</button>
			</div>
			<div class="clearfix"></div>
			<div class="mt-10"></div>
			<div class="pull-right">
				<button onclick="diy_upcache()" class="btn btn-mini btn-danger">更新缓存</button>
				<button
					onclick="<?php if(IN_DIY==1){?>layer_save_1()<?php }elseif(IN_DIY==2){?>layer_save_2()<?php }elseif(IN_DIY==3){?>diy_save()<?php }else{?>javascript:void(0)<?php }?>"
					class="btn btn-mini btn-primary">保存</button>
			</div>

			<div class="clearfix"></div>

			<div class="switcher-divider"></div>
			<p>
				<strong>终端选择</strong>
			</p>
			<div class="btn-group">
				<button
					class="btn btn-mini <?php if(CLIENT=='pc'){?>btn-primary<?php }?>"
					type="button"
					onclick="aya_get('<?php echo AYA_URL?>ajax.php?fun=client&client=pc')">电脑</button>
				<button
					class="btn btn-mini <?php if(CLIENT=='tc'){?>btn-primary<?php }?>"
					type="button"
					onclick="aya_get('<?php echo AYA_URL?>ajax.php?fun=client&client=tc')">触屏</button>
				<button
					class="btn btn-mini <?php if(CLIENT=='wx'){?>btn-primary<?php }?>"
					type="button"
					onclick="aya_get('<?php echo AYA_URL?>ajax.php?fun=client&client=wx')">微信</button>
			</div>
		</div>
		<div id="switcher-footer">
			<p>
				<a href="http://www.ayacms.com/" target="_blank"><img
					src="<?php echo AYA_TURL?>theme/images/logo.png"></a>
			</p>
		</div>

	</div>
</div>


<div class="modal fade" id="layeradd_Modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span><span class="sr-only">关闭</span>
				</button>
				<h4 class="modal-title">新加布局</h4>
			</div>
			<div class="modal-body">

				<form class="form-horizontal" role="form" id="<?php echo random()?>"
					action="<?php echo AYA_URL?>ajax.php?fun=layeritem_add&in_diy=<?php echo IN_DIY?>"
					method="post" onsubmit="aya_post(this.id);return false;">
					<input id="_layer_id" name="posts[layer_id]" type="hidden" value="" />
					<div class="form-group">
						<label class="col-md-2 control-label required">布局比例</label>
						<div class="col-md-9">

							<div class="input-group">
								<input type="text" name="posts[b]" id="_layerb" value=""
									class="form-control">

								<div class="input-group-btn">
									<button type="button" class="btn btn-default dropdown-toggle"
										data-toggle="dropdown">
										快捷输入 <span class="caret"></span>
									</button>

									<ul class="dropdown-menu" role="menu">
										<li><a href="javascript:" onclick="$('#_layerb').val('12');">1份</a></li>
										<li><a href="javascript:" onclick="$('#_layerb').val('6:6');">2等份</a></li>
										<li><a href="javascript:"
											onclick="$('#_layerb').val('4:4:4');">3等份</a></li>
										<li><a href="javascript:"
											onclick="$('#_layerb').val('3:3:3:3');">4等份</a></li>
										<li><a href="javascript:"
											onclick="$('#_layerb').val('2:2:2:2:2:2');">6等份</a></li>
										<li><a href="javascript:"
											onclick="$('#_layerb').val('1:1:1:1:1:1:1:1:1:1:1:1');">12等份</a></li>
										<li class="divider"></li>
										<li><a href="javascript:" onclick="$('#_layerb').val('4:8');">4:8</a></li>
										<li><a href="javascript:" onclick="$('#_layerb').val('8:4');">8:4</a></li>
										<li><a href="javascript:"
											onclick="$('#_layerb').val('3:3:6');">3:3:6</a></li>
										<li><a href="javascript:"
											onclick="$('#_layerb').val('6:3:3');">6:3:3</a></li>
										<li><a href="javascript:"
											onclick="$('#_layerb').val('3:6:3');">3:6:3</a></li>
									</ul>
								</div>
							</div>

							<div class="help-block">比值相加满足12;</div>
						</div>
					</div>

					<div class="form-group" style="display:<?php echo IN_DIY==2?'none':''?>">
						<label class="col-md-2 control-label"></label>
						<div class="col-md-9">
							<label class="checkbox-inline"> <input type="checkbox"
								name="posts[addlayer]" value="1">
							</label>
							<div class="help-block">我希望在此布局中再次插入布局(布局2)</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-offset-2 col-md-10">
							<button type="submit" class="btn btn-primary">提交</button>
							<button type="reset" class="btn btn-default">重置</button>
						</div>
					</div>
				</form>



			</div>


		</div>
	</div>
</div>

<div class="modal fade" id="layeredit_Modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span><span class="sr-only">关闭</span>
				</button>
				<h4 class="modal-title">更换布局</h4>
			</div>
			<div class="modal-body">

				<form class="form-horizontal" role="form" id="<?php echo random()?>"
					action="<?php echo AYA_URL?>ajax.php?fun=layeritem_edit&in_diy=<?php echo IN_DIY?>"
					method="post" onsubmit="aya_post(this.id);return false;">
					<input id="_layeritem_id" name="posts[layeritem_id]" type="hidden"
						value="" />
					<div class="form-group">
						<label class="col-md-2 control-label required">布局比例</label>
						<div class="col-md-9">

							<div class="input-group">
								<input type="text" name="posts[b]" id="_layerr" value=""
									class="form-control">

								<div class="input-group-btn">
									<button type="button" class="btn btn-default dropdown-toggle"
										data-toggle="dropdown">
										快捷输入 <span class="caret"></span>
									</button>

									<ul class="dropdown-menu" role="menu">
										<li><a href="javascript:" onclick="$('#_layerr').val('12');">1份</a></li>
										<li><a href="javascript:" onclick="$('#_layerr').val('6:6');">2等份</a></li>
										<li><a href="javascript:"
											onclick="$('#_layerr').val('4:4:4');">3等份</a></li>
										<li><a href="javascript:"
											onclick="$('#_layerr').val('3:3:3:3');">4等份</a></li>
										<li><a href="javascript:"
											onclick="$('#_layerr').val('2:2:2:2:2:2');">6等份</a></li>
										<li><a href="javascript:"
											onclick="$('#_layerr').val('1:1:1:1:1:1:1:1:1:1:1:1');">12等份</a></li>
										<li class="divider"></li>
										<li><a href="javascript:" onclick="$('#_layerr').val('4:8');">4:8</a></li>
										<li><a href="javascript:" onclick="$('#_layerr').val('8:4');">8:4</a></li>
										<li><a href="javascript:"
											onclick="$('#_layerr').val('3:3:6');">3:3:6</a></li>
										<li><a href="javascript:"
											onclick="$('#_layerr').val('6:3:3');">6:3:3</a></li>
										<li><a href="javascript:"
											onclick="$('#_layerr').val('3:6:3');">3:6:3</a></li>
									</ul>
								</div>
							</div>

							<div class="help-block">比值相加满足12;</div>
						</div>
					</div>
					<div class="form-group" style="display:<?php echo IN_DIY==2?'none':''?>">
						<label class="col-md-2 control-label"></label>
						<div class="col-md-9">
							<label class="checkbox-inline"> <input type="checkbox"
								name="posts[addlayer]" value="1">
							</label>
							<div class="help-block">我需要在此布局中再次插入布局</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-2 col-md-10">
							<button type="submit" class="btn btn-primary">提交</button>
							<button type="reset" class="btn btn-default">重置</button>
						</div>
					</div>
				</form>



			</div>


		</div>
	</div>
</div>


<?php
$file=AYA_TROOT.'diy/these.name.php';
$diyinfos=array ();
if(is_file($file)){
	$arr=include $file;
}

foreach($arr as $k=>$v){
	$diyinfos[filename($k)]=explode('|',$v); // 例: 'poll.php'=>'投票调用|itemid=|投票ID:说明|',
}

?>


<div class="modal fade" id="diyedit_Modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span><span class="sr-only">关闭</span>
				</button>
				<h4 class="modal-title">编辑</h4>
			</div>
			<div class="modal-body">

				<form class="form-horizontal" role="form" id="diyeditform"
					action="<?php echo AYA_URL?>ajax.php?fun=diyitem_edit"
					method="post" onsubmit="aya_post(this.id);return false;">
					<input id="_diyitem_id" name="posts[diyitem_id]" type="hidden"
						value="" />

					<div class="form-group">
						<div class="col-md-4">
							<select class="form-control" name="posts[diy_name]"
								id="_diy_name" onchange="disp_diybox(this.value,'edit')">
								<option value="">选择标签...</option>
            <?php foreach($diyinfos as $name=>$info){?>
            <option value="<?php echo $name?>"><?php echo html($info[0])?></option>
      <?php }?>
       </select>
						</div>
					</div>
					<div id="_diybox_edit"></div>
					<hr />

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-5 control-label">附加CSS类</label>
								<div class="col-md-7">
									<input type="text" name="posts[box_class]" value=""
										class="form-control _diy_box_class">

								</div>
							</div>
							<div class="form-group">
								<label class="col-md-5 control-label">①自定义标题</label>
								<div class="col-md-7">
									<input type="text" name="posts[box_title]" value=""
										class="form-control _diy_box_title">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-5 control-label">②缓存开关</label>
								<div class="col-md-7">
									<input type="text" name="posts[box_cache]" value=""
										class="form-control _diy_box_cache">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-5 control-label">内部容器宽</label>
								<div class="col-md-7">
									<input type="text" name="posts[box_width]" value=""
										class="form-control _diy_box_width">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-5 control-label">内部容器高</label>
								<div class="col-md-7">
									<input type="text" name="posts[box_height]" value=""
										class="form-control _diy_box_height">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-5 control-label">③新窗口</label>
								<div class="col-md-7">
									<input type="text" name="posts[blank]" value=""
										class="form-control _diy_blank">
								</div>
							</div>

						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<div class="help-block">①"hide"为隐藏标题 ②留空启用缓存,"0"关闭缓存 ③"1"链接在新窗口打开</div>
						</div>
					</div>
					<hr />
					<div class="form-group">
						<div class="col-md-offset-2 col-md-10">
							<button type="submit" class="btn btn-primary">提交</button>
							<button type="reset" class="btn btn-default">重置</button>
						</div>
					</div>
				</form>

			</div>


		</div>
	</div>
</div>

<div class="modal fade" id="diyadd_Modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span><span class="sr-only">关闭</span>
				</button>
				<h4 class="modal-title">新加标签</h4>
			</div>
			<div class="modal-body">

				<form class="form-horizontal" role="form" id="<?php echo random()?>"
					action="<?php echo AYA_URL?>ajax.php?fun=diyitem_add" method="post"
					onsubmit="aya_post(this.id);return false;">
					<input id="_diy_id" name="posts[diy_id]" type="hidden" value="" />

					<div class="form-group">
						<div class="col-md-4">
							<select class="form-control" name="posts[diy_name]"
								onchange="disp_diybox(this.value,'add')">
								<option value="">选择标签...</option>
            <?php foreach($diyinfos as $name=>$info){?>
            <option value="<?php echo $name?>"><?php echo html($info[0])?></option>
      <?php }?>
       </select>
						</div>
					</div>

					<div id="_diybox_add"></div>

					<hr />

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-5 control-label">附加CSS类</label>
								<div class="col-md-7">
									<input type="text" name="posts[box_class]" value=""
										class="form-control _diy_box_class">

								</div>
							</div>
							<div class="form-group">
								<label class="col-md-5 control-label">①自定义标题</label>
								<div class="col-md-7">
									<input type="text" name="posts[box_title]" value=""
										class="form-control _diy_box_title">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-5 control-label">②缓存开关</label>
								<div class="col-md-7">
									<input type="text" name="posts[box_cache]" value=""
										class="form-control _diy_box_cache">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-5 control-label">内部容器宽</label>
								<div class="col-md-7">
									<input type="text" name="posts[box_width]" value=""
										class="form-control _diy_box_width">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-5 control-label">内部容器高</label>
								<div class="col-md-7">
									<input type="text" name="posts[box_height]" value=""
										class="form-control _diy_box_height">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-5 control-label">③新窗口</label>
								<div class="col-md-7">
									<input type="text" name="posts[blank]" value=""
										class="form-control _diy_blank">
								</div>
							</div>

						</div>
					</div>

					<div class="form-group">
						<div class="col-md-12">
							<div class="help-block">①"hide"为隐藏标题 ②留空启用缓存,"0"关闭缓存 ③"1"链接在新窗口打开</div>
						</div>
					</div>
					<hr />
					<div class="form-group">
						<div class="col-md-offset-2 col-md-10">
							<button type="submit" class="btn btn-primary">提交</button>
							<button type="reset" class="btn btn-default">重置</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>


<?php

$su=array (
		'①',
		'②',
		'③',
		'④',
		'⑤',
		'⑥',
		'⑦',
		'⑧',
		'⑨',
		'⑩' 
);

foreach($diyinfos as $name=>$info){
	$par=$info[1];
	parse_str($par,$pars);
	
	$notes=array ();
	$arr=explode(';',$info[2]);
	foreach($arr as $k=>$v){
		if(strlen($v)<1)
			continue;
		$notes[]=explode(':',$v);
	}
	$i=0;
	reset($su);
	?>
<div style="display: none" id="_diyitem_<?php echo $name?>">
	<div class="row">
     <?php
	foreach($pars as $k=>$v){
		if($i>0&&$i%2==0)
			echo '</div><div class="row">';
		
		?>
     <div class="col-md-6">
			<div class="form-group">
				<label class="col-md-5 control-label"><?php if(strlen($notes[$i][1])>0){ $s=each($su);echo $s[1];} echo html($notes[$i][0])?></label>
				<div class="col-md-7">
					<input type="text" name="posts[<?php echo $k?>]"
						value="<?php echo html($v)?>"
						class="form-control _diy_<?php echo $k?>">
				</div>
			</div>
		</div>
      <?php
		$i++;
	}
	?>
	</div>
	<div class="form-group">
		<div class="col-md-12">
			<div class="help-block"><?php if(!$info[1]){ echo html($info[2]);}else{ reset($su); foreach($notes as $k=>$v) {if(strlen($v[1])>0){$s=each($su);echo $s[1].html($v[1]).';';}}}?></div>
		</div>
	</div>

</div>
<?php
}
?>



<script type="text/javascript">

function layer_save(){
layer_save_<?php echo IN_DIY?>();	
}


function layer_save_1(){
var a = [];
$('.layeritem').each(
		function(){
			a.push([$(this).attr('layeritem-id'),$(this).parent().attr('id')]);
}
);
var b=[];
$('.board-list').each(
		function(){
			var tpl_file=$(this).attr('tpl-file');
			if (typeof(tpl_file)!= 'undefined') b.push(tpl_file);
}
);

b=uniquearr(b);
aya_get('<?php echo AYA_URL?>ajax.php?fun=layer_save_1&layer='+encodeURIComponent(JSON.stringify(a))+'&tpl_file='+encodeURIComponent(JSON.stringify(b)));
}
function layer_save_2(){
	var a = [];
	$('.layeritem').each(
			function(){
				a.push([$(this).attr('layeritem-id'),$(this).parent().attr('id')]);
	}
	);
	var b=[];
	$('.board-list').each(
			function(){
				var tpl_file=$(this).attr('tpl-file');
				if (typeof(tpl_file)!= 'undefined') b.push(tpl_file);
	}
	);

	b=uniquearr(b);
	aya_get('<?php echo AYA_URL?>ajax.php?fun=layer_save_2&layer='+encodeURIComponent(JSON.stringify(a))+'&tpl_file='+encodeURIComponent(JSON.stringify(b)));
	}


function layer_clean(id){
	$("#"+id).html('');
	layer_save();
}

function layeritem_add(id){
	$('#_layer_id').val(id);
	$('#layeradd_Modal').modal();
}
function layeritem_del(o){
	$(o).parent().parent().parent().parent().remove();
	layer_save();
}
function layeritem_edit(o){
	$('#_layeritem_id').val($(o).parent().parent().parent().parent().attr("id"));
	$('#layeredit_Modal').modal();
}
function diy_upcache(){
	aya_get('<?php echo AYA_URL?>ajax.php?fun=diy_upcache');
}
function diy_save(){
	var a = [];
	$('.diyitem').each(
			function(){
				a.push([$(this).attr('diyitem-id'),$(this).parent().attr('id'),$(this).attr('diy-par')]);
	}
	);

	var b=[];
	$('.board-list').each(
			function(){
				var tpl_file=$(this).attr('tpl-file');
				if (typeof(tpl_file)!= 'undefined') b.push(tpl_file);
	}
	);

	b=uniquearr(b);
	
	aya_get('<?php echo AYA_URL?>ajax.php?fun=diy_save&diy='+encodeURIComponent(JSON.stringify(a))+'&tpl_file='+encodeURIComponent(JSON.stringify(b)));
	}
function diy_clean(id){
	$("#"+id).html('');
	diy_save();
}

function diyitem_add(id){
	$('#_diy_id').val(id);
	$('#diyadd_Modal').modal();
}

function diyitem_edit(o){
	var id=$(o).parent().parent().parent().parent().attr("id");
var par=$('#'+id).attr("diy-par");

par=dhtmlspecialchars(par);

var pars = eval("("+par+")");

$('#_diybox_edit').html($('#_diyitem_'+pars.name).html());
for(i in pars.pars){
	$('#diyeditform ._diy_'+pars.pars[i].key).val(pars.pars[i].val);
}
$("#_diy_name").val(pars.name);
$('#_diyitem_id').val(id);
$('#diyedit_Modal').modal();
}
function diyitem_del(o){
	$(o).parent().parent().parent().parent().remove();
	diy_save();	
}

function disp_diybox(name,type){
$('#_diybox_'+type).html(name==''?'':$('#_diyitem_'+name).html());
}

function dhtmlspecialchars(str){  
    str = str.replace(/&amp;/g, '&');
    str = str.replace(/&lt;/g, '<');
    str = str.replace(/&gt;/g, '>');
    str = str.replace(/&quot;/g, '"');
    str = str.replace(/&#039;/g, '\'');
    
    return str;
}
function uniquearr(arr)
{
    arr = arr || [];
    var a = {};
    for (var i=0; i<arr.length; i++)
    {
        var v = arr[i];
        if (typeof(a[v]) == 'undefined')
    {
            a[v] = 1;
        }
    }
    arr.length = 0; 
    for (var i in a )
    {
        arr[arr.length] = i;
    }
    
    return arr;
}
</script>
