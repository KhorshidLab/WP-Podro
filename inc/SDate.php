<?php
namespace WP_PODRO\Engine;
/*
 * @name       Shamsi Date (SDate)
 * @author     Erfan Sahafnejad <Erfan.Sahaf@gmail.com/>
 * @copyright  2015 P30Skill Development Team (http://P30Skill.ir)
 * @version    1.0
 * @link       www.P30Skill.ir
 * @reference  http://jdf.scr.ir/
*/


// This class use jdate functions for covert date
class SDate {

    /*
     * Initialize SDate Class
     * Set timezone (Tehran-Iran)
     */
    public function __construct(){
        date_default_timezone_set("Asia/Tehran");
    }

    /*
     * This function can convert Gregorian string date format to Shamsi date
     *
     * @param string $date
     * @return string
     */
    public function toShaDate($date = "2015-01-26",$outputLimiter = "/"){
        $date = $this->PersianToLatinNumber($date);
        $delimiter = substr($date,4,1);
        $en_date = explode($delimiter,$date);
        $result = $this->gregorian_to_jalali($en_date[0],$en_date[1],$en_date[2],$outputLimiter);
        return $result;
    }

    /*
     * This function can convert Shamsi string date format, to Gregorian date
     * Input string date limiter is not important
     *
     * @param string $date
     * @return string
     */
    public function toGrDate($date = "1393/11/5",$outputLimiter = "/"){
        $date = $this->persianToLatinNumber($date);
        $exploder = substr($date,4,1);
        $fa_date = explode($exploder,$date);
        $result = $this->jalali_to_gregorian($fa_date[0],$fa_date[1],$fa_date[2],$outputLimiter);
        return $result;
    }

    /*
     * This function use for get current date (today)
     * Lang Param: en OR fa
     *
     * @param bool $includeTime
     * @param string $lang
     * @param string $limiter
     *
     * @return string
     */
    public function getDate($includeTime = false ,$lang = "en",$limiter = "-"){
        if($lang=="fa"){
            $str = "Y".$limiter."n".$limiter."j";
            if($includeTime)
                return $this->persianToLatinNumber($this->jdate($str)." ".$this->getNowTime());
            else
                return $this->persianToLatinNumber($this->jdate($str));
        }
        else if($lang=="en"){
            $str = "Y".$limiter."m".$limiter."d";
            if($includeTime)
                return date($str)." ".$this->getNowTime();
            else
                return date($str);
        }
        else
            return null;
    }

    /*
     * Function Usage: get current Persian (Shamsi) Month name
     *
     * @return string
     */
    public function getMonthName(){
        return $this->jdate('F');
    }

    /*
     * Function Usage: get current Persian (Shamsi) Season name
     *
     * @return string
     */
    public function getSeasonName(){
        return $this->jdate('f');
    }


    /*
     * This function can be use for get Year,Month or day from date string
     * If flag = 1, function will return Year
     * If flag = 2, function will return Month
     * If flag = 3, function will return Day
     *
     * @param string $date
     * @param int flag
     */
    public function getYearMonthDay($date = "1393/11/5",$flag = 1){
        $limiter = substr($date,4,1);
        $date = explode($limiter,$date);
        // Return Year
        if($flag==1)
            $date = $date[0];
        // Return Month
        elseif($flag==2)
            $date = $date[1];
        // Return Day
        else
            $date = $date[2];
        return $date;
    }

    /*
     * This function can covert persian numbers (character) to latin numbers (character)
     *
     * @param string $string
     *
     * @return string
     */
    public function persianToLatinNumber($string){
        return str_replace(Array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'), Array(0,1,2,3,4,5,6,7,8,9), $string);
    }

    /*
     * Normal Date function (Hour:Minute:Second)
     *
     * @return string
     */
    public function getNowTime(){
        return date("H:i:s");
    }

    /*
     * This function can separate date format from a string
     * @param string $string
     * @return string date
     */
    public function separateEngDate($string)
    {
        preg_match('/\d{2}\.\d{2}\.\d{4} \d{2}:\d{2}/', $string, $matches);
        if (isset($matches[0]))
            return $matches[0];
        return null;
    }

    /*
     * This function can extract date and time from another
     * Also this function can detect type of date (Gregorian or Jalali) and convert it to another
     * @param string $DateTime
     * @param bool $convertDate
     * @param string $outputLimiter
     * @return mixed array consist "date" and "time" indexes
     */
    public function separateDateAndTime($DateTime, $convertDate = false, $outputLimiter = "/"){
        $DateTime = explode(" ",$DateTime);
        $DateTime['date'] = $DateTime[0];
        $DateTime['time'] = $DateTime[1];
        if($convertDate){
            $date = $DateTime[0];
            unset($DateTime[0],$DateTime[1]);
            $DateTime['date'] = $this->convertDate($date, $outputLimiter);
        }
        else
            unset($DateTime[0],$DateTime[1]);

        return $DateTime;
    }

    /*
     * This function can detect (automatically) date format and convert to that one format (Sha || Gr)
     *
     */
    public function convertDate($date, $outputLimiter = "/"){
        $sub = substr($date,0,1);
        if($sub=="2")
            return $this->toShaDate($date, $outputLimiter);
        elseif($sub=="1")
            return $this->toGrDate($date, $outputLimiter);
        else
            return null;
    }

    /*
     * This function can sum or sub Year, Month, Date with your value
     * for example: 2 days later -> editDate("2015-11-10", "2", "days", "+"); => Result: 2015-11-12
     * this function only support Y-m-d format
     * if date was empty, current date replace with your date
     */
    public function editDate($date = "", $value = "1" ,$type = "days", $operation = "+"){
        if($date=="" or $date==null)
            $date = $this->getDate();
        return date('Y-m-d', strtotime($date. ' '.$operation.' '.$value.' '.$type));
    }

    /*---------------------------------------------------------------------------
    |                                                                            |
    |                              MAIN JDF FUNCTIONS                            |
    |                                                                            |
    |---------------------------------------------------------------------------*/
    function jdate($format,$timestamp='',$none='',$time_zone='Asia/Tehran',$tr_num='fa'){

        $T_sec=0;/* <= رفع خطاي زمان سرور ، با اعداد '+' و '-' بر حسب ثانيه */

        if($time_zone!='local')date_default_timezone_set(($time_zone=='')?'Asia/Tehran':$time_zone);
        $ts=$T_sec+(($timestamp=='' or $timestamp=='now')?time():$this->tr_num($timestamp));
        $date=explode('_',date('H_i_j_n_O_P_s_w_Y',$ts));
        list($j_y,$j_m,$j_d)=$this->gregorian_to_jalali($date[8],$date[3],$date[2]);
        $doy=($j_m<7)?(($j_m-1)*31)+$j_d-1:(($j_m-7)*30)+$j_d+185;
        $kab=($j_y%33%4-1==(int)($j_y%33*.05))?1:0;
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
                    $out.=
                        $this->jdate_words(array('kh'=>$date[7]),' ');
                    break;

                case'f':
                    $out.=$this->jdate_words(array('ff'=>$j_m),' ');
                    break;

                case'F':
                    $out.=$this->jdate_words(array('mm'=>$j_m),' ');
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
                    $out.=$this->jdate_words(array('rr'=>$j_d),' ');
                    break;

                case'k';
                    $out.=$this->tr_num(100-(int)($doy/($kab+365)*1000)/10,$tr_num);
                    break;

                case'K':
                    $out.=$this->tr_num((int)($doy/($kab+365)*1000)/10,$tr_num);
                    break;

                case'l':
                    $out.=$this->jdate_words(array('rh'=>$date[7]),' ');
                    break;

                case'L':
                    $out.=$kab;
                    break;

                case'm':
                    $out.=($j_m>9)?$j_m:'0'.$j_m;
                    break;

                case'M':
                    $out.=$this->jdate_words(array('km'=>$j_m),' ');
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
                    $out.=$this->jdate_words(array('mb'=>$j_m),' ');
                    break;

                case'P':
                    $out.=$date[5];
                    break;

                case'q':
                    $out.=$this->jdate_words(array('sh'=>$j_y),' ');
                    break;

                case'Q':
                    $out.=$kab+364-$doy;
                    break;

                case'r':
                    $key=$this->jdate_words(array('rh'=>$date[7],'mm'=>$j_m));
                    $out.=$date[0].':'.$date[1].':'.$date[6].' '.$date[4]
                        .' '.$key['rh'].'، '.$j_d.' '.$key['mm'].' '.$j_y;
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
                    $out.=$this->jdate_words(array('ss'=>substr($j_y,2,2)),' ');
                    break;

                case'V':
                    $out.=$this->jdate_words(array('ss'=>$j_y),' ');
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
                        $num=($avs==4 or $avs==(($j_y%33%4-2==(int)($j_y%33*.05))?5:4))?53:52;
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
        return($tr_num!='en')?$this->tr_num($out,'fa','.'):$out;
    }

    /*	F	*/
    function jstrftime($format,$timestamp='',$none='',$time_zone='Asia/Tehran',$tr_num='fa'){

        $T_sec=0;/* <= رفع خطاي زمان سرور ، با اعداد '+' و '-' بر حسب ثانيه */

        if($time_zone!='local')date_default_timezone_set(($time_zone=='')?'Asia/Tehran':$time_zone);
        $ts=$T_sec+(($timestamp=='' or $timestamp=='now')?time():$this->tr_num($timestamp));
        $date=explode('_',date('h_H_i_j_n_s_w_Y',$ts));
        list($j_y,$j_m,$j_d)=$this->gregorian_to_jalali($date[7],$date[4],$date[3]);
        $doy=($j_m<7)?(($j_m-1)*31)+$j_d-1:(($j_m-7)*30)+$j_d+185;
        $kab=($j_y%33%4-1==(int)($j_y%33*.05))?1:0;
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
                    $out.=$this->jdate_words(array('kh'=>$date[6]),' ');
                    break;

                case'A':
                    $out.=$this->jdate_words(array('rh'=>$date[6]),' ');
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
                        $num=($avs==4 or $avs==(($j_y%33%4-2==(int)($j_y%33*.05))?5:4))?53:52;
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
                    $out.=$this->jdate_words(array('km'=>$j_m),' ');
                    break;

                case'B':
                    $out.=$this->jdate_words(array('mm'=>$j_m),' ');
                    break;

                case'm':
                    $out.=($j_m>9)?$j_m:'0'.$j_m;
                    break;

                /* Year */
                case'C':
                    $out.=substr($j_y,0,2);
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
                    $key=$this->jdate_words(array('rh'=>$date[6],'mm'=>$j_m));
                    $out.=$date[1].':'.$date[2].':'.$date[5].' '.date('P',$ts)
                        .' '.$key['rh'].'، '.$j_d.' '.$key['mm'].' '.$j_y;
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
        return($tr_num!='en')?$this->tr_num($out,'fa','.'):$out;
    }

    /*	F	*/
    function jmktime($h='',$m='',$s='',$jm='',$jd='',$jy='',$is_dst=-1){
        $h=$this->tr_num($h); $m=$this->tr_num($m); $s=$this->tr_num($s); $jm=$this->tr_num($jm); $jd=$this->tr_num($jd); $jy=$this->tr_num($jy);
        if($h=='' and $m=='' and $s=='' and $jm=='' and $jd=='' and $jy==''){
            return mktime();
        }else{
            list($year,$month,$day)=$this->jalali_to_gregorian($jy,$jm,$jd);
            return mktime($h,$m,$s,$month,$day,$year,$is_dst);
        }
    }

    /*	F	*/
    function jgetdate($timestamp='',$none='',$tz='Asia/Tehran',$tn='en'){
        $ts=($timestamp=='')?time():$this->tr_num($timestamp);
        $jdate=explode('_',$this->jdate('F_G_i_j_l_n_s_w_Y_z',$ts,'',$tz,$tn));
        return array(
            'seconds'=>$this->tr_num((int)$this->tr_num($jdate[6]),$tn),
            'minutes'=>$this->tr_num((int)$this->tr_num($jdate[2]),$tn),
            'hours'=>$jdate[1],
            'mday'=>$jdate[3],
            'wday'=>$jdate[7],
            'mon'=>$jdate[5],
            'year'=>$jdate[8],
            'yday'=>$jdate[9],
            'weekday'=>$jdate[4],
            'month'=>$jdate[0],
            0=>$this->tr_num($ts,$tn)
        );
    }

    /*	F	*/
    function jcheckdate($jm,$jd,$jy){
        $jm=$this->tr_num($jm); $jd=$this->tr_num($jd); $jy=$this->tr_num($jy);
        $l_d=($jm==12)?(($jy%33%4-1==(int)($jy%33*.05))?30:29):31-(int)($jm/6.5);
        return($jm>0 and $jd>0 and $jy>0 and $jm<13 and $jd<=$l_d)?true:false;
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
            $num=(int)$this->tr_num($num);
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
                    $array[$type]=(($num>99)?str_ireplace(array('12','13','14','19','20')
                                ,array('هزار و دویست','هزار و سیصد','هزار و چهارصد','هزار و نهصد','دوهزار')
                                ,substr($num,0,2)).((substr($num,2,2)=='00')?'':' و '):'').$h3.$p34.$h34.$h4;
                    break;

                case'mm':
                    $key=array
                    ('فروردین','اردیبهشت','خرداد','تیر','مرداد','شهریور','مهر','آبان','آذر','دی','بهمن','اسفند');
                    $array[$type]=$key[$num-1];
                    break;

                case'rr':
                    $key=array('یک','دو','سه','چهار','پنج','شش','هفت','هشت','نه','ده','یازده','دوازده','سیزده',
                        'چهارده','پانزده','شانزده','هفده','هجده','نوزده','بیست','بیست و یک','بیست و دو','بیست و سه',
                        'بیست و چهار','بیست و پنج','بیست و شش','بیست و هفت','بیست و هشت','بیست و نه','سی','سی و یک');
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
        return($mod=='')?$array:implode($mod,$array);
    }

    /** Convertor from and to Gregorian and Jalali (Hijri_Shamsi,Solar) Functions
    Copyright(C)2011, Reza Gholampanahi [ http://jdf.scr.ir/jdf ] version 2.50 */

    /*	F	*/
    function gregorian_to_jalali($g_y,$g_m,$g_d,$mod=''){
        $g_y = $this->tr_num($g_y); $g_m=$this->tr_num($g_m); $g_d=$this->tr_num($g_d);/* <= :اين سطر ، جزء تابع اصلي نيست */
        $d_4=$g_y%4;
        $g_a=array(0,0,31,59,90,120,151,181,212,243,273,304,334);
        $doy_g=$g_a[(int)$g_m]+$g_d;
        if($d_4==0 and $g_m>2)$doy_g++;
        $d_33=(int)((($g_y-16)%132)*.0305);
        $a=($d_33==3 or $d_33<($d_4-1) or $d_4==0)?286:287;
        $b=(($d_33==1 or $d_33==2) and ($d_33==$d_4 or $d_4==1))?78:(($d_33==3 and $d_4==0)?80:79);
        if((int)(($g_y-10)/63)==30){$a--;$b++;}
        if($doy_g>$b){
            $jy=$g_y-621; $doy_j=$doy_g-$b;
        }else{
            $jy=$g_y-622; $doy_j=$doy_g+$a;
        }
        if($doy_j<187){
            $jm=(int)(($doy_j-1)/31); $jd=$doy_j-(31*$jm++);
        }else{
            $jm=(int)(($doy_j-187)/30); $jd=$doy_j-186-($jm*30); $jm+=7;
        }
        return($mod=='')?array($jy,$jm,$jd):$jy.$mod.$jm.$mod.$jd;
    }

    /*	F	*/
    function jalali_to_gregorian($j_y,$j_m,$j_d,$mod=''){
        $j_y=$this->tr_num($j_y); $j_m=$this->tr_num($j_m); $j_d=$this->tr_num($j_d);/* <= :اين سطر ، جزء تابع اصلي نيست */
        $d_4=($j_y+1)%4;
        $doy_j=($j_m<7)?(($j_m-1)*31)+$j_d:(($j_m-7)*30)+$j_d+186;
        $d_33=(int)((($j_y-55)%132)*.0305);
        $a=($d_33!=3 and $d_4<=$d_33)?287:286;
        $b=(($d_33==1 or $d_33==2) and ($d_33==$d_4 or $d_4==1))?78:(($d_33==3 and $d_4==0)?80:79);
        if((int)(($j_y-19)/63)==20){$a--;$b++;}
        if($doy_j<=$a){
            $gy=$j_y+621; $gd=$doy_j+$b;
        }else{
            $gy=$j_y+622; $gd=$doy_j-$a;
        }
        foreach(array(0,31,($gy%4==0)?29:28,31,30,31,30,31,31,30,31,30,31) as $gm=>$v){
            if($gd<=$v)break;
            $gd-=$v;
        }
        return($mod=='')?array($gy,$gm,$gd):$gy.$mod.$gm.$mod.$gd;
    }

    /* [ jdf.php ] version 2.55 ?> | [ http://jdf.scr.ir ] */

}
