<?php
include 'connect.php';
$userrole = $_POST['userrole'];
$menuid=$_POST["menuid"];

$sql2 = $con->query("SELECT zmsm.name,zmsm.call_method FROM z_masters_sub_menu zmsm join z_role_detail zrd on zrd.submenu_id=zmsm.id WHERE zmsm.status='1' and zrd.code='$userrole' and zrd.menu_id='$menuid' and zrd.view_only='1' AND zrd.edit_only='1' AND zrd.all_only='1' ORDER BY zmsm.id ASC");
// $sql2 = $con->query("SELECT zmsm.name,zmsm.call_method FROM z_masters_sub_menu zmsm join z_role_detail zrd on zrd.submenu_id=zmsm.id WHERE zmsm.status='1' and zrd.code='$userrole' and zrd.menu_id='$menuid' and zrd.view_only='1' AND zrd.edit_only='1' AND zrd.all_only='1'");
// echo  "SELECT zmsm.name,zmsm.call_method FROM z_masters_sub_menu zmsm join z_role_detail zrd on zrd.submenu_id=zmsm.id WHERE zmsm.status='1' and zrd.code='$userrole' and zrd.menu_id='$menuid' and zrd.view_only='1' AND zrd.edit_only='1' AND zrd.all_only='1'";  
while ($res = $sql2->fetch(PDO::FETCH_ASSOC)) {

$submenus[] = $res;

         }
         echo json_encode($submenus);
?>