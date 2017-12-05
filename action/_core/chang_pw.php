
<h2>更改密碼</h2>
<?php $_SESSION['v'] = @$_GET['v'];
if ($_GET['v'] == null ){
$_SESSION['msg'] == 'cgpwnov';
header("Location: ../dashboard"); 
exit;
}else{?>
<div id="error" class="alert alert-warning" style="display: none">
<h4>驗證失敗</h4>
<ul id="error_info">
</ul>
</div>
<form id="cgpw" action="_sql/changpw.php" method="POST">
若無驗證碼請從電子郵件開啟。
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="v" id="v" name="v" value="<?php echo @$_GET['v'];?>" readonly >
    <label class="mdl-textfield__label" for="v">驗證碼</label>
  </div>
  <br>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="account" id="account" name="account" value="<?php echo @$_GET['id'];?>" readonly >
    <label class="mdl-textfield__label" for="account">帳號</label>
  </div>
  <br>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="password" id="password" name="password" required="required">
    <label class="mdl-textfield__label" for="password">新密碼</label>
  </div>
  <br>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="password" id="passwAgain" name="passwAgain" required="required">
    <label class="mdl-textfield__label" for="passwAgain">重複密碼</label>
  </div>
  <br>
	<div class="form-group" id="googlered">
	<label class="control-label">小驗證</label>
	<div id="googlere" class="g-recaptcha" data-sitekey="## Google 驗證API ##" value="1"></div>
	</div>
  <button class="mdl-button mdl-js-button mdl-button--primary" type="button" onclick="mailcheck()">送出</button>
</form>
<script>
function mailcheck(){
var error=0;
var account = document.getElementById("account");
var password = document.getElementById("password");
var passwAgain = document.getElementById("passwAgain");
var form = document.getElementById("cgpw");
var errordiv = document.getElementById("error");
var errorcontect = document.getElementById("error_info");
errorcontect.innerHTML = '';
var googlere = grecaptcha.getResponse();
if(googlere.length == 0){
    error += 1;
	errorcontect.innerHTML += "<li>Google reCAPTCHA 未驗證</li>";
}
if (account.value==''){
	error +=1
	errorcontect.innerHTML += "<li>請輸入帳號</li>";
}
if (password.value==''){
	error +=1
	errorcontect.innerHTML += "<li>請輸入密碼</li>";
}
if (passwAgain.value==''){
	error +=1
	errorcontect.innerHTML += "<li>請輸入重複密碼</li>";
}
if (password.value !== passwAgain.value){
	error +=1
	errorcontect.innerHTML += "<li>密碼不相同</li>";
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