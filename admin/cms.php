<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS || Punjabivarsa ||</title>
<link rel="icon" type="image/png" href="../images/browser.png" />
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
}
.style1 {font-weight: bold}
</style>
<script language="javascript">
function checkdata()
{
	if(document.form1.page_name.value=='')
	{
		alert("Please enter page page_name")
		document.form1.page_name.focus();
		return false
	}
	if(document.form1.content.value=='')
	{
		alert("Please enter content")
		document.form1.content.focus();
		return false
	}
}	
</script>
<link href="generic.css" type="text/css" rel="stylesheet" />
<script language="JavaScript" type="text/javascript" src="wysiwyg.js"></script>
<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">  
<tr>
<td><?php include("top.php"); ?></td>
</tr>  
 <?php 
	$dt = date('Y/m/d'); 
  
  if ($_REQUEST['action']=='save')
  {
 		$RegDate = date('Y/m/d');
		$page_name=$_POST['page_name'];	
		$content=str_replace("'","''",$_POST['content']);
		$page_title=$_POST['page_title'];
		$meta_desc=$_POST['meta_desc'];
		$meta_keyword=$_POST['meta_keyword'];
		
		$sql="INSERT INTO cms ( page_name, content, page_title, meta_desc,meta_keyword, updated_date) VALUES ('$page_name','$content','$page_title','$meta_desc','$meta_keyword', '$RegDate')";		
		if (!mysql_query($sql,$dbconn))
		{
			die('Error: ' . mysql_error());
		}
		echo"<meta http-equiv=refresh content=\"0;url=cms.php?action=view\">";
		
  }
  if (($_POST['action']=='update')&&($_POST['id']!=''))
  {
 		$RegDate = date('Y/m/d');
		$page_name=$_POST['page_name'];	
		$content=str_replace("'","&acute;",$_POST['content']);
		$page_title=$_POST['page_title'];
		$meta_desc=$_POST['meta_desc'];
		$meta_keyword=$_POST['meta_keyword'];			
		$id=$_POST['id'];

		$sql="update cms set page_name='$page_name', content='$content',page_title='$page_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',updated_date='$RegDate' where cms_id='$id'";
		//echo $sql;
		if (!mysql_query($sql,$dbconn))
		{
			die('Error: ' . mysql_error());
		}
		echo"<meta http-equiv=refresh content=\"0;url=cms.php?action=view\">";
  }
  ?>
<tr>
<td>&nbsp;&nbsp;&nbsp;<!--<a href="cms.php?action=add" class="text_content"><strong>ADD</strong></a>&nbsp;|&nbsp;--><a href="cms.php?action=view" class="text_content"><strong>View CMS</strong></a></td>
</tr>
<?php if($_GET['action']=='view') {?>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#EFEFEF">
    <?php 
	$order_by = isset($_REQUEST['order_by'])?$_REQUEST['order_by']:'cms_id';
	$asc_desc = isset($_REQUEST['asc_desc'])?$_REQUEST['asc_desc']:'asc';
	$attach = " order by ".$order_by." ".$asc_desc." ";

	$i=1;
	$result = mysql_query("SELECT * FROM cms where 1 ".$attach." ");
	$rCount=0;
	$rCount = @mysql_num_rows($result);		
	if($rCount>0)
	{	
	?>
  <tr>
    <td bgcolor="#FFFFFF" class="text_content"><b>Sr No</b></td>
    <td bgcolor="#FFFFFF" class="text_content"><a href="cms.php?action=view&order_by=page_name&asc_desc=<?php if($asc_desc == 'asc') { echo 'desc'; } else { echo 'asc'; } ?>"><b>Page Name</b></a></td>
    <td bgcolor="#FFFFFF" class="text_content"><b>Last Updated</b></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
	<?php while($row = mysql_fetch_array($result)){?>
	  <tr class="text_content">
		<td valign="top" bgcolor="#FFFFFF"><?php echo $i;?> </td>
		<td valign="top" bgcolor="#FFFFFF"  class="text_content"><?php echo $row['page_name']; ?></td>
		<td valign="top" bgcolor="#FFFFFF" class="text_content"><?php echo date("d-m-Y",strtotime($row['updated_date'])); ?></td>
		<td valign="top" bgcolor="#FFFFFF" class="text_content"><a href="cms.php?action=edit&id=<?php echo $row['cms_id']?>">Update</a></td>
	  </tr>
	  <?php  
	  $i++;
	   }
	 }
	 else
	 {
	 ?>
     <tr><td colspan="6"  bgcolor="#FFFFFF"  class="text_content"><b><?php echo 'Records not found.';?></b></td></tr>
     <?php  }  	?>
  
</table></td>
  </tr>
  <?php } ?>
<tr>
  <td>&nbsp;</td>
</tr>
 <?php 
  if(($_REQUEST['action']=='add') || ($_REQUEST['action']=='edit'))
  {
	  $action='save';
	  if(($_REQUEST['id']!='') || ($_REQUEST['action']=='edit'))
	  {
			$action='update';
			$result2 = mysql_query("SELECT *  FROM cms where cms_id='$_REQUEST[id]'");
			if($row2 = mysql_fetch_array($result2))
			{
				$page_name=$row2['page_name'];
				$content=$row2['content'];
				$page_title=$row2['page_title'];
				$meta_desc=$row2['meta_desc'];
				$meta_keyword=$row2['meta_keyword'];
			}
	  }
  ?>
<tr>
  <td><form action="" method="post" name="form1" id="form1" onsubmit="return checkdata()">
      <table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#EFEFEF">        
        <tr>
          <td colspan="2" bgcolor="#FFFFFF" class="title"><b>CMS</b></td>
          </tr>
        <tr>
          <td bgcolor="#FFFFFF"  class="text_content">Page Name </td>
          <td bgcolor="#FFFFFF"><input name="page_name" type="text" id="page_name" size="84" value="<?php echo $page_name; ?>" /></td>
        </tr>
        <tr>
          <td width="12%" valign="top" bgcolor="#FFFFFF"  class="text_content">Content</td>
          <td width="88%" bgcolor="#FFFFFF"><textarea name="content"  id="content" ><?php echo $content; ?> </textarea>
	  
<script type="text/javascript"> CKEDITOR.replace( 'content', {                     
		  filebrowserBrowseUrl :'js/ckeditor/filemanager/browser/default/browser.html?Connector=/punjabi-varsa/adminmode/js/ckeditor/filemanager/connectors/php/connector.php',         filebrowserImageBrowseUrl : 'js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=/punjabi-varsa/adminmode/js/ckeditor/filemanager/connectors/php/connector.php',                     
	filebrowserFlashBrowseUrl :'js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=/punjabi-varsa/adminmode/js/ckeditor/filemanager/connectors/php/connector.php', 					
	filebrowserUploadUrl  :'/punjabi-varsa//adminmode/js/ckeditor/filemanager/connectors/php/upload.php?Type=File', 									     filebrowserImageUploadUrl : '/punjabi-varsa/adminmode/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image', 					     filebrowserFlashUploadUrl : '/punjabi-varsa/adminmode/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash',
	 height: 200,
     width: 800 
	 });
       </script> 






</td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF"  class="text_content">Page Title </td>
          <td bgcolor="#FFFFFF"><input name="page_title" type="text" id="page_title" size="84" value="<?php echo $page_title; ?>" /></td>
        </tr><tr>
          <td bgcolor="#FFFFFF"  class="text_content">Meta Desc</td>
          <td bgcolor="#FFFFFF"><input name="meta_desc" type="text" id="meta_desc" size="84" value="<?php echo $meta_desc; ?>" /></td>
        </tr><tr>
          <td bgcolor="#FFFFFF"  class="text_content">Meta Keyword</td>
          <td bgcolor="#FFFFFF"><input name="meta_keyword" type="text" id="meta_keyword" size="84" value="<?php echo $meta_keyword; ?>" /></td>
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