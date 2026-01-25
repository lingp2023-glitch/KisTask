$(document).ready(function(){

	//发送手机验证码
	$("#sendBtn").bind("click",function(){
		var timestamp = $("#timestamp").val();
		var sign = $("#sign").val();
		var phone = $("#phone").val();
		var sum = $("#vSum").val();
		var sid = $("#vSid").val();
		if(phone=="")
		{
			alert("请输入手机号");
			return;
		}
		
		if(sum=="")
		{
			alert("请输计算结果");
			return;
		}
		
  	$.ajax({
			type: "POST",
		  url: "./index.php?shop/user/sendSms",
			dataType: "json",
			data: {
				timestamp:timestamp,
				sign:sign,
				phone:phone,
				sid:sid,
				sum:sum
			},
			timeout: 1000,
			complete: function(){},
			success: function(data)
			{ 
				if(data.code!=0) {alert(data.msg);}
				if(data.code==0)
				{
					let time = 60;
          let flag = 1;
          $("#sendBtn").attr("disabled",true);
        	$("#sendBtn").text("已发送");
        	
          if (flag) {
              let timer = setInterval(() => {
                time--;
                $("#sendBtn").text(time + " 秒");
                if (time === 0) {
                 	clearInterval(timer);
                  $("#sendBtn").attr("disabled",true);
        					$("#sendBtn").text("重新获取");
                  flag = 0;
                }
              }, 1000)
            }
				}
				///else
				//	alert(data.msg)
			}
		});	//$.ajax
  	
  }); // $("#sendBtn").bind()
  
  //注册
	$("#sumbitBtn").bind("click",function(){
		var timestamp = $("#timestamp").val();
		var sign = $("#sign").val();
		var phone = $("#phone").val();
		var code = $("#vCode").val();
		var adcode = $("#adCode").val(); 
		var password = $("#password").val(); 
		var cfpassword = $("#cfpassword").val(); 
		
		if(phone=="")
		{
			alert("请输入手机号");
			return;
		}
		
		if(password!=cfpassword)
		{
			alert("两次密码输入不同");
			return;
		}
		
  	$.ajax({
			type: "POST",
		  url: "./index.php?shop/user/reg",
			dataType: "json",
			data: {
				timestamp:timestamp,
				sign:sign,
				phone:phone,
				password:password,
				code:code,
				adcode:adcode
			},
			timeout: 1000,
			complete: function(){},
			success: function(data)
			{
				if(data.code==0)
				{
					alert("用户注册成功，请下载APP");
					$(location).attr('href', "?webapp/download");
				}
				else
					alert(data.msg)
			}
		});	//$.ajax
  	
  }); // $("#sendBtn").bind()
  
   //登陆
	$("#loginBtn").bind("click",function(){
		var timestamp = $("#timestamp").val();
		var sign = $("#sign").val();
		var openid = $("#openid").val();
		var phone = $("#phone").val();
		var password = $("#password").val();
		
		if(phone=="")
		{
			alert("请输入手机号");
			return;
		}
		
		if(password=="")
		{
			alert("请输入密码");
			return;
		}
		
  	$.ajax({
			type: "POST",
		  url: "./index.php?webapp/bindPhone",
			dataType: "json",
			data: {
				timestamp:timestamp,
				sign:sign,
				openid:openid,
				phone:phone,
				password:password
			},
			timeout: 1000,
			complete: function(){},
			success: function(data)
			{
				if(data.code==0)
				{
					$(location).attr('href', "?webapp/poster&openid="+openid);
				}
				else
					alert(data.msg)
			}
		});	//$.ajax*/
  	
  }); // $("#loginBtn").bind()
});