<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
DoWapHeader($pagetitle);
?>
<p><b>��Ϣ����:</b> <?=DoWapClearHtml($r[title])?><br/>
<b>����ʱ��:</b> <?=date("Y-m-d H:i:s",$r[newstime])?><br/>
<b>�� �� ��  &nbsp;:</b> <?=DoWapRepF($r[myarea],'myarea',$ret_r)?><br/>
<b>��Ϣ����:</b></p>
<p><?=DoWapRepF($r[smalltext],'smalltext',$ret_r)?><br/></p>
<p><b>��ϵ��ʽ</b><br/>
�� �� ��  &nbsp;: <?=DoWapClearHtml($r['username'])?><br/>
��ϵ����: <?=DoWapClearHtml($r['email'])?><br/>
��ϵ��ʽ: <?=DoWapRepF($r[mycontact],'mycontact',$ret_r)?><br/>
��ϵ��ַ: <?=DoWapRepF($r[address],'address',$ret_r)?><br/>
</p>
<p><br/><a href="<?=$listurl?>">�����б�</a> <a href="index.php?style=<?=$wapstyle?>">��վ��ҳ</a></p>
<?php
DoWapFooter();
?>