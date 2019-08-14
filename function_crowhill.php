<?php
/*
this function code php is the code to doing task
that requested by user from front end whatsapp messenger
through twillio,dialogflow.

as you understand about the flow of messages
from dialogflow will forward to this backend server,
and this backend server will be handled
by this php code. post php and function php

this function / method will perform the task,
and send back to dialogflow using JSON format

+================================================+
+ code made by Kukuh TW                          +
+ email:kukuhtw@gmail.com , kukuhtw@kukuhtw.com  +
+ whatsapp : 62-812.9893.706                     + 
+ website: http://kukuhtw.com                    +
+ twitter: @kukuhtw                              + 
+================================================+
*/

//============= function to sending messages back to user ==================
function sendMessage($parameters) {
	$jsonencodeparameters=json_encode($parameters);
	 echo json_encode($parameters);
}

//================ function to debug/trace ==================
function debug_text($namafile,$contentdebug) {
	$myfile = fopen($namafile, "w") or die("Unable to open file!");
	fwrite($myfile, $contentdebug);
	fclose($myfile);
}

//=========function to insert / add data to table users
function add_data($stand_number,$first_name,$last_name,
$stand_size,$date_purchased,$phone_number,$national_id,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {

$sql="insert into users (
`stand_number`,`first_name`,`last_name`,
`stand_size`,`date_purchased`,`phone_number`,`national_id`
) values
(
'$stand_number','$first_name','$last_name',
'$stand_size','$date_purchased','$phone_number','$national_id'
)";

$namafile="add.txt";
$contentdebug ="sql=".$sql;
debug_text($namafile,$contentdebug);

	$last_id=0;
	try {
			$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->exec($sql);
			$last_id = $conn->lastInsertId();
		}
	catch(PDOException $e)
	{
		$last_id=0;
	}
	
	return $last_id;
	
}
function update_data($id,$stand_number,$first_name,$last_name,
$stand_size,$date_purchased,$phone_number,$national_id,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword){
	$sql="update users set 
	stand_number='$stand_number',
	first_name='$first_name',
	last_name='$last_name',
	stand_size='$stand_size',
	date_purchased='$date_purchased',
	phone_number='$phone_number',
	national_id='$national_id'
	where id='$id'
	";

	$succeed=true;
	try {
			$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query = mysqli_query($link,$sql)or die ('gagal insert data'.mysqli_error($link));

		}
	catch(PDOException $e)
	{
		$succeed=false;
	}
	
	if ($succeed==true){
		return "Update is done and succeed!";
	}
	else
	{
		return "Update is failed!";
	}
	
	
}

function search_data($search,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword){
$sql=" select `id`,`stand_number`,`first_name`,`last_name`,
`stand_size`,`date_purchased`,`phone_number`,`national_id` 
from users 
where first_name like '%$search%'
or last_name like '%$search%'
or stand_number like '%$search%'
or stand_size like '%$search%'
or phone_number like '%$search%'
or national_id like '%$search%'
 ";
$options = array(
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			);
			$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
			$result_search="";
			foreach($conn->query($sql) as $row) {
				$id_data=$row['id'];
				$stand_number=$row['stand_number'];
				$first_name=$row['first_name'];
				$last_name=$row['last_name'];
				$stand_size=$row['stand_size'];
				$date_purchased=$row['date_purchased'];
				$phone_number=$row['phone_number'];
				$national_id=$row['national_id'];
				$result_search.="ID: $id_data \n";
				$result_search.="Stand Number: $stand_number \n";
				$result_search.="First Name: $first_name \n";
				$result_search.="Last Name: $last_name \n";
				$result_search.="Stand Size: $stand_size \n";
				$result_search.="Date Purchased: $date_purchased \n";
				$result_search.="Phone Number: $phone_number \n";
				$result_search.="National Id: $national_id \n\n";
			}
		if ($result_search=="") {
			$result_search="searching for `$search` is not found";
		}
		return $result_search;		

 
}
//function delete based on id
function delete_data($id,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword){
	$sql=" delete from users where id='$id' ";
	$succeed=true;
	try {
			$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
			// set the PDO error mode to exception
			$query = mysqli_query($link,$sql)or die ('gagal insert data'.mysqli_error($link));
		}
	catch(PDOException $e)
	{
		$succeed=false;
	}
	
	return $succeed;

}

//view data based on id
function view_data($id,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword){
$sql=" select `id`,`stand_number`,`first_name`,`last_name`,
`stand_size`,`date_purchased`,`phone_number`,`national_id` from users ";

if ($id!="" && $id!="all"){
	$sql.=" where id ='$id' ";
}

$namafile="view_data.txt";
$contentdebug="sql=".$sql;
debug_text($namafile,$contentdebug);

$options = array(
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			);
			$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
			$info="";
			foreach($conn->query($sql) as $row) {
				$id_data=$row['id'];
				$stand_number=$row['stand_number'];
				$first_name=$row['first_name'];
				$last_name=$row['last_name'];
				$stand_size=$row['stand_size'];
				$date_purchased=$row['date_purchased'];
				$phone_number=$row['phone_number'];
				$national_id=$row['national_id'];
				$info.="ID : $id_data \n";
				$info.="Stand Number : $stand_number \n";
				$info.="First Name : $first_name \n";
				$info.="Last Name : $last_name \n";
				$info.="Stand Size : $stand_size \n";
				$info.="Date Purchased : $date_purchased \n";
				$info.="Phone Number : $phone_number \n";
				$info.="National ID : $national_id \n\n";
			}
		if ($info=="") {
			$info="ID $id is not found";
		}
		return $info;		
}

function display_data_to_edit($id,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword){
$sql=" select `stand_number`,`first_name`,`last_name`,
`stand_size`,`date_purchased`,`phone_number`,`national_id` from users where id='$id' ";
$options = array(
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			);
			$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
			$info="";
			foreach($conn->query($sql) as $row) {
				$id_data=$row['id'];
				$stand_number=$row['stand_number'];
				$first_name=$row['first_name'];
				$last_name=$row['last_name'];
				$stand_size=$row['stand_size'];
				$date_purchased=$row['date_purchased'];
				$phone_number=$row['phone_number'];
				$national_id=$row['national_id'];
				$info.="Update Data \n";
				$info.="ID : $id \n";
				$info.="Stand Number : $stand_number \n";
				$info.="First Name : $first_name \n";
				$info.="Last Name : $last_name \n";
				$info.="Stand Size : $stand_size \n";
				$info.="Date Purchased : $date_purchased \n";
				$info.="Phone Number : $phone_number \n";
				$info.="National ID : $national_id \n\n";
			}
		if ($info=="") {
			$info="ID $id is not found";
		}
		return $info;		
}


//==================================EOF ========================================


?>