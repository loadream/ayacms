<?php if($USER['itemid']<1) return;?>
<span class="btn btn-link btn-xs btn-text">
	<i class="icon-user" style="color: #390"></i> <?php echo html($USER['name'])?></span>
<div class="btn-group">
	<button type="button" class="btn btn-default btn-xs upcache"
		onclick="aya_get('<?php echo AYA_ADMIN_URL?>?action=upcache')">
		<i class="icon-undo"></i>
		更新缓存
		</a>
	</button>
	
	<a class="btn btn-default btn-xs"
		href="<?php echo AYA_URL?>" target="_admin">
		<i class="icon-external-link"></i> 站点首页
		</a>
	<button type="button" class="btn btn-default btn-xs dropdown-toggle"
		data-toggle="dropdown">
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu pull-right" role="menu" style="z-index: 1001">
		<li>
			<a href="<?php echo AYA_ADMIN_URL?>?action=pass">
				<i class="icon-key"></i>
				修改密码
			</a>
		</li>
		<li>
			<a href="javascript:void(0)" onclick="if(confirm('确定要退出吗?'))aya_get('<?php echo AYA_ADMIN_URL?>?action=out');">
				<i class="icon-signout"></i>
				退出
			</a>
		</li>
		<li class="divider"></li>
		<li>
			<a href="http://www.ayacms.com" target="_blank">
				<i class="icon-external-link"></i>
				AyaCMS官网
			</a>
		</li>
	</ul>
</div>





