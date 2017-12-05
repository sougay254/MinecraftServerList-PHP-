<!-- #編輯伺服器# -->
<?php
@$no = $_GET['n'];
@$id = $_SESSION['nick'];
if ($_SESSION['admin'] == '1'){
@$sql = "SELECT * FROM svList_list WHERE No = '$no'";
}else{
@$sql = "SELECT * FROM svList_list WHERE No = '$no' AND owner = '$id'";
}
@$result3 = mysql_query($sql);
@$row = mysql_fetch_row($result3);
@$cg = $_GET['cg'];
if ($row[0] == null){
$_SESSION['msg'] = "warningeditsv";
?>
<script>document.location.href="../index";</script>
<?php
}else{
$_SESSION['cgno'] = $no;
?>
<p></p>
<div id="error" class="alert alert-warning" style="display: none">
<h4>更改失敗</h4>
<ul id="error_info">
</ul>
</div>
<div class="modal-body">
<h4 class="modal-title">編輯【<?php echo $row[1];?>】伺服器</h4>
<div class="mdl-dialog__content">
<form id="editsv" name="editsv" method="post" action="_sql/svm/editsv.php">
<div style="hidden" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" id="no" name="no" required="required" value="<?php echo $row[0]?>" readonly >
<label class="mdl-textfield__label" for="no">伺服器編號...(無法更改)</label>
</div>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" id="name" name="name" required="required"  value="<?php echo $row[1]?>">
<label class="mdl-textfield__label" for="name">伺服器名稱...</label>
</div>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" id="ip" name="ip" required="required" value="<?php echo $row[2]?>">
<label class="mdl-textfield__label" for="ip">伺服器位置(IP)...</label>
</div>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" id="version" name="version" required="required" value="<?php echo $row[7]?>">
<label class="mdl-textfield__label" for="version">伺服器版本...</label>
</div>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="url" id="website" name="website" required="required" value="<?php echo $row[9]?>">
<label class="mdl-textfield__label" for="website">伺服官方網站(請包含http)...(無網站請輸入社團/粉絲專頁)</label>
</div>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" >
<input class="mdl-textfield__input" type="text" id="port" name="port" required="required" value="<?php echo $row[3]?>">
<label class="mdl-textfield__label" for="port">伺服器端口...</label>
</div>
<?php if ($_SESSION['admin'] == '1'){?>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" id="owner" name="owner" required="required" value="<?php echo $row[5]?>" readonly >
<label class="mdl-textfield__label" for="owner">擁有者...</label>
</div>
<?php }?>
<br><br>
<font size='5'>伺服器模式：</font><br>
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="cgoption-1">
<input type="radio" id="cgoption-1" class="mdl-radio__button" name="cgtype" value="1" <?php if ($row[8] == 1){echo 'checked';}?>>
<span class="mdl-radio__label">插件伺服器</span>
</label>		
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="cgoption-2">
<input type="radio" id="cgoption-2" class="mdl-radio__button" name="cgtype" value="2" <?php if ($row[8] == 2){echo 'checked';}?>>
<span class="mdl-radio__label">模組伺服器</span>
</label>		
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="cgoption-3">
<input type="radio" id="cgoption-3" class="mdl-radio__button" name="cgtype" value="3" <?php if ($row[8] == 3){echo 'checked';}?>>
<span class="mdl-radio__label">官方伺服器</span>
</label>		
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="cgoption-4">
<input type="radio" id="cgoption-4" class="mdl-radio__button" name="cgtype" value="4" <?php if ($row[8] == 4){echo 'checked';}?>>
<span class="mdl-radio__label">綜合伺服器</span>
</label>
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-5">
<input type="radio" id="option-5" class="mdl-radio__button" name="cgtype" value="5" <?php if ($row[8] == 5){echo 'checked';}?>>
<span class="mdl-radio__label">PE伺服器</span>
</label>
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-6">
<input type="radio" id="option-6" class="mdl-radio__button" name="cgtype" value="6" <?php if ($row[8] == 6){echo 'checked';}?>>
<span class="mdl-radio__label">小遊戲伺服器</span>
</label>		
<br><br>
<font size="5">更多資訊：</font>
<textarea name="info" id="editor" style="height:250px"><?php echo @$row[6];?></textarea>
<script>
ClassicEditor
	.create( document.querySelector( '#editor' ) )
	.catch( error => {
		console.error( error );
	} );
</script>
<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="enable">
  <input type="checkbox" id="enable" class="mdl-switch__input" name="enable" value="1" <?php if ($row[11] == 1){echo 'checked';}?>>
  <span class="mdl-switch__label">是否啟用</span>
</label>
<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="ipshow">
  <input type="checkbox" id="ipshow" class="mdl-switch__input" name="ipshow" value="1" <?php if ($row[12] == 1){echo 'checked';}?>>
  <span class="mdl-switch__label">是否顯示IP</span>
</label>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" id="ipbecause" name="ipbecause" value="<?php echo @$row[13];?>">
<label class="mdl-textfield__label" for="ipbecause">不顯示原因...(請輸入如何取得管道)</label>
</div><br>
<button type="button" class="btn btn-success" onclick="dcheck()">完成</button>
</form>
</div>
</div>
<script>
function dcheck(){
var error=0;
var name = document.getElementById("name");
var ip = document.getElementById("ip");
var version = document.getElementById("version");
var port = document.getElementById("port");
var form = document.getElementById("editsv");

var errordiv = document.getElementById("error");
var errorcontect = document.getElementById("error_info");
errorcontect.innerHTML = '';
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

if (error!==0){
	errordiv.style.display = "block";
	$("html, body").animate({ scrollTop: 0 }, "fast");
}else{
	form.submit();
}
}
</script>
<?php }?>