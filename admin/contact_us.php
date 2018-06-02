<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Contact Us || Punjabivarsa ||</title>
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
		$sql="delete from pun_contact_us where id='$_REQUEST[id]'";
		
		if (!mysql_query($sql,$dbconn))
		{
			die('Error: ' . mysql_error());
		}
		echo"<meta http-equiv=refresh content=\"0;url=contact_us.php?action=view\">";
  }
  
  ?>
<tr>
<tr></tr>
<tr>
<td><a href="contact_us.php?action=view" class="text_content"><strong>&nbsp;&nbsp;&nbsp;&nbsp;View Contact Details</strong></a>
<a href="exportcontactus.php"><img src="excel_icon.gif" alt="Export email id for newsletter" title="Export Email"/></a>
</td>
</tr>
<?php if($_REQUEST['action']=='view') {?>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#EFEFEF">
    <?php 
	$order_by = isset($_REQUEST['order_by'])?$_REQUEST['order_by']:'post_date';
	$asc_desc = isset($_REQUEST['asc_desc'])?$_REQUEST['asc_desc']:'desc';
	$attach = " order by ".$order_by." ".$asc_desc." ";

	$i=1;
	$result = mysql_query("SELECT * FROM pun_contact_us where 1 ".$attach." ");
	$rCount=0;
	$rCount = @mysql_num_rows($result);		
	if($rCount>0)
	{	
	?>
  <tr>
    <td bgcolor="#FFFFFF" class="text_content"><b>Sr No</b></td>
    <td bgcolor="#FFFFFF" class="text_content"><a href="contact_us.php?action=view&order_by=name&asc_desc=<?php if($asc_desc == 'asc') { echo 'desc'; } else { echo 'asc'; } ?>"><b>Name</b></a></td>
    
     <td bgcolor="#FFFFFF" class="text_content"><b>Enquiry</b></td>
     
    <td bgcolor="#FFFFFF" class="text_content"><a href="contact_us.php?action=view&order_by=phone_no&asc_desc=<?php if($asc_desc == 'asc') { echo 'desc'; } else { echo 'asc'; } ?>"><b>Contact No</b></a></td>
    <td bgcolor="#FFFFFF" class="text_content"><a href="contact_us.php?action=view&order_by=email_id&asc_desc=<?php if($asc_desc == 'asc') { echo 'desc'; } else { echo 'asc'; } ?>"><b>Email ID</b></a></td>
    <td bgcolor="#FFFFFF" class="text_content"><b>Post Date</b></td>

    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
	<?php	
		while($row = mysql_fetch_array($result))
		{	
		?>
	  <tr class="text_content">
		<td valign="top" bgcolor="#FFFFFF"><?php echo $i;?> </td>
		<td valign="top" bgcolor="#FFFFFF"  class="text_content"><?php echo $row['name']; ?></td>
        <td valign="top" bgcolor="#FFFFFF"  class="text_content"><?php echo $row['enquiry']; ?></td>
        <td valign="top" bgcolor="#FFFFFF"  class="text_content"><?php echo $row['phone_no']; ?></td>
        <td valign="top" bgcolor="#FFFFFF"  class="text_content"><?php echo $row['email_id']; ?></td>
         <td valign="top" bgcolor="#FFFFFF" class="text_content"><?php echo date("d-m-Y",strtotime($row['post_date'])); ?></td>
		<td valign="top" bgcolor="#FFFFFF" class="text_content">
	  <a href="contact_us.php?action=del&id=<?php echo $row['id']?>" onClick="return(window.confirm('Are you sure you want to delete?'));"><img src="delete.gif" alt="Delete" width="15" height="15" border="0" /></a></td>
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
				$role=$row2['role'];
				$company_id=$row2['company_id']; 
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
          <td valign="top" bgcolor="#FFFFFF" class="text_content">Role<span class="red">*</span></td>
          <td bgcolor="#FFFFFF">
          <select name="role" id="role" style="width:162px;">
          <option value="Super Admin" <?php if($role == 'Super Admin') { echo 'selected'; } ?>>Super Admin</option>
			<option value="User" <?php if($role == 'User') { echo 'selected'; } ?>>User</option>
			</select>          </td>
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