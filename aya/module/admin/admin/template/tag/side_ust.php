<ul class="nav nav-secondary nav-stacked">

  <li <?php echo $action=='ust_chan'?'class="active"':''?>><a href="?action=ust_chan">栏目</a></li>
  <li <?php echo in_array($action,array('ust_text_e','ust_text_a','ust_text'))?'class="active"':''?>><a href="?action=ust_text">文本</a></li>
  <li <?php echo in_array($action,array('ust_pic_e','ust_pic_a','ust_pic'))?'class="active"':''?>><a href="?action=ust_pic">图片</a></li>
  <li <?php echo in_array($action,array('ust_link_e','ust_link_a','ust_link'))?'class="active"':''?>><a href="?action=ust_link">链接</a></li>
  <li <?php echo in_array($action,array('ust_video_e','ust_video_a','ust_video'))?'class="active"':''?>><a href="?action=ust_video">视频</a></li>
  <li <?php echo in_array($action,array('ust_poll_e','ust_poll_a','ust_poll'))?'class="active"':''?>><a href="?action=ust_poll">投票</a></li>
  <li <?php echo $action=='ust_tab'?'class="active"':''?>><a href="?action=ust_tab">表单</a></li>
  <li <?php echo in_array($action,array('ust_sql','ust_sql_g'))?'class="active"':''?>><a href="?action=ust_sql">数据库</a></li>
</ul>