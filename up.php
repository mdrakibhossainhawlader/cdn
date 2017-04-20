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

$f=file(''.$_GET['url'].'');
$gg=@implode($f);
$linkdir=maling($gg, '/music/down/', '.mp3');
$gg=str_replace('<strong>Download Lagu ', '<br/><strong>', $gg);
$gg=str_replace('</strong>', '.mp3</strong>', $gg);
$gg=str_replace('Download Lagu <b> ', '<br/><strong>', $gg);
$gg=str_replace('</B> gratis', '.mp3</strong>', $gg);

$gg=str_replace('</td><td><strong>', '<br/><strong>', $gg);
$gg=str_replace('</strong></td></tr>', '.mp3</strong>', $gg);

$artis=maling($gg, '<u><b>', '.mp3');
if(!empty($artis)){
$artist=maling($gg, '<u><b>', 'p3');
$artiss=maling($gg, '<u><b>',' -');
$titles=maling($artist, '- ','.M');
}else{
$artist=maling($gg, '<br/><strong>', 'p3');
$artiss=maling($gg, '<br/><strong>',' -');
$titles=maling($artist, '- ','.m');
}

$thumb=maling($gg, 'src="http://img.wapkafile.com/music/thumb/', '"');
$thumbbb=maling($gg, '/wapka_img.php', '"');

if(!empty($thumb)){
$thumbb='http://img.wapkafile.com/music/thumb/'.$thumb.'';
}else{
$thumbb='http://8.37.229.144:8999/wapka_img.php'.$thumbbb.'';
}

$url='http://pidewap.wapka.mobi/music/down/'.$linkdir.'';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, TRUE); // We'll parse redirect url from header.
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE); // We want to just get redirect url but not to follow it.
$response = curl_exec($ch);
$link=maling($response, 'music/', '?');
curl_close($ch);
$rando=rand(1,8);
$tahunn=date("Y");
echo '<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
input {display: block!important;width:70%;max-width:100%;}
</style>
</head>
<body>
<center><form method="post" action="http://cdn1.cloud.mp3tag.us/import.php?m=api&submit=from_edit_tag">URL File: <br />
<input type="text" name="mp3_filepath" value="http://m03.wapka-file.com/music/'.$link.'" class="form-control" style="widht:100%"/> 
<br /> Nama File: <br />
<input type="text" class="form-control" value="'.htmlspecialchars($titles).' - SatriaMusic.com" name="mp3_filename" style="widht:100%"/>
<input type="hidden" class="form-control" value="http://utub.yn.lt/satriamusic'.$rando.'.png" name="img1" style="widht:100%"/>
<input type="hidden" class="form-control" value="SatriaMusic.com" name="mp3_comment" style="widht:100%"/>
</div><div class="form-grup col-sm-5">
<br /> Artis: <br />
<input type="text" class="form-control" value="'.$artiss.' - Satriamusic.com" name="mp3_artist" style="widht:100%"/>
<input type="hidden" class="form-control" value="SatriaMusic.com" name="mp3_album" style="widht:100%"/>
<input type="hidden" class="form-control" value="'.$tahunn.'" name="mp3_year" style="widht:100%"/>
<input type="hidden" class="form-control" value="SatriaMusic.com" name="mp3_genre" style="widht:100%"/> 
</div> </div>
<br /> <br />
<input type="submit" value="Submit" class="btn btn-success px7" style="widht:100%" />
</form>
</center>
</body>
</html>';
?>
