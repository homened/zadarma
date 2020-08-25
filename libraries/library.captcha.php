<?php
/**
 * -A, U- Подъяпольский Владимир Андреевич,
 ** vladimir.brolib@gmail.com;
 *
 * -Date, Time- 2020.08.20;	
 * -D- Класс library_captcha отвечает за отрисовку капчи
*/
class library_captcha {
    private $captcha_name_number = 'CAPTCHA_NUMBER';
    /**
     * -D- Генерация картинки капчи
     */
    public function generateCaptchaIMG($color='#333', $bgcolor='#FFF') {
        $number = rand(1000000,9999999);
        $_SESSION[$this->captcha_name_number] = $number;

		$_img = imagecreatetruecolor(100,20);
		imagealphablending($_img, false);
		imagesavealpha($_img, true);

        $bg = $this->hex2rgb($bgcolor);
        $bg = imagecolorallocatealpha($_img, $bg[0], $bg[1], $bg[2], 0);

		imagefill($_img, 0, 0, $bg);

		$color = $this->hex2rgb($color);
		$color = imagecolorallocatealpha($_img, $color[0], $color[1], $color[2], 0); 

		imagestring($_img, 5, 18, 3, $number, $color);
		imageline($_img, 10, 8, 87, 8, $color);
		imageline($_img, 13, 12, 90, 12, $color);
		ob_start();
		imagepng($_img);
		$img64 = base64_encode(ob_get_clean());
		return '<img src="data:image/png;base64,'.$img64.'" />';
    }
    /**
     * -D- Проверка номера капчи
     */
	public function check($str) {
		return isset($_SESSION[$this->captcha_name_number]) && $str == $_SESSION[$this->captcha_name_number];
	}
    /**
     * -D- Преобразование HEX в RGB
     * -R- array
     */
	public function hex2rgb($rgb) {
		if(is_string($rgb)) {
			$rgb = str_replace('#','',$rgb);
			
			if(strlen($rgb)===3)
				$rgb = preg_replace('/^(.)(.)(.)$/','\\1\\1\\2\\2\\3\\3',$rgb);

			$r = hexdec(substr($rgb,0,2));
			$g = hexdec(substr($rgb,2,2));
			$b = hexdec(substr($rgb,4,2));
		} else {
			list($r, $g, $b) = $rgb;
			if($g==NULL || $b==NULL) {
				$r = $g = $b = $rgb;
			}
		}
		return array($r,$g,$b);
	}
}
?>