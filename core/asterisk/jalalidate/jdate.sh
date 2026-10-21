#!/bin/bash

#algorithm  from jdf project(a calender convertor for php.)
#day,month,year and other english var used for miladi and sal mah rooz and ... used for jalali.
#-h (help)  -f(farsi) -d(special date) -s (spliter character) and without option we use finglish and print curent date. 
#default spliter(delimiter) character is "-"
#although -s suport  string but recomended using a character.
#VOIPIRAN.io
#Edited by Hamed Kouhfallah
#k.haamed@gmail.com

date=$(date "+%Y-%m-%d") #set default date
mode="finglish"
spliter="-"


usage()
{
echo "
usage: $0 [-f] [-h] [-d date]  [-s spliter_text]
option list:
-h  this help
-f  farsi output  - default output is finglish
-d  set special date in this form year-month-day - default is current date
-s  spliter text (delimiter) - default is '-' (see below example)
example:
run with default value. current date in finglish
$0

current date in farsi (آزمایش نمایش فارسی)
$0 -f

special date(miladi) in farsi
$0 -f -d 1970-12-20

special date(miladi) in finglish
$0 -d 1970-12-20

special date(miladi) in farsi and special spliter(delimiter)
$0 -f -d 1970+12+20 -s '+'

"
}
miladi_to_jalali()
{
year=$1
month=${2#0}
day=${3#0}

d_4=$((year%4)) #its can be replace with "date +%j"
g_a=(0 0 31 59 90 120 151 181 212 243 273 304 334)
doy=$((g_a[$month]+day))

if [ "$d_4" == '0' ]  && [ $month -gt  2  ]  
    then
       ((  doy++ ))
fi

#d_33=$(echo "(((($year-16)%132)*.0305)*10)/10" | bc ) #cheking for remove bc

if [[ "$d_33" == 3 ]] || [[ "$d_33" -lt $(( d_4 - 1 )) ]] || [[ "$d_4" == 0 ]]
    then
        a=286
    else
        a=287
fi


if ( [ "$d_33" == 1 ] ||  [ "$d_33" == 2 ] ) && (  [ "$d_33" == $d_4 ] || [  "$d_4" == 1 ] )
    then 
        b=78
        else
            if  ( [ "$d_33" == 3 ] && [ "$d_4" == 0 ] )
                then
                b=80
                else
                b=79
            fi
fi

if [ $(($((year - 10 ))/63)) == 30 ]
    then
    (( a-- ))
    (( b++ ))
fi


if [ $doy -gt $b ]
    then
    sal=$((year-621))
    res=$((doy-b)) #Rooz E Sal
    else
    sal=$((year-622 ))
    res=$((doy+a))
fi


if [ $res -lt 187 ] 
    then
    mah=$(($((res-1))/31)) 
    rooz=$((res-$((31*mah))))
    (( mah++ ))
    else
    mah=$(($((res-187))/30))
    rooz=$((res-186 - $((mah*30))))
    (( mah += 7))
fi
echo $sal $mah $rooz
}

format_finglish()
{
sal=$1
mah=$2
rooz=$3
miladi_day_week=$4 # output from `date  "+%u"` it is  (1...7)

mah_string=(none Farvardin Ordibehesht Khordad Tir Mordad Shahrivar Mehr Aban Azar Dei Bahman Esfand )
rooz_string=( none  DoShanbe SeShanbe ChaharShanbe PanjShanbe Jomee Shabe YekShanbe )

#echo "${rooz_string[$miladi_day_week]} $rooz  ${mah_string[$mah]} $sal "
echo "$sal-$mah-$rooz-"
}

format_farsi()
{
sal=$1
mah=$2
rooz=$3
miladi_day_week=$4

mah_string=(خالی فروردین اردیبهشت خرداد تیر مرداد شهریور مهر آبان آذر دی بهمن اسفند )
rooz_string=( خالی دوشنبه سه‌شنبه چهارشنبه پنجشنبه جمعه شنبه یکشنبه) # SeShanbe has a bug
persian_num=( ۰ ۱ ۲ ۳ ۴ ۵ ۶ ۷ ۸ ۹ )

for (( i = 0 ; i <= 9 ; i++ )); { sal=`echo $sal | sed "s/$i/${persian_num[$i]}/g"`; rooz=`echo $rooz | sed "s/$i/${persian_num[$i]}/g"`; } #convert sal 1395--->۱۳۹۵

echo "${rooz_string[$miladi_day_week]} $rooz  ${mah_string[$mah]} $sal "
}

#main
while getopts ":fhd:s:" option; do
case $option in
    f)
    mode="farsi"
    ;;
    h)
    usage
    exit 1
    ;;
    d)
    date="$OPTARG"
    ;;
    s)
    spliter="$OPTARG"
    ;;
esac
done

#date="$(echo $date | sed "s/$spliter/ /g")"
date="$(echo $date | tr ${spliter} ' ' )"


if [[ ! $date =~ ^[[:digit:]]{4}[[:space:]][[:digit:]]{1,2}[[:space:]][[:digit:]]{1,2} ]]
then
	echo "can't parse .."
	echo "see $0 -h"
	exit 1
fi

emroz=`miladi_to_jalali $date` #miladi_to_jalali only return number EX: 1395 12 29  
rooz_e_hafte=`date -d $(echo $date | tr ' ' '-') "+%u"`

case $mode in
finglish)
    format_finglish $emroz $rooz_e_hafte
    ;;
farsi)
    format_farsi $emroz $rooz_e_hafte
    ;;
esac
