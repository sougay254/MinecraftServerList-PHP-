<?php
session_start();
if ($_SERVER['HTTP_HOST'] == 'svlist.amsserver.xyz'){ header('Location: https://server.wartw.top/');
}
if ($_SERVER["HTTPS"]<>"on") { 
$xredir="https://".$_SERVER["SERVER_NAME"]. $_SERVER["REQUEST_URI"]; 
header("Location: ".$xredir);
}
date_default_timezone_set("Asia/Taipei");
include('_msg.php');
include('sql.inc.php');
$url = basename($_SERVER['PHP_SELF']);
if ($url == "index.php" OR $url == null) {
	$bname = "首頁";
}elseif ($url == "dashboard.php") {
	$bname = "控制台";
}elseif ($url == "infosv.php") {
	$bname = "詳細資訊";
}elseif ($url == "users.php") {
	$bname = "會員控制";
}elseif ($url == "onlinereport.php") {
	$bname = "線上回報";
}elseif ($url == "reportlist.php") {
	$bname = "回報列表";
}elseif ($url == 'reportlist_p.php'){
	$bname = "回報列表";
}elseif ($url == 'player_db.php'){
	$bname = "玩家後台";
}elseif ($url == 'svcomment.php'){
	$bname = "玩家留言";
}elseif ($url == 'search.php'){
	$bname = "搜尋功能";
}elseif ($url == 'logout.php'){
	$bname = "登出";
}elseif ($url == 'about.php'){
	$bname = "關於作者 / 版權聲明";
}elseif ($url == 'bc_system.php'){
	$bname = "管理公告系統";
}elseif ($url == 'loginlog.php'){
	$bname = "登入紀錄";
}elseif ($url == 'instant_query.php'){
	$bname = "即時查詢";
}elseif ($url == 'tos.php'){
	$bname = "服務條款";
}else{
	$bname = "404";
}?>
<!DOCTYPE html>
<html prefix="og:http://ogp.me/ns#" lang="zh_TW" class="mdl-js">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
	<title><?php echo $bname.' » '.$info['web']['title'];?></title>
	<link rel="Shortcut Icon" type="image/x-icon" href="./favicon.ico" />
	<!-- #CSS# -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
	<link rel="stylesheet" href="_css/styles.css">
	<link rel="stylesheet" href="_css/material.css">
	<link rel="stylesheet" href="_css/bootstrap.css">
	<link rel="stylesheet" href="_css/bootstrap2.css">
	<!-- #CSS# -->
	<meta property="article:author" content="https://www.facebook.com/asuna.michael/" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="" />
    <meta property="og:site_name" content="" />
	<!-- #JavaScript# -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script src="_js/material.js"></script>
	<script src="_js/bootstrap.js"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-alpha.1/classic/ckeditor.js"></script>
	<!-- #JavaScript# -->
</head>
<body>
<style>
@font-face {
	font-family:"Minecraft Regular";
	src: url("../fonts/minecraft.eot?") format("eot"),
		 url("../fonts/minecraft.woff") format("woff"),
		 url("../fonts/minecraft.ttf") format("truetype"),
		 url("../fonts/minecraft.svg#Minecraft") format("svg");
	font-weight:normal;
	font-style:normal;
}
img {
    width:100%
}
a {
	font-family: Minecraft Regular,sans-serif;
}
</style>
<div class="mdl-layout__container">
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">
		  <?php
		  if ($url == 'index.php'){
			  echo '首頁';
		  }elseif ($url == 'dashboard.php'){
			  echo '控制台';
		  }elseif ($url == 'infosv.php'){
			  echo '詳細資訊';
		  }elseif ($url == 'users.php'){
			  echo '會員控制';
		  }elseif ($url == 'onlinereport.php'){
			  echo '線上回報';
		  }elseif ($url == 'reportlist.php'){
			  echo '回報列表';
		  }elseif ($url == 'reportlist_p.php'){
			  echo '回報列表';
		  }elseif ($url == 'player_db.php'){
			  echo '玩家後台';
		  }elseif ($url == 'svcomment.php'){
			  echo '伺服玩家留言';
		  }elseif ($url == 'search.php'){
			  echo '搜尋功能';
		  }elseif ($url == 'logout.php'){
			  echo '登出';
		  }elseif ($url == 'about.php'){
			  echo '關於作者/版權聲明';
		  }elseif ($url == 'bc_system.php'){
			  echo '管理公告系統';
		  }elseif ($url == 'loginlog.php'){
			  echo '登入紀錄';
		  }elseif ($url == 'mail.php'){
			  echo '管理寄信系統';
		  }elseif ($url == 'instant_query.php'){
			  echo '即時查詢功能';
		  }elseif ($url == 'tos.php'){
			  echo '服務條款';
		  }else{
			  echo '404';
		  }
		  ?>
			 <style>
			#bugreport {
				position: fixed;
				display: block;
				right: 0;
				bottom: 0;
				margin-right: 40px;
				margin-bottom: 40px;
				z-index: 900;
			}
			</style>
		  <noscript><font color="red">請啟用Java Script</font></noscript>
		  </span>
        <div class="mdl-layout-spacer"></div>
        <?php
        if (@$_SESSION['msg'] != null){
        echo '<h2>';
        }
        if (@$_SESSION['msg'] == 'nologin'){
        echo '<b><font color="red">請先登入！</font></b>';			
        }elseif (@$_SESSION['msg'] == 'loginerror'){
        echo '<b><font color="red">登入失敗，帳號密碼錯誤。</font></b>';			
        }elseif (@$_SESSION['msg'] == 'loginnoexist'){
        echo '<b><font color="red">登入失敗，帳號不存在。</font></b>';			
        }elseif (@$_SESSION['msg'] == 'regok'){
        echo '<b><font color="green">註冊成功！請至EMail點選驗證郵件！</font></b>';			
        }elseif (@$_SESSION['msg'] == 'verterror'){
        echo '<b><font color="red">EMail尚未驗證！</font></b>';			
        }elseif (@$_SESSION['msg'] == 'loginok'){
        echo '<b><font color="green">登入成功！</font></b>';			
        }elseif (@$_SESSION['msg'] == 'mail_ok'){
        echo '<b><font color="green">電子郵件已寄出。</font></b>';			
        }elseif (@$_SESSION['msg'] == 'mail_error'){
        echo '<b><font color="red">電子郵件無法寄出。</font></b>';			
        }elseif (@$_SESSION['msg'] == 'accountexist'){
        echo '<b><font color="red">註冊失敗，帳號已存在。</font></b>';			
        }elseif (@$_SESSION['msg'] == 'mailexist'){
        echo '<b><font color="red">註冊失敗，EMail已被註冊。</font></b>';			
        }elseif (@$_SESSION['msg'] == 'nickexist'){
        echo '<b><font color="red">註冊失敗，暱稱已存在。</font></b>';
        }elseif (@$_SESSION['msg'] == 'vok'){
        echo '<b><font color="green">驗證成功！</font></b>';			
        }elseif (@$_SESSION['msg'] == 'cmailok'){
        echo '<b><font color="green">補發驗證信成功！</font></b>';			
        }elseif (@$_SESSION['msg'] == 'verror'){
        echo '<b><font color="red">驗證失敗，請找網站管理員！</font></b>';			
        }elseif (@$_SESSION['msg'] == 'cgsvok'){
        echo '<b><font color="green">成功變更伺服器設定！</font></b>';			
        }elseif (@$_SESSION['msg'] == 'addsvok'){
        echo '<b><font color="green">伺服器新增成功。</font></b>';			
        }elseif (@$_SESSION['msg'] == 'addsvno'){
        echo '<b><font color="red">伺服器新增失敗，請洽詢管理員。</font></b>';	
        }elseif (@$_SESSION['msg'] == 'delsvok'){
        echo '<b><font color="green">伺服器移除成功。</font></b>';	
        }elseif (@$_SESSION['msg'] == 'delsvno'){
        echo '<b><font color="red">伺服器移除失敗<br>此伺服器可能不是你的伺服器。</font></b>';	
        }elseif (@$_SESSION['msg'] == 'pwmail_mailerror'){
        echo '<b><font color="red">忘記密碼驗證信寄送失敗<br>請檢查Mail是否正確。</font></b>';	
        }elseif (@$_SESSION['msg'] == 'pwmail_error'){
        echo '<b><font color="red">忘記密碼驗證信寄送失敗<br>帳號與Email不相同！</font></b>';	
        }elseif (@$_SESSION['msg'] == 'adminpwmail_mailerror'){
        echo '<b><font color="red">[管理員操作]忘記密碼驗證信寄送失敗<br>請檢查Mail是否正確。</font></b>';	
        }elseif (@$_SESSION['msg'] == 'adminpwmail_error'){
        echo '<b><font color="red">[管理員操作]忘記密碼驗證信寄送失敗<br>帳號與Email不相同！</font></b>';	
        }elseif (@$_SESSION['msg'] == 'cgpwnov'){
        echo '<b><font color="red">無驗證碼。！</font></b>';		
        }elseif (@$_SESSION['msg'] == 'noserver'){
        echo '<b><font color="red">找不到伺服器(可能是已經被隱藏了!)。</font></b>';
        }elseif (@$_SESSION['msg'] == 'pwcgok'){
        echo '<b><font color="green">成功更改密碼。</font></b>';
        }elseif (@$_SESSION['msg'] == 'pwcgno'){
        echo '<b><font color="red">更改密碼失敗，請檢查驗證碼正確。</font></b>';
        }elseif (@$_SESSION['msg'] == 'nopex'){
        echo '<b><font color="red">您沒有權限讀取此頁面。</font></b>';
        }elseif (@$_SESSION['msg'] == 'vadminok'){
        echo '<b><font color="green">[管理員操作]人工驗證成功。</font></b>';
        }elseif (@$_SESSION['msg'] == 'adminverror'){
        echo '<b><font color="red">[管理員操作]寄信失敗，請檢查程式碼。</font></b>';
        }elseif (@$_SESSION['msg'] == 'adminpwmail_ok'){
        echo '<b><font color="green">[管理員操作]寄信成功。</font></b>';
        }elseif (@$_SESSION['msg'] == 'delpok'){
        echo '<b><font color="green">[管理員操作]移除會員成功。</font></b>';
        }elseif (@$_SESSION['msg'] == 'delpno'){
        echo '<b><font color="red">[管理員操作]移除會員失敗。</font></b>';
        }elseif (@$_SESSION['msg'] == 'cgpok'){
        echo '<b><font color="green">[管理員操作]更改會員成功。</font></b>';
        }elseif (@$_SESSION['msg'] == 'cgpno'){
        echo '<b><font color="red">[管理員操作]更改會員失敗。</font></b>';
        }elseif (@$_SESSION['msg'] == 'addopok'){
        echo '<b><font color="green">回報成功，請等待回復。</font></b>';
        }elseif (@$_SESSION['msg'] == 'adminreok'){
        echo '<b><font color="green">[管理員操作]回覆成功。</font></b>';
        }elseif (@$_SESSION['msg'] == 'adminreno'){
        echo '<b><font color="red">[管理員操作]回覆失敗。</font></b>';
        }elseif (@$_SESSION['msg'] == 'adminreno'){
        echo '<b><font color="red">回報失敗。</font></b>';
        }elseif (@$_SESSION['msg'] == 'delopok'){
        echo '<b><font color="green">[管理員操作]移除回報資料成功。</font></b>';
        }elseif (@$_SESSION['msg'] == 'delopok'){
        echo '<b><font color="red">[管理員操作]移除回報資料失敗。</font></b>';
        }elseif (@$_SESSION['msg'] == 'cgpwerror_pw'){
        echo '<b><font color="red">更改密碼失敗，舊密碼錯誤。</font></b>';
        }elseif (@$_SESSION['msg'] == 'cgpwok'){
        echo '<b><font color="green">更改密碼成功。</font></b>';
        }elseif (@$_SESSION['msg'] == 'cgpwno'){
        echo '<b><font color="red">更改密碼失敗。</font></b>';
        }elseif (@$_SESSION['msg'] == 'addcomok'){
        echo '<b><font color="green">新增留言成功。</font></b>';
        }elseif (@$_SESSION['msg'] == 'addcomno'){
        echo '<b><font color="red">新增留言失敗。</font></b>';
        }elseif (@$_SESSION['msg'] == 'delcomok'){
        echo '<b><font color="green">移除留言成功。</font></b>';
        }elseif (@$_SESSION['msg'] == 'photook'){
        echo '<b><font color="green">更換大頭貼成功！</font></b>';
        }elseif (@$_SESSION['msg'] == 'accountlock'){
        echo '<b><font color="red">帳號已遭到鎖定，請詢問管理員。</font></b>';
        }elseif (@$_SESSION['msg'] == 'warningeditsv'){
        echo '<b><font color="red">禁止嘗試更改他人資料。違規紀錄+1</font></b>';
        @$id = @$_SESSION['id'];
        @$a = "SELECT * FROM svList_account WHERE account = '$id'";
        @$b = mysql_query($a);
        @$row1 = mysql_fetch_row($b);
        @$brules = $row1[8];
        @$brules += 1;
        mysql_query("UPDATE svList_account SET `brule`= $brules WHERE account = '$id'");
        }elseif (@$_SESSION['msg'] == 'addbcok'){
        echo '<b><font color="green">[管理員操作]新增公告成功。</font></b>';
        }elseif (@$_SESSION['msg'] == 'addbcno'){
        echo '<b><font color="red">[管理員操作]新增公告失敗。</font></b>';
        }elseif (@$_SESSION['msg'] == 'cgbcok'){
        echo '<b><font color="green">[管理員操作]編輯公告成功。</font></b>';
        }elseif (@$_SESSION['msg'] == 'cgbcno'){
        echo '<b><font color="red">[管理員操作]編輯公告失敗。</font></b>';
        }elseif (@$_SESSION['msg'] == 'delbcok'){
        echo '<b><font color="green">[管理員操作]移除公告成功。</font></b>';
        }elseif (@$_SESSION['msg'] == 'delbcno'){
        echo '<b><font color="red">[管理員操作]移除公告失敗。</font></b>';
        }elseif (@$_SESSION['msg'] == 'noaccount'){
        echo '<b><font color="red">無此帳號。</font></b>';
        }elseif (@$_SESSION['msg'] == 'photojpg'){
        echo '<b><font color="red">請上傳僅支援的圖檔。</font></b>';
        }
        if (@$_SESSION['msg'] != null){
        echo '</h2>';
        }
        unset($_SESSION['msg']); 
        ?>
        </div>
      </header>
      <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
	  <header class="demo-drawer-header">
	  <?php
      @$id = @$_SESSION['id'];
		if (@$_SESSION['id'] != null){
            if(is_file('_img/'.$id.'.png')){
            echo '<img src="_img/'.@$_SESSION['id'].'.png" class="demo-avatar">';
            }else{
        echo '<img src="_img/default.png" class="demo-avatar">';}}
                
        ?>
          <div class="demo-avatar-dropdown">
            <span><?php if (@$_SESSION['admin'] == null){echo '遊客';}else{echo @$_SESSION['nick'];}?></span>
            <div class="mdl-layout-spacer"> ,Welcome</div>功能
            <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
              <i class="material-icons" role="presentation">arrow_drop_down</i>
            </button>
            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
			<?php if (@$_SESSION['admin'] == null){?>
              <li><a class="mdl-menu__item" href="dashboard?c=login">登入 SignIn</a></li>
              <li><a class="mdl-menu__item" href="dashboard?c=register">註冊 SignUp</a></li>
			<?php }else{?>
		      <li><a class="mdl-menu__item" href="logout">登出</a></li>
			<?php }?>
            </ul>
          </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
		<a class="mdl-navigation__link" href="index"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>首頁</a>
		<a class="mdl-navigation__link" href="dashboard"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">dns</i>控制台</a>
        <a class="mdl-navigation__link" href="search"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">search</i>搜尋功能</a>
        <a class="mdl-navigation__link" href="instant_query"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">cloud_download</i>即時查詢</a>
		<?php if (@$_SESSION['admin'] == '1'){?>
		<a class="mdl-navigation__link" href="users"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">person</i>會員控制</a>
		<a class="mdl-navigation__link" href="reportlist"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">bug_report</i>回報列表</a>
        <a class="mdl-navigation__link" href="bc_system"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">label</i>管理公告系統</a>
		<?php } ?>
		<?php if (@$_SESSION['admin'] == '0' OR @$_SESSION['admin'] == '1'){?>
		<a class="mdl-navigation__link" href="reportlist_p"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">feedback</i>回報列表</a>
        <a class="mdl-navigation__link" href="loginlog"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">https</i>登入紀錄</a>
		<a class="mdl-navigation__link" href="player_db"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">account_circle</i>玩家後台</a>
		<?php }?>
        <a class="mdl-navigation__link" href="about"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">info</i>關於作者</a>
        <a class="mdl-navigation__link" href="tos">服務條款 &amp; CopyRight</i></a>
        </nav>
      </div>
<?php
      if ($url == 'index.php'){
		  include('action/index.php');
		  }elseif ($url == 'dashboard.php'){
		  include('action/dashboard.php');
		  }elseif ($url == 'infosv.php'){
		  include('action/infosv.php');
		  }elseif ($url == 'users.php'){
		  include('action/users.php');
		  }elseif ($url == 'onlinereport.php'){
		  include('action/onlinereport.php');
		  }elseif ($url == 'reportlist.php'){
		  include('action/reportlist.php');
		  }elseif ($url == 'reportlist_p.php'){
		  include('action/reportlist_p.php');
		  }elseif ($url == 'player_db.php'){
		  include('action/player_db.php');
		  }elseif ($url == 'svcomment.php'){
		  include('action/svcomment.php');
		  }elseif ($url == 'search.php'){
		  include('action/search.php');
		  }elseif ($url == 'logout.php'){
		  include('action/logout.php');
		  }elseif ($url == 'about.php'){
		  include('action/about.php');
		  }elseif ($url == 'bc_system.php'){
		  include('action/bc_system.php');
		  }elseif ($url == 'loginlog.php'){
		  include('action/loginlog.php');
		  }elseif ($url == 'mail.php'){
		  include('action/mail.php');
		  }elseif ($url == 'instant_query.php'){
		  include('action/instant_query.php');
		  }elseif ($url == 'tos.php'){
		  include('action/tos.php');
		  }else{
		  include('action/404.php');
		  }?>
	 </div>
</div>
	  <a href="#" id="bugreport" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored mdl-color-text--white" onclick="location.href='onlinereport'">Report蟲蟲</a>
