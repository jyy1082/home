<!DOCTYPE html>
<head>
	
	<meta charset="utf-8" />
	<meta name="google" content="notranslate" />
	<style type="text/css">
		
  </style>
  <link rel="stylesheet" type="text/css" href="css/fonts.css" />
  <link rel="stylesheet" type="text/css" href="layui/css/layui.css" />
  <script type="text/javascript" src="layui/layui.js"></script>
  <script>
  layui.use('layer', function(){
	var layer = layui.layer,
	        $ = layui.jquery;
  	$('#submit_btn').on("click",function(){
		var ssid=$('#ssid').val();
		var psk=$('#psk').val();
		if(ssid.trim()==""){
			layer.msg('SSID为必填，不能为空或空格！',{icon:2});
		}else{
			$.get("wifi.php?ssid="+ssid+"&psk="+psk, function(data, status){
					//alert("Data: " + data + "\nStatus: " + status);
					if(status=='success'){
						var indexP = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
						parent.layer.close(indexP); //再执行关闭  
						parent.layui.jquery('#wifi_diaplay').text('已选择SSID：'+ssid+'（重启生效）');	
						parent.layer.msg('设置成功！请重新启动机器',{icon:1});	
						
					}
			});
		}
    });
	$('#cancel_btn').on("click",function(){
		var indexP = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
		parent.layer.close(indexP); //再执行关闭  
	
    });
	
	
	
});  
   
  
  </script>
</head>
<body >
<br>
<div class="layui-form-item">
	<label class="layui-form-label">SSID:</label>
    <div class="layui-input-inline">
      <input type="text" id='ssid' name="ssid" required lay-verify="required" placeholder="请输入SSID" autocomplete="off" class="layui-input">
    </div>
	
</div>
<div class="layui-form-item">
	<label class="layui-form-label">密码:</label>
     <div class="layui-input-inline">
	  <input type="text" id='psk' name="psk"  placeholder="请输入密码" autocomplete="off" class="layui-input">
    </div>
 </div>
 <div class="layui-form-item">
    <div class="layui-input-block">
      <button id='submit_btn' class="layui-btn" lay-submit lay-filter="formDemo">确定</button>
      <button id='cancel_btn' type="reset" class="layui-btn layui-btn-primary">取消</button>
    </div>
 </div>
 
</body>
</html>
