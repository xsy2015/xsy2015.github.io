<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='ȡ������';
$url="<a href=../../../>��ҳ</a>&nbsp;>&nbsp;<a href=../cp/>��Ա����</a>&nbsp;>&nbsp;ȡ������";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<br>
<table width="500" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="GetPassForm" method="POST" action="../doaction.php">
    <tr class="header"> 
      <td height="25" colspan="2"><div align="center">ȡ������</div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="23%" height="25">�û���</td>
      <td width="77%"><input name="username" type="text" id="username" size="38"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">����</td>
      <td><input name="email" type="text" id="email" size="38"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">��֤��</td>
      <td><input name="key" type="text" id="key" size="6"> <img src="../../ShowKey/?v=getpassword" name="getpasswordKeyImg" id="getpasswordKeyImg" onclick="getpasswordKeyImg.src='../../ShowKey/?v=getpassword&t='+Math.random()" title="�������,���ˢ��"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp; </td>
      <td> <input type="submit" name="button" value="�ύ"> <input name="enews" type="hidden" id="enews" value="SendPassword"></td>
    </tr>
  </form>
</table>
<br>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>