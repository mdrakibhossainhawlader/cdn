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
$doma = $_GET['get-domain'];
if($_GET['get-q']){
$q = $_GET['get-q'];
}
echo''.$bukak.'<div id="mt"><h2>Video Terbaru</h2><div class="post">'.$tutup.'

';
$grab = ngegrab('https://www.googleapis.com/youtube/v3/videos?key=AIzaSyCYlCI54E9upB4u8dDtOxWrcSWlnEdCsjA&part=snippet,contentDetails,statistics&chart=mostPopular&maxResults=7&regionCode=id');
$json = json_decode($grab);

if($json)
{
foreach ($json->items as $hasil)
{
$link= $hasil->id->videoId;
$id= $hasil->id;
$name= $hasil->snippet->title;
$name=str_replace("'", '', $name);
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

echo ''.$bukak.'<div class="movie"><table width="100%"><tbody><tr><td class="pass"><img title="Download '.$name.' MP3 Gratis" src="http://img.youtube.com/vi/'.$id.'/default.jpg" width="50" height="50" alt="Download '.$name.'"/></td><td align="left"><b>'.$name.'</b><br/>'.$date.'<br/> [<a href="http://pidewap.net/site_newdl.xhtml?get-id='.$id.'&get-title='.str_replace('"', '', $name).'" title="Download '.str_replace('"', '', $name).' MP3" target="_blank"><font color="#EE5372">Download Video</font></a>] . [<a href="http://admaster.union.ucweb.com/appwall/applist.html?pub=buxin@pidewap" target="_blank"><font color="#3598DB">Play Online</font></a>] . [<a href="http://pidewap.net/site_youtube-mp3.xhtml?get-id='.$id.'&get-title='.str_replace('"', '', $name).'" title="Download '.str_replace('"', '', $name).' MP3" target="_blank"><font color="#EE5372">Download MP3</font></a>]</td></tr></tbody></table></div>'.$tutup.'


';
}}
echo ''.$bukak.'</div></div>'.$tutup.'';
?>
