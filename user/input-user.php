<?php

date_default_timezone_set('Asia/Jakarta');

$time = new DateTime();
$today = $time->format('d-m-Y');
$todayDate = $time->format("Y-m-d");
$todayTime = $time->format("H:i:s");
$retMasuk = "";
$retPulang = "";

function isWeekend($date)
{
    $weekDay = date('w', strtotime($date));
    return ($weekDay == 0 || $weekDay == 6);
}

function isMasuk($time)
{
    if($time >= "06:00:00" && $time <= "15:00:00" ) {
        $ret = true;
    } else {
        $ret = false;
    }

    return $ret;
}

function isPulang($time)
{
    if($time >= "15:00:01" && $time <= "18:00:00" ) {
        $ret = true;
    } else {
        $ret = false;
    }

    return $ret;
}

// Normal Day
if(isWeekend($today) == false) {
    if(isMasuk($todayTime) == false) {
        $retMasuk = "disabled";
    } else {
        $retMasuk = "";
    }

    if(isPulang($todayTime) == false) {
        $retPulang = "disabled";
    } else {
        $retPulang = "";
    }
}

// Weekend
if(!isWeekend($today) == false) {
    if(isMasuk($todayTime) == false) {
        $retMasuk = "disabled";
    }

    if(isPulang($todayTime) == false) {
        $retPulang = "disabled";
    }
}

echo "<input type='hidden' name='time' value='$todayTime'>";
echo "<input type='hidden' name='tanggal' value='$todayDate'>";
echo "<td><input type='text' class='head' value='$today' readonly></td>";
echo "<td><button class='masuk' type='submit' name='masuk' $retMasuk>Masuk</button></td>";
echo "<td><button class='pulang' type='submit' name='pulang' $retPulang>Pulang</button></td>";
