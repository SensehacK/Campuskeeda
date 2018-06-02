<?php session_start(); ?>

<?php include('../db.inc.php'); 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="Shortcut Icon" href="../images/fav.ico"/>

<title>Welcome to admin master Control Panel || Funduzz ||</title>

<link rel="icon" type="image/png" href="../images/browser.png" />

<style type="text/css">

<!--

body {

	margin-left: 0px;

	margin-top: 0px;

}

-->

</style>

<link href="generic.css" type="text/css" rel="stylesheet" />

<style type="text/css">

<!--

.style2 {color: #993365}

.style3 {color: #FFFFFF}

-->

</style>

<script language="javascript">

function checkform()

{

	if(document.idpform.txtUsername.value=='')

	{

		alert("Please enter username")

		document.idpform.txtUsername.focus();

		return false;

	}

	if(document.idpform.txtPassword.value=='')

	{

		alert("Please enter password")

		document.idpform.txtPassword.focus();

		return false;

	}

	if(document.idpform.captcha_code.value=='')

	{

		alert("Please enter Security Code")

		document.idpform.captcha_code.focus();

		return false;

	}

}



</script>

<script language='JavaScript' type='text/javascript'>

function refreshCaptcha()

{

	var img = document.images['captchaimg'];

	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;

}

</script>

</head>



<body>

<?php 

$msg='';

$today = date('Y-m-d');

if (!empty($_REQUEST['captcha_code']) && ($_REQUEST['txtUsername']!='') && ($_REQUEST['txtPassword']!=''))

{

    if(empty($_SESSION['captcha_code'] ) ||  strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0)

	{

		$msg= "The captcha code does not match!";

	}else

	{

		$query = "select * from admin_master where username  = '$_POST[txtUsername]' and password='$_POST[txtPassword]'";

		$result = @mysql_query($query);

		$count = @mysql_num_rows($result);

		$db_data = @mysql_fetch_array($result);

		$id = $db_data['username'];

		$role = $db_data['role'];

		$company_id = $db_data['company_id'];

		$admin_id = $db_data['id'];

		if($count > 0)

		{

			$_SESSION['curruser']=$id;

			$_SESSION['login_id']=$admin_id;

			$_SESSION['company_id']=$company_id;

			$_SESSION['curruser_role']=$role;

			echo"<meta http-equiv=refresh content=\"0;url=admin.php\">";

		}

		else 

		{ 

			$msg='Invalid login details';

		}

   

	}

}	

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0"  >



  <tr>

    <td align="center" class="title"><table width="100%" border="0" cellspacing="2" cellpadding="2" bgcolor="#F5F5F5">

          <tr>

            <td align="left"><a href="admin.php"><!--<img src="../images/logo.jpg" border="0" alt="Funduzz" title="Funduzz" height="80">--></a><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text_content"><b>Admin Control Panel</b></span></td>

          </tr>

        </table></td>

  </tr>

  <tr>

    <td align="center" class="title">&nbsp;</td>

  </tr>

  <tr>

    <td align="center" class="title style1">&nbsp;</td>

  </tr>

  <tr>

    <td>&nbsp;</td>

  </tr>

  

  <tr><form id="idpform" name="idpform" method="post" action="" onSubmit="return checkform()">

    <td><table width="318" border="0" align="center" cellpadding="0" cellspacing="0">

      <tbody>

        <tr>

          <td width="15"><img src="topleft.gif" width="15" height="25" /></td>

          <td align="center" valign="bottom" background="midtop.gif" class="style2">

		  <?php 

  

  if($msg!='') 

  { 

  	echo $msg; 

  

	}  ?>          </td>

          <td width="15"><img src="topright.gif" width="15" height="25" /></td>

        </tr>

        <tr>

          <td rowspan="2" background="midleft.gif">&nbsp;</td>

          <td bgcolor="#f5f5f5"><table width="288" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#f5f5f5" class="general">

              <tbody>

                

                <tr valign="top">

                  <td colspan="2" align="center"><strong class="text_content">Admin Login</strong></td>

                </tr>

                <tr valign="top">

                  <td class="text_content">Username&nbsp;&nbsp;:</td>

                  <td class="text_content">

                      <input name="txtUsername"  type="text" id="txtUsername" style="border-color:Silver;border-width:1px;border-style:Solid;width:150px;" />                  </td>

                </tr>

                <tr valign="top">

                  <td class="text_content">Password&nbsp;&nbsp;:</td>

                  <td class="text_content">

                      <input name="txtPassword" type="password" id="txtPassword" style="border-color:Silver;border-width:1px;border-style:Solid;width:150px;" />                      </td>

                </tr>

				<tr valign="top">

                  <td class="text_content" valign="middle">Security Code&nbsp;&nbsp;:</td>

                   <td class="text_content">

                    <p>

                    <img src="captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' ><br>

                    <input id="captcha_code" name="captcha_code" type="text"><br>

                    <small>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</small>

                    </p>

				</td>

                

                </tr>

                <tr valign="top">

                  <td colspan="2" align="center"><input type="image" src="bb-go.gif" /><!--<input name="submit" type="submit" value="Login"/> --></td>

                </tr>

              </tbody>

          </table></td>

          <td rowspan="2" background="midright.gif">&nbsp;</td>

        </tr>

        <tr>

          <td bgcolor="#f5f5f5" class="general">&nbsp;</td>

        </tr>

        <tr>

          <td><img src="btmleft.gif" width="15" height="25" /></td>

          <td background="midbtm.gif">&nbsp;</td>

          <td><img src="btmright.gif" width="15" height="25" /></td>

        </tr>

      </tbody>

    </table></td> </form> 

  </tr>

 

  <tr>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td>&nbsp;</td>

  </tr>

</table>

</body>

</html>

