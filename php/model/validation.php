<?php
setLocale(LC_ALL, 0);

/*
    Класс проверяет введенные пользователем данные в регистрационной форме,
    обрабатывает эти поля, и взводит флаги в случае возникновения ошибки
*/

class Validation
{
    //Флаги ошибок
    protected $boolErrorName = false;
    protected $boolErrorEmail = false;
    protected $boolErrorPassword = false;
    protected $boolErrorReppassword = false;
    protected $boolErrorGender = false;
    protected $boolErrorBirthDay = false;
    protected $boolErrorBirthMonth = false;
    protected $boolErrorBirthYear = false;
    //Массив с обработанными данными
    protected $aResult = array('name' => '',
        'email' => '',
        'password' => '',
        'gender' => true,
        'birth_day' => -1,
        'birth_month' => -1,
        'birth_year' => -1);

    /**
     * В конструкторе происходят все проверки, обработки и взведение флагов
     */
    function __construct($aForm)
    {
        if (empty($aForm['name'])
            || !$this->checkLength($aForm['name'], 2, 50)
            || !(preg_match("/[a-zA-Z\x20]/", $aForm['name'])
                || preg_match("/[а-яА-ЯЁё\x20]/u", $aForm['name']))) {
            $this->boolErrorName = true;
        } else {
            $this->boolErrorName = false;
            $this->aResult['name'] = $this->cleanString($aForm['name']);
        }
        if (empty($aForm['email']) || !filter_var($aForm['email'], FILTER_VALIDATE_EMAIL)) {
            $this->boolErrorEmail = true;
        } else {
            $this->boolErrorEmail = false;
            $this->aResult['email'] = $this->cleanString($aForm['email']);
        }
        if (empty($aForm['password']) || !$this->checkLength($aForm['password'], 6, 32) || !preg_match("/[a-zA-Z0-9\_\-\.]/", $aForm['password'])) {
            $this->boolErrorPassword = true;
        } else {
            $this->boolErrorPassword = false;
            $this->aResult['password'] = md5(sha1($this->cleanString($aForm['password'])));
        }
        if (empty($aForm['reppassword']) || strcmp($aForm['reppassword'], $aForm['password'])) {
            $this->boolErrorReppassword = true;
        } else {
            $this->boolErrorReppassword = false;
        }
        if (empty($aForm['gender']) || (strcmp($aForm['gender'], 'male') && strcmp($aForm['gender'], 'female'))) {
            $this->boolErrorGender = true;
        } else {
            $this->boolErrorGender = false;
            $this->aResult['gender'] = (!strcmp($aForm['gender'], 'male')) ? true : false;
        }
        if (empty($aForm['birth_day']) || !filter_var($aForm['birth_day'], FILTER_VALIDATE_INT) || $aForm['birth_day'] < 1 || $aForm['birth_day'] > 31) {
            $this->boolErrorBirthDay = true;
        } else {
            $this->boolErrorBirthDay = false;
            $this->aResult['birth_day'] = intval($aForm['birth_day']);
        }
        if (empty($aForm['birth_month']) || !filter_var($aForm['birth_month'], FILTER_VALIDATE_INT) || $aForm['birth_month'] < 1 || $aForm['birth_month'] > 12) {
            $this->boolErrorBirthMonth = true;
        } else {
            $this->boolErrorBirthMonth = false;
            $this->aResult['birth_month'] = intval($aForm['birth_month']);
        }
        if (empty($aForm['birth_year']) || !filter_var($aForm['birth_year'], FILTER_VALIDATE_INT) || $aForm['birth_year'] < 1900 || $aForm['birth_year'] > 2015) {
            $this->boolErrorBirthYear = true;
        } else {
            $this->boolErrorBirthYear = false;
            $this->aResult['birth_year'] = intval($aForm['birth_year']);
        }
    }

    /**
     * Статический метод очищающий строку от лишних символов
     */
    static function cleanString($sValue)
    {
        $sValue = trim($sValue);
        $sValue = stripslashes($sValue);
        $sValue = strip_tags($sValue);
        $sValue = htmlspecialchars($sValue);

        return $sValue;
    }

    /**
     * Провекра длины строки
     */
    static function checkLength($sValue = "", $iMin, $iMax)
    {
        $boolResult = (mb_strlen($sValue) < $iMin || mb_strlen($sValue) > $iMax);
        return !$boolResult;
    }

    /**
     * Метод возвращает true если взведен хоть один флаг ошибки
     */
    public function isError()
    {
        return $this->boolErrorName || $this->boolErrorEmail ||
            $this->boolErrorPassword || $this->boolErrorReppassword ||
            $this->boolErrorGender || $this->boolErrorBirthDay ||
            $this->boolErrorBirthMonth || $this->boolErrorBirthYear;
    }

    //Метод показывает была ли ошибка в имени
    public function isName()
    {
        return $this->boolErrorName;
    }

    //Метод показывает была ли ошибка в почте
    public function isEmail()
    {
        return $this->boolErrorEmail;
    }

    //Метод показывает была ли ошибка в пароле
    public function isPassword()
    {
        return $this->boolErrorPassword;
    }

    //Метод показывает была ли ошибка в повторном пароле
    public function isReppassword()
    {
        return $this->boolErrorReppassword;
    }

    //Метод показывает была ли ошибка в поле
    public function isGender()
    {
        return $this->boolErrorGender;
    }

    //Метод показывает была ли ошибка в дне рождения
    public function isBirth_day()
    {
        return $this->boolErrorBirthDay;
    }

    //Метод показывает была ли ошибка в месяце рождения
    public function isBirth_month()
    {
        return $this->boolErrorBirthMonth;
    }

    //Метод показывает была ли ошибка в годе рождения
    public function isBirth_year()
    {
        return $this->boolErrorBirthYear;
    }

    //Метод возвращает массив с обработанными данными
    public function getResult()
    {
        return $this->aResult;
    }
}

