<?php
function th_datenotime($time)
{
    global $thailand_day_arr, $thailand_month_arr;
    $thailand_date_return = ' วัน' . $thailand_day_arr[date('w', $time)];
    $thailand_date_return .= ' ที่ ' . date('j', $time);
    $thailand_date_return .= ' เดือน' . $thailand_month_arr[date('n', $time)];
    $thailand_date_return .= ' พุทธศักราช ' . (date('Y', $time) + 543);

    return $thailand_date_return;
}
function th_datenotime2($time)
{
    global $thailand_day_arr, $thailand_month_arr;
    $thailand_date_return  = ' ' . date('j', $time);
    $thailand_date_return .= ' ' . $thailand_month_arr[date('n', $time)];
    $thailand_date_return .= ' ' . (date('Y', $time) + 543);

    return $thailand_date_return;
}
function th_date($time)
{
    global $thailand_day_arr, $thailand_month_arr;
    $thailand_date_return = ' วัน' . $thailand_day_arr[date('w', $time)];
    $thailand_date_return .= ' ที่ ' . date('j', $time);
    $thailand_date_return .= ' เดือน' . $thailand_month_arr[date('n', $time)];
    $thailand_date_return .= ' พุทธศักราช ' . (date('Y', $time) + 543);
    $thailand_date_return .= '  ' . date('H:i:s', $time) . " น.";

    return $thailand_date_return;
}
$thailand_day_arr = array('อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์');
$thailand_month_arr = array(
    '0' => '',
    '1' => 'มกราคม',
    '2' => 'กุมภาพันธ์',
    '3' => 'มีนาคม',
    '4' => 'เมษายน',
    '5' => 'พฤษภาคม',
    '6' => 'มิถุนายน',
    '7' => 'กรกฎาคม',
    '8' => 'สิงหาคม',
    '9' => 'กันยายน',
    '10' => 'ตุลาคม',
    '11' => 'พฤศจิกายน',
    '12' => 'ธันวาคม',
);

$thailand_month_arr2 = array(
    '0' => '',
    '1' => '1',
    '2' => '2',
    '3' => '3',
    '4' => '4',
    '5' => '5',
    '6' => '6',
    '7' => '7',
    '8' => '8',
    '9' => '9',
    '10' => '10',
    '11' => '11',
    '12' => '12',
);
function th_date2($time)
{
    global $thailand_month_arr2;
    $thailand_date_return = date('j', $time);
    $thailand_date_return .= '/' . $thailand_month_arr2[date('n', $time)];
    $thailand_date_return .= '/' . (date('Y', $time) + 543);
    $thailand_date_return .= '  ' . date('H:i:s', $time);

    return $thailand_date_return;
}

// เปลี่ยนวันเวลา thailand -> database
function thai_to_date($bDay)
{
    //22-11-2558 to 2015-11-22
    $date_recent  = substr("$bDay", 0, 2); //นับจากเริ่มต้นไป 2ตัว ในที่นี้คือ 29
    $month_recent = substr("$bDay", 3, 2); //นับจากตัวที่ 3 ไป 2ตัว ในที่นี้คือ 05
    $year_recent = substr("$bDay", 6, 4) - 543; //นับจากตัวที่ 6 เริ่มต้นไป 4ตัว ในที่นี้คือ 2011
    $date_recent_box = "$year_recent" . "-$month_recent" . "-$date_recent ";
    return $date_recent_box;
}

function datethai_fomat($sddate)
{
    $date_box = $sddate;
    $bDay = $date_box;   //2014-04-11
    $date_recent  = substr("$bDay", 8, 2); //นับจากเริ่มต้นไป 2ตัว ในที่นี้คือ 29
    $month_recent = substr("$bDay", 5, 2); //นับจากตัวที่ 3 ไป 2ตัว ในที่นี้คือ 05
    $year_recent = substr("$bDay", 0, 4) + 543; //นับจากตัวที่ 6 เริ่มต้นไป 4ตัว ในที่นี้คือ 2011
    $date_recent_box = "$date_recent" . "/$month_recent" . "/$year_recent ";
    return $date_recent_box;
}

function ThaiBahtConversion($amount_number)
{
    $amount_number = number_format($amount_number, 2, ".", "");
    //echo "<br/>amount = " . $amount_number . "<br/>";
    $pt = strpos($amount_number, ".");
    $number = $fraction = "";
    if ($pt === false)
        $number = $amount_number;
    else {
        $number = substr($amount_number, 0, $pt);
        $fraction = substr($amount_number, $pt + 1);
    }

    //list($number, $fraction) = explode(".", $number);
    $ret = "";
    $baht = ReadNumber($number);
    if ($baht != "")
        $ret .= $baht . "บาท";

    $satang = ReadNumber($fraction);
    if ($satang != "")
        $ret .=  $satang . "สตางค์";
    else
        $ret .= "ถ้วน";
    //return iconv("UTF-8", "TIS-620", $ret);
    return $ret;
}

function ReadNumber($number)
{
    $position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
    $number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
    $number = $number + 0;
    $ret = "";
    if ($number == 0) return $ret;
    if ($number > 1000000) {
        $ret .= ReadNumber(intval($number / 1000000)) . "ล้าน";
        $number = intval(fmod($number, 1000000));
    }

    $divider = 100000;
    $pos = 0;
    while ($number > 0) {
        $d = intval($number / $divider);
        $ret .= (($divider == 10) && ($d == 2)) ? "ยี่" : ((($divider == 10) && ($d == 1)) ? "" : ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
        $ret .= ($d ? $position_call[$pos] : "");
        $number = $number % $divider;
        $divider = $divider / 10;
        $pos++;
    }
    return $ret;
}

function memlevel($level)
{
    switch ($level) {
        case 'NEW':
            $bg = "danger";
            break;
        case 'VIP':
            $bg = "warning";
            break;
        case 'PLATINUM':
            $bg = "success";
            break;
    }
    return $bg;
}
function DateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
}
