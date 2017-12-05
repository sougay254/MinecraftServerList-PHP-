<!-- #新增伺服器# -->
<div id="error" class="alert alert-warning" style="display: none">
<h4>新增失敗</h4>
<ul id="error_info">
</ul>
</div>
<div class="modal-body">
<h4 class="modal-title">新增伺服器</h4>
<form id="addsv" name="addsv" method="post" action="_sql/svm/addsv.php">
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" id="name" name="name" required="required">
<label class="mdl-textfield__label" for="name">伺服器名稱...</label>
</div>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" id="ip" name="ip" required="required">
<label class="mdl-textfield__label" for="ip">伺服器位置IP(請務必輸入、不需要加入端口)</label>
</div><br>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" id="version" name="version" required="required">
<label class="mdl-textfield__label" for="version">伺服器版本...</label>
</div>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="url" id="website" name="website" required="required">
<label class="mdl-textfield__label" for="website">伺服官方網站(請包含http)...(無網站請輸入社團/粉絲專頁)</label>
</div><br>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" id="port" name="port" required="required" value="25565">
<label class="mdl-textfield__label" for="port">伺服器端口...</label>
</div>
<br><br>
<font size="5">伺服器模式：</font><br>
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
<input type="radio" id="option-1" class="mdl-radio__button" name="type" value="1" checked>
<span class="mdl-radio__label">插件伺服器</span>
</label>		
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
<input type="radio" id="option-2" class="mdl-radio__button" name="type" value="2">
<span class="mdl-radio__label">模組伺服器</span>
</label>		
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-3">
<input type="radio" id="option-3" class="mdl-radio__button" name="type" value="3">
<span class="mdl-radio__label">官方伺服器</span>
</label>		
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-4">
<input type="radio" id="option-4" class="mdl-radio__button" name="type" value="4">
<span class="mdl-radio__label">綜合伺服器</span>
</label>
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-5">
<input type="radio" id="option-5" class="mdl-radio__button" name="type" value="5">
<span class="mdl-radio__label">PE伺服器</span>
</label>
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-6">
<input type="radio" id="option-6" class="mdl-radio__button" name="type" value="6">
<span class="mdl-radio__label">小遊戲伺服器</span>
</label>		
<br><br>
<font size="5">更多資訊：</font>
<textarea name="info" id="editor">## 介紹內容打在這邊 ，送出前請移除此行 ##</textarea>
<script>
ClassicEditor
	.create( document.querySelector( '#editor' ) )
	.catch( error => {
		console.error( error );
	} );
</script>
<br>
<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="enable">
  <input type="checkbox" id="enable" class="mdl-switch__input" name="enable" value="1" checked>
  <span class="mdl-switch__label">是否啟用</span>
</label>
<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="ipshow">
  <input type="checkbox" id="ipshow" class="mdl-switch__input" name="ipshow" value="1" checked>
  <span class="mdl-switch__label">是否顯示IP</span>
</label>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" id="ipbecause" name="ipbecause">
<label class="mdl-textfield__label" for="ipbecause">不顯示原因...(請輸入如何取得管道)</label>
</div>
<br>
<div class="form-group" id="googlered">
  <label class="control-label">小驗證</label>
<div id="googlere" class="g-recaptcha" data-sitekey="6Ld_vysUAAAAADl-81kZtvSIltK0llnztnC7ULyU" value="1"></div>
</div>
<button type="button" class="btn btn-success" onclick="dcheck()">完成</button>
</form>
</div>
<script>
function dcheck(){
var error=0;
var name = document.getElementById("name");
var ip = document.getElementById("ip");
var version = document.getElementById("version");
var port = document.getElementById("port");
var form = document.getElementById("addsv");
var website = document.getElementById("website");

var errordiv = document.getElementById("error");
var errorcontect = document.getElementById("error_info");
errorcontect.innerHTML = '';
var googlere = grecaptcha.getResponse();
if(googlere.length == 0){
    error += 1;
	errorcontect.innerHTML += "<li>Google reCAPTCHA 未驗證</li>";
}
if (name.value==''){
	error +=1
	errorcontect.innerHTML += "<li>請輸入伺服器名稱</li>";
}
if (ip.value==''){
	error +=1
	errorcontect.innerHTML += "<li>請輸入連線位置</li>";
}
if (version.value==''){
	error +=1
	errorcontect.innerHTML += "<li>請輸入版本</li>";
}
if (port.value == ''){
	error +=1
	errorcontect.innerHTML += "<li>請輸入端口</li>";
}
if (website.value == ''){
	error +=1
	errorcontect.innerHTML += "<li>請輸入伺服器網站</li>";
}

if (error!==0){
	errordiv.style.display = "block";
	$("html, body").animate({ scrollTop: 0 }, "fast");
}else{
	form.submit();
}
}
</script>