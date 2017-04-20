<?php
ob_start("ob_gzhandler");
error_reporting(0);
function format_size($size){$filesizename=array(" Bytes"," KB"," MB"," GB"," TB"," PB"," EB"," ZB"," YB");
return $size ? round($size/pow(1024,($i=floor(log($size,1024)))),2).$filesizename[$i] : '0 Bytes';}
function getfilesize($url) {$data=get_headers($url, true);
if (isset($data['Content-Length']))
return (int)$data['Content-Length'];}
function hapus($txt) {
$txt = preg_replace("/[^a-zA-Z0-9_\-]/", "-", trim($txt));
return $txt;
}
function hps($txt){
$txt=preg_replace("/[^a-zA-Z0-9.-]/", "+", trim($txt)); return $txt; }
function hps1($txt) { $txt = preg_replace("/[^a-zA-Z0-9.=%?_& -]/","grabing", trim($txt));
return $txt; }
function hps2($txt){
$txt=preg_replace("/[^a-zA-Z0-9.-]/", " ", trim($txt)); return $txt; }
function hps3($txt) { $txt = preg_replace("/[^a-zA-Z0-9.=%?_&-]/", "grabcore", trim($txt));
return $txt; }
function hps4($txt) { $txt = preg_replace("/[^a-zA-Z0-9.=?_&+-]/", "asep", trim($txt));
return $txt; }
function ngegrab($url){$ch = curl_init(); curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$header[] = "Accept-Language: en";
$header[] = "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.0; de; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3
";
$header[] = "Pragma: no-cache";
$header[] = "Cache-Control: no-cache";
$header[] = "Accept-Encoding: gzip,deflate";
$header[] = "Content-Encoding: gzip";
$header[] = "Content-Encoding: deflate";
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$load = curl_exec($ch);
curl_close($ch);
return $load;}
function potong($content,$start,$end){
if($content && $start && $end) {
$r = explode($start, $content);
if (isset($r[1])){
$r = explode($end, $r[1]);
return $r[0];}
return '';}}
function format_time($t,$f=':'){
if($t < 3600){
return sprintf("%02d%s%02d", floor($t/60)%60, $f, $t%60);
}else{
return sprintf("%02d%s%02d%s%02d", floor($t/3600), $f, ($t/60)%60, $f, $t%60);
}
}
function dateyt($date){
$date=substr($date,0,10); $date=explode('-',$date);
$mn=date('F',mktime(0,0,0,$date[1])); $dates=''.$date[2].' '.$mn.' '.$date[0].''; return $dates;
}

header('Content-type: text/javascript');
$bukak="document.write('";
$tutup="');";

if($_GET['get-cat']){
$doma = '&videoCategories='.$_GET['get-cat'].'';
}
echo''.$bukak.'<div class="bmenu1" align="center"><b>Popular Music & Videos</b></div>'.$tutup.'

';
$grab = ngegrab('https://www.googleapis.com/youtube/v3/videos?key=AIzaSyCYlCI54E9upB4u8dDtOxWrcSWlnEdCsjA&part=snippet,contentDetails,statistics&chart=mostPopular&maxResults=12&regionCode=id');
$json = json_decode($grab);

if($json)
{
foreach ($json->items as $hasil)
{
$link= $hasil->id->videoId;
$id= $hasil->id;
$name= $hasil->snippet->title;
$name=str_replace("'", '', $name);
$name=str_replace('"', '', $name);
$desc = $hasil->snippet->description;
$chtitle = $hasil->snippet->channelTitle;
$chid = $hasil->snippet->channelId;
$views= $hasil->statistics->viewCount;
$date = dateyt($hasil->snippet->publishedAt);
$datez = $hasil->snippet->publishedAt;
$time=$dta->contentDetails->duration;
$duration= format_time($time);
$x = str_replace(' ','_', str_replace('(','', str_replace('#','', str_replace('-','_', $name))));
$y = substr($x,0,35);
$z = strtolower($y);
$desx = substr($desc,0,200);
$namex = substr($name,0,45);
echo ''.$bukak.'<div class="list2"><table width="100%"><tbody><tr><td class="pass"><img title="Download '.$name.' MP3 Gratis" src="http://img.youtube.com/vi/'.$link.'/default.jpg" width="50" height="50" alt="Download '.$name.'"/></td><td align="left"><b>'.$name.'</b><br/>'.$date.' | Dur: '.$vvdate.'<br/> [<a href="/site_dvideo.xhtml?get-id='.$link.'&get-title='.str_replace('"', '', $name).'" title="Download '.str_replace('"', '', $name).' MP3" class="red2">Download Video</a>] . [<a href="http://adserver.adreactor.com/servlet/view/window/url/zone?zid=40&pid=2625" rel="nofollow"><font color="#3598DB">Play Online</font></a>] . [<a href="/site_youtube-mp3.xhtml?get-id='.$link.'&get-title='.str_replace('"', '', $name).'" title="Download '.str_replace('"', '', $name).' MP3" target="_blank">Download MP3</a>]</td></tr></tbody></table></div>'.$tutup.'


';
}}
echo ''.$bukak.'</div>'.$tutup.'';
?>
