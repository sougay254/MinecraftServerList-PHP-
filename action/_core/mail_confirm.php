<h2>補發驗證信</h2>
<div id="error" class="alert alert-warning" style="display: none">
<h4>寄送失敗</h4>
<ul id="error_info">
</ul>
</div>
<form id="email_c" action="_sql/mail_confirm" method="POST">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="text" id="account" name="account">
    <label class="mdl-textfield__label" for="account">帳號</label>
  </div>
  <br>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="email" id="email" name="email">
    <label class="mdl-textfield__label" for="email">EMail</label>
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
var id = document.getElementById("account");
var email = document.getElementById("email");
var form = document.getElementById("email_c");
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
if (email.value==''){
	error +=1
	errorcontect.innerHTML += "<li>請輸入Mail</li>";
}
if (error!==0){
	errordiv.style.display = "block";
	$("html, body").animate({ scrollTop: 0 }, "fast");
}else{
form.submit();
}
}
</script>