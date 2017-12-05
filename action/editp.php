<!-- #編輯會員# -->
<?php
$no = $_GET['n'];
if ($_SESSION['admin'] != '1'){
$_SESSION['msg'] == 'nopex';
?>
<script>document.location.href="../index";</script>
<?php
}else{
$sql7 = "SELECT * FROM svList_account WHERE No = '$no'";
@$result7 = mysql_query($sql7);
@$row = mysql_fetch_row($result7);
?>
<p></p>
<div id="error" class="alert alert-warning" style="display: none">
<h4>更改失敗</h4>
<ul id="error_info">
</ul>
</div>
<div class="modal-body">
<h4 class="modal-title">編輯【<?php echo $row[1];?>】會員</h4>
<div class="mdl-dialog__content">
<form id="editp" name="editp" method="post" action="_sql/updatep.php">
<div style="hidden" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" id="no" name="no" required="required" value="<?php echo $row[0]?>" readonly >
<label class="mdl-textfield__label" for="no">註冊編號...(無法更改)</label>
</div>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" id="account" name="account" required="required"  value="<?php echo $row[1]?>">
<label class="mdl-textfield__label" for="account">帳號...</label>
</div>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" id="nick" name="nick" required="required" value="<?php echo $row[3]?>">
<label class="mdl-textfield__label" for="nick">暱稱...</label>
</div>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" id="email" name="email" required="required" value="<?php echo $row[4]?>">
<label class="mdl-textfield__label" for="email">EMail...</label>
</div>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" id="verification" name="verification" required="required" value="<?php echo $row[5]?>">
<label class="mdl-textfield__label" for="verification">註冊驗證碼...</label>
</div>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" id="admin" name="admin" required="required" value="<?php echo $row[6]?>">
<label class="mdl-textfield__label" for="admin">管理員...</label>
</div>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" id="vpw" name="vpw" required="required" value="<?php echo $row[7]?>">
<label class="mdl-textfield__label" for="vpw">更換密碼驗證碼...</label>
</div>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" id="brule" name="brule" required="required" value="<?php echo $row[8]?>">
<label class="mdl-textfield__label" for="brule">違規次數...</label>
</div>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" id="locked" name="locked" required="required" value="<?php echo $row[9]?>">
<label class="mdl-textfield__label" for="locked">鎖定帳號...</label>
</div>
<br>
<button type="button" class="btn btn-success" onclick="dcheck()">完成</button>
</form>
</div>
</div>
</div>
<script>
function dcheck(){
var error=0;
var account = document.getElementById("account");
var nick = document.getElementById("nick");
var email = document.getElementById("email");
var form = document.getElementById("editp");

var errordiv = document.getElementById("error");
var errorcontect = document.getElementById("error_info");
errorcontect.innerHTML = '';
if (account.value==''){
	error +=1
	errorcontect.innerHTML += "<li>請輸入帳號</li>";
}
if (nick.value==''){
	error +=1
	errorcontect.innerHTML += "<li>請輸入暱稱</li>";
}
if (email.value==''){
	error +=1
	errorcontect.innerHTML += "<li>請輸入EMail</li>";
}

if (error!==0){
	errordiv.style.display = "block";
	$("html, body").animate({ scrollTop: 0 }, "fast");
}else{
	form.submit();
}
}
</script>
<?php }?>