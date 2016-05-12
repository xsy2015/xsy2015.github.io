<?php
define('EmpireCMSAdmin','1');
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
require("../class/t_functions.php");
$link=db_connect();
$empire=new mysqlquery();
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
CheckLevel($logininid,$loginin,$classid,"public");

//��������
function SetEnews($add,$userid,$username){
	global $empire,$dbtbpre;
	//����Ȩ��
	CheckLevel($userid,$username,$classid,"public");
	$add[newsurl]=ehtmlspecialchars($add[newsurl],ENT_QUOTES);
	if(empty($add[indextype])){
		$add[indextype]=".html";
	}
	if(empty($add[searchtype])){
		$add[searchtype]=".html";
	}
	//����Ŀ¼
	if(empty($add[bakdbpath])){
		$add[bakdbpath]="bdata";
	}
	if(!file_exists("ebak/".RepPathStr($add[bakdbpath])))
	{
		printerror("NotBakDbPath","");
	}
	if(empty($add[bakdbzip])){
		$add[bakdbzip]="zip";
	}
	if(!file_exists("ebak/".RepPathStr($add[bakdbzip]))){
		printerror("NotbakZipPath","");
	}
	//�����Ƿ����
    if(!function_exists($add['listpagefun'])||!function_exists($add['textpagefun'])||!function_exists($add['listpagelistfun']))
	{
		printerror("NotPageFun","history.go(-1)");
    }
	//adfile
	$add['adfile']=RepFilenameQz($add['adfile']);
	//�޸�ftp����
	if($add[ftppassword])
	{
		$a="ftppassword='$add[ftppassword]',";
    }
	//��������
	$add[filesize]=(int)$add[filesize];
	$add[hotnum]=(int)$add[hotnum];
	$add[newnum]=(int)$add[newnum];
	$add[relistnum]=(int)$add[relistnum];
	$add[renewsnum]=(int)$add[renewsnum];
	$add[min_keyboard]=(int)$add[min_keyboard];
	$add[max_keyboard]=(int)$add[max_keyboard];
	$add[search_num]=(int)$add[search_num];
	$add[search_pagenum]=(int)$add[search_pagenum];
	$add[newslink]=(int)$add[newslink];
	$add[checked]=(int)$add[checked];
	$add[searchtime]=(int)$add[searchtime];
	$add[loginnum]=(int)$add[loginnum];
	$add[logintime]=(int)$add[logintime];
	$add[addnews_ok]=(int)$add[addnews_ok];
	$add[register_ok]=(int)$add[register_ok];
	$add[goodlencord]=(int)$add[goodlencord];
	$add[goodnum]=(int)$add[goodnum];
	$add[exittime]=(int)$add[exittime];
	$add[smalltextlen]=(int)$add[smalltextlen];
	$add[defaultgroupid]=(int)$add[defaultgroupid];
	$add[phpmode]=(int)$add[phpmode];
	$add[install]=(int)$add[install];
	$add[hotplnum]=(int)$add[hotplnum];
	$add[dorepnum]=(int)$add[dorepnum];
	$add[loadtempnum]=(int)$add[loadtempnum];
	$add[firstnum]=(int)$add[firstnum];
	$add[min_userlen]=(int)$add[min_userlen];
	$add[max_userlen]=(int)$add[max_userlen];
	$add[min_passlen]=(int)$add[min_passlen];
	$add[max_passlen]=(int)$add[max_passlen];
	$add[filechmod]=(int)$add[filechmod];
	$add[sametitle]=(int)$add[sametitle];
	$add[addrehtml]=(int)$add[addrehtml];
	$add[loginkey_ok]=(int)$add[loginkey_ok];
	$add[limittype]=(int)$add[limittype];
	$add[redodown]=(int)$add[redodown];
	$add[candocode]=(int)$add[candocode];
	$add[opennotcj]=(int)$add[opennotcj];
	$add[reuserpagenum]=(int)$add[reuserpagenum];
	$add[revotejsnum]=(int)$add[revotejsnum];
	$add[readjsnum]=(int)$add[readjsnum];
	$add[qaddtran]=(int)$add[qaddtran];
	$add[qaddtransize]=(int)$add[qaddtransize];
	$add[ebakthisdb]=(int)$add[ebakthisdb];
	$add[delnewsnum]=(int)$add[delnewsnum];
	$add[markpos]=(int)$add[markpos];
	$add[adminloginkey]=(int)$add[adminloginkey];
	$add[php_outtime]=(int)$add[php_outtime];
	$add[addreinfo]=(int)$add[addreinfo];
	$add[rssnum]=(int)$add[rssnum];
	$add[rsssub]=(int)$add[rsssub];
	$add[dorepdlevelnum]=(int)$add[dorepdlevelnum];
	$add[listpagelistnum]=(int)$add[listpagelistnum];
	$add[infolinknum]=(int)$add[infolinknum];
	$add[searchgroupid]=(int)$add[searchgroupid];
	$add[opencopytext]=(int)$add[opencopytext];
	$add[reuserjsnum]=(int)$add[reuserjsnum];
	$add[reuserlistnum]=(int)$add[reuserlistnum];
	$add[opentitleurl]=(int)$add[opentitleurl];
	$add['qaddtranfile']=(int)$add['qaddtranfile'];
	$add['qaddtranfilesize']=(int)$add['qaddtranfilesize'];
	$add['sendmailtype']=(int)$add['sendmailtype'];
	$add['loginemail']=(int)$add['loginemail'];
	$add['feedbacktfile']=(int)$add['feedbacktfile'];
	$add['feedbackfilesize']=(int)$add['feedbackfilesize'];
	$add['searchtempvar']=(int)$add['searchtempvar'];
	$add['showinfolevel']=(int)$add['showinfolevel'];
	$add['spicwidth']=(int)$add['spicwidth'];
	$add['spicheight']=(int)$add['spicheight'];
	$add['spickill']=(int)$add['spickill'];
	$add['jpgquality']=(int)$add['jpgquality'];
	$add['markpct']=(int)$add['markpct'];
	$add['redoview']=(int)$add['redoview'];
	$add['reggetfen']=(int)$add['reggetfen'];
	$add['regbooktime']=(int)$add['regbooktime'];
	$add['revotetime']=(int)$add['revotetime'];
	$add['fpath']=(int)$add['fpath'];
	$add['openmembertranimg']=(int)$add['openmembertranimg'];
	$add['memberimgsize']=(int)$add['memberimgsize'];
	$add['openmembertranfile']=(int)$add['openmembertranfile'];
	$add['memberfilesize']=(int)$add['memberfilesize'];
	$add['openspace']=(int)$add['openspace'];
	$add['realltime']=(int)$add['realltime'];
	$add['textpagelistnum']=(int)$add['textpagelistnum'];
	$add['memberlistlevel']=(int)$add['memberlistlevel'];
	$add['ebakcanlistdb']=(int)$add['ebakcanlistdb'];
	$add['keytog']=(int)$add['keytog'];
	$add['keytime']=(int)$add['keytime'];
	$add['regkey_ok']=(int)$add['regkey_ok'];
	$add['opengetdown']=(int)$add['opengetdown'];
	$add['gbkey_ok']=(int)$add['gbkey_ok'];
	$add['fbkey_ok']=(int)$add['fbkey_ok'];
	$add['newaddinfotime']=(int)$add['newaddinfotime'];
	$add['classnavline']=(int)$add['classnavline'];
	$add['docnewsnum']=(int)$add['docnewsnum'];
	$add['dtcanbq']=(int)$add['dtcanbq'];
	$add['dtcachetime']=(int)$add['dtcachetime'];
	$add['regretime']=(int)$add['regretime'];
	$add['regemailonly']=(int)$add['regemailonly'];
	$add['repkeynum']=(int)$add['repkeynum'];
	$add['getpasstime']=(int)$add['getpasstime'];
	$add['acttime']=(int)$add['acttime'];
	$add['regacttype']=(int)$add['regacttype'];
	$add['opengetpass']=(int)$add['opengetpass'];
	$add['hlistinfonum']=(int)$add['hlistinfonum'];
	if(empty($add['hlistinfonum']))
	{
		$add['hlistinfonum']=30;
	}
	$add['qlistinfonum']=(int)$add['qlistinfonum'];
	if(empty($add['qlistinfonum']))
	{
		$add['qlistinfonum']=30;
	}
	$add['dtncanbq']=(int)$add['dtncanbq'];
	$add['dtncachetime']=(int)$add['dtncachetime'];
	$add['readdinfotime']=(int)$add['readdinfotime'];
	$add['qeditinfotime']=(int)$add['qeditinfotime'];
	$add['ftpmode']=(int)$add['ftpmode'];
	$add['ftpssl']=(int)$add['ftpssl'];
	$add['ftppasv']=(int)$add['ftppasv'];
	$add['ftpouttime']=(int)$add['ftpouttime'];
	$add['onclicktype']=(int)$add['onclicktype'];
	$add['onclickfilesize']=(int)$add['onclickfilesize'];
	$add['onclickfiletime']=(int)$add['onclickfiletime'];
	$add['closeqdt']=(int)$add['closeqdt'];
	$add['settop']=(int)$add['settop'];
	$add['qlistinfomod']=(int)$add['qlistinfomod'];
	$add['gb_num']=(int)$add['gb_num'];
	$add['member_num']=(int)$add['member_num'];
	$add['space_num']=(int)$add['space_num'];
	$add['infolday']=(int)$add['infolday'];
	$add['filelday']=(int)$add['filelday'];
	$add['baktempnum']=(int)$add['baktempnum'];
	$add['dorepkey']=(int)$add['dorepkey'];
	$add['dorepword']=(int)$add['dorepword'];
	$add['indexpagedt']=(int)$add['indexpagedt'];
	$add['closeqdtmsg']=AddAddsData($add['closeqdtmsg']);
	$add['openfileserver']=(int)$add['openfileserver'];
	$add['fieldandtop']=(int)$add['fieldandtop'];
	$add['fieldandclosetb']=$add['fieldandclosetb']?','.$add['fieldandclosetb'].',':'';
	$add['firsttitlename']=ehtmlspecialchars(str_replace("\r\n","|",$add['firsttitlename']));
	$add['isgoodname']=ehtmlspecialchars(str_replace("\r\n","|",$add['isgoodname']));
	$add['closelisttemp']=ehtmlspecialchars($add['closelisttemp']);
	$add['ipaddinfonum']=(int)$add['ipaddinfonum'];
	$add['ipaddinfotime']=(int)$add['ipaddinfotime'];
	$add['indexaddpage']=(int)$add['indexaddpage'];
	$add['modmemberedittran']=(int)$add['modmemberedittran'];
	$add['modinfoedittran']=(int)$add['modinfoedittran'];
	//�ύIP
	$doiptypes='';
	$doiptype=$add['doiptype'];
	$doiptypecount=count($doiptype);
	if($doiptypecount)
	{
		$doiptypes=',';
		for($di=0;$di<$doiptypecount;$di++)
		{
			$doiptypes.=$doiptype[$di].',';
		}
	}
	//�ر����ģ��
	$closemodss='';
	$closemods=$add['closemods'];
	$closemodscount=count($closemods);
	if($closemodscount)
	{
		$closemodss=',';
		for($cmi=0;$cmi<$closemodscount;$cmi++)
		{
			$closemodss.=$closemods[$cmi].',';
		}
	}
	//�رպ�̨�˵�
	$closehmenus='';
	$closehmenu=$add['closehmenu'];
	$closehmenucount=count($closehmenu);
	if($closehmenucount)
	{
		$closehmenus=',';
		for($chmi=0;$chmi<$closehmenucount;$chmi++)
		{
			$closehmenus.=$closehmenu[$chmi].',';
		}
	}
	//���Ʋ�����ʱ���
	$timecloses='';
	$timeclose=$add['timeclose'];
	$timeclosecount=count($timeclose);
	if($timeclosecount)
	{
		$timecloses=',';
		for($tci=0;$tci<$timeclosecount;$tci++)
		{
			$timecloses.=$timeclose[$tci].',';
		}
	}
	//����ʹ��ʱ��Ĳ���
	$timeclosedos='';
	$timeclosedo=$add['timeclosedo'];
	$timeclosedocount=count($timeclosedo);
	if($timeclosedocount)
	{
		$timeclosedos=',';
		for($tcdi=0;$tcdi<$timeclosedocount;$tcdi++)
		{
			$timeclosedos.=$timeclosedo[$tcdi].',';
		}
	}

	$add[filetype]="|".$add[filetype]."|";
	$add[qimgtype]="|".$add['qaddtranimgtype']."|";
	$add[qfiletype]="|".$add['qaddtranfiletype']."|";
	$add[feedbackfiletype]="|".$add['feedbackfiletype']."|";
	$add[memberimgtype]="|".$add['memberimgtype']."|";
	$add[memberfiletype]="|".$add['memberfiletype']."|";
	$sql=$empire->query("update {$dbtbpre}enewspublic set ".$a."sitename='$add[sitename]',newsurl='$add[newsurl]',email='$add[email]',filetype='$add[filetype]',filesize=$add[filesize],hotnum=$add[hotnum],newnum=$add[newnum],relistnum=$add[relistnum],renewsnum=$add[renewsnum],min_keyboard=$add[min_keyboard],max_keyboard=$add[max_keyboard],search_num=$add[search_num],search_pagenum=$add[search_pagenum],newslink=$add[newslink],checked=$add[checked],searchtime=$add[searchtime],loginnum=$add[loginnum],logintime=$add[logintime],addnews_ok=$add[addnews_ok],register_ok=$add[register_ok],indextype='$add[indextype]',goodlencord=$add[goodlencord],goodtype='$add[goodtype]',goodnum=$add[goodnum],searchtype='$add[searchtype]',exittime=$add[exittime],smalltextlen=$add[smalltextlen],defaultgroupid=$add[defaultgroupid],fileurl='$add[fileurl]',phpmode=$add[phpmode],ftphost='$add[ftphost]',ftpport='$add[ftpport]',ftpusername='$add[ftpusername]',ftppath='$add[ftppath]',ftpmode='$add[ftpmode]',install=$add[install],hotplnum=$add[hotplnum],dorepnum=$add[dorepnum],loadtempnum=$add[loadtempnum],firstnum=$add[firstnum],bakdbpath='$add[bakdbpath]',bakdbzip='$add[bakdbzip]',downpass='$add[downpass]',min_userlen=$add[min_userlen],max_userlen=$add[max_userlen],min_passlen=$add[min_passlen],max_passlen=$add[max_passlen],filechmod=$add[filechmod],loginkey_ok=$add[loginkey_ok],limittype=$add[limittype],redodown=$add[redodown],candocode=$add[candocode],opennotcj=$add[opennotcj],reuserpagenum=$add[reuserpagenum],revotejsnum=$add[revotejsnum],readjsnum=$add[readjsnum],qaddtran=$add[qaddtran],qaddtransize=$add[qaddtransize],ebakthisdb=$add[ebakthisdb],delnewsnum=$add[delnewsnum],markpos=$add[markpos],markimg='$add[markimg]',marktext='$add[marktext]',markfontsize='$add[markfontsize]',markfontcolor='$add[markfontcolor]',markfont='$add[markfont]',adminloginkey=$add[adminloginkey],php_outtime=$add[php_outtime],listpagefun='$add[listpagefun]',textpagefun='$add[textpagefun]',adfile='$add[adfile]',notsaveurl='$add[notsaveurl]',rssnum=$add[rssnum],rsssub=$add[rsssub],dorepdlevelnum=$add[dorepdlevelnum],listpagelistfun='$add[listpagelistfun]',listpagelistnum=$add[listpagelistnum],infolinknum=$add[infolinknum],searchgroupid=$add[searchgroupid],opencopytext=$add[opencopytext],reuserjsnum=$add[reuserjsnum],reuserlistnum=$add[reuserlistnum],opentitleurl='$add[opentitleurl]',qaddtranimgtype='$add[qimgtype]',qaddtranfile=$add[qaddtranfile],qaddtranfilesize=$add[qaddtranfilesize],qaddtranfiletype='$add[qfiletype]',sendmailtype=$add[sendmailtype],smtphost='$add[smtphost]',fromemail='$add[fromemail]',loginemail=$add[loginemail],emailusername='$add[emailusername]',emailpassword='$add[emailpassword]',smtpport='$add[smtpport]',emailname='$add[emailname]',feedbacktfile=$add[feedbacktfile],feedbackfilesize=$add[feedbackfilesize],feedbackfiletype='$add[feedbackfiletype]',searchtempvar=$add[searchtempvar],showinfolevel=$add[showinfolevel],navfh='".eaddslashes($add[navfh])."',spicwidth=$add[spicwidth],spicheight=$add[spicheight],spickill=$add[spickill],jpgquality=$add[jpgquality],markpct=$add[markpct],redoview=$add[redoview],reggetfen=$add[reggetfen],regbooktime=$add[regbooktime],revotetime=$add[revotetime],fpath=$add[fpath],filepath='$add[filepath]',openmembertranimg=$add[openmembertranimg],memberimgsize=$add[memberimgsize],openmembertranfile=$add[openmembertranfile],memberfilesize=$add[memberfilesize],memberimgtype='$add[memberimgtype]',memberfiletype='$add[memberfiletype]',canposturl='$add[canposturl]',openspace='$add[openspace]',realltime=$add[realltime],closeip='$add[closeip]',openip='$add[openip]',hopenip='$add[hopenip]',closewords='$add[closewords]',closewordsf='$add[closewordsf]',textpagelistnum=$add[textpagelistnum],memberlistlevel=$add[memberlistlevel],ebakcanlistdb=$add[ebakcanlistdb],keytog='$add[keytog]',keyrnd='$add[keyrnd]',keytime='$add[keytime]',regkey_ok='$add[regkey_ok]',opengetdown='$add[opengetdown]',gbkey_ok='$add[gbkey_ok]',fbkey_ok='$add[fbkey_ok]',newaddinfotime='$add[newaddinfotime]',classnavline='$add[classnavline]',classnavfh='".eaddslashes($add[classnavfh])."',sitekey='$add[sitekey]',siteintro='$add[siteintro]',docnewsnum='$add[docnewsnum]',dtcanbq='$add[dtcanbq]',dtcachetime='$add[dtcachetime]',regretime='$add[regretime]',regclosewords='$add[regclosewords]',regemailonly='$add[regemailonly]',repkeynum='$add[repkeynum]',getpasstime='$add[getpasstime]',acttime='$add[acttime]',regacttype='$add[regacttype]',acttext='".eaddslashes($add[acttext])."',getpasstext='".eaddslashes($add[getpasstext])."',acttitle='".eaddslashes($add[acttitle])."',getpasstitle='".eaddslashes($add[getpasstitle])."',opengetpass='$add[opengetpass]',hlistinfonum='$add[hlistinfonum]',qlistinfonum='$add[qlistinfonum]',dtncanbq='$add[dtncanbq]',dtncachetime='$add[dtncachetime]',readdinfotime='$add[readdinfotime]',qeditinfotime='$add[qeditinfotime]',ftpssl='$add[ftpssl]',ftppasv='$add[ftppasv]',ftpouttime='$add[ftpouttime]',onclicktype='$add[onclicktype]',onclickfilesize='$add[onclickfilesize]',onclickfiletime='$add[onclickfiletime]',closeqdt='$add[closeqdt]',settop='$add[settop]',qlistinfomod='$add[qlistinfomod]',gb_num='$add[gb_num]',member_num='$add[member_num]',space_num='$add[space_num]',opendoip='$add[opendoip]',closedoip='$add[closedoip]',doiptype='$doiptypes',infolday='$add[infolday]',filelday='$add[filelday]',baktempnum='$add[baktempnum]',dorepkey='$add[dorepkey]',dorepword='$add[dorepword]',onclickrnd='$add[onclickrnd]',indexpagedt='$add[indexpagedt]',keybgcolor='$add[keybgcolor]',keyfontcolor='$add[keyfontcolor]',keydistcolor='$add[keydistcolor]',closeqdtmsg='$add[closeqdtmsg]',openfileserver='$add[openfileserver]',closemods='$closemodss',fieldandtop='$add[fieldandtop]',fieldandclosetb='$add[fieldandclosetb]',firsttitlename='".eaddslashes($add[firsttitlename])."',isgoodname='".eaddslashes($add[isgoodname])."',closelisttemp='".eaddslashes($add[closelisttemp])."',chclasscolor='".eaddslashes($add[chclasscolor])."',timeclose='".eaddslashes($timecloses)."',timeclosedo='".eaddslashes($timeclosedos)."',ipaddinfonum='$add[ipaddinfonum]',ipaddinfotime='$add[ipaddinfotime]',closehmenu='$closehmenus',indexaddpage='$add[indexaddpage]',modmemberedittran='$add[modmemberedittran]',modinfoedittran='$add[modinfoedittran]';");
	DoSetFileServer($add);//Զ�̸�������
	GetConfig();
	//��ҳ��̬�ļ�
	if($add['indexpagedt']!=$add['oldindexpagedt'])
	{
		if($add['indexpagedt'])
		{
			DelFiletext(ECMS_PATH.'index'.$add[indextype]);
			@copy(ECMS_PATH.'e/data/template/dtindexpage.txt',ECMS_PATH.'index.php');
		}
		else
		{
			DelFiletext(ECMS_PATH.'index.php');
			$indextemp=GetIndextemp();
			NewsBq(0,$indextemp,1,0);
		}
	}
	if($sql){
		insert_dolog("");//������־
		printerror("SetPublicSuccess","SetEnews.php".hReturnEcmsHashStrHref2(1));
	}
	else{
		printerror("DbError","history.go(-1)");
	}
}

//Զ�̸�������
function DoSetFileServer($add){
	global $empire,$dbtbpre;
	$update='';
	if($add['fs_ftppassword'])
	{
		$update=",ftppassword='$add[fs_ftppassword]'";
	}
	$add['fs_ftpmode']=(int)$add['fs_ftpmode'];
	$add['fs_ftpssl']=(int)$add['fs_ftpssl'];
	$add['fs_ftppasv']=(int)$add['fs_ftppasv'];
	$add['fs_ftpouttime']=(int)$add['fs_ftpouttime'];
	$sql=$empire->query("update {$dbtbpre}enewspostserver set purl='$add[fs_purl]',ftphost='$add[fs_ftphost]',ftpport='$add[fs_ftpport]',ftpusername='$add[fs_ftpusername]',ftppath='$add[fs_ftppath]',ftpmode='$add[fs_ftpmode]',ftpssl='$add[fs_ftpssl]',ftppasv='$add[fs_ftppasv]',ftpouttime='$add[fs_ftpouttime]'".$update." where pid='1'");
}

//����Զ�̸���FTP
function CheckFileServerFtp($add,$userid,$username){
	global $empire,$dbtbpre;
	//����Ȩ��
	CheckLevel($userid,$username,$classid,"public");
	$ftphost=$add[fs_ftphost];
	$ftpport=$add[fs_ftpport];
	$ftpusername=$add[fs_ftpusername];
	if($add[fs_ftppassword])
	{
		$ftppassword=$add[fs_ftppassword];
	}
	else
	{
		$fsr=$empire->fetch1("select ftppassword from {$dbtbpre}enewspostserver where pid='1' limit 1");
		$ftppassword=$fsr[ftppassword];
	}
	$ftppath=$add[fs_ftppath];
	$tranmode=(int)$add['fs_ftpmode'];
	$ftpssl=(int)$add['fs_ftpssl'];
	$pasv=(int)$add['fs_ftppasv'];
	$timeout=(int)$add['fs_ftpouttime'];
	CheckFtpConnect($ftphost,$ftpport,$ftpusername,$ftppassword,$ftppath,$ftpssl,$pasv,$tranmode,$timeout);
}

//����Զ�̷���FTP
function CheckPostServerFtp($add,$userid,$username){
	global $empire,$dbtbpre;
	//����Ȩ��
	CheckLevel($userid,$username,$classid,"public");
	$ftphost=$add[ftphost];
	$ftpport=$add[ftpport];
	$ftpusername=$add[ftpusername];
	if($add[ftppassword])
	{
		$ftppassword=$add[ftppassword];
	}
	else
	{
		$fsr=$empire->fetch1("select ftppassword from {$dbtbpre}enewspublic limit 1");
		$ftppassword=$fsr[ftppassword];
	}
	$ftppath=$add[ftppath];
	$tranmode=(int)$add['ftpmode'];
	$ftpssl=(int)$add['ftpssl'];
	$pasv=(int)$add['ftppasv'];
	$timeout=(int)$add['ftpouttime'];
	CheckFtpConnect($ftphost,$ftpport,$ftpusername,$ftppassword,$ftppath,$ftpssl,$pasv,$tranmode,$timeout);
}

$enews=$_POST['enews'];
if(empty($enews))
{
	$enews=$_GET['enews'];
}
if($enews)
{
	hCheckEcmsRHash();
	include LoadLang("pub/fun.php");
	include("../data/dbcache/class.php");
	include("../data/dbcache/MemberLevel.php");
}
if($enews=="SetEnews")//��������
{
	SetEnews($_POST,$logininid,$loginin);
}
elseif($enews=='CheckFileServerFtp')//���Ը���FTP
{
	CheckFileServerFtp($_POST,$logininid,$loginin);
}
elseif($enews=='CheckPostServerFtp')//����Զ�̷���FTP
{
	CheckPostServerFtp($_POST,$logininid,$loginin);
}

$r=$empire->fetch1("select * from {$dbtbpre}enewspublic limit 1");
//�ļ����
$filetype=substr($r[filetype],1,strlen($r[filetype]));
$filetype=substr($filetype,0,strlen($filetype)-1);
//Ͷ��ͼƬ��չ��
$qaddimgtype=substr($r[qaddtranimgtype],1,strlen($r[qaddtranimgtype]));
$qaddimgtype=substr($qaddimgtype,0,strlen($qaddimgtype)-1);
//Ͷ�帽����չ��
$qaddfiletype=substr($r[qaddtranfiletype],1,strlen($r[qaddtranfiletype]));
$qaddfiletype=substr($qaddfiletype,0,strlen($qaddfiletype)-1);
//��������
$feedbackfiletype=substr($r[feedbackfiletype],1,strlen($r[feedbackfiletype])-2);
//��Ա��
$memberimgtype=substr($r[memberimgtype],1,strlen($r[memberimgtype]));
$memberimgtype=substr($memberimgtype,0,strlen($memberimgtype)-1);
$memberfiletype=substr($r[memberfiletype],1,strlen($r[memberfiletype]));
$memberfiletype=substr($memberfiletype,0,strlen($memberfiletype)-1);
//----------��Ա��
$sql1=$empire->query("select groupid,groupname from {$dbtbpre}enewsmembergroup order by level");
while($l_r=$empire->fetch($sql1))
{
	if($r[defaultgroupid]==$l_r[groupid])
	{$select=" selected";}
	else
	{$select="";}
	//������Ա��
	if($r[searchgroupid]==$l_r[groupid])
	{$s_select=" selected";}
	else
	{$s_select="";}
	//�鿴����Ȩ��
	if($r[showinfolevel]==$l_r[groupid])
	{$showinfo_select=" selected";}
	else
	{$showinfo_select="";}
	//��Ա�б�鿴Ȩ��
	if($r[memberlistlevel]==$l_r[groupid])
	{$memberlist_select=" selected";}
	else
	{$memberlist_select="";}
	$membergroup.="<option value=".$l_r[groupid].$select.">".$l_r[groupname]."</option>";
	$searchmembergroup.="<option value=".$l_r[groupid].$s_select.">".$l_r[groupname]."</option>";
	$showinfolevel.="<option value=".$l_r[groupid].$showinfo_select.">".$l_r[groupname]."</option>";
	$memberlistlevel.="<option value=".$l_r[groupid].$memberlist_select.">".$l_r[groupname]."</option>";
}
//Զ�̸���
if($r['openfileserver']==1)
{
	$hiddenfileserver="<script>document.getElementById('setfileserver').style.display='';</script>";
}
else
{
	$hiddenfileserver="<script>document.getElementById('setfileserver').style.display='none';</script>";
}
$fsr=$empire->fetch1("select * from {$dbtbpre}enewspostserver where pid='1' limit 1");
//��ǰʹ�õ�ģ����
$thegid=GetDoTempGid();
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>��������</title>
<link href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<link id="luna-tab-style-sheet" type="text/css" rel="stylesheet" href="adminstyle/<?=$loginadminstyleid?>/tab.winclassic.css" disabled="disabled" /> 
<!-- the id is not needed. It is used here to be able to change css file at runtime -->
<style type="text/css"> 
   .dynamic-tab-pane-control .tab-page { 
          width:                100%;
 } 
  .dynamic-tab-pane-control .tab-page .dynamic-tab-pane-control .tab-page { 
         height:                150px; 
 } 
  form { 
         margin:        0; 
         padding:        0; 
 } 
  /* over ride styles from webfxlayout */ 
  .dynamic-tab-pane-control h2 { 
         font-size:12px;
		 font-weight:normal;
		 text-align:        center; 
         width:                auto;
		 height:            20; 
 } 
   .dynamic-tab-pane-control h2 a { 
         display:        inline; 
         width:                auto; 
 } 
  .dynamic-tab-pane-control a:hover { 
         background: transparent; 
 } 
  </style>
 <script type="text/javascript" src="../data/images/tabpane.js"></script> <script type="text/javascript"> 
  function setLinkSrc( sStyle ) { 
         document.getElementById( "luna-tab-style-sheet" ).disabled = sStyle != "luna"; 
  
         //document.documentElement.style.background = "";
         //document.body.style.background = sStyle == "webfx" ? "white" : "ThreeDFace"; 
 } 
function chgBg(obj,color){
 if (document.all || document.getElementById)
   obj.style.backgroundColor=color;
 else if (document.layers)
   obj.bgColor=color;
}
  setLinkSrc( "luna" ); 
  
  function foreColor(objf)
{
  if (!Error())	return;
  var arr = showModalDialog("ecmseditor/fieldfile/selcolor.html", "", "dialogWidth:18.5em; dialogHeight:17.5em; status:0");
  if (arr != null) objf.value=arr;
  else objf.focus();
}
  </script> 
</head>

<body>
<table width="100%%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>λ�ã�<a href="SetEnews.php<?=$ecms_hashur['whehref']?>">��������</a></td>
  </tr>
</table>
<form name="form1" method="post" action="SetEnews.php">
<div class="tab-pane" id="TabPane1"> <script type="text/javascript">
tb1 = new WebFXTabPane( document.getElementById( "TabPane1" ) );
</script>
<div class="tab-page" id="baseinfo"> 
                    
      <h2 class="tab">&nbsp;<font class=tabcolor>��������</font>&nbsp;</h2>
                    <script type="text/javascript">tb1.addTabPage( document.getElementById( "baseinfo" ) );</script>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
	  <?=$ecms_hashur['form']?>
        <input type=hidden name=enews value=SetEnews>
        <tr class="header"> 
          <td height="25" colspan="2">������Ϣ����</td>
        </tr>
        <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">վ������</td>
          <td width="78%" height="25" bgcolor="#FFFFFF"> <input name="sitename" type="text" id="sitename" value="<?=$r[sitename]?>" size="38"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��վ��ַ</td>
          <td height="25" bgcolor="#FFFFFF"> <input name="newsurl" type="text" id="newsurl4" value="<?=$r[newsurl]?>" size="38"> 
            <font color="#666666">(��β��ӡ�/�����磺/)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">������ַ</td>
          <td height="25" bgcolor="#FFFFFF"><input name="fileurl" type="text" id="fileurl" value="<?=$r[fileurl]?>" size="38"> 
            <font color="#666666">(������ʱ���ã���β��ӡ�/�����磺/d/file/)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">����Ա����</td>
          <td height="25" bgcolor="#FFFFFF"> <input name="email" type="text" id="email" value="<?=$r[email]?>" size="38"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��վ�ؼ���</td>
          <td height="25" bgcolor="#FFFFFF"><input name="sitekey" type="text" id="sitekey" value="<?=$r[sitekey]?>" size="38"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��վ���</td>
          <td height="25" bgcolor="#FFFFFF"><textarea name="siteintro" cols="80" rows="5" id="siteintro"><?=$r[siteintro]?></textarea></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��ҳ�ļ���չ��</td>
          <td height="25" bgcolor="#FFFFFF"><input name="indextype" type="text" id="indextype" value="<?=$r[indextype]?>" size="38"> 
            <font color="#666666"> 
            <select name="select" onchange="document.form1.indextype.value=this.value">
              <option value=".html">��չ��</option>
              <option value=".html">.html</option>
              <option value=".htm">.htm</option>
              <option value=".php">.php</option>
              <option value=".shtml">.shtml</option>
            </select>
            <input name="oldindextype" type="hidden" id="oldindextype" value="<?=$r[indextype]?>">
            <font color="#666666"></font>(�磺.html,.htm,.xml,.php)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��ҳģʽ</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="indexpagedt" value="0"<?=$r['indexpagedt']==0?' checked':''?>>
            ��̬��ҳ 
            <input type="radio" name="indexpagedt" value="1"<?=$r['indexpagedt']==1?' checked':''?>>
            ��̬��ҳ 
            <input name="oldindexpagedt" type="hidden" id="oldindexpagedt" value="<?=$r[indexpagedt]?>"></td>
        </tr>
        <tr>
          <td height="25" bgcolor="#FFFFFF">��ҳ���Ӽ��ļ���</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="indexaddpage" value="1"<?=$r['indexaddpage']==1?' checked':''?>>
            ����
            <input type="radio" name="indexaddpage" value="0"<?=$r['indexaddpage']==0?' checked':''?>>
  ������</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">PHP��ʱʱ������</td>
          <td height="25" bgcolor="#FFFFFF"><input name="php_outtime" type="text" id="php_outtime" value="<?=$r[php_outtime]?>" size="38">
            �� <font color="#666666">(һ�㲻��Ҫ����)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�ر�ǰ̨���ж�̬ҳ��</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="closeqdt" value="1"<?=$r[closeqdt]==1?' checked':''?>>
            �� 
            <input type="radio" name="closeqdt" value="0"<?=$r[closeqdt]==0?' checked':''?>>
            ��<font color="#666666">(���������ǰ̨���ж�̬�ļ����޷�ʹ�ã������ܺͰ�ȫ�����)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�رն�̬ҳ����ʾ����</td>
          <td height="25" bgcolor="#FFFFFF"> <textarea name="closeqdtmsg" cols="80" rows="5" id="closeqdtmsg"><?=ehtmlspecialchars($r[closeqdtmsg])?></textarea></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�ر�ǰ̨ģ����ع���</td>
          <td height="25" bgcolor="#FFFFFF"><input name="closemods[]" type="checkbox" id="closemods[]" value="down"<?=strstr($r['closemods'],',down,')?' checked':''?>>
            ���� 
            <input name="closemods[]" type="checkbox" id="closemods[]" value="movie"<?=strstr($r['closemods'],',movie,')?' checked':''?>>
            ��Ӱ 
            <input name="closemods[]" type="checkbox" id="closemods[]" value="shop"<?=strstr($r['closemods'],',shop,')?' checked':''?>>
            �̳� 
            <input name="closemods[]" type="checkbox" id="closemods[]" value="pay"<?=strstr($r['closemods'],',pay,')?' checked':''?>>
            ����֧�� 
            <input name="closemods[]" type="checkbox" id="closemods[]" value="rss"<?=strstr($r['closemods'],',rss,')?' checked':''?>>
            RSS 
            <input name="closemods[]" type="checkbox" id="closemods[]" value="search"<?=strstr($r['closemods'],',search,')?' checked':''?>>
            ����
			<input name="closemods[]" type="checkbox" id="closemods[]" value="sch"<?=strstr($r['closemods'],',sch,')?' checked':''?>>
            ȫվ����<br>
            <input name="closemods[]" type="checkbox" id="closemods[]" value="member"<?=strstr($r['closemods'],',member,')?' checked':''?>>
            ��Ա
			<input name="closemods[]" type="checkbox" id="closemods[]" value="pl"<?=strstr($r['closemods'],',pl,')?' checked':''?>>
            ����
			<input name="closemods[]" type="checkbox" id="closemods[]" value="print"<?=strstr($r['closemods'],',print,')?' checked':''?>>
            ��ӡ 
            <input name="closemods[]" type="checkbox" id="closemods[]" value="mconnect"<?=strstr($r['closemods'],',mconnect,')?' checked':''?>>
�ⲿ��¼
<input name="closemods[]" type="checkbox" id="closemods[]" value="fieldand"<?=strstr($r['closemods'],',fieldand,')?' checked':''?>>
            �����</td>
        </tr>
        <tr>
          <td height="25" bgcolor="#FFFFFF">������������ʱ���</td>
          <td height="25" bgcolor="#FFFFFF"><table width="500" border="0" cellspacing="1" cellpadding="3">
            <tr>
              <td><input name="timeclose[]" type="checkbox" value="0"<?=strstr($r['timeclose'],',0,')?' checked':''?>>
                0��</td>
              <td><input name="timeclose[]" type="checkbox" value="1"<?=strstr($r['timeclose'],',1,')?' checked':''?>>
                1��</td>
              <td><input name="timeclose[]" type="checkbox" value="2"<?=strstr($r['timeclose'],',2,')?' checked':''?>>
                2��</td>
              <td><input name="timeclose[]" type="checkbox" value="3"<?=strstr($r['timeclose'],',3,')?' checked':''?>>
                3��</td>
              <td><input name="timeclose[]" type="checkbox" value="4"<?=strstr($r['timeclose'],',4,')?' checked':''?>>
                4��</td>
              <td><input name="timeclose[]" type="checkbox" value="5"<?=strstr($r['timeclose'],',5,')?' checked':''?>>
                5��</td>
            </tr>
            <tr>
              <td><input name="timeclose[]" type="checkbox" value="6"<?=strstr($r['timeclose'],',6,')?' checked':''?>>
                6��</td>
              <td><input name="timeclose[]" type="checkbox" value="7"<?=strstr($r['timeclose'],',7,')?' checked':''?>>
                7��</td>
              <td><input name="timeclose[]" type="checkbox" value="8"<?=strstr($r['timeclose'],',8,')?' checked':''?>>
                8��</td>
              <td><input name="timeclose[]" type="checkbox" value="9"<?=strstr($r['timeclose'],',9,')?' checked':''?>>
                9��</td>
              <td><input name="timeclose[]" type="checkbox" value="10"<?=strstr($r['timeclose'],',10,')?' checked':''?>>
                10��</td>
              <td><input name="timeclose[]" type="checkbox" value="11"<?=strstr($r['timeclose'],',11,')?' checked':''?>>
                11��</td>
            </tr>
            <tr>
              <td><input name="timeclose[]" type="checkbox" value="12"<?=strstr($r['timeclose'],',12,')?' checked':''?>>
                12��</td>
              <td><input name="timeclose[]" type="checkbox" value="13"<?=strstr($r['timeclose'],',13,')?' checked':''?>>
                13��</td>
              <td><input name="timeclose[]" type="checkbox" value="14"<?=strstr($r['timeclose'],',14,')?' checked':''?>>
                14��</td>
              <td><input name="timeclose[]" type="checkbox" value="15"<?=strstr($r['timeclose'],',15,')?' checked':''?>>
                15��</td>
              <td><input name="timeclose[]" type="checkbox" value="16"<?=strstr($r['timeclose'],',16,')?' checked':''?>>
                16��</td>
              <td><input name="timeclose[]" type="checkbox" value="17"<?=strstr($r['timeclose'],',17,')?' checked':''?>>
                17��</td>
            </tr>
            <tr>
              <td><input name="timeclose[]" type="checkbox" value="18"<?=strstr($r['timeclose'],',18,')?' checked':''?>>
                18��</td>
              <td><input name="timeclose[]" type="checkbox" value="19"<?=strstr($r['timeclose'],',19,')?' checked':''?>>
                19��</td>
              <td><input name="timeclose[]" type="checkbox" value="20"<?=strstr($r['timeclose'],',20,')?' checked':''?>>
                20��</td>
              <td><input name="timeclose[]" type="checkbox" value="21"<?=strstr($r['timeclose'],',21,')?' checked':''?>>
                21��</td>
              <td><input name="timeclose[]" type="checkbox" value="22"<?=strstr($r['timeclose'],',22,')?' checked':''?>>
                22��</td>
              <td><input name="timeclose[]" type="checkbox" value="23"<?=strstr($r['timeclose'],',23,')?' checked':''?>>
                23��</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="25" bgcolor="#FFFFFF">�޶�����ʱ��Ĳ���</td>
          <td height="25" bgcolor="#FFFFFF"><input name="timeclosedo[]" type="checkbox" id="timeclosedo[]" value="reg"<?=strstr($r['timeclosedo'],',reg,')?' checked':''?>>
          ע���Ա
            <input name="timeclosedo[]" type="checkbox" id="timeclosedo[]" value="info"<?=strstr($r['timeclosedo'],',info,')?' checked':''?>>
Ͷ��
<input name="timeclosedo[]" type="checkbox" id="timeclosedo[]" value="pl"<?=strstr($r['timeclosedo'],',pl,')?' checked':''?>>
����
<input name="timeclosedo[]" type="checkbox" id="timeclosedo[]" value="gbook"<?=strstr($r['timeclosedo'],',gbook,')?' checked':''?>>
���԰�</td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF">Զ�̱�����Ե�ַ<br> <br> <font color="#666666">(һ��Ϊһ����ַ)</font></td>
          <td height="25" bgcolor="#FFFFFF"><textarea name="notsaveurl" cols="80" rows="8" id="notsaveurl"><?=$r[notsaveurl]?></textarea></td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF">ǰ̨�����ύ����Դ��ַ<br> <br> 
            <font color="#666666">(һ��Ϊһ����ַ)</font></td>
          <td height="25" bgcolor="#FFFFFF"><textarea name="canposturl" cols="80" rows="8" id="canposturl"><?=$r[canposturl]?></textarea></td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF">��֤���ַ����</td>
          <td height="25" bgcolor="#FFFFFF"><select name="keytog" id="keytog">
              <option value="0"<?=$r[keytog]==0?' selected':''?>>����</option>
              <option value="1"<?=$r[keytog]==1?' selected':''?>>��ĸ</option>
              <option value="2"<?=$r[keytog]==2?' selected':''?>>����+��ĸ</option>
            </select></td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF">��֤�����ʱ��</td>
          <td height="25" bgcolor="#FFFFFF"><input name="keytime" type="text" id="keytime" value="<?=$r[keytime]?>" size="38">
            ���� </td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF">��֤������ַ���</td>
          <td height="25" bgcolor="#FFFFFF"><input name="keyrnd" type="text" id="keyrnd" value="<?=$r[keyrnd]?>" size="38"> 
            <font color="#666666">(10~60�������ַ�����ö����ַ����)</font></td>
        </tr>
        <tr> 
          <td rowspan="3" bgcolor="#FFFFFF">��֤����ɫ</td>
          <td height="25" bgcolor="#FFFFFF">������ɫ�� 
            <input name="keybgcolor" type="text" id="keybgcolor" value="<?=$r[keybgcolor]?>"> 
            <a onclick="foreColor(document.form1.keybgcolor);"><img src="../data/images/color.gif" width="21" height="21" align="absbottom"></a>          </td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">������ɫ�� 
            <input name="keyfontcolor" type="text" id="keyfontcolor" value="<?=$r[keyfontcolor]?>"> 
            <a onclick="foreColor(document.form1.keyfontcolor);"><img src="../data/images/color.gif" width="21" height="21" align="absbottom"></a>          </td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">������ɫ�� 
            <input name="keydistcolor" type="text" id="keydistcolor" value="<?=$r[keydistcolor]?>"> 
            <a onclick="foreColor(document.form1.keydistcolor);"><img src="../data/images/color.gif" width="21" height="21" align="absbottom"></a>          </td>
        </tr>
      </table>
  </div>
    <div class="tab-page" id="login"> 
      <h2 class="tab">&nbsp;<font class="tabcolor">�û�����</font>&nbsp;</h2>
                    <script type="text/javascript">tb1.addTabPage( document.getElementById( "login" ) );</script>
	<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
          <td height="25" colspan="2">��̨����</td>
    </tr>
	<tr> 
          <td height="25" bgcolor="#FFFFFF">��̨��½��֤��</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="adminloginkey" value="0"<?=$r[adminloginkey]==0?' checked':''?>>
            ���� 
            <input type="radio" name="adminloginkey" value="1"<?=$r[adminloginkey]==1?' checked':''?>>
            �ر�</td>
        </tr>
    <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">��̨��¼��������</td>
      <td height="25" bgcolor="#FFFFFF"><input name="loginnum" type="text" id="loginnum" value="<?=$r[loginnum]?>" size="38">
        ��</td>
    </tr>
    <tr> 
          <td height="25" bgcolor="#FFFFFF">���µ�¼ʱ����</td>
      <td height="25" bgcolor="#FFFFFF"><input name="logintime" type="text" id="logintime" value="<?=$r[logintime]?>" size="38">
        ����</td>
    </tr>
    <tr> 
          <td height="25" bgcolor="#FFFFFF">��¼��ʱ����</td>
      <td height="25" bgcolor="#FFFFFF"><input name="exittime" type="text" id="exittime" value="<?=$r[exittime]?>" size="38">
        ����</td>
    </tr>
	</table>
	
	  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="24" colspan="2">ǰ̨����</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF"><p>��Աע��</p></td>
          <td height="25" bgcolor="#FFFFFF"><p> 
              <input type="radio" name="register_ok" value="0"<?=$r[register_ok]==0?' checked':''?>>
              ���� 
              <input type="radio" name="register_ok" value="1"<?=$r[register_ok]==1?' checked':''?>>
              �ر�</p></td>
        </tr>
        <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">ע���ԱĬ�ϻ�Ա��</td>
          <td height="25" bgcolor="#FFFFFF"><select name="defaultgroupid">
              <?=$membergroup?>
            </select></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">ע�����͵���</td>
          <td height="25" bgcolor="#FFFFFF"><input name="reggetfen" type="text" id="reggetfen" value="<?=$r[reggetfen]?>" size="38"></td>
        </tr>
        <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">ע���û�������</td>
          <td height="25" bgcolor="#FFFFFF"><input name="min_userlen" type="text" id="min_userlen" value="<?=$r[min_userlen]?>" size="6">
            ~ 
            <input name="max_userlen" type="text" id="max_userlen" value="<?=$r[max_userlen]?>" size="6">
            ���ֽ�</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">ע����������</td>
          <td height="25" bgcolor="#FFFFFF"><input name="min_passlen" type="text" id="min_passlen" value="<?=$r[min_passlen]?>" size="6">
            ~ 
            <input name="max_passlen" type="text" id="max_passlen" value="<?=$r[max_passlen]?>" size="6">
            ���ֽ�</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��Ա����Ψһ�Լ��:</td>
          <td height="25" bgcolor="#FFFFFF"><input name="regemailonly" type="radio" value="1"<?=$r[regemailonly]==1?' checked':''?>>
            ���� 
            <input name="regemailonly" type="radio" value="0"<?=$r[regemailonly]==0?' checked':''?>>
            �ر�</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">ͬһIPע��������:</td>
          <td height="25" bgcolor="#FFFFFF"><input name="regretime" type="text" id="regretime" value="<?=$r[regretime]?>" size="38">
            ��Сʱ</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�û��������ؼ���:</td>
          <td height="25" bgcolor="#FFFFFF"><input name="regclosewords" type="text" id="repnum3" value="<?=$r[regclosewords]?>" size="38">
            <font color="#666666">(��ֹ�����ַ�,�����&quot;|&quot;�Ÿ���,֧�ֶ�����֤)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">Ͷ�幦��</td>
          <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="addnews_ok" value="0"<?=$r[addnews_ok]==0?' checked':''?>>
            ���� 
            <input type="radio" name="addnews_ok" value="1"<?=$r[addnews_ok]==1?' checked':''?>>
            �ر�</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��Ա�ռ�</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="openspace" value="0"<?=$r[openspace]==0?' checked':''?>>
            ���� 
            <input type="radio" name="openspace" value="1"<?=$r[openspace]==1?' checked':''?>>
            �ر� </td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��Ա��½��֤��</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="loginkey_ok" value="1"<?=$r[loginkey_ok]==1?' checked':''?>>
            ���� 
            <input type="radio" name="loginkey_ok" value="0"<?=$r[loginkey_ok]==0?' checked':''?>>
            �ر�</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��Աע����֤��</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="regkey_ok" value="1"<?=$r[regkey_ok]==1?' checked':''?>>
            ���� 
            <input type="radio" name="regkey_ok" value="0"<?=$r[regkey_ok]==0?' checked':''?>>
            �ر�</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��Ա�б�鿴Ȩ��</td>
          <td height="25" bgcolor="#FFFFFF"><select name="memberlistlevel" id="memberlistlevel">
              <option value=0>�ο�</option>
              <?=$memberlistlevel?>
            </select></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�鿴��Ա����Ȩ��</td>
          <td height="25" bgcolor="#FFFFFF"><select name="showinfolevel" id="showinfolevel">
              <option value=0>�ο�</option>
              <?=$showinfolevel?>
            </select></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��Ա�б�ÿҳ��ʾ</td>
          <td height="25" bgcolor="#FFFFFF"><input name="member_num" type="text" id="member_num" value="<?=$r[member_num]?>" size="38">
            ����Ա</td>
        </tr>
        <tr>
          <td height="25" bgcolor="#FFFFFF">��Ա�ռ���Ϣÿҳ��ʾ</td>
          <td height="25" bgcolor="#FFFFFF"><input name="space_num" type="text" id="space_num" value="<?=$r[space_num]?>" size="38">
            ����Ϣ</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��Աע����˷�ʽ</td>
          <td height="25" bgcolor="#FFFFFF"><input name="regacttype" type="radio" value="0"<?=$r[regacttype]==0?' checked':''?>>
            �� 
            <input name="regacttype" type="radio" value="1"<?=$r[regacttype]==1?' checked':''?>>
            �ʼ�����</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�����ʺ�������Ч��</td>
          <td height="25" bgcolor="#FFFFFF"><input name="acttime" type="text" id="acttime" value="<?=$r[acttime]?>" size="38">
            Сʱ</td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF">�ʺż����ʼ�����<br> <br> <font color="#666666">[!--pageurl--]:�����ַ 
            <br>
            [!--username--]:�û���<br>
            [!--email--]:�����ַ<br>
            [!--date--]:����ʱ��<br>
            [!--sitename--]:��վ����<br>
            [!--news.url--]:��վ��ַ</font></td>
          <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td>���⣺ 
                  <input name="acttitle" type="text" id="acttitle" value="<?=stripSlashes($r[acttitle])?>" size="38"></td>
              </tr>
              <tr> 
                <td><textarea name="acttext" cols="80" rows="12" style="WIDTH: 100%" id="acttext"><?=ehtmlspecialchars(stripSlashes($r[acttext]))?></textarea></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">����ȡ�����빦��</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="opengetpass" value="1"<?=$r[opengetpass]==1?' checked':''?>>
            ���� 
            <input type="radio" name="opengetpass" value="0"<?=$r[opengetpass]==0?' checked':''?>>
            �ر�</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">ȡ������������Ч��</td>
          <td height="25" bgcolor="#FFFFFF"><input name="getpasstime" type="text" id="getpasstime" value="<?=$r[getpasstime]?>" size="38">
            Сʱ</td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF">ȡ�������ʼ�����<br> <br> <font color="#666666">[!--pageurl--]:ȡ�ص�ַ 
            <br>
            [!--username--]:�û���<br>
            [!--email--]:�����ַ<br>
            [!--date--]:����ʱ��<br>
            [!--sitename--]:��վ����<br>
            [!--news.url--]:��վ��ַ </font></td>
          <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td>���⣺ 
                  <input name="getpasstitle" type="text" id="getpasstitle" value="<?=stripSlashes($r[getpasstitle])?>" size="38"></td>
              </tr>
              <tr> 
                <td><textarea name="getpasstext" cols="80" rows="12" style="WIDTH: 100%" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[getpasstext]))?></textarea></td>
              </tr>
            </table></td>
        </tr>
      </table>
	  
	  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">���ʿ�������</td>
        </tr>
        <tr> 
          <td width="22%" height="25" valign="top" bgcolor="#FFFFFF"> <strong>��ֹ 
            IP �����б�:(ǰ̨����̨��Ч)</strong><br>
            ÿ�� IP һ�У��ȿ�����������ַ��Ҳ��ֻ���� IP ��ͷ������ &quot;192.168.&quot;(��������) ��ƥ�� 192.168.0.0��192.168.255.255 
            ��Χ�ڵ����е�ַ������Ϊ������ <br> </td>
          <td height="25" valign="top" bgcolor="#FFFFFF"> <textarea name="closeip" cols="80" rows="8" id="closeip"><?=$r[closeip]?></textarea> 
          </td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF"><strong>���� IP �����б�:(ǰ̨����̨��Ч)</strong><br>
            ֻ�е��û����ڱ��б��е� IP ��ַʱ�ſ��Է�����վ���б�����ĵ�ַ���ʽ���Ϊ IP ����ֹ.ÿ�� IP һ�У��ȿ�����������ַ��Ҳ��ֻ���� 
            IP ��ͷ������ &quot;192.168.&quot;(��������) ��ƥ�� 192.168.0.0��192.168.255.255 
            ��Χ�ڵ����е�ַ������Ϊ���� IP ����ȷ��ֹ��������ɷ���<br></td>
          <td height="25" valign="top" bgcolor="#FFFFFF"><textarea name="openip" cols="80" rows="8" id="textarea2"><?=$r[openip]?></textarea></td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF"><strong>�����̨ IP �����б�:(��̨��Ч)<br>
            </strong>ֻ�е�����Ա���ڱ��б��е� IP ��ַʱ�ſ��Է��ʺ�̨���б�����ĵ�ַ���ʽ���Ϊ IP ����ֹ.ÿ�� IP һ�У��ȿ�����������ַ��Ҳ��ֻ���� 
            IP ��ͷ������ &quot;192.168.&quot;(��������) ��ƥ�� 192.168.0.0��192.168.255.255 
            ��Χ�ڵ����е�ַ������Ϊ���� IP ����ȷ��ֹ��������ɷ���<strong> </strong></td>
          <td height="25" valign="top" bgcolor="#FFFFFF"><textarea name="hopenip" cols="80" rows="8" id="textarea3"><?=$r[hopenip]?></textarea></td>
        </tr>
        <tr> 
          <td height="25" colspan="2" class="header">�ύ��������</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">���ƶ���</td>
          <td height="25" bgcolor="#FFFFFF">
<input name="doiptype[]" type="checkbox" id="doiptype[]" value="register"<?=strstr($r['doiptype'],',register,')?' checked':''?>>
            ע�� 
            <input name="doiptype[]" type="checkbox" id="doiptype[]" value="pl"<?=strstr($r['doiptype'],',pl,')?' checked':''?>>
            ���� 
            <input name="doiptype[]" type="checkbox" id="doiptype[]" value="postinfo"<?=strstr($r['doiptype'],',postinfo,')?' checked':''?>>
            Ͷ�� 
            <input name="doiptype[]" type="checkbox" id="doiptype[]" value="gbook"<?=strstr($r['doiptype'],',gbook,')?' checked':''?>>
            ���� 
            <input name="doiptype[]" type="checkbox" id="doiptype[]" value="downinfo"<?=strstr($r['doiptype'],',downinfo,')?' checked':''?>>
            ���� 
            <input name="doiptype[]" type="checkbox" id="doiptype[]" value="onlineinfo"<?=strstr($r['doiptype'],',onlineinfo,')?' checked':''?>>
            ���߹ۿ� 
            <input name="doiptype[]" type="checkbox" id="doiptype[]" value="showinfo"<?=strstr($r['doiptype'],',showinfo,')?' checked':''?>>
            �鿴��Ϣ</td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF"><strong>��ֹ IP �ύ�б�:</strong><br>
            ÿ�� IP һ�У��ȿ�����������ַ��Ҳ��ֻ���� IP ��ͷ������ &quot;192.168.&quot;(��������) ��ƥ�� 192.168.0.0��192.168.255.255 
            ��Χ�ڵ����е�ַ������Ϊ������</td>
          <td height="25" valign="top" bgcolor="#FFFFFF"><textarea name="closedoip" cols="80" rows="8" id="closedoip"><?=$r[closedoip]?></textarea></td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF"><strong>���� IP �ύ�б�:</strong><br>
            ֻ�е��û����ڱ��б��е� IP ��ַʱ�ſ����ύ���ݣ��б�����ĵ�ַ�ύ����Ϊ IP ����ֹ.ÿ�� IP һ�У��ȿ�����������ַ��Ҳ��ֻ���� 
            IP ��ͷ������ &quot;192.168.&quot;(��������) ��ƥ�� 192.168.0.0��192.168.255.255 
            ��Χ�ڵ����е�ַ������Ϊ���� IP ����ȷ��ֹ��������ɷ���</td>
          <td height="25" valign="top" bgcolor="#FFFFFF"><textarea name="opendoip" cols="80" rows="8" id="opendoip"><?=$r[opendoip]?></textarea></td>
        </tr>
      </table>
	</div>
	  
    <div class="tab-page" id="file"> 
      <h2 class="tab">&nbsp;<font class="tabcolor">�ļ�����</font>&nbsp;</h2>
                    <script type="text/javascript">tb1.addTabPage( document.getElementById( "file" ) );</script>
	  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">�ļ�����</td>
        </tr>
        <tr> 
          <td rowspan="2" valign="top" bgcolor="#FFFFFF">�������Ŀ¼</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="fpath" value="0"<?=$r[fpath]==0?' checked':''?>>
            ��ĿĿ¼ 
            <input type="radio" name="fpath" value="1"<?=$r[fpath]==1?' checked':''?>>
            /d/file/pĿ¼ 
            <input type="radio" name="fpath" value="2"<?=$r[fpath]==2?' checked':''?>>
            /d/fileĿ¼</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF"><input name="filepath" type="text" id="filepath" value="<?=$r[filepath]?>" size="38"> 
            <select name="select6" onchange="document.form1.filepath.value=this.value">
              <option value="Y-m-d">ѡ��</option>
              <option value="Y-m-d">2005-01-27</option>
              <option value="Y/m-d">2005/01-27</option>
              <option value="Y/m/d">2005/01/27</option>
              <option value="Ymd">20050127</option>
              <option value="">������Ŀ¼</option>
            </select> <font color="#666666">(��Y-m-d��Y/m-d��Y/m/d��Ymd����ʽ)</font></td>
        </tr>
        <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">��̨�ϴ�������С</td>
          <td height="25" bgcolor="#FFFFFF"><input name="filesize" type="text" id="filesize" value="<?=$r[filesize]?>" size="38">
            KB</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��̨�ϴ��ļ���չ��</td>
          <td height="25" bgcolor="#FFFFFF"><input name="filetype" type="text" id="filetype" value="<?=$filetype?>" size="38"> 
            <font color="#666666">(������á�|���񿪣��磺.gif|.jpg)</font></td>
        </tr>
        <tr> 
          <td rowspan="2" valign="top" bgcolor="#FFFFFF">ǰ̨Ͷ�帽������</td>
          <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td><input name="qaddtran" type="checkbox" value="1"<?=$r[qaddtran]==1?' checked':''?>>
                  �����ϴ�ͼƬ,���ͼƬ�� 
                  <input name="qaddtransize" type="text" id="qaddtransize" value="<?=$r[qaddtransize]?>" size="6">
                  KB </td>
              </tr>
              <tr> 
                <td>ͼƬ��չ��: 
                  <input name="qaddtranimgtype" type="text" value="<?=$qaddimgtype?>" size="30"> 
                  <font color="#666666"> (�����&quot;|&quot;��) </font></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td><input name="qaddtranfile" type="checkbox" value="1"<?=$r[qaddtranfile]==1?' checked':''?>>
                  �����ϴ�����,��󸽼��� 
                  <input name="qaddtranfilesize" type="text" value="<?=$r[qaddtranfilesize]?>" size="6">
                  KB </td>
              </tr>
              <tr> 
                <td>������չ��: 
                  <input name="qaddtranfiletype" type="text" value="<?=$qaddfiletype?>" size="30"> 
                  <font color="#666666">(�����&quot;|&quot;��)</font></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF">ǰ̨������������</td>
          <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td><input name="feedbacktfile" type="checkbox" id="feedbacktfile" value="1"<?=$r[feedbacktfile]==1?' checked':''?>>
                  �����ϴ�����,��󸽼��� 
                  <input name="feedbackfilesize" type="text" value="<?=$r[feedbackfilesize]?>" size="6">
                  KB </td>
              </tr>
              <tr> 
                <td>������չ��: 
                  <input name="feedbackfiletype" type="text" value="<?=$feedbackfiletype?>" size="30"> 
                  <font color="#666666">(�����&quot;|&quot;��)</font></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td rowspan="2" valign="top" bgcolor="#FFFFFF">��Ա����������</td>
          <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td><input name="openmembertranimg" type="checkbox" id="openmembertranimg" value="1"<?=$r[openmembertranimg]==1?' checked':''?>>
                  �����ϴ�ͼƬ,���ͼƬ�� 
                  <input name="memberimgsize" type="text" id="memberimgsize" value="<?=$r[memberimgsize]?>" size="6">
                  KB </td>
              </tr>
              <tr> 
                <td>ͼƬ��չ��: 
                  <input name="memberimgtype" type="text" id="memberimgtype" value="<?=$memberimgtype?>" size="30"> 
                  <font color="#666666"> (�����&quot;|&quot;��) </font></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td><input name="openmembertranfile" type="checkbox" id="openmembertranfile" value="1"<?=$r[openmembertranfile]==1?' checked':''?>>
                  �����ϴ�����,��󸽼��� 
                  <input name="memberfilesize" type="text" id="memberfilesize" value="<?=$r[memberfilesize]?>" size="6">
                  KB </td>
              </tr>
              <tr> 
                <td>������չ��: 
                  <input name="memberfiletype" type="text" id="memberfiletype" value="<?=$memberfiletype?>" size="30"> 
                  <font color="#666666">(�����&quot;|&quot;��)</font></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="25" bgcolor="#FFFFFF">��Ա�����ֶ�֧����д</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="modmemberedittran" value="1"<?=$r[modmemberedittran]==1?' checked':''?>>��
              <input type="radio" name="modmemberedittran" value="0"<?=$r[modmemberedittran]==0?' checked':''?>>��
          </td>
        </tr>
        <tr>
          <td height="25" bgcolor="#FFFFFF">Ͷ�帽���ֶ�֧����д</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="modinfoedittran" value="1"<?=$r[modinfoedittran]==1?' checked':''?>>��
              <input type="radio" name="modinfoedittran" value="0"<?=$r[modinfoedittran]==0?' checked':''?>>��
          </td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�ļ�����Ȩ��</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="filechmod" value="0"<?=$r[filechmod]==0?' checked':''?>>
            0777 
            <input type="radio" name="filechmod" value="1"<?=$r[filechmod]==1?' checked':''?>>
            ������</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">���JS�ļ�ǰ׺</td>
          <td height="25" bgcolor="#FFFFFF"><input name="adfile" type="text" id="adfile" value="<?=$r[adfile]?>" size="38">
		  <iframe name="checkftpiframe" style="display: none" src="blank.php"></iframe></td>
        </tr>
        <tbody id="setfileserver" style="display:none">
        </tbody>
      </table>
		<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">��������</td>
        </tr>
        <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">���ݱ��ݴ��Ŀ¼</td>
          <td height="25" bgcolor="#FFFFFF">admin/ebak/ 
            <input name="bakdbpath" type="text" id="bakdbpath" value="<?=$r[bakdbpath]?>"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">ѹ�������Ŀ¼</td>
          <td height="25" bgcolor="#FFFFFF">admin/ebak/ 
            <input name="bakdbzip" type="text" id="bakdbzip" value="<?=$r[bakdbzip]?>"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">����ֻѡ��ǰ���ݿ�</td>
          <td height="25" bgcolor="#FFFFFF"><input name="ebakthisdb" type="checkbox" id="ebakthisdb" value="1"<?=$r[ebakthisdb]==1?' checked':''?>>
            ��</td>
        </tr>
		<tr>
          <td height="25" bgcolor="#FFFFFF">�ռ䲻֧�����ݿ��б�</td>
          <td height="25" bgcolor="#FFFFFF"><input name="ebakcanlistdb" type="checkbox" id="ebakcanlistdb" value="1"<?=$r[ebakcanlistdb]==1?' checked':''?>>
            ��<font color="#666666">(����ռ䲻�����г����ݿ�,���)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">֧��MYSQL��ѯ��ʽ</td>
          <td height="25" bgcolor="#FFFFFF"><input name="limittype" type="checkbox" id="limittype" value="1"<?=$r[limittype]==1?' checked':''?>>
            ֧��</td>
        </tr>
      </table>
	</div>
	  
    <div class="tab-page" id="dojs"> 
      <h2 class="tab">&nbsp;<font class="tabcolor">JS����</font>&nbsp;</h2>
                    <script type="text/javascript">tb1.addTabPage( document.getElementById( "dojs" ) );</script>
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">��Ϣ��������(JS)</td>
    </tr>
    <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">������Ϣ��ʾ</td>
      <td height="25" bgcolor="#FFFFFF"><input name="hotnum" type="text" id="hotnum" value="<?=$r[hotnum]?>" size="38">
            ����Ϣ</td>
    </tr>
    <tr> 
          <td height="25" bgcolor="#FFFFFF">������Ϣ��ʾ</td>
      <td height="25" bgcolor="#FFFFFF"><input name="newnum" type="text" id="newnum" value="<?=$r[newnum]?>" size="38">
            ����Ϣ</td>
    </tr>
    <tr> 
          <td height="25" bgcolor="#FFFFFF">�Ƽ���Ϣ��ʾ</td>
      <td height="25" bgcolor="#FFFFFF"><input name="goodnum" type="text" id="goodnum" value="<?=$r[goodnum]?>" size="38">
            ����Ϣ</td>
    </tr>
    <tr> 
          <td height="25" bgcolor="#FFFFFF">����������ʾ</td>
      <td height="25" bgcolor="#FFFFFF"><input name="hotplnum" type="text" id="hotplnum" value="<?=$r[hotplnum]?>" size="38">
            ����Ϣ</td>
    </tr>
    <tr> 
          <td height="25" bgcolor="#FFFFFF">ͷ����Ϣ��ʾ</td>
      <td height="25" bgcolor="#FFFFFF"><input name="firstnum" type="text" id="firstnum" value="<?=$r[firstnum]?>" size="38">
            ����Ϣ</td>
    </tr>
  </table>
	</div>
	  
    <div class="tab-page" id="rehtml"> 
      <h2 class="tab">&nbsp;<font class="tabcolor">��������</font>&nbsp;</h2>
                    <script type="text/javascript">tb1.addTabPage( document.getElementById( "rehtml" ) );</script>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">�����������ã����������������ô�С��</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">ÿ�����ɼ��</td>
          <td height="25" bgcolor="#FFFFFF"><input name="realltime" type="text" id="realltime" value="<?=$r[realltime]?>" size="38">
            ��<font color="#666666">(0Ϊ��������)</font></td>
        </tr>
        <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">��Ŀ����ÿ��</td>
          <td height="25" bgcolor="#FFFFFF"><input name="relistnum" type="text" id="relistnum" value="<?=$r[relistnum]?>" size="38">
            ��</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��Ϣ����ÿ��</td>
          <td height="25" bgcolor="#FFFFFF"><input name="renewsnum" type="text" id="renewsnum" value="<?=$r[renewsnum]?>" size="38">
            ��</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�����������ÿ��</td>
          <td height="25" bgcolor="#FFFFFF"><input name="infolinknum" type="text" id="infolinknum" value="<?=$r[infolinknum]?>" size="38">
            ��</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�����Զ���JSÿ��</td>
          <td height="25" bgcolor="#FFFFFF"><input name="reuserjsnum" type="text" id="reuserjsnum" value="<?=$r[reuserjsnum]?>" size="38">
            ��</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�����Զ����б�ÿ��</td>
          <td height="25" bgcolor="#FFFFFF"><input name="reuserlistnum" type="text" id="reuserlistnum" value="<?=$r[reuserlistnum]?>" size="38">
            ��</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�Զ���ҳ��ÿ��</td>
          <td height="25" bgcolor="#FFFFFF"> <input name="reuserpagenum" type="text" id="reuserpagenum" value="<?=$r[reuserpagenum]?>" size="38">
            ��</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">ͶƱJSÿ��</td>
          <td height="25" bgcolor="#FFFFFF"><input name="revotejsnum" type="text" id="revotejsnum" value="<?=$r[revotejsnum]?>" size="38">
            ��</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">���JSÿ��</td>
          <td height="25" bgcolor="#FFFFFF"><input name="readjsnum" type="text" id="readjsnum" value="<?=$r[readjsnum]?>" size="38">
            ��</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�滻�ֶ�ֵÿ��</td>
          <td height="25" bgcolor="#FFFFFF"><input name="dorepnum" type="text" id="dorepnum" value="<?=$r[dorepnum]?>" size="38">
            ��</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�滻��ַȨ��ÿ��</td>
          <td height="25" bgcolor="#FFFFFF"><input name="dorepdlevelnum" type="text" id="dorepdlevelnum" value="<?=$r[dorepdlevelnum]?>" size="38">
            ��</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">����ɾ����Ϣÿ��</td>
          <td height="25" bgcolor="#FFFFFF"><input name="delnewsnum" type="text" id="delnewsnum" value="<?=$r[delnewsnum]?>" size="38">
            ��</td>
        </tr>
        <tr>
          <td height="25" bgcolor="#FFFFFF">�����鵵��Ϣÿ��</td>
          <td height="25" bgcolor="#FFFFFF"><input name="docnewsnum" type="text" id="docnewsnum" value="<?=$r[docnewsnum]?>" size="38">
            ��</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">������Ŀģ��ÿ��</td>
          <td height="25" bgcolor="#FFFFFF"><input name="loadtempnum" type="text" id="loadtempnum" value="<?=$r[loadtempnum]?>" size="38">
            ��</td>
        </tr>
      </table>
  </div>
    <div class="tab-page" id="setsearch"> 
      <h2 class="tab">&nbsp;<font class="tabcolor">��������</font>&nbsp;</h2>
                    <script type="text/javascript">tb1.addTabPage( document.getElementById( "setsearch" ) );</script>
	  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">��������</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�����û���</td>
          <td height="25" bgcolor="#FFFFFF"><select name="searchgroupid" id="searchgroupid">
              <option value=0>�ο�</option>
              <?=$searchmembergroup?>
            </select></td>
        </tr>
        <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">�����ؼ���</td>
          <td height="25" bgcolor="#FFFFFF">�� 
            <input name="min_keyboard" type="text" id="min_keyboard" value="<?=$r[min_keyboard]?>" size="6">
            ���ַ��� 
            <input name="max_keyboard" type="text" id="max_keyboard" value="<?=$r[max_keyboard]?>" size="6">
            ���ַ�֮��</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">����ʱ����</td>
          <td height="25" bgcolor="#FFFFFF">�� 
            <input name="searchtime" type="text" id="searchtime" value="<?=$r[searchtime]?>" size="6">
            ��</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">ҳ����ʾ</td>
          <td height="25" bgcolor="#FFFFFF">ÿҳ 
            <input name="search_num" type="text" id="search_num" value="<?=$r[search_num]?>" size="6">
            ��ʾ����¼�� 
            <input name="search_pagenum" type="text" id="search_pagenum" value="<?=$r[search_pagenum]?>" size="6">
            ����ҳ����<font color="#666666">(Ϊ0�Ļ���ϵͳĬ��25����12������)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">֧�ֹ���ģ�����</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="searchtempvar" value="0"<?=$r['searchtempvar']==0?' checked':''?>>
            ��֧�� 
            <input type="radio" name="searchtempvar" value="1"<?=$r['searchtempvar']==1?' checked':''?>>
            ֧��<font color="#666666">(����ģ�弰��̬ҳ��)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�߼�����ҳ��չ��</td>
          <td height="25" bgcolor="#FFFFFF"><input name="searchtype" type="text" id="searchtype" value="<?=$r[searchtype]?>" size="10"> 
            <font color="#666666"> 
            <select name="select2" onchange="document.form1.searchtype.value=this.value">
              <option value=".html">��չ��</option>
              <option value=".html">.html</option>
              <option value=".htm">.htm</option>
              <option value=".php">.php</option>
              <option value=".shtml">.shtml</option>
            </select>
            (�磺.html,.htm,.xml,.php)</font></td>
        </tr>
      </table>
	</div>
	  
    <div class="tab-page" id="donews"> 
      <h2 class="tab">&nbsp;<font class="tabcolor">��Ϣ����</font>&nbsp;</h2>
                    <script type="text/javascript">tb1.addTabPage( document.getElementById( "donews" ) );</script>
	  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">��Ϣ����</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��̨������Ϣ</td>
          <td height="25" bgcolor="#FFFFFF">ÿҳ��ʾ 
            <input name="hlistinfonum" type="text" id="hlistinfonum" value="<?=$r[hlistinfonum]?>">
            ����Ϣ</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">ǰ̨������б�</td>
          <td height="25" bgcolor="#FFFFFF">ÿҳ��ʾ 
            <input name="qlistinfonum" type="text" id="qlistinfonum" value="<?=$r[qlistinfonum]?>">
            ����Ϣ</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��̨��ϢĬ����ʾʱ�䷶Χ</td>
          <td height="25" bgcolor="#FFFFFF"><select name="infolday" id="infolday">
              <option value="0"<?=$r['infolday']==0?' selected':''?>>ȫ����ʾ</option>
              <option value="86400"<?=$r['infolday']==86400?' selected':''?>>1 
              ��</option>
              <option value="172800"<?=$r['infolday']==172800?' selected':''?>>2 
              ��</option>
              <option value="604800"<?=$r['infolday']==604800?' selected':''?>>һ��</option>
              <option value="2592000"<?=$r['infolday']==2592000?' selected':''?>>1 
              ����</option>
              <option value="7948800"<?=$r['infolday']==7948800?' selected':''?>>3 
              ����</option>
              <option value="15897600"<?=$r['infolday']==15897600?' selected':''?>>6 
              ����</option>
              <option value="31536000"<?=$r['infolday']==31536000?' selected':''?>>1 
              ��</option>
            </select></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��̨����Ĭ����ʾʱ�䷶Χ</td>
          <td height="25" bgcolor="#FFFFFF"><select name="filelday" id="filelday">
              <option value="0"<?=$r['filelday']==0?' selected':''?>>ȫ����ʾ</option>
              <option value="86400"<?=$r['filelday']==86400?' selected':''?>>1 
              ��</option>
              <option value="172800"<?=$r['filelday']==172800?' selected':''?>>2 
              ��</option>
              <option value="604800"<?=$r['filelday']==604800?' selected':''?>>һ��</option>
              <option value="2592000"<?=$r['filelday']==2592000?' selected':''?>>1 
              ����</option>
              <option value="7948800"<?=$r['filelday']==7948800?' selected':''?>>3 
              ����</option>
              <option value="15897600"<?=$r['filelday']==15897600?' selected':''?>>6 
              ����</option>
              <option value="31536000"<?=$r['filelday']==31536000?' selected':''?>>1 
              ��</option>
            </select></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��Ϣ�ö�����</td>
          <td height="25" bgcolor="#FFFFFF"><select name="settop" id="settop">
              <option value="0"<?=$r[settop]==0?' selected':''?>>��ʹ���ö�</option>
              <option value="1"<?=$r[settop]==1?' selected':''?>>��Ŀ�б��ö�</option>
              <option value="2"<?=$r[settop]==2?' selected':''?>>��ǩ�����ö�</option>
              <option value="3"<?=$r[settop]==3?' selected':''?>>JS�����ö�</option>
              <option value="4"<?=$r[settop]==4?' selected':''?>>��Ŀ/��ǩ/JS�ö�</option>
              <option value="5"<?=$r[settop]==5?' selected':''?>>��Ŀ/��ǩ�ö�</option>
              <option value="6"<?=$r[settop]==6?' selected':''?>>��Ŀ/JS�ö�</option>
              <option value="7"<?=$r[settop]==7?' selected':''?>>��ǩ/JS�ö�</option>
            </select></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
          <td height="25" bgcolor="#FFFFFF"><input name="fieldandtop" type="checkbox" id="fieldandtop" value="1"<?=$r[fieldandtop]==1?' checked':''?>>
            �����֧���ö�</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�������õı�</td>
          <td height="25" bgcolor="#FFFFFF"><input name="fieldandclosetb" type="text" id="fieldandclosetb" value="<?=substr($r[fieldandclosetb],1,strlen($r[fieldandclosetb])-2)?>" size="38"> 
            <font color="#666666">(��������ð�Ƕ��Ÿ������磺news,download)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��̬�б�֧�ֱ�ǩ</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="dtcanbq" value="0"<?=$r[dtcanbq]==0?' checked':''?>>
            ��֧�� 
            <input type="radio" name="dtcanbq" value="1"<?=$r[dtcanbq]==1?' checked':''?>>
            ֧��</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��̬�б��������</td>
          <td height="25" bgcolor="#FFFFFF"><input name="dtcachetime" type="text" id="dtcachetime" value="<?=$r[dtcachetime]?>" size="38">
            ����</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��̬����ҳ֧�ֱ�ǩ</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="dtncanbq" value="0"<?=$r[dtncanbq]==0?' checked':''?>>
            ��֧�� 
            <input type="radio" name="dtncanbq" value="1"<?=$r[dtncanbq]==1?' checked':''?>>
            ֧��</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��̬����ҳ��������</td>
          <td height="25" bgcolor="#FFFFFF"><input name="dtncachetime" type="text" id="dtncachetime" value="<?=$r[dtncachetime]?>" size="38">
            ����</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�»�ԱͶ������</td>
          <td height="25" bgcolor="#FFFFFF">����ע���Ա����� 
            <input name="newaddinfotime" type="text" id="newaddinfotime" value="<?=$r[newaddinfotime]?>" size="6">
            ���Ӳ���Ͷ�� <font color="#666666">(0Ϊ������)</font></td>
        </tr>
        <tr>
          <td height="25" bgcolor="#FFFFFF">Ͷ����������</td>
          <td height="25" bgcolor="#FFFFFF">ͬһ��IP��
            <input name="ipaddinfotime" type="text" id="ipaddinfotime" value="<?=$r[ipaddinfotime]?>" size="6">
          ��Сʱ�����ֻ��������
          <input name="ipaddinfonum" type="text" id="ipaddinfonum" value="<?=$r[ipaddinfonum]?>" size="6">
          ����Ϣ<font color="#666666">(0Ϊ���ޣ���ģ��Ҫ����infoip�ֶ�)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�ظ�Ͷ��ʱ������</td>
          <td height="25" bgcolor="#FFFFFF"><input name="readdinfotime" type="text" id="readdinfotime" value="<?=$r[readdinfotime]?>" size="38">
            ��</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">Ͷ����Ϣ�޸�ʱ�����ƣ�</td>
          <td height="25" bgcolor="#FFFFFF"><input name="qeditinfotime" type="text" id="qeditinfotime" value="<?=$r[qeditinfotime]?>" size="38">
            ����<font color="#666666">(0Ϊ������)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">Ͷ�������Ϣ��ʾ��ʽ��</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="qlistinfomod" value="0"<?=$r[qlistinfomod]==0?' checked':''?>>
            ������ʾ 
            <input type="radio" name="qlistinfomod" value="1"<?=$r[qlistinfomod]==1?' checked':''?>>
            ��ģ����ʾ <font color="#666666">(��ģ����ʾӰ��Ч��)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��Ŀ�����ָ��ַ�</td>
          <td height="25" bgcolor="#FFFFFF"><input name="classnavfh" type="text" id="navfh3" value="<?=ehtmlspecialchars($r[classnavfh])?>" size="38"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��Ŀ������ʾ����</td>
          <td height="25" bgcolor="#FFFFFF"><input name="classnavline" type="text" id="classnavline" value="<?=$r[classnavline]?>" size="38"> 
            <font color="#666666">(0Ϊ����)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">����λ�õ����ָ��ַ�</td>
          <td height="25" bgcolor="#FFFFFF"><input name="navfh" type="text" id="navfh" value="<?=$r[navfh]?>" size="38"> 
            <font color="#666666">(��:����ҳ &gt; ���š��еġ�&gt;��)</font></td>
        </tr>
        <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">��Ϣ����ȡ</td>
          <td height="25" bgcolor="#FFFFFF"> <input name="smalltextlen" type="text" id="smalltextlen" value="<?=$r[smalltextlen]?>" size="38">
            ����<font color="#666666"> (���Ϊ��ʱ����ȡ��Ϣ����)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�����������</td>
          <td height="25" bgcolor="#FFFFFF"><select name="newslink" id="newslink">
              <option value="0"<?=$r['newslink']==0?' selected':''?>>��������ؼ���</option>
              <option value="1"<?=$r['newslink']==1?' selected':''?>>�ؼ�����ͬ</option>
              <option value="2"<?=$r['newslink']==2?' selected':''?>>���������ؼ�����ͬ</option>
            </select> </td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">������Ϣ����������Χ</td>
          <td height="25" bgcolor="#FFFFFF"><input name="onclickrnd" type="text" id="onclickrnd" value="<?=$r[onclickrnd]?>" size="38"> 
            <font color="#666666">(��ʽ:����С��,����������ձ�ʾ��ʹ�á����ӣ�20,100)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">������Ϣ���ݹ����ַ��滻</td>
          <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="dorepword" value="0"<?=$r['dorepword']==0?' checked':''?>>
            ����ҳ��ʱ�滻 
            <input type="radio" name="dorepword" value="1"<?=$r['dorepword']==1?' checked':''?>>
            ������Ϣʱ�滻 
            <input type="radio" name="dorepword" value="2"<?=$r['dorepword']==2?' checked':''?>>
            �ر��滻<font color="#666666"> (�ر��滻Ч�ʸ�)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">������Ϣ���ݹؼ����滻</td>
          <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="dorepkey" value="0"<?=$r['dorepkey']==0?' checked':''?>>
            ����ҳ��ʱ�滻 
            <input type="radio" name="dorepkey" value="1"<?=$r['dorepkey']==1?' checked':''?>>
            ������Ϣʱ�滻 
            <input type="radio" name="dorepkey" value="2"<?=$r['dorepkey']==2?' checked':''?>>
            �ر��滻<font color="#666666"> (�ر��滻Ч�ʸ�)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��Ϣ���ݹؼ����ظ��滻</td>
          <td height="25" bgcolor="#FFFFFF"><input name="repkeynum" type="text" id="repkeynum" value="<?=$r[repkeynum]?>" size="38">
            ��<font color="#666666"> (0Ϊ����,Ч�ʸߣ������滻������Ӱ������Ч�ʡ�)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">������֤��</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="fbkey_ok" value="1"<?=$r[fbkey_ok]==1?' checked':''?>>
            ���� 
            <input type="radio" name="fbkey_ok" value="0"<?=$r[fbkey_ok]==0?' checked':''?>>
            �ر� </td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">������֤��</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="gbkey_ok" value="1"<?=$r[gbkey_ok]==1?' checked':''?>>
            ���� 
            <input type="radio" name="gbkey_ok" value="0"<?=$r[gbkey_ok]==0?' checked':''?>>
            �ر� </td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�ظ�����ʱ������</td>
          <td height="25" bgcolor="#FFFFFF"><input name="regbooktime" type="text" id="regbooktime" value="<?=$r[regbooktime]?>" size="38">
            ��</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�ظ�ͶƱʱ������</td>
          <td height="25" bgcolor="#FFFFFF"><input name="revotetime" type="text" id="revotetime" value="<?=$r[revotetime]?>" size="38">
            ��</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">����ÿҳ��ʾ</td>
          <td height="25" bgcolor="#FFFFFF"><input name="gb_num" type="text" id="gb_num" value="<?=$r[gb_num]?>" size="38">
            ������</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">ģ�屸�ݼ�¼��</td>
          <td height="25" bgcolor="#FFFFFF"><input name="baktempnum" type="text" id="baktempnum" value="<?=$r[baktempnum]?>" size="38"> 
            <font color="#666666">(0Ϊ������)</font></td>
        </tr>
        <tr>
          <td height="25" bgcolor="#FFFFFF">�رն�̬ʹ�õ��б�ģ��ID</td>
          <td height="25" bgcolor="#FFFFFF"><input name="closelisttemp" type="text" id="closelisttemp" value="<?=$r[closelisttemp]?>" size="38">
            <input type="button" name="Submit6222" value="�����б�ģ��" onclick="window.open('template/ListListtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"> 
            <font color="#666666">(���ID�ð�Ƕ��š�,������)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">ģ��֧�ֳ������</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="candocode" value="1"<?=$r[candocode]==1?' checked':''?>>
            ���� 
            <input type="radio" name="candocode" value="0"<?=$r[candocode]==0?' checked':''?>>
            �ر�</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">���ɼ�</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="opennotcj" value="1"<?=$r[opennotcj]==1?' checked':''?>>
            ���� 
            <input type="radio" name="opennotcj" value="0"<?=$r[opennotcj]==0?' checked':''?>>
            �ر�</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">���ݷ�����</td>
          <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="opencopytext" value="1"<?=$r[opencopytext]==1?' checked':''?>>
            ���� 
            <input type="radio" name="opencopytext" value="0"<?=$r[opencopytext]==0?' checked':''?>>
            �ر�<font color="#666666"> (��������ַ�)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�б��ҳ����(����)</td>
          <td height="25" bgcolor="#FFFFFF"><input name="listpagefun" type="text" id="listpagefun" value="<?=$r[listpagefun]?>" size="38"> 
            <font color="#666666"> (�ɼӵ�e/class/userfun.php�ļ���)</font></td>
        </tr>
        <tr> 
          <td rowspan="2" valign="top" bgcolor="#FFFFFF">�б��ҳ����(�б�)</td>
          <td height="25" bgcolor="#FFFFFF"><input name="listpagelistfun" type="text" id="listpagelistfun" value="<?=$r[listpagelistfun]?>" size="38"> 
            <font color="#666666">(�ɼӵ�e/class/userfun.php�ļ���)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">ÿҳ��ʾ 
            <input name="listpagelistnum" type="text" id="listpagelistnum" value="<?=$r[listpagelistnum]?>" size="6">
            ��ҳ��</td>
        </tr>
        <tr> 
          <td height="25" rowspan="2" bgcolor="#FFFFFF">���ݷ�ҳ����</td>
          <td height="12" bgcolor="#FFFFFF"><input name="textpagefun" type="text" id="textpagefun" value="<?=$r[textpagefun]?>" size="38"> 
            <font color="#666666">(�ɼӵ�e/class/userfun.php�ļ���)</font></td>
        </tr>
        <tr> 
          <td height="12" bgcolor="#FFFFFF">ÿҳ��ʾ 
            <input name="textpagelistnum" type="text" id="textpagelistnum" value="<?=$r[textpagelistnum]?>" size="6">
            ��ҳ��</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">RSS/XML����</td>
          <td height="25" bgcolor="#FFFFFF">��ʾ���� 
            <input name="rssnum" type="text" id="rssnum" value="<?=$r[rssnum]?>" size="6">
            ����¼������ȡ 
            <input name="rsssub" type="text" id="rsssub" value="<?=$r[rsssub]?>" size="6">
            ����</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">���ͳ������</td>
          <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="25">���ͣ� 
                  <select name="onclicktype" id="onclicktype">
                    <option value="0"<?=$r[onclicktype]==0?' selected':''?>>ʵʱͳ��</option>
                    <option value="1"<?=$r[onclicktype]==1?' selected':''?>>�ı�����</option>
                    <option value="2"<?=$r[onclicktype]==2?' selected':''?>>��ͳ��</option>
                  </select></td>
              </tr>
              <tr> 
                <td height="25">�ı���������ļ��� 
                  <input name="onclickfilesize" type="text" id="onclickfilesize" value="<?=$r[onclickfilesize]?>" size="38">
                  KB</td>
              </tr>
              <tr> 
                <td height="25">�ı������ʱ�䣺 
                  <input name="onclickfiletime" type="text" id="onclickfiletime" value="<?=$r[onclickfiletime]?>" size="38">
                  ����</td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��Ϣ�ⲿ��������</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="opentitleurl" value="0"<?=$r[opentitleurl]==0?' checked':''?>>
            ͳ�Ƶ�� 
            <input type="radio" name="opentitleurl" value="1"<?=$r[opentitleurl]==1?' checked':''?>>
            ��ʾԭ����</td>
        </tr>
        <tr>
          <td height="25" bgcolor="#FFFFFF">ѡ���ռ���Ŀ�ı�����ɫ</td>
          <td height="25" bgcolor="#FFFFFF"><input name="chclasscolor" type="text" id="chclasscolor" value="<?=$r[chclasscolor]?>" size="38"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�ż�ͷ������</td>
          <td height="25" bgcolor="#FFFFFF"><textarea name="firsttitlename" cols="80" rows="8" id="firsttitlename"><?=str_replace("|","\r\n",$r[firsttitlename])?></textarea></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�ż��Ƽ�����</td>
          <td height="25" bgcolor="#FFFFFF"><textarea name="isgoodname" cols="80" rows="8" id="isgoodname"><?=str_replace("|","\r\n",$r[isgoodname])?></textarea></td>
        </tr>
      </table>
	</div>
	  
    <div class="tab-page" id="doftp"> 
      <h2 class="tab">&nbsp;<font class="tabcolor">FTP/EMAIL</font>&nbsp;</h2>
                    <script type="text/javascript">tb1.addTabPage( document.getElementById( "doftp" ) );</script>
	  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">�����ʼ�����</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�ʼ�����ģʽ</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="sendmailtype" value="0"<?=$r[sendmailtype]==0?' checked':''?>>
            mail �������� 
            <input type="radio" name="sendmailtype" value="1"<?=$r[sendmailtype]==1?' checked':''?>>
            SMTP ģ�鷢��</td>
        </tr>
        <tr> 
          <td height="25" colspan="2" bgcolor="#FFFFFF"><strong>SMTP ģ�鷢������</strong></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">SMTP������</td>
          <td height="25" bgcolor="#FFFFFF"><input name="smtphost" type="text" id="smtphost" value="<?=$r[smtphost]?>" size="38"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">SMTP�˿�</td>
          <td height="25" bgcolor="#FFFFFF"><input name="smtpport" type="text" id="smtpport" value="<?=$r[smtpport]?>" size="38"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�����˵�ַ</td>
          <td height="25" bgcolor="#FFFFFF"><input name="fromemail" type="text" id="fromemail" value="<?=$r[fromemail]?>" size="38"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�������س�</td>
          <td height="25" bgcolor="#FFFFFF"><input name="emailname" type="text" id="emailname" value="<?=$r[emailname]?>" size="38"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�Ƿ���Ҫ��¼��֤</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="loginemail" value="1"<?=$r[loginemail]==1?' checked':''?>>
            �� 
            <input type="radio" name="loginemail" value="0"<?=$r[loginemail]==0?' checked':''?>>
            ��</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�����¼�û���</td>
          <td height="25" bgcolor="#FFFFFF"><input name="emailusername" type="text" id="emailusername" value="<?=$r[emailusername]?>" size="38"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�����¼����</td>
          <td height="25" bgcolor="#FFFFFF"><input name="emailpassword" type="password" id="emailpassword" value="<?=$r[emailpassword]?>" size="38"></td>
        </tr>
        <tr class="header"> 
          <td height="25" colspan="2">FTP����(Զ�̷��� / PHP�����ڰ�ȫģʽ�����������������ѡ��)</td>
        </tr>
        <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">PHP�����ڰ�ȫģʽ</td>
          <td height="25" bgcolor="#FFFFFF"><input name="phpmode" type="checkbox" id="phpmode" value="1"<?=$r[phpmode]==1?' checked':''?>>
            ��</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">��װ��ʽ</td>
          <td height="25" bgcolor="#FFFFFF"><select name="install" id="select">
              <option value="0"<?=$r[install]==0?' selected':''?>>�����</option>
              <option value="1"<?=$r[install]==1?' selected':''?>>�ͻ���</option>
            </select> <font color="#666666">(����Զ�̷�������ѡ�ͻ��ˣ�����������FTPѡ��)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">���� SSL ����</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="ftpssl" value="1"<?=$r[ftpssl]==1?' checked':''?>>
            �� 
            <input type="radio" name="ftpssl" value="0"<?=$r[ftpssl]==0?' checked':''?>>
            �� </td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">����ģʽ(pasv)����</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="ftppasv" value="1"<?=$r[ftppasv]==1?' checked':''?>>
            �� 
            <input type="radio" name="ftppasv" value="0"<?=$r[ftppasv]==0?' checked':''?>>
            �� </td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">FTP��������ַ</td>
          <td height="25" bgcolor="#FFFFFF"><input name="ftphost" type="text" id="ftphost" value="<?=$r[ftphost]?>" size="38">
            �˿ڣ� 
            <input name="ftpport" type="text" id="ftpport" value="<?=$r[ftpport]?>" size="4"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">FTP�û���</td>
          <td height="25" bgcolor="#FFFFFF"><input name="ftpusername" type="text" id="ftpusername" value="<?=$r[ftpusername]?>" size="38"> 
          </td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">FTP����</td>
          <td height="25" bgcolor="#FFFFFF"><input name="ftppassword" type="password" size="38">
            <font color="#666666">(���޸�����������) </font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">����ģʽ</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="ftpmode" value="1"<?=$r[ftpmode]==1?' checked':''?>>
            ASCII 
            <input type="radio" name="ftpmode" value="0"<?=$r[ftpmode]==0?' checked':''?>>
            ������</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">FTP ���䳬ʱʱ��</td>
          <td height="25" bgcolor="#FFFFFF"><input name="ftpouttime" type="text" id="ftpouttime" value="<?=$r[ftpouttime]?>" size="38">
            ��<font color="#666666">(0Ϊ������Ĭ��)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">ϵͳ��Ŀ¼(FTP)</td>
          <td height="25" bgcolor="#FFFFFF"><input name="ftppath" type="text" value="<?=$r[ftppath]?>" size="38"> 
            <font color="#666666">(Ŀ¼��β��Ҫ��б�ܡ�/������Ϊ��Ŀ¼)</font></td>
        </tr>
        <tr>
          <td height="25" bgcolor="#FFFFFF">����FTP������</td>
          <td height="25" bgcolor="#FFFFFF"><input type="submit" name="Submit32" value="����FTP������" onClick="document.form1.enews.value='CheckPostServerFtp';document.form1.action='SetEnews.php';document.form1.target='checkftpiframe';">
            <font color="#666666">(���豣�����ü��ɲ��ԣ����ڲ���ͨ�����ٱ���)</font></td>
        </tr>
      </table>
	</div>
	
	<div class="tab-page" id="dom"> 
      <h2 class="tab">&nbsp;<font class="tabcolor">ģ������</font>&nbsp;</h2>
                    <script type="text/javascript">tb1.addTabPage( document.getElementById( "dom" ) );</script>
	  <table width="100%" border="0" cellspacing="1" cellpadding="3" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">��ϢͶ����������</td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td width="22%" height="25" valign="top"><strong>�����ֶ�</strong><br>
            ����á�|���񿪣��硰title|newstext��<br>
            <br>
            <a href="db/ListTable.php<?=$ecms_hashur['whehref']?>" target="_blank"><font color="#666666">[����鿴�ֶ�]</font></a></td>
          <td><textarea name="closewordsf" cols="80" rows="5"><?=$r[closewordsf]?></textarea></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="25" valign="top">
<strong>�����ַ��б�</strong><br>
            (1)������á�|���������硰�ַ�1|�ַ�2�� ��<br>
            (2)��ͬʱ��������ʱ���ο���˫��#���������硰��##��|�ַ�2�� ������ֻҪ����ͬʱ�������ơ��͡��⡱�ֶ��ᱻ���Ρ�</td>
          <td><textarea name="closewords" cols="80" rows="8"><?=$r[closewords]?></textarea></td>
        </tr>
      </table>
	  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">����/����/��Ӱ/�̳ǵ�ģ������</td>
        </tr>
		<tr>
          <td height="25" bgcolor="#FFFFFF">�رպ�̨�˵�</td>
          <td height="25" bgcolor="#FFFFFF"><input name="closehmenu[]" type="checkbox" id="closehmenu[]" value="shop"<?=stristr($r['closehmenu'],',shop,')?' checked':''?>>
          �̳�</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">ͬһ��ַ����/�ۿ�����</td>
          <td height="25" bgcolor="#FFFFFF"><input name="redodown" type="text" id="redodown" value="<?=$r[redodown]?>" size="38">
            ��Сʱ ���ظ��۵�</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">ͬһ��Ϣ�鿴����</td>
          <td height="25" bgcolor="#FFFFFF"><input name="redoview" type="text" id="redoview" value="<?=$r[redoview]?>" size="38">
            ��Сʱ ���ظ��۵�</td>
        </tr>
        <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">������֤��</td>
          <td height="25" bgcolor="#FFFFFF"><input name="downpass" type="text" id="downpass" value="<?=$r[downpass]?>" size="38"> 
            <font color="#666666">(��Ҫ���ڷ�����,�붨�ڸ���һ������)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">����ֱ������</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="opengetdown" value="1"<?=$r[opengetdown]==1?' checked':''?>>
            �� 
            <input type="radio" name="opengetdown" value="0"<?=$r[opengetdown]==0?' checked':''?>>
            ��</td>
        </tr>
      </table>
    </div>
	<div class="tab-page" id="doimage"> 
      <h2 class="tab">&nbsp;<font class="tabcolor">ͼƬ����</font>&nbsp;</h2>
                    <script type="text/javascript">tb1.addTabPage( document.getElementById( "doimage" ) );</script>
	  <table width="100%" border="0" cellspacing="1" cellpadding="3" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">ͼƬ����ͼ����</td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td width="22%" height="25">Ĭ��ֵ</td>
          <td>��: 
            <input name="spicwidth" type="text" id="spicwidth" value="<?=$r[spicwidth]?>" size="6">
            ����: 
            <input name="spicheight" type="text" id="spicheight" value="<?=$r[spicheight]?>" size="6"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="25">���������Ƿ��ȡ</td>
          <td><input type="radio" name="spickill" value="1"<?=$r['spickill']==1?' checked':''?>>
            �� 
            <input type="radio" name="spickill" value="0"<?=$r['spickill']==0?' checked':''?>>
            ��</td>
        </tr>
      </table>
	  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">ͼƬˮӡ����(������ͼƬˮӡ��������)</td>
        </tr>
        <tr> 
          <td width="22%" height="25" valign="top" bgcolor="#FFFFFF">ˮӡλ��</td>
          <td height="25" bgcolor="#FFFFFF"> <table width="200" border="0" cellpadding="6" cellspacing="1" bgcolor="#CCCCCC">
              <tr bgcolor="#FFFFFF"> 
                <td rowspan="3"> <div align="center"> 
                    <input type="radio" name="markpos" value="0"<?=$r[markpos]==0?' checked':'';?>>
                    <br>
                    ��� </div></td>
                <td> <div align="center"> 
                    <input type="radio" name="markpos" value="1"<?=$r[markpos]==1?' checked':'';?>>
                  </div></td>
                <td> <div align="center"> 
                    <input type="radio" name="markpos" value="2"<?=$r[markpos]==2?' checked':'';?>>
                  </div></td>
                <td> <div align="center"> 
                    <input type="radio" name="markpos" value="3"<?=$r[markpos]==3?' checked':'';?>>
                  </div></td>
              </tr>
              <tr> 
                <td bgcolor="#FFFFFF"> <div align="center"> 
                    <input type="radio" name="markpos" value="4"<?=$r[markpos]==4?' checked':'';?>>
                  </div></td>
                <td bgcolor="#FFFFFF"> <div align="center"> 
                    <input type="radio" name="markpos" value="5"<?=$r[markpos]==5?' checked':'';?>>
                  </div></td>
                <td bgcolor="#FFFFFF"> <div align="center"> 
                    <input type="radio" name="markpos" value="6"<?=$r[markpos]==6?' checked':'';?>>
                  </div></td>
              </tr>
              <tr> 
                <td bgcolor="#FFFFFF"> <div align="center"> 
                    <input type="radio" name="markpos" value="7"<?=$r[markpos]==7?' checked':'';?>>
                  </div></td>
                <td bgcolor="#FFFFFF"> <div align="center"> 
                    <input type="radio" name="markpos" value="8"<?=$r[markpos]==8?' checked':'';?>>
                  </div></td>
                <td bgcolor="#FFFFFF"> <div align="center"> 
                    <input type="radio" name="markpos" value="9"<?=$r[markpos]==9?' checked':'';?>>
                  </div></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td rowspan="4" valign="top" bgcolor="#FFFFFF">����ˮӡ</td>
          <td height="25" bgcolor="#FFFFFF">�������� 
            <input name="marktext" type="text" id="marktext" value="<?=$r[marktext]?>"> 
            <font color="#666666">(Ŀǰ��֧������)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">�������� 
            <input name="markfont" type="text" id="markfont" value="<?=$r[markfont]?>"> 
            <font color="#666666">(�Ӻ�̨��ʼ�㣬��../data����dataĿ¼)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">������ɫ 
            <input name="markfontcolor" type="text" id="markfontcolor" value="<?=$r[markfontcolor]?>"> 
            <a onclick="foreColor(document.form1.markfontcolor);"><img src="../data/images/color.gif" width="21" height="21" align="absbottom"></a> 
          </td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">���ִ�С 
            <input name="markfontsize" type="text" value="<?=$r[markfontsize]?>"> 
            <font color="#666666">(1~5֮�������)</font> </td>
        </tr>
        <tr> 
          <td rowspan="3" valign="top" bgcolor="#FFFFFF">ͼƬˮӡ</td>
          <td height="25" bgcolor="#FFFFFF"> ͼƬ�ļ� 
            <input name="markimg" type="text" id="markimg" value="<?=$r[markimg]?>"> 
            <font color="#666666">(�Ӻ�̨��ʼ�㣬��../data����dataĿ¼)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">ͼƬ���� 
            <input name="jpgquality" type="text" id="jpgquality" value="<?=$r[jpgquality]?>"> 
            <font color="#666666">(��ֵ���� jpg ��ʽͼƬ����������Χ�� 0 �� 100)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">ˮӡ͸���� 
            <input name="markpct" type="text" id="markpct" value="<?=$r[markpct]?>"> 
            <font color="#666666">(��ֵ����ͼƬˮӡ�����ȣ���ֵ��Χ�� 0 �� 100)</font></td>
        </tr>
      </table>
	</div>
	
	
	</div>
	<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
      <tr> 
        <td height="25" bgcolor="#FFFFFF"> <div align="center">
            <input type="submit" name="Submit" value=" ���� " onClick="document.form1.enews.value='SetEnews';document.form1.action='SetEnews.php';document.form1.target='';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="reset" name="Submit2" value=" ���� ">
          </div></td>
      </tr>
    </table>
</form>
<?=$hiddenfileserver?>
</body>
</html>
