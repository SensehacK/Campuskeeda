<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Category || Punjabi Varsa ||</title>
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
	if(document.form1.category_name.value=='')
	{
		alert("Please enter category name")
		document.form1.category_name.focus();
		return false
	}
}	
</script>
<link rel='stylesheet' href='calendar_blue.css' title='calendar'>
<script language="javascript" src="calendar.js"></script>
<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">  
<tr>
<td><?php include("top.php"); ?></td>
</tr>  

 <?php 
  $dt = date('Y/m/d'); 
  
  if (($_REQUEST['action']=='del') && ($_REQUEST['category_id']!=''))
  {
		$sql="delete from pun_category_master where category_id='$_REQUEST[category_id]'";
		
		if (!mysql_query($sql,$dbconn))
		{
			die('Error: ' . mysql_error());
		}
		echo"<meta http-equiv=refresh content=\"0;url=manage_category.php?action=view\">";
  }
  
  if (($_REQUEST['action']=='active') && ($_REQUEST['category_id']!=''))
  {

		$status=$_REQUEST['status'];	
		$category_id=$_REQUEST['category_id'];
		$sql="update pun_category_master set status='$status' where category_id='$category_id'";
		if (!mysql_query($sql,$dbconn))
		{
			die('Error: ' . mysql_error());
		}
		echo"<meta http-equiv=refresh content=\"0;url=manage_category.php?action=view\">";
  }
  
  
  if ($_REQUEST['action']=='save')
  {
 		
		$category_name=$_REQUEST['category_name'];
		$post_date=$dt;
		
		$sql="INSERT INTO pun_category_master (category_name,status,post_date) VALUES ('$category_name',1,'$post_date')";
				
			if (!mysql_query($sql,$dbconn))
			{
				die('Error: ' . mysql_error());
			}
			echo"<meta http-equiv=refresh content=\"0;url=manage_category.php?action=view\">";
		
  }
  if (($_REQUEST['action']=='update')&&($_REQUEST['category_id']!=''))
  {
		$category_name=$_REQUEST['category_name'];
		$category_id=$_REQUEST['category_id'];
		
		$sql="update pun_category_master set category_name='$category_name' where category_id='$category_id'";

		if (!mysql_query($sql,$dbconn))
		{
			die('Error: ' . mysql_error());
		}
		echo"<meta http-equiv=refresh content=\"0;url=manage_category.php?action=view\">";
  }
  ?>
<tr>
<tr></tr>
<tr>
<td><a href="manage_category.php?action=add" class="text_content">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Add New Category</strong></a> | <a href="manage_category.php?action=view" class="text_content"><strong>View Category</strong></a></td>
</tr>
<?php if($_REQUEST['action']=='view') {?>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#EFEFEF">
    <?php 
	$order_by = isset($_REQUEST['order_by'])?$_REQUEST['order_by']:'category_name';
	$asc_desc = isset($_REQUEST['asc_desc'])?$_REQUEST['asc_desc']:'asc';
	$attach = " order by ".$order_by." ".$asc_desc." ";

	$i=1;
	$result = mysql_query("SELECT * FROM pun_category_master where 1 ".$attach." ");
	$rCount=0;
	$rCount = @mysql_num_rows($result);		
	if($rCount>0)
	{	
	?>
  <tr>
    <td bgcolor="#FFFFFF" class="text_content"><b>Sr No</b></td>
    <td bgcolor="#FFFFFF" class="text_content"><b>Category Name</b></td>
    <td bgcolor="#FFFFFF" class="text_content"><b>Created on</b></td>
    <td bgcolor="#FFFFFF" class="text_content"><b>Status</b></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
	<?php	
		while($row = mysql_fetch_array($result))
		{	
		?>
	  <tr class="text_content">
		<td valign="top" bgcolor="#FFFFFF"><?php echo $i;?> </td>
		<td valign="top" bgcolor="#FFFFFF"  class="text_content"><?php echo $row['category_name']; ?></td>
        <td valign="top" bgcolor="#FFFFFF"  class="text_content"><?php echo date("d-m-Y",strtotime($row['post_date'])); ?></td>

        <td valign="top" bgcolor="#FFFFFF"  class="text_content"><?php 
		if($row['status'] == '1') 
		{ 
		echo "<span style='color:green'>Active</span>";
		}else if($row['status'] == '0') 
		{
		echo "<span style='color:red'>Deactive</span>";
		}
		?></td>
		<td valign="top" bgcolor="#FFFFFF" class="text_content">
        <?php if($row['status'] == '1') { ?><a href="manage_category.php?category_id=<?php echo $row['category_id']; ?>&status=0&action=active" onClick="return(window.confirm('Are you sure to deactivate country.'));"><?php echo "Deactive"; ?></a><?php } else { ?><a href="manage_category.php?category_id=<?php echo $row['category_id']; ?>&status=1&action=active" onClick="return(window.confirm('Are u sure to activate country.'));"><?php echo "Active"; ?></a><?php } ?>&nbsp;&nbsp; 
	   <a href="manage_category.php?action=edit&category_id=<?php echo $row['category_id']?>"><img src="edit.gif" alt="Edit" width="15" height="15" border="0" /></a> &nbsp;&nbsp; <a href="manage_category.php?action=del&category_id=<?php echo $row['category_id']?>" onClick="return(window.confirm('Are you sure you want to delete?'));"><img src="delete.gif" alt="Delete" width="15" height="15" border="0" /></a></td>
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
	  if(($_REQUEST['category_id']!='') || ($_REQUEST['action']=='edit'))
	  {
			$action='update';
			$result2 = mysql_query("SELECT *  FROM pun_category_master  where category_id='$_REQUEST[category_id]'");
			if($row2 = mysql_fetch_array($result2))
			{
				$category_name=$row2['category_name'];
								
			}
	  }
  ?>
<tr>
  <td><form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return checkdata()">
      <table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#EFEFEF">        
        <tr>
          <td colspan="2" bgcolor="#FFFFFF" class="title">Add New Category</td>
          </tr>
        <tr>
          <td width="23%" bgcolor="#FFFFFF"  class="text_content"> Category Name<span class="red">*</span></td>
          <td width="77%" bgcolor="#FFFFFF"><input name="category_name" type="text" id="category_name" value="<?php echo $category_name; ?>" size="35" /></td>
        </tr>
        
        <tr>
          <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
          <td bgcolor="#FFFFFF"><input type="submit" name="button" id="button" value="Submit" />
            <input type="hidden" name="action" id="action" value="<?php echo $action;?>" />
            <input type="hidden" name="id" id="id"  value="<?php echo $_REQUEST['category_id'];?>" /></td>
        </tr>
      </table>
        </form></td>
</tr>
 <?php } ?>
</table>
</body>
</html>