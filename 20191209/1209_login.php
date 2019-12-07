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
    <title>login</title>
    <style>
      body{
            background-color: #f0ff70;
        }
    </style>
  </head>
  <body>

 <section class="py-4">
	 <div class="container text-center">
	 	<div class="row">
	 		<h2 class="col-sm-12 text-center font-weight-bold text-info">登入會員</h2>
	 	</div>
	 </div>
 </section>

<section class=" py-4">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
		        <form>
			 	    <div class="form-group">
					    <label for="Account">帳號</label>
					    <input type="text" class="form-control" id="Account" placeholder="">
						<div id="uni_check"></div>
				    </div>
					<div class="form-group">
					    <label for="Password">密碼</label>
					    <input type="password" class="form-control" id="Password" placeholder="">
						<div id="psd_check"></div>
					</div>
					<div class="text-center">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cnl">取消</button>
				        <button type="button" class="btn btn-info" id="btn_login">登入</button>
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

	$(function(){ 

			//$("#btn_login").bind("click",to_api);
			$("#cnl").bind("click",showhome);

// 即時監聽帳號--------------------------------------------------------------
			$("#Account").bind("input propertychange",function(){
				if ($(this).val().length == "") {
					$("#uni_check").html("不可空白");
					$("#uni_check").addClass("text-danger");
					flag_Account=false;
				}else{
					$("#uni_check").html("");
					flag_Account=true;
				}
			});

// 密碼-----------------------------------------------------------------------
			$("#Password").bind("input propertychange",function(){
				if ($(this).val().length == "") {
					$("#psd_check").html("不可空白");
					$("#psd_check").addClass("text-danger");
					flag_Password=false;
				}else{
					$("#psd_check").html("");
					flag_Password=true;
				}
			});

// login------------------------------------------------------------------------
			$("#btn_login").bind('click',function(){
				if (flag_Account && flag_Password) {
					$.ajax({
						type:"GET",
						url:"1209_login_api.php",
						data:{Account:$("#Account").val(),Password:$("#Password").val()},
						success:show_login,
						error:function(){
							alert("loginin_api_ERROR");
						}
					});
				}else{
					alert("欄位不可空白")
				}
			});
		});
		function show_login(data_login){
			if (data_login) {
				alert("400(StatusBadRequest)");
				location.href="1209_login.php";
			}else{
				alert("200(StatusOK)");
				location.href="1209_change.php";
			}
		}
		
        function showhome(){
            location.href="1209_change.php";
            console.log(location.href);
        }

    </script>
  </body>
</html>