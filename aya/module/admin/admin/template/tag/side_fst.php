<ul class="nav nav-secondary nav-stacked">
<?php $file=$_GET['file']?>
  <li <?php echo $file==''?'class="active"':''?>><a href="?action=fst&file=">根目录</a></li>
  <li <?php echo $file=='aya/template'?'class="active"':''?>><a href="?action=fst&file=aya/template">风格</a></li>
  <li <?php echo $file=='aya/upload'?'class="active"':''?>><a href="?action=fst&file=aya/upload">上传</a></li>
  <li <?php echo $file=='aya/backup'?'class="active"':''?>><a href="?action=fst&file=aya/backup">备份</a></li>
  <li <?php echo $file=='aya/cache'?'class="active"':''?>><a href="?action=fst&file=aya/cache">缓存</a></li>
  <li <?php echo $file=='aya/lang'?'class="active"':''?>><a href="?action=fst&file=aya/lang">语言</a></li>
  <li <?php echo $file=='aya/module'?'class="active"':''?>><a href="?action=fst&file=aya/module">模型</a></li>
  <li <?php echo $file=='aya/table'?'class="active"':''?>><a href="?action=fst&file=aya/table">表单</a></li>
</ul>