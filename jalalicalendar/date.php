<?php

class Application_Helper_Date {

    var $Day;
    var $Month;
    var $Year;

    public function __construct() {
        require_once("libs/params.php");
        $this->params = new Application_Lib_Params();
    }

    public function npdate($datetime) {
        list ($date, $time) = explode(' ', $datetime);
        list ($g_y, $g_m, $g_d, $g_w) = explode('-', $date);
        $jy = $g_y;
        $i = $g_m - 1;
        $j_day_no = $g_d - 1;
        if ($g_y > 1600) {
            $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
            $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);

            $div = create_function('$a,$b', 'return (int) ($a / $b);');

            $gy = $g_y - 1600;
            $gm = $g_m - 1;
            $gd = $g_d - 1;
            $g_day_no = 365 * $gy + $div($gy + 3, 4) - $div($gy + 99, 100) + $div($gy + 399, 400);

            for ($i = 0; $i < $gm; ++$i)
                $g_day_no += $g_days_in_month[$i];
            if ($gm > 1 && (($gy % 4 == 0 && $gy % 100 != 0) || ($gy % 400 == 0)))
            /* leap and after Feb */
                $g_day_no++;
            $g_day_no += $gd;

            $j_day_no = $g_day_no - 79;

            $j_np = $div($j_day_no, 12053); /* 12053 = 365*33 + 32/4 */
            $j_day_no = $j_day_no % 12053;

            $jy = 979 + 33 * $j_np + 4 * $div($j_day_no, 1461); /* 1461 = 365*4 + 4/4 */
            $j_day_no %= 1461;

            if ($j_day_no >= 366) {
                $jy += $div($j_day_no - 1, 365);
                $j_day_no = ($j_day_no - 1) % 365;
            }

            for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i)
                $j_day_no -= $j_days_in_month[$i];
        }
        switch ($i) {
            case 0:
                $jm = "/ 01 /";
                break;
            case 1:
                $jm = "/ 02 /";
                break;
            case 2:
                $jm = "/ 03 /";
                break;
            case 3:
                $jm = "/ 04 /";
                break;
            case 4:
                $jm = "/ 05 /";
                break;
            case 5:
                $jm = "/ 06 /";
                break;
            case 6:
                $jm = "/ 07 /";
                break;
            case 7:
                $jm = "/ 08 /";
                break;
            case 8:
                $jm = "/ 09 /";
                break;
            case 9:
                $jm = "/ 10 /";
                break;
            case 10:
                $jm = "/ 11 /";
                break;
            case 11:
                $jm = "/ 12 /";
                break;
        };
        $jd = $j_day_no + 1;
        switch ($g_w) {
            case "Sat":
                $jw = "&#1588;&#1606;&#1576;&#1607;";
                break;
            case "Sun":
                $jw = "&#1610;&#1603;&#8204;&#1588;&#1606;&#1576;&#1607;";
                break;
            case "Mon":
                $jw = "&#1583;&#1608;&#1588;&#1606;&#1576;&#1607;";
                break;
            case "Tue":
                $jw = "&#1587;&#1607;&#8204;&#1588;&#1606;&#1576;&#1607;";
                break;
            case "Wed":
                $jw = "&#1670;&#1607;&#1575;&#1585;&#1588;&#1606;&#1576;&#1607;";
                break;
            case "Thu":
                $jw = "&#1662;&#1606;&#1580;&#8204;&#1588;&#1606;&#1576;&#1607;";
                break;
            case "Fri":
                $jw = "&#1580;&#1605;&#1593;&#1607;";
                break;
        };

        return "$jw $jd $jm $jy &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$time";
    }

    public function shamsi_select($name, $val = null, $show_time = true, $show_current = true) {

        if ($val == null && $show_current) {

            $val = date("Y-m-d H:i:s");
        }

        $sv = explode(" ", $val);
        $val = $sv[0];




        $time = $sv[1];
        if ($time) {
            $timea = explode(":", $time);
        }




        for ($i = 0; $i <= 23; $i++) {

            if ($i == $timea[0])
                $selected = " selected='selected' ";
            else
                $selected = "";

            $hoursoptions .= "<option " . $selected . "



value='" . $i . "'>" . $i . "</option>";
        }

        for ($i = 0; $i <= 59; $i++) {

            if ($i == $timea[1])
                $selected = " selected='selected' ";
            else
                $selected = "";



            $minutesoptions .= "<option " . $selected . " value='" . $i . "'>" . $i . "</option>";
        }

        if ($val) {
            $sval = explode("-", $val);
            $lastdate = $this->gregorian_to_jalali($sval[0], $sval[1], $sval[2]);
        }


        // months

        $months = array
            (
            "0" => "...",
            1 => "فروردین",
            2 => "اردیبهشت",
            3 => "خرداد",
            4 => "تیر",
            5 => "مرداد",
            6 => "شهریور",
            7 => "مهر",
            8 => "آبان",
            9 => "آذر",
            10 => "دی",
            11 => "بهمن",
            12 => "اسفند"
        );


        foreach ($months as $key => $month) {
            if ($key == $lastdate[1]) {
                $selected = " selected='selected' ";
            }
            else
                $selected = "";

            $monthoptions = $monthoptions . " <option value='" . $key . "' $selected >" . $month . " </option>";
        }

        $yearoptions = "<option value='0'>...</option>";
        for ($year = 1300; $year < 1405; $year++) {
            if ($year == $lastdate[0])
                $selected = " selected='selected' ";
            else
                $selected = "";

            $yearoptions = $yearoptions . " <option value='" . $year . "' $selected >" . $year . " </option>";
        }


        $dayoptions = "<option value='0'>...</option>";
        for ($day = 1; $day < 32; $day++) {
            if ($day == $lastdate[2])
                $selected = " selected='selected' ";
            else
                $selected = "";

            $dayoptions = $dayoptions . " <option value='" . $day . "' $selected >" . $day . " </option>";
        }
        ?> 

        <select id="<?php echo $name ?>day" name="<?php echo $name ?>day"> <?php echo $dayoptions ?></select>
        <select id="<?php echo $name ?>month" name="<?php echo $name ?>month"> <?php echo $monthoptions ?></select>
        <select id="<?php echo $name ?>year" name="<?php echo $name ?>year"><?php echo $yearoptions ?> </select>
        <div style='clear:both'></div>
        <?php if ($show_time) { ?>
            <br />
            <select style='text-align:center' id="<?php echo $name ?>minute" name="<?php echo $name ?>minute" > <?php echo $minutesoptions ?> </select>
            <select style='text-align:center' id="<?php echo $name ?>hour" name="<?php echo $name ?>hour"><?php echo $hoursoptions ?></select>
        <?php } ?>
        <script>
            $('#hour-up').click(function() {
                $('#showhour option:selected').next().prop('selected', true);
            });
            $('#min-up').click(function() {
                $('#showminute option:selected').next().prop('selected', true);
            });
            $('#hour-down').click(function() {
                $('#showhour option:selected').prev().prop('selected', true);
            });
            $('#min-down').click(function() {
                $('#showminute option:selected').prev().prop('selected', true);
            });
        </script>
        <?php
    }

    public function shamsi_get($name) {

        if (!isset($_POST[$name . "year"])) {
            return null;
        }
        $year = $this->params->post($name . "year");
        $month = $this->params->post($name . "month");
        $day = $this->params->post($name . "day");
        $date = $this->jalali_to_gregorian($year, $month, $day);
        foreach ($date as &$d) {
            if (strlen($d) == 1) {
                $d = "0" . $d;
            }
        }

        if (isset($_POST[$name . "hour"])) {
            $hour = $this->params->post($name . "hour");
            $minute = $this->params->post($name . "minute");

            $r = $date[0] . "-" . $date[1] . "-" . $date[2] . " " . $hour . ":" . $minute . ":00";
        } else {

            $r = $date[0] . "-" . $date[1] . "-" . $date[2];
        }

        return $r;
    }

    public function jgmdate($type, $maket = "now") {
        //set 1 if you want translate number to farsi or if you don't like set 0
        $transnumber = 1;
        ///chosse your timezone
        $TZhours = 3;
        $TZminute = 30;
        $need = "";
        $result1 = "";
        $result = "";
        if ($maket == "now") {
            $year = gmdate("Y");
            $month = gmdate("m");
            $day = gmdate("d");
            list( $jyear, $jmonth, $jday ) = $this->gregorian_to_jalali($year, $month, $day);
            $maket = mktime(gmdate("H") + $TZhours, gmdate("i") + $TZminute, gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y"));
        } else {
            //$maket=0;
            $maket+=$TZhours * 3600 + $TZminute * 60;
            $gmdate = gmdate("Y-m-d", $maket);
            list( $year, $month, $day ) = preg_split('/-/', $gmdate);

            list( $jyear, $jmonth, $jday ) = $this->gregorian_to_jalali($year, $month, $day);
        }

        $need = $maket;
        $year = gmdate("Y", $need);
        $month = gmdate("m", $need);
        $day = gmdate("d", $need);
        $i = 0;
        $subtype = "";
        $subtypetemp = "";
        list( $jyear, $jmonth, $jday ) = $this->gregorian_to_jalali($year, $month, $day);
        while ($i < strlen($type)) {
            $subtype = substr($type, $i, 1);
            if ($subtypetemp == "\\") {
                $result.=$subtype;
                $i++;
                continue;
            }

            switch ($subtype) {

                case "A":
                    $result1 = gmdate("a", $need);
                    if ($result1 == "pm")
                        $result.= "&#1576;&#1593;&#1583;&#1575;&#1586;&#1592;&#1607;&#1585;";
                    else
                        $result.="&#1602;&#1576;&#1604;&#8207;&#1575;&#1586;&#1592;&#1607;&#1585;";
                    break;

                case "a":
                    $result1 = gmdate("a", $need);
                    if ($result1 == "pm")
                        $result.= "&#1576;&#46;&#1592;";
                    else
                        $result.="&#1602;&#46;&#1592;";
                    break;
                case "d":
                    if ($jday < 10
                    )
                        $result1 = "0" . $jday;
                    else
                        $result1 = $jday;
                    if ($transnumber == 1)
                        $result.=$this->Convertnumber2farsi($result1);
                    else
                        $result.=$result1;
                    break;
                case "D":
                    $result1 = gmdate("D", $need);
                    if ($result1 == "Thu")
                        $result1 = "&#1662;";
                    else if ($result1 == "Sat")
                        $result1 = "&#1588;";
                    else if ($result1 == "Sun")
                        $result1 = "&#1609;";
                    else if ($result1 == "Mon")
                        $result1 = "&#1583;";
                    else if ($result1 == "Tue")
                        $result1 = "&#1587;";
                    else if ($result1 == "Wed")
                        $result1 = "&#1670;";
                    else if ($result1 == "Thu")
                        $result1 = "&#1662;";
                    else if ($result1 == "Fri")
                        $result1 = "&#1580;";
                    $result.=$result1;
                    break;
                case"F":
                    $result.=$this->monthname($jmonth);
                    break;
                case "g":
                    $result1 = gmdate("g", $need);
                    if ($transnumber == 1)
                        $result.=$this->Convertnumber2farsi($result1);
                    else
                        $result.=$result1;
                    break;
                case "G":
                    $result1 = gmdate("G", $need);
                    if ($transnumber == 1)
                        $result.=$this->Convertnumber2farsi($result1);
                    else
                        $result.=$result1;
                    break;
                case "h":
                    $result1 = gmdate("h", $need);
                    if ($transnumber == 1)
                        $result.=$this->Convertnumber2farsi($result1);
                    else
                        $result.=$result1;
                    break;
                case "H":
                    $result1 = gmdate("H", $need);
                    if ($transnumber == 1)
                        $result.=$this->Convertnumber2farsi($result1);
                    else
                        $result.=$result1;
                    break;
                case "i":
                    $result1 = gmdate("i", $need);
                    if ($transnumber == 1)
                        $result.=$this->Convertnumber2farsi($result1);
                    else
                        $result.=$result1;
                    break;
                case "j":
                    $result1 = $jday;
                    if ($transnumber == 1)
                        $result.=$this->Convertnumber2farsi($result1);
                    else
                        $result.=$result1;
                    break;
                case "l":
                    $result1 = gmdate("l", $need);
                    if ($result1 == "Saturday")
                        $result1 = "&#1588;&#1606;&#1576;&#1607;";
                    else if ($result1 == "Sunday")
                        $result1 = "&#1610;&#1603;&#1588;&#1606;&#1576;&#1607;";
                    else if ($result1 == "Monday")
                        $result1 = "&#1583;&#1608;&#1588;&#1606;&#1576;&#1607;";
                    else if ($result1 == "Tuesday")
                        $result1 = "&#1587;&#1607;&#32;&#1588;&#1606;&#1576;&#1607;";
                    else if ($result1 == "Wednesday")
                        $result1 = "&#1670;&#1607;&#1575;&#1585;&#1588;&#1606;&#1576;&#1607;";
                    else if ($result1 == "Thursday")
                        $result1 = "&#1662;&#1606;&#1580;&#1588;&#1606;&#1576;&#1607;";
                    else if ($result1 == "Friday")
                        $result1 = "&#1580;&#1605;&#1593;&#1607;";
                    $result.=$result1;
                    break;
                case "m":
                    if ($jmonth < 10)
                        $result1 = "0" . $jmonth;
                    else
                        $result1 = $jmonth;
                    if ($transnumber == 1)
                        $result.=$this->Convertnumber2farsi($result1);
                    else
                        $result.=$result1;
                    break;
                case "M":
                    $result.=$this->short_monthname($jmonth);
                    break;
                case "n":
                    $result1 = $jmonth;
                    if ($transnumber == 1)
                        $result.=$this->Convertnumber2farsi($result1);
                    else
                        $result.=$result1;
                    break;
                case "s":
                    $result1 = gmdate("s", $need);
                    if ($transnumber == 1)
                        $result.=$this->Convertnumber2farsi($result1);
                    else
                        $result.=$result1;
                    break;
                case "S":
                    $result.="&#1575;&#1605;";
                    break;
                case "t":
                    $result.=$this->lastday($month, $day, $year);
                    break;
                case "w":
                    $result1 = gmdate("w", $need);
                    if ($transnumber == 1)
                        $result.=$this->Convertnumber2farsi($result1);
                    else
                        $result.=$result1;
                    break;
                case "y":
                    $result1 = substr($jyear, 2, 4);
                    if ($transnumber == 1)
                        $result.=$this->Convertnumber2farsi($result1);
                    else
                        $result.=$result1;
                    break;
                case "Y":
                    $result1 = $jyear;
                    if ($transnumber == 1)
                        $result.=$this->Convertnumber2farsi($result1);
                    else
                        $result.=$result1;
                    break;
                case "U" :
                    $result.=mktime();
                    break;
                case "Z" :
                    $result.=$this->days_of_year($jmonth, $jday, $jyear);
                    break;
                case "L" :
                    list( $tmp_year, $tmp_month, $tmp_day ) = $this->jalali_to_gregorian(1384, 12, 1);
                    echo $tmp_day;
                    /* if(lastday($tmp_month,$tmp_day,$tmp_year)=="31")
                      $result.="1";
                      else
                      $result.="0";
                     */
                    break;
                default:
                    $result.=$subtype;
            }
            $subtypetemp = substr($type, $i, 1);
            $i++;
        }
        return $result;
    }

    public function jmaketime($hour = "", $minute = "", $second = "", $jmonth = "", $jday = "", $jyear = "") {
        if (!$hour && !$minute && !$second && !$jmonth && !$jmonth && !$jday && !$jyear)
            return mktime();
        list( $year, $month, $day ) = jalali_to_gregorian($jyear, $jmonth, $jday);
        $i = mktime($hour, $minute, $second, $month, $day, $year);
        return $i;
    }

///Find num of Day Begining Of Month ( 0 for Sat & 6 for Sun)
    public function mstart($month, $day, $year) {
        list( $jyear, $jmonth, $jday ) = gregorian_to_jalali($year, $month, $day);
        list( $year, $month, $day ) = jalali_to_gregorian($jyear, $jmonth, "1");
        $timestamp = mktime(0, 0, 0, $month, $day, $year);
        return gmdate("w", $timestamp);
    }

//Find Number Of Days In This Month
    public function lastday($month, $day, $year) {
        $jday2 = "";
        $jgmdate2 = "";
        $lastdayen = gmdate("d", mktime(0, 0, 0, $month + 1, 0, $year));
        list( $jyear, $jmonth, $jday ) = $this->gregorian_to_jalali($year, $month, $day);
        $lastgmdatep = $jday;
        $jday = $jday2;
        while ($jday2 != "1") {
            if ($day < $lastdayen) {
                $day++;
                list( $jyear, $jmonth, $jday2 ) = $this->gregorian_to_jalali($year, $month, $day);
                if ($jgmdate2 == "1")
                    break;
                if ($jgmdate2 != "1")
                    $lastgmdatep++;
            }
            else {
                $day = 0;
                $month++;
                if ($month == 13) {
                    $month = "1";
                    $year++;
                }
            }
        }
        return $lastgmdatep - 1;
    }

//Find days in this year untile now
    public function days_of_year($jmonth, $jday, $jyear) {
        $year = "";
        $month = "";
        $year = "";
        $result = "";
        if ($jmonth == "01")
            return $jday;
        for ($i = 1; $i < $jmonth || $i == 12; $i++) {
            list( $year, $month, $day ) = jalali_to_gregorian($jyear, $i, "1");
            $result+=lastday($month, $day, $year);
        }
        return $result + $jday;
    }

//translate number of month to name of month
    public function monthname($month) {

        if ($month == "01")
            return "&#1601;&#1585;&#1608;&#1585;&#1583;&#1610;&#1606;";

        if ($month == "02")
            return "&#1575;&#1585;&#1583;&#1610;&#1576;&#1607;&#1588;&#1578;";

        if ($month == "03")
            return "&#1582;&#1585;&#1583;&#1575;&#1583;";

        if ($month == "04")
            return "&#1578;&#1610;&#1585;";

        if ($month == "05")
            return "&#1605;&#1585;&#1583;&#1575;&#1583;";

        if ($month == "06")
            return "&#1588;&#1607;&#1585;&#1610;&#1608;&#1585;";

        if ($month == "07")
            return "&#1605;&#1607;&#1585;";

        if ($month == "08")
            return "&#1570;&#1576;&#1575;&#1606;";

        if ($month == "09")
            return "&#1570;&#1584;&#1585;";

        if ($month == "10")
            return "&#1583;&#1610;";

        if ($month == "11")
            return "&#1576;&#1607;&#1605;&#1606;";

        if ($month == "12")
            return "&#1575;&#1587;&#1601;&#1606;&#1583;";
    }

    public function short_monthname($month) {

        if ($month == "01")
            return "&#1601;&#1585;&#1608;";

        if ($month == "02")
            return "&#1575;&#1585;&#1583;";

        if ($month == "03")
            return "&#1582;&#1585;&#1583;";

        if ($month == "04")
            return "&#1578;&#1610;&#1585;";

        if ($month == "05")
            return "&#1605;&#1585;&#1583;";

        if ($month == "06")
            return "&#1588;&#1607;&#1585;";

        if ($month == "07")
            return "&#1605;&#1607;&#1585;";

        if ($month == "08")
            return "&#1570;&#1576;&#1575;";

        if ($month == "09")
            return "&#1570;&#1584;&#1585;";

        if ($month == "10")
            return "&#1583;&#1610;";

        if ($month == "11")
            return "&#1576;&#1607;&#1605;";

        if ($month == "12")
            return "&#1575;&#1587;&#1601; ";
    }

////here convert to  number in persian
    public function Convertnumber2farsi($srting) {
        $num0 = "&#1776;";
        $num1 = "&#1777;";
        $num2 = "&#1778;";
        $num3 = "&#1779;";
        $num4 = "&#1780;";
        $num5 = "&#1781;";
        $num6 = "&#1782;";
        $num7 = "&#1783;";
        $num8 = "&#1784;";
        $num9 = "&#1785;";

        $stringtemp = "";
        $len = strlen($srting);
        for ($sub = 0; $sub < $len; $sub++) {
            if (substr($srting, $sub, 1) == "0"
            )
                $stringtemp.=$num0;
            elseif (substr($srting, $sub, 1) == "1"
            )
                $stringtemp.=$num1;
            elseif (substr($srting, $sub, 1) == "2"
            )
                $stringtemp.=$num2;
            elseif (substr($srting, $sub, 1) == "3"
            )
                $stringtemp.=$num3;
            elseif (substr($srting, $sub, 1) == "4"
            )
                $stringtemp.=$num4;
            elseif (substr($srting, $sub, 1) == "5"
            )
                $stringtemp.=$num5;
            elseif (substr($srting, $sub, 1) == "6"
            )
                $stringtemp.=$num6;
            elseif (substr($srting, $sub, 1) == "7"
            )
                $stringtemp.=$num7;
            elseif (substr($srting, $sub, 1) == "8"
            )
                $stringtemp.=$num8;
            elseif (substr($srting, $sub, 1) == "9"
            )
                $stringtemp.=$num9;
            else
                $stringtemp.=substr($srting, $sub, 1);
        }
        return $stringtemp;
    }

///end conver to number in persian

    public function is_kabise($year) {
        if ($year % 4 == 0 && $year % 100 != 0)
            return true;
        return false;
    }

    public function jcheckgmdate($month, $day, $year) {
        $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);
        if ($month <= 12 && $month > 0) {
            if ($j_days_in_month[$month - 1] >= $day && $day > 0)
                return 1;
            if (is_kabise($year))
                echo "Asdsd";
            if (is_kabise($year) && $j_days_in_month[$month - 1] == 31)
                return 1;
        }

        return 0;
    }

    public function jtime() {
        return mktime();
    }

    public function jgetgmdate($timestamp = "") {
        if ($timestamp == "")
            $timestamp = mktime();

        return array(
            0 => $timestamp,
            "seconds" => $this->jgmdate("s", $timestamp),
            "minutes" => $this->jgmdate("i", $timestamp),
            "hours" => $this->jgmdate("G", $timestamp),
            "mday" => $this->jgmdate("j", $timestamp),
            "wday" => $this->jgmdate("w", $timestamp),
            "mon" => $this->jgmdate("n", $timestamp),
            "year" => $this->jgmdate("Y", $timestamp),
            "yday" => $this->days_of_year($this->jgmdate("m", $timestamp), $this->jgmdate("d", $timestamp), $this->jgmdate("Y", $timestamp)),
            "weekday" => $this->jgmdate("l", $timestamp),
            "month" => $this->jgmdate("F", $timestamp),
        );
    }

// "jalali.php" is convertor to and from Gregorian and Jalali calendars.
// Copyright (C) 2000  Roozbeh Pournader and Mohammad Toossi
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// A copy of the GNU General Public License is available from:
//
//    <a href="http://www.gnu.org/copyleft/gpl.html" target="_blank">http://www.gnu.org/copyleft/gpl.html</a>
//


    public function div($a, $b) {
        return (int) ($a / $b);
    }

    public function gregorian_to_jalali($g_y, $g_m, $g_d) {
        $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);





        $gy = $g_y - 1600;
        $gm = $g_m - 1;
        $gd = $g_d - 1;

        $g_day_no = 365 * $gy + $this->div($gy + 3, 4) - $this->div($gy + 99, 100) + $this->div($gy + 399, 400);

        for ($i = 0; $i < $gm; ++$i)
            $g_day_no += $g_days_in_month[$i];
        if ($gm > 1 && (($gy % 4 == 0 && $gy % 100 != 0) || ($gy % 400 == 0)))
        /* leap and after Feb */
            $g_day_no++;
        $g_day_no += $gd;

        $j_day_no = $g_day_no - 79;

        $j_np = $this->div($j_day_no, 12053); /* 12053 = 365*33 + 32/4 */
        $j_day_no = $j_day_no % 12053;

        $jy = 979 + 33 * $j_np + 4 * $this->div($j_day_no, 1461); /* 1461 = 365*4 + 4/4 */

        $j_day_no %= 1461;

        if ($j_day_no >= 366) {
            $jy += $this->div($j_day_no - 1, 365);
            $j_day_no = ($j_day_no - 1) % 365;
        }

        for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i)
            $j_day_no -= $j_days_in_month[$i];
        $jm = $i + 1;
        $jd = $j_day_no + 1;

        return array($jy, $jm, $jd);
    }

    public function jalali_to_gregorian($j_y, $j_m, $j_d) {
        $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);



        $jy = $j_y - 979;
        $jm = $j_m - 1;
        $jd = $j_d - 1;

        $j_day_no = 365 * $jy + $this->div($jy, 33) * 8 + $this->div($jy % 33 + 3, 4);
        for ($i = 0; $i < $jm; ++$i)
            $j_day_no += $j_days_in_month[$i];

        $j_day_no += $jd;

        $g_day_no = $j_day_no + 79;

        $gy = 1600 + 400 * $this->div($g_day_no, 146097); /* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */
        $g_day_no = $g_day_no % 146097;

        $leap = true;
        if ($g_day_no >= 36525) /* 36525 = 365*100 + 100/4 */ {
            $g_day_no--;
            $gy += 100 * $this->div($g_day_no, 36524); /* 36524 = 365*100 + 100/4 - 100/100 */
            $g_day_no = $g_day_no % 36524;

            if ($g_day_no >= 365)
                $g_day_no++;
            else
                $leap = false;
        }

        $gy += 4 * $this->div($g_day_no, 1461); /* 1461 = 365*4 + 4/4 */
        $g_day_no %= 1461;

        if ($g_day_no >= 366) {
            $leap = false;

            $g_day_no--;
            $gy += $this->div($g_day_no, 365);
            $g_day_no = $g_day_no % 365;
        }

        for ($i = 0; $g_day_no >= $g_days_in_month[$i] + ($i == 1 && $leap); $i++)
            $g_day_no -= $g_days_in_month[$i] + ($i == 1 && $leap);
        $gm = $i + 1;
        $gd = $g_day_no + 1;

        return array($gy, $gm, $gd);
    }

    // ##################### hijri date #######################################################################

    function intPart($floatNum) {
        if ($floatNum < -0.0000001) {
            return ceil($floatNum - 0.0000001);
        }
        return floor($floatNum + 0.0000001);
    }

    function ConstractDayMonthYear($date, $format) { // extract day, month, year out of the date based on the format.
        $this->Day = "";
        $this->Month = "";
        $this->Year = "";

        $format = strtoupper($format);
        $format_Ar = str_split($format);
        $srcDate_Ar = str_split($date);

        for ($i = 0; $i < count($format_Ar); $i++) {

            switch ($format_Ar[$i]) {
                case "D":
                    $this->Day.=$srcDate_Ar[$i];
                    break;
                case "M":
                    $this->Month.=$srcDate_Ar[$i];
                    break;
                case "Y":
                    $this->Year.=$srcDate_Ar[$i];
                    break;
            }
        }
    }

    function HijriToGregorian($date, $format) { // $date like 10121400, $format like DDMMYYYY, take date & check if its hijri then convert to gregorian date in format (DD-MM-YYYY), if it gregorian the return empty;
        $this->ConstractDayMonthYear($date, $format);
        $d = intval($this->Day);
        $m = intval($this->Month);
        $y = intval($this->Year);

        if ($y < 1700) {

            $jd = $this->intPart((11 * $y + 3) / 30) + 354 * $y + 30 * $m - $this->intPart(($m - 1) / 2) + $d + 1948440 - 385;

            if ($jd > 2299160) {
                $l = $jd + 68569;
                $n = $this->intPart((4 * $l) / 146097);
                $l = $l - $this->intPart((146097 * $n + 3) / 4);
                $i = $this->intPart((4000 * ($l + 1)) / 1461001);
                $l = $l - $this->intPart((1461 * $i) / 4) + 31;
                $j = $this->intPart((80 * $l) / 2447);
                $d = $l - $this->intPart((2447 * $j) / 80);
                $l = $this->intPart($j / 11);
                $m = $j + 2 - 12 * $l;
                $y = 100 * ($n - 49) + $i + $l;
            } else {
                $j = $jd + 1402;
                $k = $this->intPart(($j - 1) / 1461);
                $l = $j - 1461 * $k;
                $n = $this->intPart(($l - 1) / 365) - $this->intPart($l / 1461);
                $i = $l - 365 * $n + 30;
                $j = $this->intPart((80 * $i) / 2447);
                $d = $i - $this->intPart((2447 * $j) / 80);
                $i = $this->intPart($j / 11);
                $m = $j + 2 - 12 * $i;
                $y = 4 * $k + $n + $i - 4716;
            }

            if ($d < 10)
                $d = "0" . $d;

            if ($m < 10)
                $m = "0" . $m;

            return $d . "-" . $m . "-" . $y;
        }
        else
            return "";
    }

    function GregorianToHijri($date, $format) { // $date like 10122011, $format like DDMMYYYY, take date & check if its gregorian then convert to hijri date in format (DD-MM-YYYY), if it hijri the return empty;
        $this->ConstractDayMonthYear($date, $format);
        $d = intval($this->Day);
        $m = intval($this->Month);
        $y = intval($this->Year);

        if ($y > 1700) {
            if (($y > 1582) || (($y == 1582) && ($m > 10)) || (($y == 1582) && ($m == 10) && ($d > 14))) {
                $jd = $this->intPart((1461 * ($y + 4800 + $this->intPart(($m - 14) / 12))) / 4) + $this->intPart((367 * ($m - 2 - 12 * ($this->intPart(($m - 14) / 12)))) / 12) - $this->intPart((3 * ($this->intPart(($y + 4900 + $this->intPart(($m - 14) / 12)) / 100))) / 4) + $d - 32075;
            } else {
                $jd = 367 * $y - $this->intPart((7 * ($y + 5001 + $this->intPart(($m - 9) / 7))) / 4) + $this->intPart((275 * $m) / 9) + $d + 1729777;
            }

            $l = $jd - 1948440 + 10632;
            $n = $this->intPart(($l - 1) / 10631);
            $l = $l - 10631 * $n + 354;
            $j = ($this->intPart((10985 - $l) / 5316)) * ($this->intPart((50 * $l) / 17719)) + ($this->intPart($l / 5670)) * ($this->intPart((43 * $l) / 15238));
            $l = $l - ($this->intPart((30 - $j) / 15)) * ($this->intPart((17719 * $j) / 50)) - ($this->intPart($j / 16)) * ($this->intPart((15238 * $j) / 43)) + 29;
            $m = $this->intPart((24 * $l) / 709);
            $d = $l - $this->intPart((709 * $m) / 24);
            $y = 30 * $n + $j - 30;

            if ($d < 10)
                $d = "0" . $d;

            if ($m < 10)
                $m = "0" . $m;

            return $d . "-" . $m . "-" . $y;
        }
        else
            return "";
    }

    public function getDuration($date1, $date2) {
        $months = round((strtotime($date1) - strtotime($date2)) / (60 * 60 * 24 * 30));

        if ($months >= 12) {
            return round($months / 12) . " سال";
        }

        if ($months > 0) {
            return $months . " ماه";
        }

        $days = (int) abs((strtotime($date1) - strtotime($date2)) / (60 * 60 * 24));
        if ($days > 0) {
            return round($days) . " روز";
        }
        return "چند ساعت";
    }

}
?>
