<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
DoWapHeader($pagetitle);
?>
<p><b>�б�:</b><?=$pagetitle?></p>
<p>
<?php
while($r=$empire->fetch($sql))
{
	$titleurl="show.php?classid=".$r[classid]."&amp;id=".$r[id]."&amp;style=".$wapstyle."&amp;bclassid=".$bclassid."&amp;cid=".$classid."&amp;cpage=".$page;
	//��ȡ����
	if($pr['wapsubtitle'])
	{
		$r[title]=sub($r[title],0,$pr['wapsubtitle'],false);
	}
	//ʱ���ʽ
	$r[newstime]=date($pr['wapshowdate'],$r[newstime]);
?>
<a href="<?=$titleurl?>"><?=DoWapClearHtml($r[title])?></a> <small>(<?=$r[newstime]?>)</small><br />
<?php
}
?>
</p>
<?php
if($returnpage)
{
?>
<p><?=$returnpage?><br /></p>
<?php
}
?>
<p><a href="index.php?style=<?=$wapstyle?>&amp;bclassid=<?=$bclassid?>">����</a> <a href="index.php?style=<?=$wapstyle?>">��վ��ҳ</a></p>
<?php
DoWapFooter();
?>