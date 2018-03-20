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
  	$('button[id^="select_btn"]').on("click",function(){
		var ssid=$(this).val();
        layer.prompt({title: '请输入'+ssid+'的密码：'},function(val, index){
			//layer.msg('得到了'+index);
			$.get("wifi.php?ssid="+ssid+"&psk="+val, function(data, status){
				//alert("Data: " + data + "\nStatus: " + status);
				if(status=='success'){
					var indexP = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
					parent.layer.close(indexP); //再执行关闭  
					parent.layui.jquery('#wifi_diaplay').text('已选择SSID：'+ssid+'（重启生效）');	
					parent.layer.msg('设置成功！请重新启动机器',{icon:1});	
					
				}
			});
			layer.close(index);
					
			
		});
    });
	
	
	
	
});  
   
  
  </script>
</head>
<body >
<br>
<?php
	$data=explode(",",$_GET['wifi_list']);
		foreach ($data as $key=>$value) {
			echo "&nbsp;&nbsp;".++$key.".SSID: <B>".$value. "</B><button id='select_btn".$key."' class='layui-btn layui-btn-sm' style='float:right;margin-bottom: 10px;' value='".$value."'>选择</button><hr class='layui-bg-blue'>";
		}
?>
</body>
</html>
