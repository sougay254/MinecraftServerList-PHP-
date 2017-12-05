<?php 
session_start();
$id = $_SESSION['id'];
if(!is_file(@$id.'.png')){
echo '<img src="_img/'.@$_SESSION['id'].'.png" class="demo-avatar">';
}else{
echo '<img src="_img/default.png" class="demo-avatar">';}