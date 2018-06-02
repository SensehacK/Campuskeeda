<?php session_start(); 
include('../db.inc.php'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Password || Funduzz ||</title>
<link href="generic.css" rel="stylesheet" type="text/css" />
<link rel="icon" type="image/png" href="../images/browser.png" />
<script language="javascript">
function checkform()
{
	if(document.form1.old_pass.value=='')
	{
		alert("Please enter Old Password");
		document.form1.old_pass.focus();
		return false;
	}
	if(document.form1.new_pass.value=='')
	{
		alert("Please enter New Password");
		document.form1.new_pass.focus();
		return false;
	}
	if(document.form1.new_pass.value.length < 6)
	{
		alert("Please enter alleast 6 character in password");
		document.form1.new_pass.focus();
		return false;
	}
	if(document.form1.conf_pass.value=='')
	{
		alert("Please enter Confirm Password");
		document.form1.conf_pass.focus();
		return false;
	}
	if(document.form1.conf_pass.value != document.form1.new_pass.value)
	{
		alert("New Password and Confirm Password not match");
		document.form1.new_pass.focus();
		return false;
	}
}
</script>
</head>
<body>
<?php //print_r($_REQUEST); 
if(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'Submit')
{
	$error_msg = "";
	$old_pass = isset($_REQUEST['old_pass'])?$_REQUEST['old_pass']:'';
	$new_pass = isset($_REQUEST['new_pass'])?$_REQUEST['new_pass']:'';
	$conf_pass = isset($_REQUEST['conf_pass'])?$_REQUEST['conf_pass']:'';
	$sql = "SELECT username FROM admin_master WHERE password='".$old_pass."' AND username='".$_SESSION['curruser']."' ";
	
	$result = mysql_query($sql);
	if(mysql_num_rows($result) == 0)
	{
		$error_msg = "Password can not reset, Old Password is wrong.";
	}
	else
	{
		$sql = "UPDATE admin_master SET password='$new_pass' WHERE password='".$old_pass."' AND username='".$_SESSION['curruser']."' ";
		@mysql_query($sql);
		$error_msg = "Password changed successfully.";
	}
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
  <tr>
    <td><?php include("top.php"); ?></td>
  </tr>
  <tr></tr>
  <tr>
<td style="padding-left:10px;"><a href="change_pass.php" class="text_content"><b>Change Password</b></a></td>
</tr>
<tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
    <form id="form1" name="form1" method="post" action="" onsubmit="return checkform();">
	  <table width="98%" border="0" align="center" cellpadding="2" cellspacing="3" bgcolor="#F5F5F5" style="padding-left:0px;">
		
		<tr>
			<td colspan="2" bgcolor="#FFFFFF" align="center">&nbsp;<b><span style="color:red;"><?php echo $error_msg; ?></span></b>			</td>
		</tr>
		<tr>
			<td width="13%" bgcolor="#FFFFFF" class="text_content">Old Password<span class="red">*</span>			</td>
			<td width="87%" bgcolor="#FFFFFF" class="text_content"><input type="password" name="old_pass" id="old_pass" value=""/>			</td>
		</tr>
		<tr>
			<td bgcolor="#FFFFFF" class="text_content">New Password<span class="red">*</span>			</td>
			<td bgcolor="#FFFFFF" class="text_content"><input type="password" name="new_pass" id="new_pass" value=""/>			</td>
		</tr>
		<tr>
          <td bgcolor="#FFFFFF" class="text_content">Confirm Password<span class="red">*</span> </td>
		  <td bgcolor="#FFFFFF" class="text_content"><input type="password" name="conf_pass" id="conf_pass" value=""/>
          </td>
		  </tr>
		<tr>
		  <td bgcolor="#FFFFFF" class="text_content">&nbsp;</td>
		  <td bgcolor="#FFFFFF" class="text_content"><input type="submit" name="submit" id="submit" value="Submit" /></td>
		  </tr>
		<tr>
			<td bgcolor="#FFFFFF" class="text_content" align="center" colspan="2">&nbsp;</td>
		</tr>
		</table>
	  </form>
	</td>
	</tr>
</table>
</body>
</html>