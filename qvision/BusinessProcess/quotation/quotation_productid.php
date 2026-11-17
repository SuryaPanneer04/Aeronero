<?php
require '../../../connect.php';
include("../../../user.php");
$productname=$_REQUEST['name'];

$exp=explode('-',$productname);

$name=$exp[0];
// Reconstruct the ID in case it contained hyphens (e.g. SW-001)
$id = implode('-', array_slice($exp, 1));


if (!empty($id)) {
    $sel=$con->prepare("SELECT product_id, description FROM product_master WHERE id=:id AND name=:name");
    $sel->execute([':id' => $id, ':name' => $name]);
} else {
    $sel=$con->prepare("SELECT product_id, description FROM product_master WHERE name=:name LIMIT 1");
    $sel->execute([':name' => $name]);
}
$sfet=$sel->fetch();

if ($sfet) {
    echo $sfet['product_id']."||".$sfet['description']; 
} else {
    // Check software_master_list
    if (!empty($id)) {
        $sel_sw=$con->prepare("SELECT software_id, description FROM software_master_list WHERE software_id=:id AND software_name=:name");
        $sel_sw->execute([':id' => $id, ':name' => $name]);
    } else {
        $sel_sw=$con->prepare("SELECT software_id, description FROM software_master_list WHERE software_name=:name LIMIT 1");
        $sel_sw->execute([':name' => $name]);
    }
    $sfet_sw=$sel_sw->fetch();
    if ($sfet_sw) {
        echo $sfet_sw['software_id']."||".$sfet_sw['description']; 
    } else {
        echo "||";
    }
}
?>