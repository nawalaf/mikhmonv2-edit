	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            	            <?php
// Copy Paste ke template editor [Settings -> Template Editor].

if(substr($validity,-2) == "1d"){
  $validity = "".substr($validity,0,0)." 24 jam";}
if(substr($validity,-1) == "h"){
  $validity = "".substr($validity,0,-1)." jam";
}else if(substr($validity,-1) == "d"){
  $validity = "".substr($validity,0,-1)." Hari";
}
if(substr($timelimit,-1) == "d"){
  $timelimit = "Durasi:".substr($timelimit,0,-1)."Hari";
}else if(substr($timelimit,-1) == "h"){
  $timelimit = "Durasi:".substr($timelimit,0,-1)."Jam";
}
if($datalimit == ""){
  $kuota = "";
}else{
  $kuota = "Kuota:";
}

?>
<table class="voucher" style=" width: 220px;">
  <tbody>
<!-- Logo Hotspotname -->
    <tr>
      <td style="text-align: center; font-size: 20px; border-bottom: 1px black solid;"><font size=2>aktif </font><b><?php echo $validity;?></b><font size=2> sejak awal pakai</font></span></td>
    </tr>
<!-- /  -->
    <tr>
      <td>
    <table style=" text-align: center; width: 210px; font-size: 12px;">
  <tbody>
<!-- Username Password QR    -->
    <tr>
      <td>
        <table style="width:100%;">
<!-- Username = Password    -->
<?php if($usermode == "vc"){?>
        <tr>
          <td font-size: 12px;>Kode Voucher</td>
        </tr>
        <tr>
          <td style="width:100%; border: 1px solid black; font-weight:bold; font-size:18px;"><?php echo $username;?></td>
        </tr>
<!-- /  -->
<!-- Username & Password  -->
<?php }elseif($usermode == "up"){?>
<!-- Check QR  -->
<?php if($qr == "yes"){?>
        <tr>
          <td>Username</td>
        </tr>
        <tr>
          <td style="border: 1px solid black; font-size: 18px; border-radius: 8px; letter-spacing: 1px; font-weight:bold;"><?php echo $username;?></td>
        </tr>
        <tr>
          <td>Password</td>
        </tr>
        <tr>
          <td style="border: 1px solid black; font-size: 18px; border-radius: 8px; letter-spacing: 1px; font-weight:bold;"><?php echo $password;?></td>
        </tr>
<?php }else{?>
        <tr>
          <td style="width: 50%">Username</td>
          <td >Password</td>
        </tr>
        <tr style="font-size: 14px;">
          <td style="border: 1px solid black; font-size: 18px; letter-spacing: 1px; border-radius: 8px; font-weight:bold;"><?php echo $username;?></td>
          <td style="border: 1px solid black; font-size: 18px; letter-spacing: 1px; border-radius: 8px; font-weight:bold;"><?php echo $password;?></td>
        </tr>
<?php }}?>
<!-- /  -->
        </table>
      </td>
<!-- QR Code    -->
<?php if($qr == "yes"){?>
      <td>
	<img src="<?php echo $qrcode ?>" style="height:90px;border:0;" alt="qrcode">
      </td>
<?php }?>

<!-- /  -->
    </tr>
    <tr>
      <!-- Note  -->
      <td colspan="2" style="font-size:12px">sambungkan HP dg sinyal "wi.fi" lalu buka Google Chrome, ketik <b><?php echo $dnsname;?></b></td>
<!-- /  -->
    </tr>
<!-- /  -->
  </tbody>
    </table>
      </td>
    </tr>
  </tbody>
</table>	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          	            	          