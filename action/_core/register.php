<h2>帳號註冊</h2>
<div id="error" class="alert alert-warning" style="display: none">
<h4>註冊失敗</h4>
<ul id="error_info">
</ul>
</div>
<form id="register" action="_sql/register_check" method="POST">
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
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="password" id="PasswdAgain" >
    <label class="mdl-textfield__label" for="PasswdAgain">確認密碼</label>
  </div>
  <br>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="email" id="mail" name="email">
    <label class="mdl-textfield__label" for="mail">電子郵件(驗證用)若亂填寫收不到驗證信請自行負責。</label>
  </div>
  <br>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="text" id="nick" name="nick">
    <label class="mdl-textfield__label" for="nick">暱稱</label>
  </div>
  <br>
  <div class="form-group" id="googlered">
  <label class="control-label">小驗證</label>
<div id="googlere" class="g-recaptcha" data-sitekey="## Google 驗證API ##" value="1"></div>
</div>
  <label class="control-label">註冊後表示您將同意本網站之<a href="tos" target="_blank">服務條款</a></label>
  <input id="sbmit" class="btn btn-outline-success" type="submit" onclick="regcheck()" value="註冊"/>
</form>
<script>
function regcheck(){
var error=0;
var id = document.getElementById("account");
var pw = document.getElementById("password");
var pw2 = document.getElementById("PasswdAgain");
var mail = document.getElementById("mail");
var nick = document.getElementById("nick");
//
var form = document.getElementById("register");
//
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
}else if (pw.value !== pw2.value){
	error +=1
	errorcontect.innerHTML += "<li>確認密碼輸入錯誤</li>";
}
if (mail.value==''){
	error +=1
	errorcontect.innerHTML += "<li>請輸入電子郵件</li>";
}
if (nick.value==''){
	error +=1
	errorcontect.innerHTML += "<li>請輸入暱稱</li>";
}
if (error!==0){
	errordiv.style.display = "block";
	$("html, body").animate({ scrollTop: 0 }, "fast");
}else{
	document.getElementById('sbmit').className = "btn btn-outline-danger disabled";
	document.getElementById('sbmit').value = "請等待...";
    form.submit();
}
}
</script>