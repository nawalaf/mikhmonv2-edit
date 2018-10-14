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
ini_set('max_execution_time', 300);

if(!isset($_SESSION["$userhost"])){
echo "<!--";
}else{
  
  $srvlist = $API->comm("/ip/hotspot/print");
  
  if(isset($_POST['qty'])){
    $qty = ($_POST['qty']);
    $server = ($_POST['server']);
    $user = ($_POST['user']);
    $userl = ($_POST['userl']);
    $prefix = ($_POST['prefix']);
    $char = ($_POST['char']);
    $profile = ($_POST['profile']);
    $timelimit = ($_POST['timelimit']);
    $datalimit = ($_POST['datalimit']);
	$comment = ($_POST['comment']);
    if($timelimit == ""){$timelimit = "0";}else{$timelimit = $timelimit;}
    if($datalimit == ""){$datalimit = "0";}else{$datalimit = $datalimit*1000000000;}
    $getprofile = $API->comm("/ip/hotspot/user/profile/print", array("?name" => "$profile"));
    $ponlogin = $getprofile[0]['on-login'];
    $getvalid = explode(",",$ponlogin)[3];
    $getprice = explode(",",$ponlogin)[2];
    
    $commt = $user . "-" . rand(100,999) . "-" . $comment ;
    
    $gen = '<?php $genu="'. $commt . "-" . $profile . "-" . $getvalid . '";?>';
    $temp = './voucher/temp.php';
		$handle = fopen($temp, 'w') or die('Cannot open file:  '.$temp);
		$data = $gen;
		fwrite($handle, $data);
    
		$a = array ("1"=>"","",1,2,2,3,3,4);

    if($user=="up"){
		for($i=1;$i<=$qty;$i++){
			if($char == "lower"){
			$u[$i]= substr(str_shuffle("123450678912345067891234506789"), -$userl);
		  }elseif($char == "upper"){
		  $u[$i]= substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), -$userl);
		  }elseif($char == "upplow"){
		  $u[$i]= substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), -$userl);
		  }elseif($char == "mix"){
		  $u[$i]= substr(str_shuffle("123456789123456789123456789abcdefghijklmnopqrstuvwxyz"), -$userl);
		  }elseif($char == "mix1"){
		  $u[$i]= substr(str_shuffle("123456789123456789123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), -$userl);
		  }elseif($char == "mix2"){
		  $u[$i]= substr(str_shuffle("123456789123456789123456789AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz"), -$userl);
		  }
		  if($userl == 3){
				$p[$i]= rand(100,999);
			}elseif($userl == 4){
				$p[$i]= rand(1000,9999);
			}elseif($userl == 5){
				$p[$i]= rand(10000,99999);
			}elseif($userl == 6){
				$p[$i]= rand(100000,999999);
			}elseif($userl == 7){
				$p[$i]= rand(1000000,9999999);
			}elseif($userl == 2){
				$p[$i]= rand(01,99);
			}
			
			$u[$i] = "$prefix$u[$i]";
		}
		
		for($i=1;$i<=$qty;$i++){
			$API->comm("/ip/hotspot/user/add", array(
			"server" => "$server",
			"name" => "$u[$i]",
			"password" => "$p[$i]",
			"profile" => "$profile",
			"limit-uptime" => "$timelimit",
			"limit-bytes-out" => "$datalimit",
			"comment" => "$commt",
			));
		}}
		
		if($user=="vc"){
		  $shuf = ($userl-$a[$userl]);
		for($i=1;$i<=$qty;$i++){
        if($char == "lower"){
          $u[$i]= substr(str_shuffle("abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz"), -$shuf);
        }elseif($char == "upper"){
          $u[$i]= substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ"), -$shuf);
        }elseif($char == "upplow"){
          $u[$i]= substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"), -$shuf);
        }
        if($userl == 3){
			  	$p[$i]= rand(1,9);
			  }elseif($userl == 4 || $userl == 5){
			  	$p[$i]= rand(10,99);
			  }elseif($userl == 6 || $userl == 7){
			  	$p[$i]= rand(100,999);
			  }elseif($userl == 8){
			  	$p[$i]= rand(1000,9999);
			  }

	      $u[$i] = "$prefix$u[$i]$p[$i]";
	      
	      if($char == "num"){
	      if($userl == 3){
			  	$p[$i]= rand(100,999);
			  }elseif($userl == 4){
			  	$p[$i]= rand(1000,9999);
			  }elseif($userl == 5){
			  	$p[$i]= rand(10000,99999);
			  }elseif($userl == 6){
			  	$p[$i]= rand(100000,999999);
			  }elseif($userl == 7){
			  	$p[$i]= rand(1000000,9999999);
			  }elseif($userl == 8){
			  	$p[$i]= rand(10000000,99999999);
			  }

	      $u[$i] = "$prefix$p[$i]";
	      }
	      if($char == "mix"){
			  	$p[$i]= substr(str_shuffle("123456789123456789123456789abcdefghijklmnopqrstuvwxyz"), -$userl);
			  

	      $u[$i] = "$prefix$p[$i]";
	      }
	      if($char == "mix1"){
			  	$p[$i]= substr(str_shuffle("123456789123456789123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), -$userl);
			  

	      $u[$i] = "$prefix$p[$i]";
	      }
	      if($char == "mix2"){
			  	$p[$i]= substr(str_shuffle("123456789123456789123456789AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz"), -$userl);
			  

	      $u[$i] = "$prefix$p[$i]";
	      }
	      
		}
		for($i=1;$i<=$qty;$i++){
			$API->comm("/ip/hotspot/user/add", array(
			"server" => "$server",
			"name" => "$u[$i]",
			"password" => "$u[$i]",
			"profile" => "$profile",
			"limit-uptime" => "$timelimit",
			"limit-bytes-out" => "$datalimit",
			"comment" => "$commt",
			));
		}}
		

		
	if($qty < 2){
		  echo "<script>window.location='./?hotspot-user=".$u[1]."'</script>";
		}else{
		header("Location:$url");
		}
	}
  $getprofile = $API->comm("/ip/hotspot/user/profile/print");
  include_once('./voucher/temp.php');
  $genuser = explode("-",$genu);
  $umode = $genuser[0];
  $ucode = $genuser[1];
  $udate = $genuser[2];
  $uprofile = $genuser[3];
  $uvalid = $genuser[4];
  $urlprint = "$umode-$ucode-$udate";
}
?>
<div>
<section class="content p-0 bg-trp">
<div class="col-12 p-1">
<div class="card">
<div class="card-header p-2">
    <h3 class="card-title pull-left">Generate User</h3>
</div>
<!-- /.card-header -->
<div class="card-body p-0">
<div class="row">
<div class="col-sm-12">
<form autocomplete="off" method="post" action="">
<table class="tdata">
  <tr>
  	<td colspan="2">
  <?php if($_SESSION['ubp'] != ""){
    echo "    <a class='btnsubmit' href='./?user-by-profile=".$_SESSION['ubp']."'> <i class='fa fa-close'></i> Close</a>";
}else{
    echo "    <a class='btnsubmit' href='./?hotspot=users'> <i class='fa fa-close'></i> Close</a>";
}
?>
    <button type="submit" name="save" class="btnsubmit" title="Generate User"> <i class="fa fa-save"></i> Generate</button>
    <a class="btnsubmit" title="Print Default" href="./voucher/print.php?id=<?php echo $urlprint;?>&qr=no" target="_blank"> <i class="fa fa-print"></i> Print</a>
    <a class="btnsubmit" title="Print QR" href="./voucher/print.php?id=<?php echo $urlprint;?>&qr=yes" target="_blank"> <i class="fa fa-qrcode"></i> QR</a>
    <a class="btnsubmit" title="Print Small" href="./voucher/print.php?id=<?php echo $urlprint;?>&small=yes" target="_blank"> <i class="fa fa-print"></i> Small</a>
    </td>
  </tr>	
  <tr>
    <td class="align-middle">Qty</td><td><input class="form-control form-control-sm" type="number" size="4" name="qty" min="1" max="500" value="30" required="1"></td>
  </tr>
  <tr>
    <td class="align-middle">Server</td>
    <td>
		<select class="form-control form-control-sm" name="server" required="1">
			<option>pilih</option>
				<?php $TotalReg = count($srvlist);
				for ($i=0; $i<$TotalReg; $i++){
				  echo "<option>" . $srvlist[$i]['name'] . "</option>";
				  }
				?>

		</select>
	</td>
	</tr>
	<tr>
    <td class="align-middle">User Mode</td><td>
			<select class="form-control form-control-sm" onchange="defUserl();" id="user" name="user" required="1">
				<option value="up">Username & Pasword</option>
				<option value="vc">Username = Pasword</option>
			</select>
		</td>
	</tr>
  <tr>
    <td class="align-middle">User Length</td><td>
      <select class="form-control form-control-sm" id="userl" name="userl" required="1">
        <option>3</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
				<option>6</option>
				<option>7</option>
				<option>2</option>
			</select>
    </td>
  </tr>
  <tr>
    <td class="align-middle">Prefix</td><td><input class="form-control form-control-sm" type="text" size="4" maxlength="4" autocomplete="off" name="prefix" value=""></td>
  </tr>
  <tr>
    <td class="align-middle">Character</td><td>
      <select class="form-control form-control-sm" name="char" required="1">
				<option id="lower" style="display:block;" value="lower">123</option>
				<option id="upper" style="display:block;" value="upper">abc</option>
				<option id="upplow" style="display:block;" value="upplow">aBcD</option>
				<option id="lower1" style="display:none;" value="lower">abcd1234</option>
				<option id="upper1" style="display:none;" value="upper">ABCD1234</option>
				<option id="upplow1" style="display:none;" value="upplow">aBcD1234</option>
				<option id="mix" style="display:block;" value="mix">1ab2c34d</option>
				<option id="mix1" style="display:block;" value="mix1">1AB2C34D</option>
				<option id="mix2" style="display:block;" value="mix2">1aB2c34D</option>
				<option id="num" style="display:none;" value="num">1234</option>
			</select>
    </td>
  </tr>
  <tr>
    <td class="align-middle">Profile</td><td>
			<select class="form-control form-control-sm" onchange="GetVP();" id="uprof" name="profile" required="1">
				<?php $TotalReg = count($getprofile);
				for ($i=0; $i<$TotalReg; $i++){
				  echo "<option>" . $getprofile[$i]['name'] . "</option>";
				  }
				?>
			</select>
		</td>
	</tr>
	<tr>
    <td class="align-middle">Time Limit</td><td><input class="form-control form-control-sm" type="text" size="4" autocomplete="off" name="timelimit" value=""></td>
  </tr>
  <tr>
    <td class="align-middle">Data Limit</td><td>
	<div class="input-group input-group-sm">
        <input class="form-control form-control-sm" type="number" min="0" max="9999" name="datalimit" value=""><span class="input-group-text">GB</span>
    </div>
	</td>
  </tr>
  <tr>
    <td class="align-middle">Comment</td><td><input class="form-control form-control-sm" type="text"  autocomplete="off" name="comment" value=""></td>
  </tr>
  <tr >
    <td class="align-middle">Validity | Price</td><td id="GetValidPrice"></td>
  </tr>
  <tr >
    <td colspan="2">
      <?php if($curency == "Rp" || $curency == "rp" || $curency == "IDR" || $curency == "idr"){
         echo "Generate Terakhir:<br>Kode Generate: $ucode | Tanggal: $udate | Profile: $uprofile | Validity: $uvalid";
      }else{
        echo "Last Generated:<br>Generate Code: $ucode | Date: $udate | Profile: $uprofile | Validity: $uvalid";
      }
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="2">
      <?php if($curency == "Rp" || $curency == "rp" || $curency == "IDR" || $curency == "idr"){?>
      <p style="padding:0px 5px;">
        Format Time Limit.<br>
        [wdhm] Contoh : 30d = 30hari, 12h = 12jam, 4w3d = 31hari.
      </p>
      <?php }else{?>
      <p style="padding:0px 5px;">
        Format Time Limit.<br>
        [wdhm] Example : 30d = 30days, 12h = 12hours, 4w3d = 31days.
      </p>
      <?php }?>
    </td>
  </tr>
</table>
</form>
</div>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</section>
</div>	
