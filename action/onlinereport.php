<?php
if (@$_SESSION['admin'] == null){
$_SESSION['msg'] = 'nologin';	
?>
<script>document.location.href="../index";</script>
<?php }else{ ?>
<main class="mdl-layout__content mdl-color--grey-100">
<div class="mdl-dialog__content">
<h5>線上回報系統</h5>
<div id="error" class="alert alert-warning" style="display: none">
<h4>回報失敗</h4>
<ul id="error_info">
</ul>
</div>
<form id="onliner" name="onliner" method="post" action="_sql/addop.php">
  <div class="mdl-textfield mdl-js-textfield">
    <textarea class="mdl-textfield__input" type="text" rows= "3" id="contect" name="contect"></textarea>
    <label class="mdl-textfield__label" for="contect">回報內容...</label>
  </div>
<button type="button" class="btn btn-success" onclick="dcheck()">完成</button>
<script>
function dcheck(){
var error=0;
var contect = document.getElementById("contect");
var form = document.getElementById("onliner");

var errordiv = document.getElementById("error");
var errorcontect = document.getElementById("error_info");
errorcontect.innerHTML = '';
if (contect.value==''){
	error +=1
	errorcontect.innerHTML += "<li>請輸入內容</li>";
}

if (error!==0){
	errordiv.style.display = "block";
	$("html, body").animate({ scrollTop: 0 }, "fast");
}else{
	form.submit();
}
}
</script>
</form>
</div>
</main>
<?php } ?>