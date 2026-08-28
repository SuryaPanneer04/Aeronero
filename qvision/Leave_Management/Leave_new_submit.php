<?php
require '../../connect.php';

$employee=$_REQUEST['employee'];
$count=$_REQUEST['count'];
$balance_leave=$_REQUEST['balance_leave'];
$leave_type=$_REQUEST['leave_type'];
$from_date=date("Y-m-d",strtotime($_REQUEST['from_date']));
//$from_time=$_REQUEST['from_time'];
$to_date=date("Y-m-d",strtotime($_REQUEST['to_date']));
$no_of_days=$_REQUEST['no_of_days'];
$reason=$_REQUEST['reason'];
$address=$_REQUEST['address'];
$phone=$_REQUEST['phone'];
$approver_name=$_REQUEST['approver_name'];
$month=date('m');
$year=date('Y');
$status="1";
$now=date('Y-m-d');

/* $no_of_days=abs(strtotime($from_date) - strtotime($to_date));
$years = floor($no_of_days / (365*60*60*24));
$months = floor(($no_of_days - $years * 365*60*60*24) / (30*60*60*24));
$no_of_dayss = floor(($no_of_days - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24)); // days gets */

$statement = $con->prepare('INSERT INTO leave_details(employee_name, count, balance_leave, leave_type, no_of_days, from_date, to_date, reason, address, phone, approver_name, month,  year, status, created_on)
    VALUES (:employee, :count, :balance_leave, :leave_type, :no_of_days, :from_date, :to_date, :reason, :address, :phone, :approver_name, :month, :year, :status, :now)');

$statement->execute([
    'employee' => $employee,
    'count' => $count,
    'balance_leave' => $balance_leave,
    'leave_type' => $leave_type,
    'no_of_days' => $no_of_days,
    'from_date' => $from_date,
    'to_date' => $to_date,
    'reason' => $reason,
    'address' => $address,
    'phone' => $phone,
    'approver_name' => $approver_name,
    'month' => $month,
    'year' => $year,
    'status' => $status,
    'now' => $now
]);


if($statement)
{
	0;
}
else
{
	1;
}

?>