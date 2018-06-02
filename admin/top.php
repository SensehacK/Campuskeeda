<link rel="Shortcut Icon" href=""/>

<?php 

include('../db.inc.php');

//include('../functions.php');



if($_SESSION['curruser']=='')

{  

	echo"<meta http-equiv=refresh content=\"0;url=index.php\">";

}

?>

<link rel="stylesheet" href="style.css" type="text/css" />

<link href="generic.css" type="text/css" rel="stylesheet" />

<style type="text/css">

#tabs {

	float:left;

	width:100%;

	font-size:93%;

	line-height:normal;

	border-bottom:2px solid #666;

	margin-bottom:1em; /*margin between menu and rest of page*/

	overflow:hidden;

	}



#tabs ul {

	margin:0;

	padding:10px 10px 0 0px;

	list-style:none;	

	}



#tabs li {

	display:inline;

	margin:0;

	padding:0;

	}



#tabs a {

	float:left;

	background:url("left.png") no-repeat left top;

	margin:0;

	padding:0 0 0 6px;

	text-decoration:none;

	}



#tabs a span {

	float:left;

	display:block;

	background:url("right.png") no-repeat right top;

	padding:6px 15px 4px 6px;

	margin-right:2px;

	color:#FFF;

	}



/* Commented Backslash Hack hides rule from IE5-Mac \*/

#tabs a span {float:none;}



/* End IE5-Mac hack */

#tabs a:hover span {

	}



#tabs a:hover {

	background-position:0% -42px;

	}



#tabs a:hover span {

	background-position:100% -42px;

	}



body {

	margin-left: 0px;

	margin-top: 0px;

	font-family:Verdana, Arial, Helvetica, sans-serif;

	font-size:14px;

	color:#000000;



}

.style3 {color: #FFFFFF}

.style4 {color: #FFFEFF}

</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td ><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#F5F5F5" >

      <tr>

        <td width="34%"><table width="100%" border="0" cellspacing="2" cellpadding="2" >

          <tr>

            <td align="left"><a href="admin.php"><!--<img src="../images/logo.jpg" border="0" alt="Funduzz" title="Funduzz" height="80">--></a><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text_content"><b>Admin Control Panel</b></span></td>

          </tr>

        </table></td>

        <td width="86%" valign="top" bgcolor="#F5F5F5"><table width="100%" border="0" cellspacing="2" cellpadding="2" >

          <tr>

            <td width="36%">&nbsp;</td>

            <td width="64%" align="right" class="text_content">Welcome <b><?php echo $_SESSION['curruser'];?></b></td>

          </tr>

          <tr>

            <td height="80">&nbsp;</td>

            <td align="right"><a href="logout.php" class="text_content"><strong>Logout</strong></a><br />

              <span class="text_content">Developed by <b><a style="text-decoration:none;" href="http://www.kwebmaker.com/" target="_blank" class="text_content">Mukesh Singh</a></b></span></td>

          </tr>

        </table></td>

      </tr>

    </table></td>

  </tr>

  <tr>

  <?php 

  $url = $_SERVER['PHP_SELF'];

  #for Local

  //$attach = "/funduzz/adminmode/";

  #for Live

  $attach = "/adminmode/";

  ?>

    <td>

    <div class="grey">

        <div id="waxcontainer">

          <div id="waxnav">

            <ul>

            <li><a href="sub_user.php?action=view" <?php if($url == $attach.'sub_user.php') { ?>style="color:green;"<?php } else { ?>class="current" <?php } ?>><span>Manage Admin</span></a></li>

             <li><a href="manage_beprojects.php?action=view" <?php if($url == $attach.'manage_beprojects.php' ) { ?>style="color:green;"<?php } else { ?>class="current" <?php } ?>><span>Manage B.E Projects</span></a></li>
             <li><a href="manage_miniprojects.php?action=view" <?php if($url == $attach.'manage_miniprojects.php' ) { ?>style="color:green;"<?php } else { ?>class="current" <?php } ?>><span>Manage Mini Projects</span></a></li>
             
          <!--   
            <li><a href="contact_us.php?action=view" <?php if($url == $attach.'contact_us.php') { ?>style="color:green;"<?php } else { ?>class="current" <?php } ?>><span>Contact Us</span></a></li>-->
            </ul>
            </div>

        </div>

    </div></td>

  </tr>

  <tr>

    <td>&nbsp;</td>

  </tr>

</table> 

