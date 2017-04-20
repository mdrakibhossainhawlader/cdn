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
if(!empty($_GET['get-q'])){
echo ''.$bukak.'<div id="mt"><h2>Result for '.ucwords(str_replace('_', ' ', $q)).'</h2><div class="post"><div class="breadcrumb"><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"> <a href="http://pidewap.net/" itemprop="url"><span itemprop="title">Home</span></a> > </span> <span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="http://pidewap.net/site_newsearch.xhtml" itemprop="url"><span itemprop="title">MV Search</span></a> > </span>'.ucwords(str_replace('_', ' ', $q)).'</div>'.$tutup.'

';}
else{
echo''.$bukak.'<div id="mt"><h2>Result for Popular videos</h2><div class="post"><div class="breadcrumb"><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"> <a href="http://pidewap.net/" itemprop="url" target="_blank"><span itemprop="title">Home</span></a> > </span> <span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="http://pidewap.net/site_newsearch.xhtml" itemprop="url" target="_blank"><span itemprop="title">MV Search</span></a> > </span>Popular Videos</div>'.$tutup.'

';}

$qu=$q;
$qu=str_replace(" ","+", $qu);
$qu=str_replace("-","+", $qu);
$qu=str_replace("_","+", $qu);
if(!empty($_GET['get-newpage'])){
$dpage='&pageToken='.$_GET['get-newpage'].'';
}
if(!empty($_GET['get-more'])){
$vmore='&relatedToVideoId='.$_GET['get-more'].'';}
$grab=ngegrab('https://www.googleapis.com/youtube/v3/search?part=id,snippet&q='.$qu.'&type=video&maxResults=15&key=AIzaSyCYlCI54E9upB4u8dDtOxWrcSWlnEdCsjA'.$dpage.''.$vmore.'');
$json = json_decode($grab);
$isinya = $json->pageInfo->totalResults;
$nextpagecode = $json->nextPageToken;
$prevpagecode = $json->prevPageToken;
if($isinya == 0){
echo''.$bukak.'<div class="movie"><table width="100%"><tbody><tr><td class="pass"><img title="Download '.$name.' MP3 Gratis" src="http://img.youtube.com/vi/'.$link.'/default.jpg" width="50" height="50" alt="Download '.ucwords(str_replace('_', ' ', $q)).'"/></td><td align="left"><b>'.ucwords(str_replace('_', ' ', $q)).'</b><br/>05 Juni 2015 | Dur: 02.50<br/> [<a href="http://admaster.union.ucweb.com/appwall/applist.html?pub=buxin@pidewap" title="Download '.$name.' MP3" target="_blank"><font color="#EE5372">Download</font></a>]</td></tr></tbody></table></div>'.$tutup.'


';}else{
foreach($json->items as $hasil) {
$name = $hasil->snippet->title;
$name = str_replace("'", '', $name);
$link = $hasil->id->videoId;
$yf=json_decode(ngegrab('https://www.googleapis.com/youtube/v3/videos?part=id,snippet,contentDetails&id='.$link.'&maxResults=1&key=AIzaSyCYlCI54E9upB4u8dDtOxWrcSWlnEdCsjA'),true);
$dura=$yf[items][0][contentDetails][duration];
$vdate = new DateTime('1970-01-01');
$vdate->add(new DateInterval($dura));
$vvdate = $vdate->format('H:i:s');
$tgl = $hasil->snippet->publishedAt;
$date = dateyt($tgl);
echo ''.$bukak.'<div class="movie"><table width="100%"><tbody><tr><td class="pass"><img title="Download '.$name.' MP3 Gratis" src="http://img.youtube.com/vi/'.$link.'/default.jpg" width="50" height="50" alt="Download '.$name.'"/></td><td align="left"><b>'.$name.'</b><br/>'.$date.' | Dur: '.$vvdate.'<br/> [<a href="http://pidewap.net/site_newdl.xhtml?get-id='.$link.'&get-title='.str_replace('"', '', $name).'" title="Download '.str_replace('"', '', $name).' MP3" target="_blank"><font color="#EE5372">Download Video</font></a>] . [<a href="http://admaster.union.ucweb.com/appwall/applist.html?pub=buxin@pidewap" target="_blank"><font color="#3598DB">Play Online</font></a>] . [<a href="http://pidewap.net/site_youtube-mp3.xhtml?get-id='.$link.'&get-title='.str_replace('"', '', $name).'" title="Download '.str_replace('"', '', $name).' MP3" target="_blank"><font color="#EE5372">Download MP3</font></a>]</td></tr></tbody></table></div>'.$tutup.'


';
}}
if($_GET['get-q']){
$wq = 'get-q='.$_GET['get-q'].'&';
}
if(!empty($prevpagecode)){
$pagenavprev='<a href="http://pidewap.net/site_newsearch.xhtml?'.$wq.'get-newpage='.$prevpagecode.'" target="_blank">« Prev</a>';
}else{
$pagenavprev='< Prev';
}
if(!empty($nextpagecode)){
$pagenavnext='<a href="http://pidewap.net/site_newsearch.xhtml?'.$wq.'get-newpage='.$nextpagecode.'" target="_blank">Next ></a>';
}else{
$pagenavnext='Next >';
}
echo ''.$bukak.'<div class="pagination">'.$pagenavprev.' | '.$pagenavnext.'</div></div></div>'.$tutup.'';
?>
