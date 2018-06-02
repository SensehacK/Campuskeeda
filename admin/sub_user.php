<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Create New Users || Campus keeda ||</title>

<link rel="icon" type="image/png" href="../images/browser.png" />



<style type="text/css">

<!--

body {

	margin-left: 0px;

	margin-top: 0px;

}

.style1 {font-weight: bold}

-->

</style>

<script language="javascript">

function checkdata()

{

	if(document.form1.contact_name.value=='')

	{

		alert("Please enter contact name")

		document.form1.contact_name.focus();

		return false

	}



	if(document.form1.txt_username.value=='')

	{

		alert("Please enter user name")

		document.form1.txt_username.focus();

		return false

	}

	if(document.form1.txt_password.value=='')

	{

		alert("Please enter admin password")

		document.form1.txt_password.focus();

		return false

	}

	

}	

</script>

</head>



<body>

<table width="100%" border="0" cellspacing="0" cellpadding="0">  

<tr>

<td><?php include("top.php"); ?></td>

</tr>  



 <?php 

	$dt = date('Y/m/d'); 

  

  if (($_REQUEST['action']=='del') && ($_REQUEST['id']!=''))

  {

		$sql="delete from admin_master where id='$_REQUEST[id]'";

		

		if (!mysql_query($sql,$con))

		{

			die('Error: ' . mysql_error());

		}

		echo"<meta http-equiv=refresh content=\"0;url=sub_user.php?action=view\">";

  }

  if ($_REQUEST['action']=='save')

  {

 		$post_date = date('Y/m/d');

		$contact_name=$_REQUEST['contact_name'];

		$address=$_REQUEST['address'];

		$txt_username=$_REQUEST['txt_username'];

		$txt_password=$_REQUEST['txt_password'];

		$mobile_no=$_REQUEST['mobile_no'];

		

		$result = @mysql_query("select * from admin_master where username='$txt_username' and password='$txt_password'");

		$cnt = mysql_num_rows($result);

		if($cnt > 0)

		{

			echo "<script langauge=\"javascript\">alert(\"Sub User allready Exists\");location.href='sub_user.php?action=view';</script>";

		}

		else

		{

			$sql="INSERT INTO admin_master (contact_name, username,password,mobile_no,address,status, post_date) VALUES ('$contact_name','$txt_username','$txt_password','$mobile_no','$address',1,'$post_date')";	

			if (!mysql_query($sql,$con))

			{

				die('Error: ' . mysql_error());

			}

			echo"<meta http-equiv=refresh content=\"0;url=sub_user.php?action=view\">";

		}

  }

  if (($_REQUEST['action']=='update')&&($_REQUEST['id']!=''))

  {

 		$post_date = date('Y/m/d');

		$txt_username=$_REQUEST['txt_username'];

		$txt_password=$_REQUEST['txt_password'];

		$contact_name=$_REQUEST['contact_name'];

		$mobile_no=$_REQUEST['mobile_no'];

		$address=$_REQUEST['address'];

		

		$id=$_REQUEST['id'];	

		$sql="update admin_master set contact_name='$contact_name',username='$txt_username', password='$txt_password',mobile_no='$mobile_no',address='$address' where id='$id'";

		

		if (!mysql_query($sql,$con))

		{

			die('Error: ' . mysql_error());

		}

		echo"<meta http-equiv=refresh content=\"0;url=sub_user.php?action=view\">";

  }

  ?>

<tr>

<tr></tr>

<tr>

<td><a href="sub_user.php?action=add" class="text_content">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Add User</strong></a> | <a href="sub_user.php?action=view" class="text_content"><strong>View Users</strong></a></td>

</tr>

<?php if($_REQUEST['action']=='view') {?>

  <tr>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td><table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#EFEFEF">

    <?php 

	$order_by = isset($_REQUEST['order_by'])?$_REQUEST['order_by']:'id';

	$asc_desc = isset($_REQUEST['asc_desc'])?$_REQUEST['asc_desc']:'desc';

	$attach = " order by ".$order_by." ".$asc_desc." ";



	$i=1;

	$result = mysql_query("SELECT * FROM admin_master where 1".$attach." ");

	$rCount=0;

	$rCount = @mysql_num_rows($result);		

	if($rCount>0)

	{	

	?>

  <tr>

    <td bgcolor="#FFFFFF" class="text_content"><b>Sr No</b></td>

    <td bgcolor="#FFFFFF" class="text_content"><a href="sub_user.php?action=view&order_by=contact_name&asc_desc=<?php if($asc_desc == 'asc') { echo 'desc'; } else { echo 'asc'; } ?>"><b>Name</b></a></td>

    <td bgcolor="#FFFFFF" class="text_content"><a href="sub_user.php?action=view&order_by=mobile_no&asc_desc=<?php if($asc_desc == 'asc') { echo 'desc'; } else { echo 'asc'; } ?>"><b>Mobile No</b></a></td>

    <td bgcolor="#FFFFFF" class="text_content"><a href="sub_user.php?action=view&order_by=username&asc_desc=<?php if($asc_desc == 'asc') { echo 'desc'; } else { echo 'asc'; } ?>"><b>Username</b></a></td>

    <td bgcolor="#FFFFFF" class="text_content"><b>Password</b></td>

    

    <td bgcolor="#FFFFFF">&nbsp;</td>

  </tr>

	<?php	

		while($row = mysql_fetch_array($result))

		{	

		?>

	  <tr class="text_content">

		<td valign="top" bgcolor="#FFFFFF"><?php echo $i;?> </td>

		<td valign="top" bgcolor="#FFFFFF"  class="text_content"><?php echo $row['contact_name']; ?></td>

        <td valign="top" bgcolor="#FFFFFF"  class="text_content"><?php echo $row['mobile_no']; ?></td>

        <td valign="top" bgcolor="#FFFFFF"  class="text_content"><?php echo $row['username']; ?></td>

        <td valign="top" bgcolor="#FFFFFF" class="text_content"><?php echo $row['password']; ?></td>

        

		<td valign="top" bgcolor="#FFFFFF" class="text_content">

	   <a href="sub_user.php?action=edit&id=<?php echo $row['admin_id']?>"><img src="edit.gif" alt="Edit" width="15" height="15" border="0" /></a> &nbsp;&nbsp; <a href="sub_user.php?action=del&id=<?php echo $row['admin_id']?>" onClick="return(window.confirm('Are you sure you want to delete?'));"><img src="delete.gif" alt="Delete" width="15" height="15" border="0" /></a></td>

	  </tr>

	  <?php  

	  $i++;

	   }

	 }

	 else

	 {

	 ?>

     <tr><td colspan="9"  bgcolor="#FFFFFF"  class="text_content"><?php echo 'Records not found.';?></td></tr>

     <?php  }  	?>

  

</table></td>

  </tr>

  <?php } ?>

<tr>

  <td>&nbsp;</td>

</tr>

 <?php 

	$txt_username='';

	$txt_password='';

	$role = '';

  if(($_REQUEST['action']=='add') || ($_REQUEST['action']=='edit'))

  {

	  $action='save';

	  if(($_REQUEST['id']!='') || ($_REQUEST['action']=='edit'))

	  {

			$action='update';

			$result2 = mysql_query("SELECT *  FROM admin_master  where admin_id='$_REQUEST[id]'");

			if($row2 = mysql_fetch_array($result2))

			{

				$txt_username=$row2['username'];

				$txt_password=$row2['password'];

				$contact_name=$row2['contact_name'];

				$mobile_no=$row2['mobile_no'];

				$address=$row2['address'];

				

			}

	  }

  ?>

<tr>

  <td><form action="" method="post" name="form1" id="form1" onsubmit="return checkdata()">

      <table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#EFEFEF">        

        <tr>

          <td colspan="2" bgcolor="#FFFFFF" class="title">Add User</td>

          </tr>

        <tr>

          <td bgcolor="#FFFFFF"  class="text_content">Contact Name<span class="red">*</span></td>

          <td bgcolor="#FFFFFF"><input name="contact_name" type="text" id="contact_name" value="<?php echo $contact_name; ?>" size="30" maxlength="50" /></td>

        </tr>

        <tr>

          <td valign="top" bgcolor="#FFFFFF" class="text_content">Address</td>

          <td bgcolor="#FFFFFF"><input name="address" type="text" id="address" value="<?php echo $address; ?>" size="30" maxlength="50" /></td>

        </tr>

        <tr>

          <td valign="top" bgcolor="#FFFFFF" class="text_content">Mobile No</td>

          <td bgcolor="#FFFFFF"><input name="mobile_no" type="text" id="mobile_no" value="<?php echo $mobile_no; ?>" size="30" maxlength="50" /></td>

        </tr>

        <tr>

          <td width="12%" bgcolor="#FFFFFF"  class="text_content">Username<span class="red">*</span></td>

          <td width="88%" bgcolor="#FFFFFF"><input name="txt_username" type="text" id="txt_username" value="<?php echo $txt_username; ?>" size="30" maxlength="50" /></td>

        </tr>

        

        <tr>

          <td valign="top" bgcolor="#FFFFFF" class="text_content">Password<span class="red">*</span></td>

          <td bgcolor="#FFFFFF"><input name="txt_password" type="password" id="txt_password" value="<?php echo $txt_password; ?>" size="30" maxlength="50" /></td>

        </tr>

        

        <tr>

          <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>

          <td bgcolor="#FFFFFF"><input type="submit" name="button" id="button" value="Submit" />

            <input type="hidden" name="action" id="action" value="<?php echo $action;?>" />

            <input type="hidden" name="id" id="id"  value="<?php echo $_REQUEST['id'];?>" /></td>

        </tr>

      </table>

        </form></td>

</tr>

 <?php } ?>

</table>

</body>

</html>