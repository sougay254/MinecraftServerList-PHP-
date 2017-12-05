<?php
if ($_SESSION['admin'] == 0 OR $_SESSION['admin'] == null){
$_SESSION['msg'] == 'nopex';
Header("Location: ../index");
exit;
}else{
$no = $_GET['no'];
$sql ="SELECT * FROM svList_op WHERE no = $no";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);?>
<main class="mdl-layout__content mdl-color--grey-100">
<div class="mdl-dialog__content">
<h5>管理回覆系統</h5>
<div id="error" class="alert alert-warning" style="display: none">
<h4>回報失敗</h4>
<ul id="error_info">
</ul>
</div>
<form id="onliner" name="onliner" method="post" action="_sql/adminre.php">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="text" id="no" name="no" value="<?php echo $row[0];?>">
    <label class="mdl-textfield__label" for="no">編號...</label>
  </div><br>
   <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="text" id="report" name="report" value="<?php echo @$row[2];?>">
    <label class="mdl-textfield__label" for="report">回報者...</label>
  </div><br>
  <div class="mdl-textfield mdl-js-textfield">
    <textarea class="mdl-textfield__input" type="text" rows= "3" id="contect" name="contect" readonly="readonly"><?php echo $row[1];?></textarea>
    <label class="mdl-textfield__label" for="contect">回報內容...</label>
  </div><br>
  <div class="mdl-textfield mdl-js-textfield">
    <textarea class="mdl-textfield__input" type="text" rows= "3" id="adminre" name="adminre" ><?php echo @$row[5];?></textarea>
    <label class="mdl-textfield__label" for="adminre">管理員回覆...</label>
  </div><br>
  <div class="mdl-textfield mdl-js-textfield">
    <input class="mdl-textfield__input" type="text" id="ip" name="ip" value="<?php echo @$row[6];?>" readonly>
    <label class="mdl-textfield__label" for="ip">回報IP...</label>
  </div><br>
<button type="button" class="btn btn-success" onclick="dcheck()">完成</button>
<script>
function dcheck(){
var error=0;
var contect = document.getElementById("adminre");
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
<?php }?>
</div>
</main>
