<main class="mdl-layout__content mdl-color--grey-100">
<div class="mdl-dialog__content">
<h5>個人資料</h5>
<?php
$id = $_SESSION['id'];
$sql = "SELECT * FROM svList_account WHERE account = '$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
?>
<table class="table">
<thead>
<tr>
<th>
<?php echo $row[3];?>,您好。
</th>
</tr>
</thead>
<tbody>
<tr>
<th>帳號</th>
<th><?php echo $row[1];?></th>
<th><button class="btn btn-outline-danger" type="button" disabled>無法更改</button></th>
</tr>
<tr>
<th>密碼</th>
<th><?php echo 'xxx';?></th>
<th><button class="btn btn-outline-success" type="button" onclick="location.href='?editpw=true'">點擊更換</button></th>
</tr>
<tr>
<th>電子郵件</th>
<th><?php echo $row[4];?></th>
<th><button class="btn btn-outline-danger" type="button" disabled>無法更改</button></th>
</tr>
<tr>
<th>管理員</th>
<th><?php if ($row[6] == 1){echo '是';}else{echo '否';}?></th>
<th></th>
</tr>
<tr>
<th>違規次數</th>
<th><?php if ($row[8] == 0){echo '無違規';}else{echo $row[8];}?></th>
<th></th>
</tr>
<tr>
<th>大頭貼</th>
<th><a href="_img/<?php echo @$_SESSION['id'];?>.png">查看</a></th>
<th><button class="btn btn-outline-success" type="button" onclick="location.href='?photo=true'">點擊更換</button></th>
</tr>
</tbody>
</table>
<?php if (@$_GET['editpw'] == 'true'){?>
<form id="editpw" name="editpw" method="post" action="_sql/editpw.php">
<div id="error" class="alert alert-warning" style="display: none">
<h4>更改失敗</h4>
<ul id="error_info">
</ul>
</div>
<h2>更換密碼</h2>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="password" id="oldpw" name="oldpw">
    <label class="mdl-textfield__label" for="oldpw">舊密碼...</label>
  </div><br>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="password" id="newpw" name="newpw">
    <label class="mdl-textfield__label" for="newpw">新密碼...</label>
  </div><br>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="password" id="newpw2" name="newpw2">
    <label class="mdl-textfield__label" for="newpw2">重複新密碼...</label>
  </div><br>
<button type="button" class="btn btn-success" onclick="dcheck()">完成</button>
</form>
<script>
function dcheck(){
var error=0;
var oldpw = document.getElementById("oldpw");
var newpw = document.getElementById("newpw");
var newpw2 = document.getElementById("newpw2");

var form = document.getElementById("editpw");

var errordiv = document.getElementById("error");
var errorcontect = document.getElementById("error_info");
errorcontect.innerHTML = '';
if (oldpw.value==''){
	error +=1
	errorcontect.innerHTML += "<li>請輸入舊密碼</li>";
}
if (newpw.value==''){
	error +=1
	errorcontect.innerHTML += "<li>請輸入新密碼</li>";
}
if (newpw.value !== newpw2.value){
	error +=1
	errorcontect.innerHTML += "<li>新密碼不相符</li>";
}


if (error!==0){
	errordiv.style.display = "block";
	$("html, body").animate({ scrollTop: 0 }, "fast");
}else{
	form.submit();
}
}
</script>
<?php }elseif(@$_GET['photo'] == 'true'){
    ?>
<div class="mdl-dialog__content">
<h2>更換大頭貼//圖片檔案僅支援(PNG/JPG/JPEG/BMP)</h2>
<form action="./action/upload.php" method="post" enctype="multipart/form-data">
之前的將會直接覆蓋<br><input class="btn btn-outline-success" type="file" name="file" id="file" />
<input class="btn btn-info" type="submit" name="submit" value="上傳檔案" />
    <?php
}?>
<?php include('ad.php'); ?>
</div>
</main>