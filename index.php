<!DOCTYPE html>
<head>
	<title>欢迎页面</title>
	<meta charset="utf-8" />
	<meta name="google" content="notranslate" />
	<style type="text/css">
		body { background: #1E6CCE url('images/welcome.jpg'); background-size: 100%; font-size: 1.3em;}
		#container { background: rgba(255,255,255,.5); width: 100%; max-width: 1000px; padding: 10px; margin: 30px auto;position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); }	
		h1, h2 { margin: .2em 0 0 0; }
		h1 { font-size: 3em; color:white}
		header, section, footer { background: #2173A9; padding: 10px; margin: 10px; text-align: center; }
		footer p { margin: 0; font-size: 1.1em; font-style: italic;}
		section { background: #B73453; }
  </style>
  <link rel="stylesheet" type="text/css" href="css/fonts.css" />
  <link rel="stylesheet" type="text/css" href="layui/css/layui.css" />
  <script type="text/javascript" src="layui/layui.js"></script>
  <script>
  layui.use('layer', function(){
	var layer = layui.layer,
	        $ = layui.jquery;
  	$("#urlChange_btn").on("click",function(){
        layer.prompt({title: '请输入新的加载地址'},function(val, index){
			//layer.msg('得到了'+val);
			if(val.trim()!=""){
				$.get('url.php?url='+val, function(data, status){
				//alert("Data: " + data + "\nStatus: " + status);
					if(status=='success'){						
						$("#url_diaplay").text(val+" (重启生效)");
						layer.msg('修改成功！请重新启动机器',{icon:1});
					}
				});
			}else{
				layer.msg('失败！输入格式错误',{icon:2});
			}
			
			layer.close(index);
		});
    });
	$("#wifiChange_btn").on("click",function(){
		var wifi_list;
		$.get("wifi_scan.php", function(data, status){
				//alert("Data: " + data + "\nStatus: " + status);
				wifi_list=$.grep(data.replace(/"/g,"").split("\n"), function(n){ return (n); });
				
				if(status=='success'){
					
					layer.open({title: '搜索Wi-Fi热点',type:2,area : [, '500px'],content:'wifi_list.php?wifi_list='+wifi_list},function(val, index){
										
						layer.close(index);						
					});						
				}
		});       
    });
	$("#reboot_btn").on("click",function(){
        layer.confirm('确定要重新启动机器？', {
			btn: ['确定','取消'], //按钮
			title:'重启提示'
		}, function(index){
				$.get("reboot.php", function(data, status){
					
				});
				layer.close(index);
		});
		
    });
	$("#shutdown_btn").on("click",function(){
        layer.confirm('确定要关闭机器？', {
			btn: ['确定','取消'], //按钮
			title:'关机提示'
		}, function(index){
				$.get("shutdown.php", function(data, status){
					
				});
				layer.close(index);
		});
		
    });
	$("#wifiInput_btn").on("click",function(){
		
		layer.open({title: '手动设置Wi-Wi',type:2,area : ['400px', '250px'],content:'wifi_input.php'},function(val, index){
										
			layer.close(index);						
		});			
    });
	
	
	
});  
   
  
  </script>
</head>
<body >
	<div id="container">
		<header>
			<h1 class="font-kai">本机序列号</h1>
			<font size=15px color=#F2CA27>
			<?php
				echo shell_exec("sudo cat /proc/cpuinfo | grep Serial | cut -d ' ' -f 2");
			?>
			</font>
		</header>

		<section>
			<h1 class="font-kai">屏显加载网址</h1>
			<div id="url_diaplay" style="color:#F2CA27;font-size:20px;">
			<?php
				echo shell_exec("sudo cat /boot/fullpageos.txt");
			?>
			</div>
			<button id="urlChange_btn" class="layui-btn layui-btn-normal">修改网址</button>
		</section>
		<section>
			<h1 class="font-kai">Wi-Fi设置</h1>
			<div id="wifi_diaplay" style="color:#F2CA27;font-size:20px;">
			<?php
				$wifi_name=shell_exec("sudo iwconfig wlan0|awk -F ':' '/ESSID:/ {print $2;}'");
				$wifi_name=str_replace("\"","",$wifi_name);
				if(trim($wifi_name)=="off/any"){
					echo "未连接";		
				}else{					
					echo "已连接SSID：$wifi_name";
				}

			?>
			</div>
			<button id="wifiChange_btn" class="layui-btn layui-btn-normal">搜索Wi-Fi</button>
			<button id="wifiInput_btn" class="layui-btn layui-btn-normal">手动设置</button>
		</section>
		<section>
			
			
			<button id="reboot_btn" class="layui-btn layui-btn-radius layui-btn-warm">重启</button>
			<button id="shutdown_btn" class="layui-btn layui-btn-radius layui-btn-warm">关机</button>
		</section>
		
		<footer>
			<p><img src='images/logo.png' width='150px'></img></p>
			<p><a href="http://www.zhisolution.com" target="_blank" style='color:white;'>~* www.zhisolution.com *~</a></p>
		</footer>
	</div>
  
	<style>
		@keyframes subtle { from { color: #ffffff; } to { color: #000000; } }
	</style>
	
</body>
</html>
