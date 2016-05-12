<?php
if(!function_exists('version_compare') || version_compare( phpversion(), '5', '<' ) )
	include_once(dirname(__FILE__).'/fckeditor_php4.php');
else
	include_once(dirname(__FILE__).'/fckeditor_php5.php');

//������,����ֵ,������ģʽ,�༭��Ŀ¼,�߶�,���
function ECMS_ShowEditorVar($varname,$varvalue,$toolbar='Default',$basepath='',$height='300',$width='100%'){
	if(empty($basepath))
	{
		$basepath='ecmseditor/infoeditor/';
	}
	if(empty($height))
	{
		$height='300';
	}
	if(empty($width))
	{
		$width='100%';
	}
	//��������
	$oFCKeditor=new FCKeditor($varname);
	$oFCKeditor->BasePath=$basepath;
	$oFCKeditor->Value=$varvalue;
	$oFCKeditor->Height=$height;
	$oFCKeditor->Width=$width;
	$oFCKeditor->ToolbarSet=$toolbar;
	//�����ģ�����
	$area=$oFCKeditor->CreateHtml();
	return $area;
}

//���Ӳ���
function ECMS_ReturnEditorCx(){
	global $classid,$filepass,$id,$r,$enews,$ecms_hashur;
	if($enews=='AddClass'||$enews=='EditClass')
	{
		$modtype=1;
	}
	elseif($enews=='AddZt'||$enews=='EditZt')
	{
		$modtype=2;
	}
	else
	{
		$modtype=0;
	}
	$str="&classid=$classid&filepass=$filepass&infoid=$id&modtype=$modtype&sinfo=1".$ecms_hashur['ehref'];
	return $str;
}
?>