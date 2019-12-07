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
    <title>change</title>
    <style>
      body{
            background-color: #f0ff70;
        }
    </style>
  </head>

  <body>

    <div class="container py-3">
        <div class="row">
            <div class="col-sm-12">
                <table class="table bg-secondary table-bordered table-sm">
                    <!-- 標題 -->
                    <thead class="thead-secondary text-center text-light">
                        <tr>
                            <th>帳號</th>
                            <th>修改</th>
                            <th>刪除</th>
                        </tr>
                    </thead>
                    <tbody id="send">
                        <tr class="table-light">
                            <td>帳號</td>
                            <td>修改</td>
                            <td>刪除</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

   <!-- 更改密碼-dialog -->
  <div class="modal fade" id="for_Password" tabindex="-1" role="dialog" aria-labelledby="for_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="for_modal">密碼修改</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <form>
             <div class="form-group">
                 <label for="Account">帳號</label>
                 <input type="text" class="form-control" id="Account" placeholder="" readonly>
              </div>
              <div class="form-group">
                 <label for="Password">請輸入新密碼</label>
                 <input type="password" class="form-control" id="Password" placeholder="">
                 <div id="error_Password"></div>
              </div>
              <div class="form-group mt-2">
                 <label for="Password2">請確認新密碼</label>
                 <input type="password" class="form-control" id="Password2" placeholder="">
                 <div id="error_Password2"></div>
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">取消</button>
          <button type="button" class="btn btn-primary" id="send_mode" onclick="update_OK()">確定</button>
        </div>
      </div>
    </div>
  </div>
  

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <script src="js/jquery-3.3.1.min.js"></script>   
    
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>

    <script>

    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };

    var flag_Password = false;
    var flag_Password2 = false;

      $(function(){
            $.ajax({
                type:"GET",
                url:"1209_list_api.php",
                dataType:"json",
                success:show,
                error:function(){
                    alert("1209_list_api ERROR!!");
                }
            });
        });
     function show(data){
         //console.log(data.length);
            $("#send").empty();
            for(i=0;i<data.length;i++){
                strHTML='';

                strHTML='<tr class="table-light"><td>'+data[i].Account+'</td><td><button class="btn-light" onclick=update_item("'+data[i].ID+'") data-toggle="modal" data-target="#for_Password">修改</button></td><td><button class="btn-info" id="del" data-id="'+data[i].ID+'" onclick=delete_item("'+data[i].ID+'")>刪除</button></td></tr>';
                
                $("#send").append(strHTML);
            }
        }

      function update_item(id){
          //alert(id);
          dataID=getUrlParameter('ID');
          $.ajax({
            type:"POST",
            url:"1209_change2_api.php",
            data:{ID:id},
            dataType:"json",
            success:show_one,
            error:function(){
              alert("1209_change2_api ERROR");
              }
            });            
            // location.href="login_update_mode.php?ID="+id;
        }

      function show_one(data){
        //alert(data.length);
        $("#Account").val(data[0].Account);
        $("#send_mode").attr("data-id",data[0].ID);
      }

   $(function(){

    $("#cancel").bind('click',showhome);
        
      $("#Password").bind("input propertychange",function(){
        if ($(this).val().length<=0) {
          $("#error_Password").html("密碼不得空白");
          $("#error_Password").css("color","red");
          flag_Password=false;
        }else{
          $("#error_Password").html("");
          flag_Password=true;
        }
        if ($(this).val()!=$("#Password2").val()) {
          $("#error_Password2").html("密碼輸入不相同");
          $("#error_Password2").css("color","red");
          flag_Password2=false;
        }else{
          $("#error_Password2").html("密碼符合");
          $("#error_Password2").css("color","green");
          flag_Password2=true;
        }
      });
      $("#Password2").bind("input propertychange",function(){
        if ($(this).val()!=$("#Password").val()) {
          $("#error_Password2").html("密碼輸入不相同");
          $("#error_Password2").css("color","red");
          flag_Password2=false;
        }else{
          $("#error_Password2").html("密碼符合");
          $("#error_Password2").css("color","green");
          flag_Password2=true;
        }
      });

    });

      function update_OK(){
            if (flag_Password && flag_Password2 == true) {
                if (confirm("確定更新?")){
                  $.ajax({
                    type: "POST",
                    url: "1209_change_api.php",
                    data: {ID: $("#send_mode").data("id"), Password:$("#Password").val()},
                    success:show_update,
                    error:function(){
                      alert("1209_change_api ERROR");
                    }
                  });
                }
            }else{
                alert("輸入錯誤!!");
            }
        }
        function showhome(){
            location.href="1209_change.php";
        }
        function show_update(data){
            if (data) {
                alert("更新成功");
                location.href="1209_change.php";
              }else{
                alert("更新失敗");
              }
        }


      function delete_item(id){

        dataID=getUrlParameter('ID');

           if (confirm("確認刪除?")) {
                
                $.ajax({
                    type:"POST",
                    url:"1209_delete_api.php",
                    data:{ID:id},
                    success:show_del,
                    error:function(){
                        alert("1209_delete_api error");
                    }
                });
            }
        }
        function show_del(data){
            alert(data);
            location.href="1209_change.php";
        }

    </script>
  </body>
</html>