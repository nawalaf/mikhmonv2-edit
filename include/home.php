<?php
/*
 *  Copyright (C) 2018 Laksamadi Guko.
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
session_start();
// hide all error
error_reporting(0);

// load ip user pass MikroTik
include_once('./config.php');

if(!isset($_SESSION["$userhost"])){
	echo "<meta http-equiv='refresh' content='0;url=./' />";
}else{

// array color
$color = array ('1'=>'#D50000','#880E4F','#C51162','#9C27B0','#6A1B9A','#4A148C','#311B92','#536DFE','#3F51B5','#1565C0','#01579B','#0097A7','#00838F','#00B8D4','#00897B','#00BFA5','#388E3C','#558B2F','#827717','#E65100','#D84315','#795548','#757575','#607D8B','#37474F');


// routeros api

include_once('../lib/routeros_api.class.php');
include_once('../lib/formatbytesbites.php');
$API = new RouterosAPI();
$API->debug = false;
$API->connect( $iphost, $userhost, $passwdhost );
}
?>

<div id="reloadHome">
<div class="header">
  <table style="width:100%;">
    <tr>
      <td style="font-weight:bold; border-bottom: 1px solid #ccc;">RB 750gr3</td>
    </tr>
    <tr>
      <td>

<?php

// get system resource MikroTik
$getresource = $API->comm("/system/resource/print");
$resource = $getresource[0];
?>
  </b>
  <b class="btnhome" style="background-color: #4CAF50;" title="CPU Load">CPU Load <br>
<?php echo $resource['cpu-load']?>%
  </b>
  <b class="btnhome" style="background-color: #607D8B;" title="Free Memory">Free Memory <br>
<?php echo formatBytes($resource['free-memory'],0)?>
  </b>
  <b class="btnhome" style="background-color: #673AB7;" title="Free HDD Space">Free HDD <br>
<?php echo formatBytes($resource['free-hdd-space'],0)?>
  </b>
      </td>
    </tr>
  </table>
</div>
<div class="left">
<table class="">
  <tr>
    <td style="font-weight:bold; border-bottom: 1px solid #ccc;">Hotspot</td>
  </tr>
  <tr>
    <td>
      <a class="btnhome" style="font-weight:bold; background-color: <?php echo $color[rand(1,25)];?>;" href="./?hotspot=active" title="Hotspot Active">Online <br>
<span style="font-size: 35px;">
	  <?php
// get & counting hotspot active
  $counthotspotactive = $API->comm("/ip/hotspot/active/print", array(
  	"count-only" => ""));
	if($counthotspotactive < 2 ){echo "$counthotspotactive";
  }elseif($counthotspotactive > 1){
  echo "$counthotspotactive ";
  }
?></span>

      </a>
      <a class="btnhome" style="font-weight:bold; background-color: <?php echo $color[rand(1,25)];?>;" href="./?hotspot=users" title="Hotspot Users">Sisa Vocer<br>
<span style="font-size: 35px;"><?php
// get & counting hotspot users
  $countallusers = $API->comm("/ip/hotspot/user/print", array(
    "count-only" => ""));
	if($countallusers < 2 ){echo "$countallusers ";
  }elseif($countallusers > 1){
  echo "$countallusers ";}
?></span>
      </a>
      
      <a class="btnhome" style=" background-color: <?php echo $color[rand(1,25)];?>;" href="./?hotspot-user=generate" title="Generate Hotspot User"><span style="font-size: 20px;">Generate</span><span style="font-size: 23px;font-weight:bold;"><br>Vocer</a></span>
    </td>
  </tr>
  

  <tr>
    <td style="font-weight:bold; border-bottom: 1px solid #ccc;">Traffic & AP</td>
  </tr>
  <tr>
    <td>
<?php /*
$system = ini_get('system');
$win  = is_bool($system);
$host = "google.com";
$ping = exec("ping -n 1 $host");
$getping = explode(",",$ping);
  if ( substr($ping, -2) == 'ms')
		{
		echo "<b class='btnhome' style='background-color: ".$color[rand(1,25)].";' title='ping $host ".$getping[2] ."'>ping $host <br>".$getping[2] ."</b>";
		}
	  else
		{
			echo "<b class='btnhome' style='background-color: ".$color[rand(1,25)].";' title='ping $host ".$getping[2] ."'>ping $host <br>request timeout...</b>";
		}*/
?>
<?php
// get traffic ether1
  $getinterface = $API->comm("/interface/print");
  $interface = $getinterface[$iface-1]['name'];
  $getinterfacetraffic = $API->comm("/interface/monitor-traffic", array(
	  "interface" => "$interface",
	  "once" => "",
	  ));
	$tx = formatBites($getinterfacetraffic[0]['tx-bits-per-second'],0);
	$rx = formatBites($getinterfacetraffic[0]['rx-bits-per-second'],0);
?>
      <b class="btnhome" style="font-weight:bold; background-color: <?php echo $color[rand(1,25)];?>;"  title="Traffic <?php echo $interface." Tx : ".$tx." Rx : ".$rx;?>"><span style="font-size: 18px;"><?php echo $rx;?></b></span>
		<a class="btnhome" style="font-weight:bold; border-radius: 30px; background-color: #F57B00;" href="http://ten.da/" target="_blank" title="AP"><span style="font-size: 18px;">AP 1</a></span>
		<a class="btnhome" style="font-weight:bold; border-radius: 30px; background-color: #BBCAEF;" href="http://ten.da/" target="_blank" title="AP"><span style="font-size: 18px;">AP 2</a></span>
		<a class="btnhome" style="font-weight:bold; border-radius: 30px; background-color: #BBCAEF;" href="http://ten.da/" target="_blank" title="AP"><span style="font-size: 18px;">AP 3</a></span>
		<a class="btnhome" style="font-weight:bold; border-radius: 30px; background-color:#BBCAEF;" href="http://ten.da/" target="_blank" title="AP"><span style="font-size: 18px;">AP 4</a></span>
		<a class="btnhome" style="font-weight:bold; border-radius: 30px; background-color:#BBCAEF;" href="http://ten.da/" target="_blank" title="AP"><span style="font-size: 18px;">AP 5</a></span>
	
	</td>
	</tr>
</table>
</div>
<div class="right">
<table class="thome">
  <tr>
    <td style="font-weight:bold;"><a href="./?hotspot=log">Hotspot Log</td>
  </tr>
  <tr>
    <td>
      <textarea overflow: auto; rows="25" cols="38" style="font-size:12px; background-color: #3D4241; color:#fff;">
<?php
// move hotspot log to disk
  $getlogging = $API->comm("/system/logging/print", array(
    "?prefix" => "->",));
	$logging = $getlogging[0];
	if($logging['prefix'] == "->"){}else{
  $API->comm("/system/logging/add", array("action" => "disk","prefix" => "->","topics" => "hotspot,info,debug",));
  }
// get hotspot log
	$getlog = $API->comm("/log/print", array(
	  "?topics" => "hotspot,info,debug",));
	$log = array_reverse($getlog);
	$TotalReg = count($getlog);
	for ($i=0; $i<$TotalReg; $i++){
	echo "" . $log[$i]['message']."&#13;&#10;";
	}
?>
      </textarea>
    </td>
  </tr>
</table>
</div>
</div>

