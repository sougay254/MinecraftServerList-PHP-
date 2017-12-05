<?php
$no = $_GET['no'];
$sql ="SELECT * FROM svList_op WHERE no = $no";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);?>
<main class="mdl-layout__content mdl-color--grey-100">
	<div class="mdl-dialog__content">
	  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		<input class="mdl-textfield__input" type="text" id="no" name="no" value="<?php echo $row[0];?>">
		<label class="mdl-textfield__label" for="no">編號...</label>
	  </div><br>
	  <div class="mdl-textfield mdl-js-textfield">
		<textarea class="mdl-textfield__input" type="text" rows= "3" id="contect" name="contect" readonly="readonly"><?php echo $row[1];?></textarea>
		<label class="mdl-textfield__label" for="contect">回報內容...</label>
	  </div><br>
	  <div class="mdl-textfield mdl-js-textfield">
		<textarea class="mdl-textfield__input" type="text" rows= "3" id="adminre" name="adminre" readonly="readonly"><?php echo @$row[5];?></textarea>
		<label class="mdl-textfield__label" for="adminre">管理員的回覆...</label>
	  </div><br>
	</div>
</main>
