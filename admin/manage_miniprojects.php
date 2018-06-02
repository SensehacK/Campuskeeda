<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Manage Mini Projects || Kampus keeda ||</title>

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

	if(document.form1.title.value=='')
	{
		alert("Please enter title")
		document.form1.title.focus();
		return false
	}
}	

</script>

<link rel='stylesheet' href='calendar_blue.css' title='calendar'>
<script language="javascript" src="calendar.js"></script>
<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
</head>
<body
<table width="100%" border="0" cellspacing="0" cellpadding="0">  
<tr>
<td><?php include("top.php"); ?></td>
</tr>  
 <?php 
  $dt = date('Y/m/d'); 
  if (($_REQUEST['action']=='del') && ($_REQUEST['id']!=''))
  {
		$sql="delete from campues_miniprojects where id='$_REQUEST[id]'";	
		if (!mysql_query($sql,$con))
		{
			die('Error: ' . mysql_error());
		}
		echo"<meta http-equiv=refresh content=\"0;url=manage_miniprojects.php?action=view\">";
  }
  if (($_REQUEST['action']=='active') && ($_REQUEST['id']!=''))
  {
		$status=$_REQUEST['status'];	
		$id=$_REQUEST['id'];
		$sql="update campues_miniprojects set status='$status' where id='$id'";
		if (!mysql_query($sql,$con))
		{
			die('Error: ' . mysql_error());
		}
		echo"<meta http-equiv=refresh content=\"0;url=manage_miniprojects.php?action=view\">";
  }

  if ($_REQUEST['action']=='save')
  {

		$title=$_REQUEST['title'];
		$post_date=$dt;
		//------------------------------------  Update projects pic ----------------------------------------------------------
		$projects = '';
		$target_folder = 'mini_projects/';
		$path_parts = "";
		$ext="";
		$target_path = "";
		$filetoupload="";
		$temp_code = rand();
		if($_FILES['projects']['name'] != '')
		{
				$target_path = $target_folder.$temp_code.'_'.$_FILES['projects']['name'];
				if(@move_uploaded_file($_FILES['projects']['tmp_name'], $target_path))
				{
					$projects = $temp_code.'_'.$_FILES['projects']['name'];
				}
				else
				{
					echo "<script langauge=\"javascript\">alert(\"Sorry you can not upload this Image.\");location.href='manage_miniprojects.php?action=view';</script>";
					return;
				}
		}

		$sql="INSERT INTO campues_miniprojects (title,projects,post_date) VALUES ('$title','$projects','$post_date')";
			if (!mysql_query($sql,$con))
			{
				die('Error: ' . mysql_error());
			}
			echo"<meta http-equiv=refresh content=\"0;url=manage_miniprojects.php?action=view\">";
  }

  if (($_REQUEST['action']=='update')&&($_REQUEST['id']!=''))
  {
		$title=$_REQUEST['title'];
		$id=$_REQUEST['id'];
		//------------------------------------  Update profile pic ----------------------------------------------------------
		$projects = '';
		$target_folder = 'mini_projects/';
		$path_parts = "";
		$ext="";
		$target_path = "";
		$filetoupload="";
		$temp_code = rand();
		if($_FILES['projects']['name'] != '')
		{
				$target_path = $target_folder.$temp_code.'_'.$_FILES['projects']['name'];
				if(@move_uploaded_file($_FILES['projects']['tmp_name'], $target_path))
				{
					$projects = $temp_code.'_'.$_FILES['projects']['name'];
					$sql="update campues_miniprojects set projects='$projects' where id='$id'";
					$result=mysql_query($sql);
				}
				else
				{
					echo "<script langauge=\"javascript\">alert(\"Sorry you can not upload this Image.\");location.href='manage_miniprojects.php?action=view';</script>";
					return;
				}
		}		

		$sql="update campues_miniprojects set title='$title' where id='$id'";
		if (!mysql_query($sql,$con))
		{
			die('Error: ' . mysql_error());
		}
		echo"<meta http-equiv=refresh content=\"0;url=manage_miniprojects.php?action=view\">";
  }
  ?>

<tr>

<tr></tr>

<tr>

<td><a href="manage_miniprojects.php?action=add" class="text_content">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Add New project</strong></a> | <a href="manage_miniprojects.php?action=view" class="text_content"><strong>View project</strong></a></td>

</tr>

<?php if($_REQUEST['action']=='view') {?>

  <tr>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td><table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#EFEFEF">

    <?php 

	$order_by = isset($_REQUEST['order_by'])?$_REQUEST['order_by']:'id';

	$asc_desc = isset($_REQUEST['asc_desc'])?$_REQUEST['asc_desc']:'asc';

	$attach = " order by ".$order_by." ".$asc_desc." ";



	$i=1;

	$result = mysql_query("SELECT * FROM campues_miniprojects where 1 ".$attach." ");

	$rCount=0;

	$rCount = @mysql_num_rows($result);		

	if($rCount>0)

	{	

	?>

  <tr>

    <td bgcolor="#FFFFFF" class="text_content"><b>Sr No</b></td>

    <td bgcolor="#FFFFFF" class="text_content"><b>Title</b></td>

	<td bgcolor="#FFFFFF" class="text_content"><b>projects</b></td>

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

		<td valign="top" bgcolor="#FFFFFF"  class="text_content"><?php echo $row['title']; ?></td>

		<td valign="top" bgcolor="#FFFFFF"  class="text_content"><a href="mini_projects/<?php echo $row['projects']; ?>" target="_blank">View</a></td>

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

        <?php if($row['status'] == '1') { ?><a href="manage_miniprojects.php?id=<?php echo $row['id']; ?>&status=0&action=active" onClick="return(window.confirm('Are you sure to deactivate .'));"><?php echo "Deactive"; ?></a><?php } else { ?><a href="manage_miniprojects.php?id=<?php echo $row['id']; ?>&status=1&action=active" onClick="return(window.confirm('Are u sure to activate .'));"><?php echo "Active"; ?></a><?php } ?>&nbsp;&nbsp; 

	   <a href="manage_miniprojects.php?action=edit&id=<?php echo $row['id']?>"><img src="edit.gif" alt="Edit" width="15" height="15" border="0" /></a> &nbsp;&nbsp; <a href="manage_miniprojects.php?action=del&id=<?php echo $row['id']?>" onClick="return(window.confirm('Are you sure you want to delete?'));"><img src="delete.gif" alt="Delete" width="15" height="15" border="0" /></a></td>

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

			$result2 = mysql_query("SELECT *  FROM campues_miniprojects  where id='$_REQUEST[id]'");

			if($row2 = mysql_fetch_array($result2))

			{

				$title=$row2['title'];

				$projects=$row2['projects'];

								

			}

	  }

  ?>

<tr>

  <td><form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return checkdata()">

      <table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#EFEFEF">        

        <tr>

          <td colspan="2" bgcolor="#FFFFFF" class="title">Add New project</td>

          </tr>

        <tr>

          <td width="23%" bgcolor="#FFFFFF"  class="text_content"> project title <span class="red">*</span></td>

          <td width="77%" bgcolor="#FFFFFF"><input name="title" type="text" id="title" value="<?php echo $title; ?>" size="35" /></td>

        </tr>

        <tr>

          <td bgcolor="#FFFFFF"  class="text_content">project pdf</td>

          <td bgcolor="#FFFFFF"><input type="file" name="projects" id="projects" /></td>

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