<?php

//ini_set('log_errors', 0);
//ini_set('html_errors', 0);

//-------------------------------------------------------------------------------------------------------------
//include( 'jdf.php' );
/* In the name of Allah = بسم اللّه الرّحمن الرّحیم */

/**
 * @فارسی : توابع زمان و تاریخ هجری شمسی (جلالی) در پی اچ پی
 * @name: Hijri_Shamsi,Solar(Jalali) Date and Time Functions
 * @Author : Reza Gholampanahi & WebSite : http://jdf.scr.ir
 * @License: GNU/LGPL _ Open Source & Free : [all functions]
 * @Version: 2.70 =>[ 1395/11/22 = 1438/05/12 = 2017/02/10 ]
 */

//-----------------------------------------------------------------------------------



class HijriDate{
    private $hijri;
    public function __construct( $time = false ){
        if(!$time) $time = time();
        $this->hijri = $this->GregorianToHijri($time);
    }
    public function get_date(){
        return $this->hijri[1] . ' ' . $this->get_month_name($this->hijri[0]) . ' ' . $this->hijri[2];
    }
    public function get_day(){
        return $this->hijri[1];
    }
    public function get_month(){
        return $this->hijri[0];
    }
    public function get_year(){
        return $this->hijri[2];
    }
    
    public function get_month_name($i){
        static $month  = array(
            "محرم", "صفر", "ربیع‌الاول", "ربیع‌الاخر",
            "جمادی‌الاول", "جمادی‌الاخر", "رجب", "شعبان",
            "رمضان", "شوال", "ذی‌القعده", "ذی‌الحجه"
        );
        return $month[$i-1];
    }
    private function GregorianToHijri($time = null){
        if ($time === null) $time = time();
        $m = date('m', $time);
        $d = date('d', $time);
        $y = date('Y', $time);
        return $this->JDToHijri(cal_to_jd(CAL_GREGORIAN, $m, $d, $y));
    }
    private function HijriToGregorian($m, $d, $y){
        return jd_to_cal(CAL_GREGORIAN, $this->HijriToJD($m, $d, $y));
    }
    # Julian Day Count To Hijri
    private function JDToHijri($jd){
        $jd = $jd - 1948440 + 10632;
        $n  = (int)(($jd - 1) / 10631);
        $jd = $jd - 10631 * $n + 354;
        $j  = ((int)((10985 - $jd) / 5316)) *
            ((int)(50 * $jd / 17719)) +
            ((int)($jd / 5670)) *
            ((int)(43 * $jd / 15238));
        $jd = $jd - ((int)((30 - $j) / 15)) *
            ((int)((17719 * $j) / 50)) -
            ((int)($j / 16)) *
            ((int)((15238 * $j) / 43)) + 29;
        $m  = (int)(24 * $jd / 709);
        $d  = $jd - (int)(709 * $m / 24);
        $y  = 30*$n + $j - 30;
        return array($m, $d, $y);
    }
    # Hijri To Julian Day Count
    private function HijriToJD($m, $d, $y){
        return (int)((11 * $y + 3) / 30) +
            354 * $y + 30 * $m -
            (int)(($m - 1) / 2) + $d + 1948440 - 385;
    }
}


//------------------------------------------------------------------------------------



/*	F	*/
function jdate($format,$timestamp='',$none='',$time_zone='Asia/Tehran',$tr_num='fa'){

 $T_sec=0;/* <= رفع خطاي زمان سرور ، با اعداد '+' و '-' بر حسب ثانيه */

 if($time_zone!='local')date_default_timezone_set(($time_zone==='')?'Asia/Tehran':$time_zone);
 $ts=$T_sec+(($timestamp==='')?time():tr_num($timestamp));
 $date=explode('_',date('H_i_j_n_O_P_s_w_Y',$ts));
 list($j_y,$j_m,$j_d)=gregorian_to_jalali($date[8],$date[3],$date[2]);
 $doy=($j_m<7)?(($j_m-1)*31)+$j_d-1:(($j_m-7)*30)+$j_d+185;
 $kab=(((($j_y%33)%4)-1)==((int)(($j_y%33)*0.05)))?1:0;
 $sl=strlen($format);
 $out='';
 for($i=0; $i<$sl; $i++){
  $sub=substr($format,$i,1);
  if($sub=='\\'){
	$out.=substr($format,++$i,1);
	continue;
  }
  switch($sub){

	case'E':case'R':case'x':case'X':
	$out.='http://jdf.scr.ir';
	break;

	case'B':case'e':case'g':
	case'G':case'h':case'I':
	case'T':case'u':case'Z':
	$out.=date($sub,$ts);
	break;

	case'a':
	$out.=($date[0]<12)?'ق.ظ':'ب.ظ';
	break;

	case'A':
	$out.=($date[0]<12)?'قبل از ظهر':'بعد از ظهر';
	break;

	case'b':
	$out.=(int)($j_m/3.1)+1;
	break;

	case'c':
	$out.=$j_y.'/'.$j_m.'/'.$j_d.' ،'.$date[0].':'.$date[1].':'.$date[6].' '.$date[5];
	break;

	case'C':
	$out.=(int)(($j_y+99)/100);
	break;

	case'd':
	$out.=($j_d<10)?'0'.$j_d:$j_d;
	break;

	case'D':
	$out.=jdate_words(array('kh'=>$date[7]),' ');
	break;

	case'f':
	$out.=jdate_words(array('ff'=>$j_m),' ');
	break;

	case'F':
	$out.=jdate_words(array('mm'=>$j_m),' ');
	break;

	case'H':
	$out.=$date[0];
	break;

	case'i':
	$out.=$date[1];
	break;

	case'j':
	$out.=$j_d;
	break;

	case'J':
	$out.=jdate_words(array('rr'=>$j_d),' ');
	break;

	case'k';
	$out.=tr_num(100-(int)($doy/($kab+365)*1000)/10,$tr_num);
	break;

	case'K':
	$out.=tr_num((int)($doy/($kab+365)*1000)/10,$tr_num);
	break;

	case'l':
	$out.=jdate_words(array('rh'=>$date[7]),' ');
	break;

	case'L':
	$out.=$kab;
	break;

	case'm':
	$out.=($j_m>9)?$j_m:'0'.$j_m;
	break;

	case'M':
	$out.=jdate_words(array('km'=>$j_m),' ');
	break;

	case'n':
	$out.=$j_m;
	break;

	case'N':
	$out.=$date[7]+1;
	break;

	case'o':
	$jdw=($date[7]==6)?0:$date[7]+1;
	$dny=364+$kab-$doy;
	$out.=($jdw>($doy+3) and $doy<3)?$j_y-1:(((3-$dny)>$jdw and $dny<3)?$j_y+1:$j_y);
	break;

	case'O':
	$out.=$date[4];
	break;

	case'p':
	$out.=jdate_words(array('mb'=>$j_m),' ');
	break;

	case'P':
	$out.=$date[5];
	break;

	case'q':
	$out.=jdate_words(array('sh'=>$j_y),' ');
	break;

	case'Q':
	$out.=$kab+364-$doy;
	break;

	case'r':
	$key=jdate_words(array('rh'=>$date[7],'mm'=>$j_m));
	$out.=$date[0].':'.$date[1].':'.$date[6].' '.$date[4].' '.$key['rh'].'، '.$j_d.' '.$key['mm'].' '.$j_y;
	break;

	case's':
	$out.=$date[6];
	break;

	case'S':
	$out.='ام';
	break;

	case't':
	$out.=($j_m!=12)?(31-(int)($j_m/6.5)):($kab+29);
	break;

	case'U':
	$out.=$ts;
	break;

	case'v':
	 $out.=jdate_words(array('ss'=>($j_y%100)),' ');
	break;

	case'V':
	$out.=jdate_words(array('ss'=>$j_y),' ');
	break;

	case'w':
	$out.=($date[7]==6)?0:$date[7]+1;
	break;

	case'W':
	$avs=(($date[7]==6)?0:$date[7]+1)-($doy%7);
	if($avs<0)$avs+=7;
	$num=(int)(($doy+$avs)/7);
	if($avs<4){
	 $num++;
	}elseif($num<1){
	 $num=($avs==4 or $avs==((((($j_y%33)%4)-2)==((int)(($j_y%33)*0.05)))?5:4))?53:52;
	}
	$aks=$avs+$kab;
	if($aks==7)$aks=0;
	$out.=(($kab+363-$doy)<$aks and $aks<3)?'01':(($num<10)?'0'.$num:$num);
	break;

	case'y':
	$out.=substr($j_y,2,2);
	break;

	case'Y':
	$out.=$j_y;
	break;

	case'z':
	$out.=$doy;
	break;

	default:$out.=$sub;
  }
 }
 return($tr_num!='en')?tr_num($out,'fa','.'):$out;
}

/*	F	*/
function jstrftime($format,$timestamp='',$none='',$time_zone='Asia/Tehran',$tr_num='fa'){

 $T_sec=0;/* <= رفع خطاي زمان سرور ، با اعداد '+' و '-' بر حسب ثانيه */

 if($time_zone!='local')date_default_timezone_set(($time_zone==='')?'Asia/Tehran':$time_zone);
 $ts=$T_sec+(($timestamp==='')?time():tr_num($timestamp));
 $date=explode('_',date('h_H_i_j_n_s_w_Y',$ts));
 list($j_y,$j_m,$j_d)=gregorian_to_jalali($date[7],$date[4],$date[3]);
 $doy=($j_m<7)?(($j_m-1)*31)+$j_d-1:(($j_m-7)*30)+$j_d+185;
 $kab=(((($j_y%33)%4)-1)==((int)(($j_y%33)*0.05)))?1:0;
 $sl=strlen($format);
 $out='';
 for($i=0; $i<$sl; $i++){
  $sub=substr($format,$i,1);
  if($sub=='%'){
	$sub=substr($format,++$i,1);
  }else{
	$out.=$sub;
	continue;
  }
  switch($sub){

	/* Day */
	case'a':
	$out.=jdate_words(array('kh'=>$date[6]),' ');
	break;

	case'A':
	$out.=jdate_words(array('rh'=>$date[6]),' ');
	break;

	case'd':
	$out.=($j_d<10)?'0'.$j_d:$j_d;
	break;

	case'e':
	$out.=($j_d<10)?' '.$j_d:$j_d;
	break;

	case'j':
	$out.=str_pad($doy+1,3,0,STR_PAD_LEFT);
	break;

	case'u':
	$out.=$date[6]+1;
	break;

	case'w':
	$out.=($date[6]==6)?0:$date[6]+1;
	break;

	/* Week */
	case'U':
	$avs=(($date[6]<5)?$date[6]+2:$date[6]-5)-($doy%7);
	if($avs<0)$avs+=7;
	$num=(int)(($doy+$avs)/7)+1;
	if($avs>3 or $avs==1)$num--;
	$out.=($num<10)?'0'.$num:$num;
	break;

	case'V':
	$avs=(($date[6]==6)?0:$date[6]+1)-($doy%7);
	if($avs<0)$avs+=7;
	$num=(int)(($doy+$avs)/7);
	if($avs<4){
	 $num++;
	}elseif($num<1){
	 $num=($avs==4 or $avs==((((($j_y%33)%4)-2)==((int)(($j_y%33)*0.05)))?5:4))?53:52;
	}
	$aks=$avs+$kab;
	if($aks==7)$aks=0;
	$out.=(($kab+363-$doy)<$aks and $aks<3)?'01':(($num<10)?'0'.$num:$num);
	break;

	case'W':
	$avs=(($date[6]==6)?0:$date[6]+1)-($doy%7);
	if($avs<0)$avs+=7;
	$num=(int)(($doy+$avs)/7)+1;
	if($avs>3)$num--;
	$out.=($num<10)?'0'.$num:$num;
	break;

	/* Month */
	case'b':
	case'h':
	$out.=jdate_words(array('km'=>$j_m),' ');
	break;

	case'B':
	$out.=jdate_words(array('mm'=>$j_m),' ');
	break;

	case'm':
	$out.=($j_m>9)?$j_m:'0'.$j_m;
	break;

	/* Year */
	case'C':
	$tmp=(int)($j_y/100);
	$out.=($tmp>9)?$tmp:'0'.$tmp;
	break;

	case'g':
	$jdw=($date[6]==6)?0:$date[6]+1;
	$dny=364+$kab-$doy;
	$out.=substr(($jdw>($doy+3) and $doy<3)?$j_y-1:(((3-$dny)>$jdw and $dny<3)?$j_y+1:$j_y),2,2);
	break;

	case'G':
	$jdw=($date[6]==6)?0:$date[6]+1;
	$dny=364+$kab-$doy;
	$out.=($jdw>($doy+3) and $doy<3)?$j_y-1:(((3-$dny)>$jdw and $dny<3)?$j_y+1:$j_y);
	break;

	case'y':
	$out.=substr($j_y,2,2);
	break;

	case'Y':
	$out.=$j_y;
	break;

	/* Time */
	case'H':
	$out.=$date[1];
	break;

	case'I':
	$out.=$date[0];
	break;

	case'l':
	$out.=($date[0]>9)?$date[0]:' '.(int)$date[0];
	break;

	case'M':
	$out.=$date[2];
	break;

	case'p':
	$out.=($date[1]<12)?'قبل از ظهر':'بعد از ظهر';
	break;

	case'P':
	$out.=($date[1]<12)?'ق.ظ':'ب.ظ';
	break;

	case'r':
	$out.=$date[0].':'.$date[2].':'.$date[5].' '.(($date[1]<12)?'قبل از ظهر':'بعد از ظهر');
	break;

	case'R':
	$out.=$date[1].':'.$date[2];
	break;

	case'S':
	$out.=$date[5];
	break;

	case'T':
	$out.=$date[1].':'.$date[2].':'.$date[5];
	break;

	case'X':
	$out.=$date[0].':'.$date[2].':'.$date[5];
	break;

	case'z':
	$out.=date('O',$ts);
	break;

	case'Z':
	$out.=date('T',$ts);
	break;

	/* Time and Date Stamps */
	case'c':
	$key=jdate_words(array('rh'=>$date[6],'mm'=>$j_m));
	$out.=$date[1].':'.$date[2].':'.$date[5].' '.date('P',$ts).' '.$key['rh'].'، '.$j_d.' '.$key['mm'].' '.$j_y;
	break;

	case'D':
	$out.=substr($j_y,2,2).'/'.(($j_m>9)?$j_m:'0'.$j_m).'/'.(($j_d<10)?'0'.$j_d:$j_d);
	break;

	case'F':
	$out.=$j_y.'-'.(($j_m>9)?$j_m:'0'.$j_m).'-'.(($j_d<10)?'0'.$j_d:$j_d);
	break;

	case's':
	$out.=$ts;
	break;

	case'x':
	$out.=substr($j_y,2,2).'/'.(($j_m>9)?$j_m:'0'.$j_m).'/'.(($j_d<10)?'0'.$j_d:$j_d);
	break;

	/* Miscellaneous */
	case'n':
	$out.="\n";
	break;

	case't':
	$out.="\t";
	break;

	case'%':
	$out.='%';
	break;

	default:$out.=$sub;
  }
 }
 return($tr_num!='en')?tr_num($out,'fa','.'):$out;
}

/*	F	*/
function jmktime($h='',$m='',$s='',$jm='',$jd='',$jy='',$none='',$timezone='Asia/Tehran'){
 if($timezone!='local')date_default_timezone_set($timezone);
 if($h===''){
  return time();
 }else{
    list($h,$m,$s,$jm,$jd,$jy)=explode('_',tr_num($h.'_'.$m.'_'.$s.'_'.$jm.'_'.$jd.'_'.$jy));
  if($m===''){
   return mktime($h);
  }else{
   if($s===''){
    return mktime($h,$m);
   }else{
    if($jm===''){
     return mktime($h,$m,$s);
    }else{
     $jdate=explode('_',jdate('Y_j','','',$timezone,'en'));
     if($jd===''){
      list($gy,$gm,$gd)=jalali_to_gregorian($jdate[0],$jm,$jdate[1]);
      return mktime($h,$m,$s,$gm);
     }else{
      if($jy===''){
       list($gy,$gm,$gd)=jalali_to_gregorian($jdate[0],$jm,$jd);
       return mktime($h,$m,$s,$gm,$gd);
      }else{
       list($gy,$gm,$gd)=jalali_to_gregorian($jy,$jm,$jd);
       return mktime($h,$m,$s,$gm,$gd,$gy);
      }
     }
    }
   }
  }
 }
}

/*	F	*/
function jgetdate($timestamp='',$none='',$timezone='Asia/Tehran',$tn='en'){
 $ts=($timestamp==='')?time():tr_num($timestamp);
 $jdate=explode('_',jdate('F_G_i_j_l_n_s_w_Y_z',$ts,'',$timezone,$tn));
 return array(
	'seconds'=>tr_num((int)tr_num($jdate[6]),$tn),
	'minutes'=>tr_num((int)tr_num($jdate[2]),$tn),
	'hours'=>$jdate[1],
	'mday'=>$jdate[3],
	'wday'=>$jdate[7],
	'mon'=>$jdate[5],
	'year'=>$jdate[8],
	'yday'=>$jdate[9],
	'weekday'=>$jdate[4],
	'month'=>$jdate[0],
	0=>tr_num($ts,$tn)
 );
}

/*	F	*/
function jcheckdate($jm,$jd,$jy){
 list($jm,$jd,$jy)=explode('_',tr_num($jm.'_'.$jd.'_'.$jy));
 $l_d=($jm==12)?((((($jy%33)%4)-1)==((int)(($jy%33)*0.05)))?30:29):31-(int)($jm/6.5);
 return($jm>12 or $jd>$l_d or $jm<1 or $jd<1 or $jy<1)?false:true;
}

/*	F	*/
function tr_num($str,$mod='en',$mf='٫'){
 $num_a=array('0','1','2','3','4','5','6','7','8','9','.');
 $key_a=array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹',$mf);
 return($mod=='fa')?str_replace($num_a,$key_a,$str):str_replace($key_a,$num_a,$str);
}

/*	F	*/
function jdate_words($array,$mod=''){
 foreach($array as $type=>$num){
  $num=(int)tr_num($num);
  switch($type){

	case'ss':
	$sl=strlen($num);
	$xy3=substr($num,2-$sl,1);
	$h3=$h34=$h4='';
	if($xy3==1){
	 $p34='';
	 $k34=array('ده','یازده','دوازده','سیزده','چهارده','پانزده','شانزده','هفده','هجده','نوزده');
	 $h34=$k34[substr($num,2-$sl,2)-10];
	}else{
	 $xy4=substr($num,3-$sl,1);
	 $p34=($xy3==0 or $xy4==0)?'':' و ';
	 $k3=array('','','بیست','سی','چهل','پنجاه','شصت','هفتاد','هشتاد','نود');
	 $h3=$k3[$xy3];
	 $k4=array('','یک','دو','سه','چهار','پنج','شش','هفت','هشت','نه');
	 $h4=$k4[$xy4];
	}
	$array[$type]=(($num>99)?str_replace(array('12','13','14','19','20')
 ,array('هزار و دویست','هزار و سیصد','هزار و چهارصد','هزار و نهصد','دوهزار')
 ,substr($num,0,2)).((substr($num,2,2)=='00')?'':' و '):'').$h3.$p34.$h34.$h4;
	break;

	case'mm':
	$key=array('فروردین','اردیبهشت','خرداد','تیر','مرداد','شهریور','مهر','آبان','آذر','دی','بهمن','اسفند');
	$array[$type]=$key[$num-1];
	break;

	case'rr':
	$key=array('یک','دو','سه','چهار','پنج','شش','هفت','هشت','نه','ده','یازده','دوازده','سیزده'
 ,'چهارده','پانزده','شانزده','هفده','هجده','نوزده','بیست','بیست و یک','بیست و دو','بیست و سه'
 ,'بیست و چهار','بیست و پنج','بیست و شش','بیست و هفت','بیست و هشت','بیست و نه','سی','سی و یک');
	$array[$type]=$key[$num-1];
	break;

	case'rh':
	$key=array('یکشنبه','دوشنبه','سه شنبه','چهارشنبه','پنجشنبه','جمعه','شنبه');
	$array[$type]=$key[$num];
	break;

	case'sh':
	$key=array('مار','اسب','گوسفند','میمون','مرغ','سگ','خوک','موش','گاو','پلنگ','خرگوش','نهنگ');
	$array[$type]=$key[$num%12];
	break;

	case'mb':
	$key=array('حمل','ثور','جوزا','سرطان','اسد','سنبله','میزان','عقرب','قوس','جدی','دلو','حوت');
	$array[$type]=$key[$num-1];
	break;

	case'ff':
	$key=array('بهار','تابستان','پاییز','زمستان');
	$array[$type]=$key[(int)($num/3.1)];
	break;

	case'km':
	$key=array('فر','ار','خر','تی‍','مر','شه‍','مه‍','آب‍','آذ','دی','به‍','اس‍');
	$array[$type]=$key[$num-1];
	break;

	case'kh':
	$key=array('ی','د','س','چ','پ','ج','ش');
	$array[$type]=$key[$num];
	break;

	default:$array[$type]=$num;
  }
 }
 return($mod==='')?$array:implode($mod,$array);
}


/** Gregorian & Jalali (Hijri_Shamsi,Solar) date converter Functions
Author: JDF.SCR.IR =>> Download Full Version : http://jdf.scr.ir/jdf
License: GNU/LGPL _ Open Source & Free _ Version: 2.70 : [2017=1395]
--------------------------------------------------------------------
1461 = 365*4 + 4/4   &  146097 = 365*400 + 400/4 - 400/100 + 400/400
12053 = 365*33 + 32/4    &    36524 = 365*100 + 100/4 - 100/100   */

/*	F	*/
function gregorian_to_jalali($gy,$gm,$gd,$mod=''){
	list($gy,$gm,$gd)=explode('_',tr_num($gy.'_'.$gm.'_'.$gd));/* <= Extra :اين سطر ، جزء تابع اصلي نيست */
 $g_d_m=array(0,31,59,90,120,151,181,212,243,273,304,334);
 if($gy > 1600){
  $jy=979;
  $gy-=1600;
 }else{
  $jy=0;
  $gy-=621;
 }
 $gy2=($gm > 2)?($gy+1):$gy;
 $days=(365*$gy) +((int)(($gy2+3)/4)) -((int)(($gy2+99)/100)) +((int)(($gy2+399)/400)) -80 +$gd +$g_d_m[$gm-1];
 $jy+=33*((int)($days/12053));
 $days%=12053;
 $jy+=4*((int)($days/1461));
 $days%=1461;
 $jy+=(int)(($days-1)/365);
 if($days > 365)$days=($days-1)%365;
 if($days < 186){
  $jm=1+(int)($days/31);
  $jd=1+($days%31);
 }else{
  $jm=7+(int)(($days-186)/30);
  $jd=1+(($days-186)%30);
 }
 return($mod==='')?array($jy,$jm,$jd):$jy .$mod .$jm .$mod .$jd;
}

/*	F	*/
function jalali_to_gregorian($jy,$jm,$jd,$mod=''){
	list($jy,$jm,$jd)=explode('_',tr_num($jy.'_'.$jm.'_'.$jd));/* <= Extra :اين سطر ، جزء تابع اصلي نيست */
 if($jy > 979){
  $gy=1600;
  $jy-=979;
 }else{
  $gy=621;
 }
 $days=(365*$jy) +(((int)($jy/33))*8) +((int)((($jy%33)+3)/4)) +78 +$jd +(($jm<7)?($jm-1)*31:(($jm-7)*30)+186);
 $gy+=400*((int)($days/146097));
 $days%=146097;
 if($days > 36524){
  $gy+=100*((int)(--$days/36524));
  $days%=36524;
  if($days >= 365)$days++;
 }
 $gy+=4*((int)(($days)/1461));
 $days%=1461;
 $gy+=(int)(($days-1)/365);
 if($days > 365)$days=($days-1)%365;
 $gd=$days+1;
 foreach(array(0,31,((($gy%4==0) and ($gy%100!=0)) or ($gy%400==0))?29:28 ,31,30,31,30,31,31,30,31,30,31) as $gm=>$v){
  if($gd <= $v)break;
  $gd-=$v;
 }
 return($mod==='')?array($gy,$gm,$gd):$gy .$mod .$gm .$mod .$gd;
}
//-------------------------------------------------------------------------------------------------------------


/*
 * ============================================================================
 *  VOIZ | توابع یکسان‌ساز تقویم شمسی
 *  هدف: یک منبع واحد برای نام ماه‌ها و پارس/تبدیل بدون خطای تاریخ شمسی
 *  در ماژول‌های گزارش‌گیری (monitoring, voicemail, cdrreport, ...)
 * ============================================================================
 */

/**
 * منبع واحد نام ماه‌های شمسی.
 * نکته: datepicker جاوااسکریپت (persianDatepicker) همین نام‌ها را با «ی» فارسی
 * (U+06CC) تولید می‌کند؛ هر ناسازگاری در این آرایه باعث fail شدن فیلتر تاریخ می‌شود.
 */
function voiz_shamsi_months()
{
    static $months = array(
        1  => 'فروردین',
        2  => 'اردیبهشت',
        3  => 'خرداد',
        4  => 'تیر',
        5  => 'مرداد',
        6  => 'شهریور',
        7  => 'مهر',
        8  => 'آبان',
        9  => 'آذر',
        10 => 'دی',
        11 => 'بهمن',
        12 => 'اسفند',
    );
    return $months;
}

function voiz_shamsi_month_name($num)
{
    $months = voiz_shamsi_months();
    $num = (int) $num;
    return isset($months[$num]) ? $months[$num] : '';
}

/** تنظیم منطقه زمانی فقط در صورت تغییر (جلوگیری از اثر جانبی تکراری روی کل پنل) */
function voiz_tz_set($tz = 'Asia/Tehran')
{
    if (function_exists('date_default_timezone_get') && date_default_timezone_get() !== $tz) {
        date_default_timezone_set($tz);
    }
}

/** تبدیل ارقام فارسی (۰-۹) و عربی (٠-٩) به ارقام لاتین */
function voiz_normalize_digits($str)
{
    $fa = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    $ar = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
    $en = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    return str_replace(array_merge($fa, $ar), array_merge($en, $en), (string) $str);
}

/**
 * یکسان‌سازی متن فارسی: ارقام، «ي/ك» عربی به «ی/ک» فارسی،
 * حذف نیم‌فاصله و کاراکترهای کنترلی بی‌عرض جهت‌دهی.
 */
function voiz_normalize_text($str)
{
    if (is_array($str) || is_object($str) || is_bool($str) || $str === null) return '';
    $str = voiz_normalize_digits($str);
    $str = str_replace(array('ي', 'ى', 'ك'), array('ی', 'ی', 'ک'), $str);
    $clean = preg_replace('/[\x{200B}-\x{200F}\x{202A}-\x{202E}\x{FEFF}]/u', '', $str);
    if ($clean === null) {
        $clean = str_replace(
            array("\xE2\x80\x8B", "\xE2\x80\x8C", "\xE2\x80\x8D", "\xE2\x80\x8E", "\xE2\x80\x8F", "\xEF\xBB\xBF"),
            '',
            $str
        );
    }
    $clean = preg_replace('/[\s\x{00A0}]+/u', ' ', $clean);
    return trim($clean === null ? $str : $clean);
}

/** شمارهٔ ماه از روی نام ماه (پشتیبانی از نام فارسی/عربی، نام لاتین datepicker قدیمی و از عدد) */
function voiz_shamsi_month_number($name)
{
    $name = voiz_normalize_text($name);
    if ($name === '') return 0;
    if (preg_match('/^\d{1,2}$/', $name)) {
        $num = (int) $name;
        return ($num >= 1 && $num <= 12) ? $num : 0;
    }
    foreach (voiz_shamsi_months() as $num => $title) {
        if (voiz_normalize_text($title) === $name) return $num;
    }
    $latin = array(
        1 => 'farvardin', 2 => 'ordibehesht', 3 => 'khordad', 4 => 'tir', 5 => 'mordad', 6 => 'shahrivar',
        7 => 'mehr', 8 => 'aban', 9 => 'azar', 10 => 'dye', 11 => 'bahman', 12 => 'esfand',
    );
    $needle = strtolower($name);
    foreach ($latin as $num => $title) {
        if (strpos($needle, $title) === 0) return $num;
    }
    return 0;
}

/** اعتبارسنجی تاریخ شمسی (شامل سال کبیسه) */
function voiz_jalali_valid($year, $month, $day)
{
    $year  = (int) $year;
    $month = (int) $month;
    $day   = (int) $day;
    if ($year < 1200 || $year > 1700) return false;
    if ($month < 1 || $month > 12)    return false;
    return (bool) jcheckdate($month, $day, $year);
}

/**
 * پارس تاریخ/ساعت و تبدیل به اجزای آن.
 * قالب‌های پذیرفته‌شده:
 *   «۰۸ مهر ۱۴۰۵ 10:30:00» | «8 مهر 1405» | «8/مهر/1405»
 *   «1405/07/08» | «2026-09-30» (میلادی، فقط برای عبور بی‌خطر)
 * خروجی: array('y','m','d','h','i','s','calendar') یا false در صورت نامعتبر بودن
 */
function voiz_parse_datetime($str)
{
    $str = voiz_normalize_text($str);
    if ($str === '') return false;

    $h = 0;
    $i = 0;
    $s = 0;
    if (preg_match('/^(.*\S)\s+(\d{1,2}):(\d{1,2})(?::(\d{1,2}))?$/', $str, $m)) {
        $str = trim($m[1]);
        $h = (int) $m[2];
        $i = (int) $m[3];
        $s = isset($m[4]) ? (int) $m[4] : 0;
    }
    if ($h > 23 || $i > 59 || $s > 59) return false;

    $parts = preg_split('/[\s\/\.\-\\\\]+/', $str);
    $parts = array_values(array_filter(array_map('trim', $parts), function ($v) { return $v !== ''; }));
    if (count($parts) !== 3) return false;

    // قالب کاملاً عددی
    if (preg_match('/^\d{1,4}$/', $parts[0]) && preg_match('/^\d{1,2}$/', $parts[1]) && preg_match('/^\d{1,2}$/', $parts[2])) {
        $a = (int) $parts[0];
        $b = (int) $parts[1];
        $c = (int) $parts[2];
        if ($a > 1600) { // میلادی
            if (!checkdate($b, $c, $a)) return false;
            return array('y' => $a, 'm' => $b, 'd' => $c, 'h' => $h, 'i' => $i, 's' => $s, 'calendar' => 'gregorian');
        }
        if (!voiz_jalali_valid($a, $b, $c)) return false;
        return array('y' => $a, 'm' => $b, 'd' => $c, 'h' => $h, 'i' => $i, 's' => $s, 'calendar' => 'jalali');
    }

    // قالب متنی شمسی: «۸ مهر ۱۴۰۵»
    if (preg_match('/^\d{1,2}$/', $parts[0]) && preg_match('/^\d{3,4}$/', $parts[2])) {
        $month = voiz_shamsi_month_number($parts[1]);
        $day   = (int) $parts[0];
        $year  = (int) $parts[2];
        if ($month > 0 && voiz_jalali_valid($year, $month, $day)) {
            return array('y' => $year, 'm' => $month, 'd' => $day, 'h' => $h, 'i' => $i, 's' => $s, 'calendar' => 'jalali');
        }
    }

    return false;
}

/** پارس تاریخ میلادی (برای داده‌های خام دیتابیس و مقادیر ISO) */
function voiz_parse_gregorian_datetime($str)
{
    $str = voiz_normalize_text($str);
    if ($str === '') return false;
    if (!preg_match('/^(\d{4})-(\d{1,2})-(\d{1,2})(?:[ T]+(\d{1,2}):(\d{1,2})(?::(\d{1,2}))?)?/', $str, $m)) return false;
    $parts = array('y' => (int) $m[1], 'm' => (int) $m[2], 'd' => (int) $m[3]);
    $parts['h'] = isset($m[4]) ? (int) $m[4] : 0;
    $parts['i'] = isset($m[5]) ? (int) $m[5] : 0;
    $parts['s'] = isset($m[6]) ? (int) $m[6] : 0;
    if (!checkdate($parts['m'], $parts['d'], $parts['y'])) return false;
    $parts['calendar'] = 'gregorian';
    return $parts;
}

/**
 * تبدیل تاریخ شمسی (متنی یا عددی) به تاریخ میلادی ISO.
 * خروجی: 'YYYY-MM-DD' یا رشتهٔ خالی در صورت نامعتبر بودن ورودی.
 */
function voiz_jalali_to_iso($str)
{
    $parts = voiz_parse_datetime($str);
    if ($parts === false) return '';
    if ($parts['calendar'] === 'gregorian') {
        return sprintf('%04d-%02d-%02d', $parts['y'], $parts['m'], $parts['d']);
    }
    list($gy, $gm, $gd) = jalali_to_gregorian($parts['y'], $parts['m'], $parts['d']);
    return sprintf('%04d-%02d-%02d', $gy, $gm, $gd);
}

/**
 * تبدیل تاریخ شمسی به تاریخ میلادی کامل برای کوئری دیتابیس.
 * خروجی: 'Y-m-d H:i:s' یا false در صورت نامعتبر بودن ورودی.
 */
function voiz_jalali_to_gregorian_datetime($str)
{
    $parts = voiz_parse_datetime($str);
    if ($parts === false) return false;
    if ($parts['calendar'] === 'gregorian') {
        return sprintf('%04d-%02d-%02d %02d:%02d:%02d', $parts['y'], $parts['m'], $parts['d'], $parts['h'], $parts['i'], $parts['s']);
    }
    list($gy, $gm, $gd) = jalali_to_gregorian($parts['y'], $parts['m'], $parts['d']);
    return sprintf('%04d-%02d-%02d %02d:%02d:%02d', $gy, $gm, $gd, $parts['h'], $parts['i'], $parts['s']);
}

/**
 * تبدیل تاریخ/ساعت میلادی به نمایش شمسی.
 * $format : 'name'  => «۰۸ مهر ۱۴۰۵ ۱۰:۳۰:۰۰»
 *           'slash' => «۱۴۰۵/۰۷/۰۸»
 * $persianDigits : true برای ارقام فارسی
 */
function voiz_gregorian_to_jalali_text($dateTime, $format = 'name', $persianDigits = true, $withTime = true)
{
    $parts = voiz_parse_gregorian_datetime($dateTime);
    if ($parts === false) {
        if (!is_string($dateTime) && !is_numeric($dateTime)) return '';
        $ts = strtotime((string) $dateTime);
        if ($ts === false) return (string) $dateTime;
        $parts = array(
            'y' => (int) date('Y', $ts), 'm' => (int) date('n', $ts), 'd' => (int) date('j', $ts),
            'h' => (int) date('G', $ts), 'i' => (int) date('i', $ts), 's' => (int) date('s', $ts),
        );
    }
    list($jy, $jm, $jd) = gregorian_to_jalali($parts['y'], $parts['m'], $parts['d']);

    if ($format === 'slash') {
        $text = sprintf('%d/%02d/%02d', $jy, $jm, $jd);
        if ($withTime) $text .= sprintf(' %02d:%02d:%02d', $parts['h'], $parts['i'], $parts['s']);
    } else {
        $text = sprintf('%02d %s %d', $jd, voiz_shamsi_month_name($jm), $jy);
        if ($withTime) $text .= sprintf(' %02d:%02d:%02d', $parts['h'], $parts['i'], $parts['s']);
    }
    return $persianDigits ? adad_en_to_fa($text) : $text;
}

/** نمایش استاندارد و یکسان تاریخ شمسی برای نمایش در فرم‌ها و فیلترها */
function voiz_jalali_display($str, $persianDigits = true)
{
    $parts = voiz_parse_datetime($str);
    if ($parts === false) return voiz_normalize_text($str);
    if ($parts['calendar'] === 'gregorian') {
        list($jy, $jm, $jd) = gregorian_to_jalali($parts['y'], $parts['m'], $parts['d']);
        $parts['y'] = $jy;
        $parts['m'] = $jm;
        $parts['d'] = $jd;
    }
    $text = sprintf('%02d %s %d', $parts['d'], voiz_shamsi_month_name($parts['m']), $parts['y']);
    if ($parts['h'] || $parts['i'] || $parts['s']) {
        $text .= sprintf(' %02d:%02d:%02d', $parts['h'], $parts['i'], $parts['s']);
    }
    return $persianDigits ? adad_en_to_fa($text) : $text;
}

/**
 * مقدار عددی تقویم (همان قالبی که datepicker در data-jdate تولید می‌کند): 'YYYY/MM/DD'
 * اگر ورودی میلادی باشد، به شمسی تبدیل می‌شود. در صورت نامعتبر بودن: ''
 */
function voiz_jalali_picker_value($str)
{
    $parts = voiz_parse_datetime($str);
    if ($parts === false) return '';
    if ($parts['calendar'] === 'gregorian') {
        list($jy, $jm, $jd) = gregorian_to_jalali($parts['y'], $parts['m'], $parts['d']);
    } else {
        $jy = $parts['y'];
        $jm = $parts['m'];
        $jd = $parts['d'];
    }
    return sprintf('%d/%02d/%02d', $jy, $jm, $jd);
}

/** تاریخ شمسی امروز به همراه اجزای آن */
function voiz_jalali_today()
{
    voiz_tz_set();
    $ts = time();
    list($jy, $jm, $jd) = gregorian_to_jalali((int) date('Y', $ts), (int) date('n', $ts), (int) date('j', $ts));
    return array(
        'y' => $jy, 'm' => $jm, 'd' => $jd,
        'label' => voiz_jalali_display(sprintf('%d %s %d', $jd, voiz_shamsi_month_name($jm), $jy)),
    );
}

/**
 * استخراج بخش تاریخ (Y-m-d) از فیلد مخفی ISO یا متن شمسی ارسالی فرم.
 * خروجی: 'Y-m-d' یا رشتهٔ خالی در صورت نامعتبر بودن ورودی.
 */
function voiz_filter_date_part($iso, $shamsiText)
{
    $iso = is_string($iso) ? trim($iso) : '';
    if ($iso !== '') {
        $parts = voiz_parse_gregorian_datetime($iso);
        if ($parts !== false) return sprintf('%04d-%02d-%02d', $parts['y'], $parts['m'], $parts['d']);
    }
    return voiz_jalali_to_iso($shamsiText);
}

/**
 * تولید بازهٔ زمانی میلادی برای فیلتر گزارش‌ها.
 * اولویت با مقدار ISO (فیلد مخفی datepicker) و سپس متن شمسی ارسالی فرم است.
 * اگر تاریخ‌ها معکوس انتخاب شده باشند آن‌ها جابه‌جا می‌شوند.
 * اگر یکی از تاریخ‌ها نامعتبر باشد، تاریخ معتبر دیگر جایگزین آن می‌شود و 'fallback' برابر true می‌گردد.
 * خروجی: array('from' => 'Y-m-d H:i:s', 'to' => 'Y-m-d H:i:s', 'valid' => bool, 'swapped' => bool, 'fallback' => bool)
 */
function voiz_report_range($isoStart, $textStart, $isoEnd, $textEnd, $defaultTime = array('00:00:00', '23:59:59'))
{
    $out = array('from' => '', 'to' => '', 'valid' => false, 'swapped' => false, 'fallback' => false);
    $startDate = voiz_filter_date_part($isoStart, $textStart);
    $endDate   = voiz_filter_date_part($isoEnd, $textEnd);

    if ($startDate === '') {
        $out['fallback'] = true;
        $startDate = voiz_filter_date_part('', date('Y-m-d H:i:s'));
    }
    if ($endDate === '') {
        $out['fallback'] = true;
        $endDate = $startDate !== '' ? $startDate : voiz_filter_date_part('', date('Y-m-d H:i:s'));
    }

    if ($startDate !== '' && $endDate !== '' && $startDate > $endDate) {
        $tmp = $startDate;
        $startDate = $endDate;
        $endDate = $tmp;
        $out['swapped'] = true;
    }

    if ($startDate === '' || $endDate === '') return $out;

    $out['from'] = $startDate . ' ' . $defaultTime[0];
    $out['to']   = $endDate . ' ' . $defaultTime[1];
    $out['valid'] = true;
    return $out;
}

//-------------------------------------------------------------------------------------------------------------


function zamanstr()
{
	
	$timenow = time();
	$LocalDateTime=date("m/d/Y g:i:s a");
	$timeiran = jdate( "H:i:s", $timenow );
	$dateiran = jdate( "Y/m/d", $timenow );
	$rrr=$dateiran." - ".$timeiran;	
return $rrr;	
}




function tarikhemroz (){

	
	
//===========================================================================================================================


	
	
	$rrr=array();
	
	date_default_timezone_set('Asia/Tehran');
	$hafte=array('يکشنبه','دوشنبه','سه شنبه','چهارشنبه','پنجشنبه','جمعه','شنبه');
	$shamsiMName=array_values(voiz_shamsi_months());
	$miladiMName=array('ژانويه','فوريه','مارس','آپريل','مي','جون','جولاي','آگوست','سپتامبر','اکتبر','نوامبر','دسامبر');

	
	$rrr['mahayeshamsi']=$shamsiMName;
	
	$timenow = time();
	$rrr['timenow']=$timenow;
	
	$dat11e=$timenow;
	//$dat11e = strtotime("-1 day", $dat11e);	
	$hijri = new HijriDate($dat11e);
	$rrr['dateiran'] = jdate( "Y/m/d", $timenow );
	$rrr['timeiran'] = jdate( "H:i:s", $timenow );
	$rrr['saat']=Date('H');
	$rrr['daghighe']=Date('i');
	$rrr['shomarehafte']=Date('w');
	
	$HafteName=$hafte[Date('w')];

	$miladi_Y = Date('Y');
	$miladi_M = Date('m');
	$miladi_D = Date('d');
	$miladi_MN= Date('F');
	$miladi_MNF= $miladiMName[Date('n')-1];

	$shmasiarray=gregorian_to_jalali($miladi_Y,$miladi_M,$miladi_D);
	$shamsi_Y = $shmasiarray[0];
	$shamsi_M = $shmasiarray[1];
	$shamsi_D = $shmasiarray[2];
	$shamsi_MN = $shamsiMName[$shmasiarray[1]-1];

	$ghamari_Y=$hijri->get_year();
	$ghamari_M=$hijri->get_month();
	$ghamari_D=$hijri->get_day();
	$ghamari_MN=$hijri->get_month_name($hijri->get_month());

	$roydad="";
	$istatil=false;
	
	if(Date('w')==5)
		$istatil=true;	
	
	
		
	$tarikhhala="⏰ساعت : ".Date('H:i:s');
	$tarikhhala=$tarikhhala."\r\nامروز : ".$HafteName." ".$shamsi_D." ".$shamsi_MN." ".$shamsi_Y." (".$shamsi_Y."/".$shamsi_M."/".$shamsi_D.")";
	$tarikhhala=$tarikhhala."\n\r"."برابر با : ".$miladi_D." ".$miladi_MNF." ".$miladi_Y;
	$tarikhhala=$tarikhhala."\n\r".$miladi_D." ".$miladi_MN." ".$miladi_Y." (".$miladi_Y."/".$miladi_M."/".$miladi_D.")";
	$tarikhhala=$tarikhhala."\n\r"."مصادف با : ".$ghamari_D." ".$ghamari_MN." ".$ghamari_Y." (".$ghamari_Y."/".$ghamari_M."/".$ghamari_D.")";

	$rrr['istatil']=0;
	if($istatil){
		$tarikhhala=$tarikhhala."\n\r <code>امروز تعطیل رسمی می‌باشد</code>";
		$rrr['istatil']=1;
	}
	
	
	$rrr['tarikhstr']=$tarikhhala;
	$rrr['miladi_y']=$miladi_Y;
	$rrr['miladi_m']=$miladi_M;
	$rrr['miladi_d']=$miladi_D;
	$rrr['miladi_mn']=$miladi_MN;
	$rrr['miladi_mnf']=$miladi_MNF;
	$rrr['shamsi_y']=$shamsi_Y;
	$rrr['shamsi_m']=$shamsi_M;
	$rrr['shamsi_d']=$shamsi_D;
	$rrr['shamsi_mn']=$shamsi_MN;
	$rrr['ghamari_y']=$ghamari_Y;
	$rrr['ghamari_m']=$ghamari_M;
	$rrr['ghamari_d']=$ghamari_D;
	$rrr['ghamari_mn']=$ghamari_MN;
	$rrr['hafte']=$HafteName;
	$rrr['timefa']=jdate('h:m:s');
	$rrr['timeen']=Date('H:i:s');
	// مقدار پیش‌فرض یکسان و آمادهٔ استفاده برای فیلدهای تاریخ شمسی فرم‌ها
	$rrr['shamsi_label']=voiz_jalali_display(sprintf('%d %s %d', $shamsi_D, $shamsi_MN, $shamsi_Y));
	//$rrr['akharemah']=jdate('y-m-d',return_timestamp($rrr['dateiran']));
	
	return $rrr;
}

function adad_fa_to_en($string) {
$persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
$english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
 
$output= str_replace($persian, $english, $string);
return $output;
}


function adad_en_to_fa($string) {
$persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
$english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
 
$output= str_replace($english, $persian, $string);
return $output;
}


/**
 * تبدیل تاریخ شمسیِ ارسالی فرم‌ها (یا تاریخ میلادی/ISO) به تاریخ میلادی کامل.
 * ورودی‌های پشتیبانی‌شده: «۰۸ مهر ۱۴۰۵ 00:00:00» ، «8 مهر 1405» ، «1405/07/08» ، «2026-09-30 10:00:00»
 * خروجی: 'Y-m-d H:i:s' و در صورت نامعتبر بودن ورودی false (به‌جای تاریخ ۱۹۷۰).
 */
function tarjomedatehshamsi($datestr)
{
    return voiz_jalali_to_gregorian_datetime($datestr);
}

/** تبدیل تاریخ میلادی (دیتابیس یا فیلتر) به نمایش شمسی: «۰۸ مهر ۱۴۰۵ ۱۰:۳۰:۰۰» */
function rectohejri($datestr)
{
    return voiz_gregorian_to_jalali_text($datestr, 'name', true);
}

/** تبدیل ستون تاریخ آرایه‌های خروجی دیتابیس (مثلاً CEL) به نمایش شمسی «۱۴۰۵/۰۷/۰۸ ۱۰:۳۰:۰۰» */
function chengetarikhdararray($datestr)
{
    if (!is_array($datestr)) return $datestr;
    $total = count($datestr);
    for ($i = 0; $i < $total; $i++) {
        if (!isset($datestr[$i][0])) continue;
        $parts = voiz_parse_gregorian_datetime($datestr[$i][0]);
        if ($parts === false) continue;
        $text = sprintf('%d/%02d/%02d %02d:%02d:%02d', $parts['y'], $parts['m'], $parts['d'], $parts['h'], $parts['i'], $parts['s']);
        $datestr[$i][0] = adad_en_to_fa(voiz_gregorian_to_jalali_text($text, 'slash', false, true));
    }
    return $datestr;
}




function isLeapYear($year)
{
    $ary = array(1, 5, 9, 13, 17, 22, 26, 30);
    $b = $year % 33;
    if (in_array($b, $ary))
        return true;
    return false;
}

?>