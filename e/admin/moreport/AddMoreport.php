<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//��֤�û�
$lur=is_login();
$logininid=$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();
//��֤Ȩ��
CheckLevel($logininid,$loginin,$classid,"moreport");
$enews=ehtmlspecialchars($_GET['enews']);
$r['ppath']=ReturnAbsEcmsPath();
$url="<a href=ListMoreport.php".$ecms_hashur['whehref'].">������վ���ʶ�</a> &gt; ������վ���ʶ�";
$postword='������վ���ʶ�';
if($enews=="EditMoreport")
{
	$pid=(int)$_GET['pid'];
	if($pid==1)
	{
		printerror("ErrorUrl","history.go(-1)");
	}
	$r=$empire->fetch1("select * from {$dbtbpre}enewsmoreport where pid='$pid' limit 1");
	$url="<a href=ListMoreport.php".$ecms_hashur['whehref'].">������վ���ʶ�</a> &gt; �޸���վ���ʶˣ�<b>".$r[pname]."</b>";
	$postword='�޸���վ���ʶ�';
}
$tgtemps='';
$tgsql=$empire->query("select gid,gname,isdefault from {$dbtbpre}enewstempgroup order by gid");
while($tgr=$empire->fetch($tgsql))
{
	$selected='';
	if($tgr['gid']==$r['tempgid'])
	{
		$selected=' selected';
	}
	$tgtemps.="<option value='".$tgr['gid']."'".$selected.">".$tgr['gname']."</option>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>��վ���ʶ�</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>λ�ã�<?=$url?></td>
  </tr>
</table>
<form name="moreportform" method="post" action="ListMoreport.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"><?=$postword?> 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>">
        <input name="pid" type="hidden" id="pid" value="<?=$pid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="25%" height="25">���ʶ����ƣ�</td>
      <td width="75%" height="25"><input name="pname" type="text" id="pname" value="<?=$r[pname]?>" size="50">
      *
        <font color="#666666">(���磺�ֻ����ʶ�)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���ʶ˵�ַ��</td>
      <td height="25"><input name="purl" type="text" id="purl" value="<?=$r[purl]?>" size="50">
        *        <font color="#666666">(��β��ӡ�/�������磺http://3g.phome.net/)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���ʶ�Ŀ¼��</td>
      <td height="25"><input name="ppath" type="text" id="ppath" value="<?=$r[ppath]?>" size="50">
        *<font color="#666666">(�������Ŀ¼��ַ����β��ӡ�/�������磺d:/abc/3g/)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">ͨѶ��Կ��</td>
      <td height="25"><input name="postpass" type="text" id="postpass" value="<?=$r[postpass]?>" size="50">
        *
        <input type="button" name="Submit32" value="���" onclick="document.moreportform.postpass.value='<?=make_password(60)?>';">
      <font color="#666666">(��д10~100�������ַ�����ö����ַ����)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">ʹ��ģ���飺</td>
      <td height="25"><select name="tempgid" id="tempgid">
        <?=$tgtemps?>
      </select>
        *        <font color="#666666">(ѡ�񱾷��ʶ�ʹ�õ�ģ����)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">ҳ��ģʽ��</td>
      <td height="25"><input type="radio" name="mustdt" value="1"<?=$r[mustdt]==1?' checked':''?>>
        <a href="#empirecms" title="ǿ�ƶ�̬ҳ��ģʽʱ�����ʶ���ҳ����Ŀ������ҳ�Ⱦ����ö�̬ҳ�淽ʽ��ʾ���ô��ǣ����������ɾ�̬ҳ��">ǿ�ƶ�̬ҳ��ģʽ</a>
        <input type="radio" name="mustdt" value="0"<?=$r[mustdt]==0?' checked':''?>>
        <a href="#empirecms" title="��������ͬ����������ǲ��þ�̬ҳ��ģʽ����Ҫ�ڱ����ʶ˺�̨����ҳ�棬�Ż�ͬ����ʾ��">��������ͬ</a></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�رշ��ʶˣ�</td>
      <td height="25"><input name="isclose" type="checkbox" id="isclose" value="1"<?=$r[isclose]==1?' checked':''?>>
      �ر�</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�ر�Ͷ�壺</td>
      <td height="25"><input name="closeadd" type="checkbox" id="closeadd" value="1"<?=$r[closeadd]==1?' checked':''?>>
        �ر�</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="�ύ">&nbsp;<input type="reset" name="Submit2" value="����"></td>
    </tr>
  </table>
</form>
</body>
</html>
<?
db_close();
$empire=null;
?>