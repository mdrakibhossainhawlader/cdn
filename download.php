<?php
error_reporting(0);
function maling($content,$start,$end){
if($content && $start && $end) {
$r = explode($start, $content);
if (isset($r[1])){
$r = explode($end, $r[1]);
return $r[0];
}
return '';
}
}
$uar=array('Nokia2610/2.0 (07.04a) Profile/MIDP-2.0 Configuration/CLDC-1.1 UP.Link/6.3.1.20.0','Nokia5300/2.0 (05.51) Profile/MIDP-2.0 Configuration/CLDC-1.1','Nokia6030/2.0 (y3.44) Profile/MIDP-2.0 Configuration/CLDC-1.1','NokiaN70-1/5.0616.2.0.3 Series60/2.8 Profile/MIDP-2.0 Configuration/CLDC-1.1');
$uarr=array_rand($uar);
$uarand=$uar[$uarr];

ini_set('default_charset',"UTF-8");
ini_set('user_agent',$uarand."\r\naccept: text/html, application/xml;q=0.9, application/xhtml+xml, image/png, image/jpeg, image/gif, image/x-xbitmap, */*;q=0.1\r\naccept_charset: $_SERVER[HTTP_ACCEPT_CHARSET]\r\naccept_language: bahasa");
$f=file('http://keepvid.com/?url=http://www.youtube.com/watch?v='.$_GET['id'].'');
$gg=@implode($f);
$gg = preg_replace('/\s+/', ' ',$gg);
$gg=str_replace('&title=', '&title=waphan.co+-+', $gg);
$gg=str_replace('(Max 720p)', 'Max 720p', $gg);
$gg=str_replace('<span class="spanWid"><img src="style/images/d_icon1.png" alt=""/> ', '', $gg);
$ggg=maling($gg, '<div class="d-info2">', '</dl>');
echo htmlspecialchars($ggg);

if($_GET['type'] == '720p') {
$isatu=maling($ggg, 'Full Video</dt>', '720p');
$satu=maling($isatu, '<a href="', '"');
header('Location: '.$satu.'');
}

if($_GET['type'] == '480p') {
$idua=maling($ggg, '720p<', '480p');
$dua=maling($idua, '<a href="', '"');
header('Location: '.$dua.'');
}

if($_GET['type'] == '240p') {
$itiga=maling($ggg, '480p<', '240p');
$tiga=maling($itiga, '<a href="', '"');
header('Location: '.$tiga.'');
}

if($_GET['type'] == '144p') {
$iempat=maling($ggg, '240p<', '144p');
$empat=maling($iempat, '<a href="', '"');
header('Location: '.$empat.'');
}

if($_GET['type'] == '360p') {
$ilima=maling($ggg, '144p<', '360p');
$lima=maling($ilima, '<a href="', '"');
header('Location: '.$lima.'');
}
?>
