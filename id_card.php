function getIDCardInfo($IDCard, $format = 1) {
        $result['error'] = 0;
        //0：未知错误，1：身份证格式错误，2：无错误
        $result['flag'] = '';
        //0标示成年，1标示未成年
        $result['tdate'] = '';
        //生日，格式如：2012-11-15
        if (!preg_match("/^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/", $IDCard)) {
            $result['error'] = 1;
            return $result;
        } else {
            if (strlen($IDCard) == 18) {
                $tyear = intval(substr($IDCard, 6, 4));
                $tmonth = intval(substr($IDCard, 10, 2));
                $tday = intval(substr($IDCard, 12, 2));
            } elseif (strlen($IDCard) == 15) {
                $tyear = intval("19" . substr($IDCard, 6, 2));
                $tmonth = intval(substr($IDCard, 8, 2));
                $tday = intval(substr($IDCard, 10, 2));
            }
            if ($tyear > date("Y") || $tyear < (date("Y") - 100)) {
                $flag = 0;
            } elseif ($tmonth < 0 || $tmonth > 12) {
                $flag = 0;
            } elseif ($tday < 0 || $tday > 31) {
                $flag = 0;
            } else {
                if ($format) {
                    $tdate = $tyear . "-" . $tmonth . "-" . $tday;
                } else {
                    $tdate = $tmonth . "-" . $tday;
                }
                if ((time() - mktime(0, 0, 0, $tmonth, $tday, $tyear)) > 18 * 365 * 24 * 60 * 60) {
                    $flag = 0;
                } else {
                    $flag = 1;
                }
            }
        }
        $result['error'] = 2;
        //0：未知错误，1：身份证格式错误，2：无错误
        $result['isAdult'] = $flag;
        //0标示成年，1标示未成年
        $result['birthday'] = $tdate;
        //生日日期
        return $result;
    }
