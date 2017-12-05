<h2>帳號登入</h2>
<div id="error" class="alert alert-warning" style="display: none">
<h4>登入失敗</h4>
<ul id="error_info">
</ul>
</div>
<form id="login" action="_sql/login_action" method="POST">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="text" id="account" name="account">
    <label class="mdl-textfield__label" for="account">帳號</label>
  </div>
  <br>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="password" id="password" name="password">
    <label class="mdl-textfield__label" for="password">密碼</label>
  </div>
  <br>
	<div class="form-group" id="googlered">
	<h3>小驗證</h3>
	<div id="googlere" class="g-recaptcha" data-sitekey="## Google 驗證API ##" value="1"></div>
	</div>
  <button class="mdl-button mdl-js-button mdl-button--primary" type="button">登入</button>
</form>
<script>
function logcheck(){
var error=0;
var id = document.getElementById("account");
var pw = document.getElementById("password");
var form = document.getElementById("login");
var errordiv = document.getElementById("error");
var errorcontect = document.getElementById("error_info");
errorcontect.innerHTML = '';
var googlere = grecaptcha.getResponse();
if(googlere.length == 0){
    error += 1;
	errorcontect.innerHTML += "<li>Google reCAPTCHA 未驗證</li>";
}
if (id.value==''){
	error +=1
	errorcontect.innerHTML += "<li>請輸入帳號</li>";
}
if (pw.value==''){
	error +=1
	errorcontect.innerHTML += "<li>請輸入密碼</li>";
}
if (error!==0){
	errordiv.style.display = "block";
}else{
form.submit();
}
}
</script>