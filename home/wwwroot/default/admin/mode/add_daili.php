<?php

   
    	function success_go($msg,$url){
		echo '<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">
                &times;
            </button>
            '.$msg.',系统将在3秒后跳转。<a href="'.$url.'">等不及了！</a>
        </div> ';
        echo '<script>setTimeout(function(){
        	window.location.href="'.$url.'";
        },3000)</script>';
	}
	function error_go($msg,$url){
		echo '<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">
                &times;
            </button>
            '.$msg.',系统将在3秒后跳转。<a href="'.$url.'">等不及了！</a>
        </div> ';
        echo '<script>setTimeout(function(){
        	window.location.href="'.$url.'";
        },3000)</script>';
	}
	
 	include('head2.php');
	include('nav2.php');
 	if($_GET['act'] == 'update'){
		$db = db('line');
		if($db->where(array('id'=>$_GET['id']))->update(array(
			'name'=>$_POST['name'],
			'type'=>$_POST['type'],
			'label'=>$_POST['label'],
			'content'=>$_POST['content'],
			'group'=>$_POST['group'],
			'show'=>$_POST['show'] == '1' ? '1':'0'
		))){
			success_go("修改线路【".$_POST['name']."】成功！",'add_line.php?act=mod&id='.$_GET['id']);
		}else{
			error_go("十分抱歉修改失败",'add_line.php?act=mod&id='.$_GET['id']);
		}
		
	}elseif($_GET['act'] == 'add'){
		$db = db('line');
		if($db->insert(array(
			'name'=>$_POST['name'],
			'type'=>$_POST['type'],
			'label'=>$_POST['label'],
			'content'=>$_POST['content'],
			'group'=>$_POST['group'],
			'time'=>time(),
			'show'=>$_POST['show'] == '1' ? '1':'0'
		))){
			success_go("新增线路【".$_POST['name']."】成功！",'add_line.php');
		}else{
			error_go("十分抱歉修改失败",'add_line.php');
		}
		
	}else{
	
	$action = '?act=add';
	if($_GET['act'] == 'mod'){
		$info = db('line')->where(array('id'=>$_GET['id']))->find();
		$action = "?act=update&id=".$_GET['id'];
	}
		
 ?>
<div class="main">
<span class="label label-default">代理与客服</span>
<div style="clear:both;height:10px;"></div>
	<form class="form-horizontal" role="form" method="POST" action="<?php echo $action?>">
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">代理用户名</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" placeholder="daili" value="<?php echo $info['name'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">代理密码</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="type" placeholder="pass" value="<?php echo $info['pass'] ?>">
        </div>
    </div>
      <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">代理官网(开发中 暂时不显示)</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="label" placeholder="http://www.abc.com" value="<?php echo $info['label'] ?>">
        </div>
    </div>
     
    <div class="form-group" >
        <label for="name" class="col-sm-2 control-label">个性自定义内容(<span style="color:red">支持HTML</span>)</label>
         <div class="col-sm-10">
		 <textarea class="form-control" rows="10" name="content"><?php echo $info['content'] ?></textarea></div>
    </div> 
	
	<div class="form-group" >
	<label for="name" class="col-sm-2 control-label">代理QQ(<span style="color:red">换行区分QQ 下方示例</span>)<br>12345|qq1<br>12345|qq2<br></label>
         <div class="col-sm-10">
		 <textarea class="form-control" rows="10" name="content"><?php echo $info['content'] ?></textarea></div>
    </div>
	
	<div class="form-group" >
        <label for="name" class="col-sm-2 control-label">充值页面个性化内容(<span style="color:red">支持HTML</span>)</label>
         <div class="col-sm-10">
		 <textarea class="form-control" rows="10" name="content"><?php echo $info['content'] ?></textarea></div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="show" value="1">是否启用
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">提交数据</button>
        </div>
    </div>
</form> 
	</div>
	<script>
	function autoGs(){
		var content = $("[name=content]").val();
		content = content.replace("\n\r","\n");  
		content = content.replace("\n","\n\r");
		$("[name=content]").val(content);
	}
	</script>
<?php
	}
	include('footer.php');
	
?>
