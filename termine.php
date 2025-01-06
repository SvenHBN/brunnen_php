<?php

function split_sql_date($date)
{
	$arr[] = substr($date, 0, 4); // year
  $arr[] = substr($date, 4, 2); // month
  $arr[] = substr($date, 6, 2); // day
  return $arr;
}

$arr_wd_ext = array(
	1 => 'und',
	2 => 'bis');

$terminTable = '<table width="100%"  border="0" cellspacing="0" cellpadding="0">';

// Don't be verbose at any costs :D
$res_sql = @mysql_connect("xxxxx", "xxxxxx", "xxxxx");
@mysql_select_db("xxxxxx");
$todays_sqldate = date("Ymd"); // 20070308
$sql = 'SELECT * FROM termine WHERE terminDatum >= '.$todays_sqldate.' ORDER BY terminDatum ASC';
$result = @mysql_query($sql);
while( $row = @mysql_fetch_array($result, MYSQL_ASSOC) ) $termine[] = $row;
@mysql_close($res_sql);
if( !empty($termine) )
{
	foreach( $termine as $termin )
	{
		list($year, $month, $day) = split_sql_date($termin['terminDatum']);
		$year = substr($year, 2, 2);
		$wd_ext = ( $termin['terminUnd'] != 0 ? "&nbsp;".$arr_wd_ext[$termin['terminUnd']] : '' );
		$costs = ( $termin['terminKosten'] ? $termin['terminKosten']."&nbsp;&euro;" : '');
		$terminTable .= '<tr valign="top">
        <td width="22%">'.$day.'.'.$month.'.'.$year.'</td>
        <td width="20%"> '.$termin['terminTag'].$wd_ext.'</td>
        <td width="30%">'.$termin['terminUhrzeit'].' Uhr</td>
        <td width="15%">'.$termin['terminOrt'].'</td>
        <td width="13%" align="right">'.$costs.'</td>
      </tr>';
  }
}
else
{
	$terminTable .= '<tr><td align="center"> Einzel-, Paar-, und Familiensitzungen nach Vereinbarung </td></tr>';
}
$terminTable .= '</table>';
// html page
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Heilpraxis M&uuml;nchen -  Heilpraktiker Susanne Hausladen-Schwab</title>
<meta http-equiv="imagetoolbar" content="no" />
<meta name="keywords" content="Naturheilkunde, Heilpraktiker, Heilpraxis, M&uuml;nchen, Medizin, Therapie, Hom&ouml;opathie, Chinesische, Manuelle,  Schamanismus, Schamanische, Susanne, Hausladen, Schwab, Familienaufstellung, Systemaufstellungen" />
<meta name="description" content="Website der Heilpraxis Susanne Hausladen-Schwab, Heilpraktiker in M&uuml;nchen" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="container">
  <div id="box1">
    <p><img src="../pics/transparent.gif" alt="" width="100" height="1" /></p>

    <p><img src="../pics/transparent.gif" alt="" width="106" height="20" /><img src="../pics/Logo.gif" alt="Susanne Hausladen-Schwab" width="360" height="60" /></p>
  </div>
  <div id="box2"><img src="../pics/transparent.gif" alt="" width="100" height="9" /></div>
  <div id="spacer_box3_li"></div>
  <div id="box3">
    <h2>&nbsp;</h2>
    <h2>Termine</h2>
    <p>&nbsp;</p>

    <h2>&nbsp;</h2>
  </div>
  <div id="spacer_box3_re"></div>
  <div id="box4">
    <img src="../pics/haus.jpg" alt="" width="180" height="180" />

    <img src="../pics/transparent.gif" alt="" width="180" height="100" />
   <div id="navcontainer">
		<ul id="navlist">
		<li id="active"><a href="../index.html" id="current">Home</a></li>
		<li><a href="homoeopathie.htm">Klassische Hom&ouml;opathie</a></li>
		
		<li><a href="systemaufstellung.htm">Systemaufstellungen</a></li>
		<li><a href="termine.php">Termine</a></li>
		<li><a href="kontakt.htm">Kontakt</a></li>
		<li><a href="impressum.htm">Impressum</a></li>
		</ul>
	</div>
  </div>

    <div id="spacer_box5_li"></div>
    <div id="box5">
      <h1>&nbsp;</h1>
      <h1>&nbsp;</h1>
      <h1>Termine</h1>
      <h2>System- und Familienaufstellungen</h2>
      
      <?php
      echo $terminTable;
      ?>
      <br/>
      
      
      
    </div>  
  <div id="box6">
    <p class="Stil1">&copy; Susanne Hausladen-Schwab</p>
  </div>
</div>
</body>
</html>
