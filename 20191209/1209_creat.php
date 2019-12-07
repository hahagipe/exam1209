<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Title -->
    <title>creat</title>
    <style>
      body{
            background-color: #fff5d1;
        }
    </style>
  </head>
  <body>
<!-- title -------------------------------------------------------------------->
 <section class="py-4">
	 <div class="container text-center">
	 	<div class="row">
	 		<h2 class="col-sm-12 text-center font-weight-bold text-info">新增會員</h2>
	 	</div>
	 </div>
 </section>
<!-- 表格 --------------------------------------------------------------------->
	<section class="py-4">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<form>
					  <div class="form-group">
					    <label for="Account">帳號</label>
					    <input type="text" class="form-control" id="Account" placeholder="">
					    <div id="error_Account"></div>
					  </div>
					  <div class="form-group">
					    <label for="Password">密碼</label>
					    <input type="password" class="form-control" id="Password" placeholder="">
					    <div id="error_password"></div>
					  </div>
					  <div class="form-group">
					    <label for="Password2">確認密碼</label>
					    <input type="password" class="form-control" id="Password2" placeholder="">
					    <div id="error_password2"></div>
					  </div>
					  <div class="text-center">
					  	<button type="button" class="btn btn-secondary" id="cnl">取消</button>
					  	<button type="button" class="btn btn-info" id="ok_btn">新增</button>
					  </div>
					</form>
				</div>
				
			</div>
		</div>
	</section>	
	

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <script src="js/jquery-3.3.1.min.js"></script>   

    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
  
    <script>

		var flag_Account = false;
		var flag_Password = false;
		var flag_Password2 = false;

    	$(function(){
    		
			$("#ok_btn").bind("click",send_to_api);
			$("#cnl").bind("click",showhome);

// 及時監聽帳號------------------------------------------------------------------
			$("#Account").bind("input propertychange",function(){
				if ($(this).val().length<=0) {
					$("#error_Account").html("帳號不得空白");
					$("#error_Account").addClass("text-danger");
					flag_Account=false;
				}else{
					$.ajax({
						type:"POST",
						url:"1209_creat_uni_api.php",
						data:{Account:$("#Account").val()},
						success:check_uni,
						error:function(){
							alert("1209_creat_uni_api_ERROR");
						}
					});
				}
				
            });

// 密碼------------------------------------------------------------------------
			$("#Password").bind("input propertychange",function(){
				if ($(this).val().length<=0) {
					$("#error_password").html("密碼不得空白");
					$("#error_password").css("color","red");
					flag_Password=false;
				}else{
					$("#error_password").html("");
					flag_Password=true;
				}
				if ($(this).val()!=$("#Password2").val()) {
					$("#error_password2").html("密碼輸入不相同!!");
					$("#error_password2").css("color","red");
					flag_Password2=false;
				}else{
					$("#error_password2").html("密碼符合!!");
					$("#error_password2").css("color","green");
					flag_Password2=true;
				}
			});

// 密碼2----------------------------------------------------------------------
			$("#Password2").bind("input propertychange",function(){
				if ($(this).val()!=$("#Password").val()) {
					$("#error_password2").html("密碼輸入不相同!!");
					$("#error_password2").css("color","red");
					flag_Password2=false;
				}else{
					$("#error_password2").html("密碼符合!!");
					$("#error_password2").css("color","green");
					flag_Password2=true;
				}
			});
		});

// OK--------------------------------------------------------------------------
		function send_to_api(){
			if(flag_Account && flag_Password && flag_Password2 == true){
				if (confirm("確定新增?")){
					$.ajax({
						type: "POST",
						url: "1209_creat_api.php",
						data: {Account:$("#Account").val(),Password:$("#Password").val()},
						success: show,
						error:function(){
							alert("1209_creat_api ERROR");
						}
					});
				}
			}else{
				alert("欄位輸入不符合規定");
			}
		}
		function show(data){
			if (data) {
				alert("true");
				location.href="1209_login.php";
			}else{
				alert("false");
			}  
        }
		
// cancel----------------------------------------------------------------------
		function showhome(){
            location.href="1209_list.php";
            console.log(location.href);
        }
         function check_uni(uni_data){
			if (uni_data) {
				
				$("#error_Account").html("此帳號已有人使用");
				$("#error_Account").addClass("text-danger");
				flag_Account=false;
			}else{
				
				$("#error_Account").html("此帳號可使用");
				$("#error_Account").removeClass("text-danger");
				$("#error_Account").addClass("text-primary");
				flag_Account=true;
			}
		}

    </script>
  </body>
</html>