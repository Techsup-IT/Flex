<?php
class feature {
	private $address = null;
	private	$encryptkey = 'SHIFTCRYPT';
	/**
	 *
	 * @param
	 *       	 type 0 return first character of string in capital letter.
	 *
	 * @param
	 *       	 type 1 return first character of all word in capital letter.
	 *
	 * @param
	 *       	 type 2 return all character of string in small letters.
	 *
	 * @param
	 *       	 type 3 return all character of string in capital letters.
	 *
	 * @param
	 *       	 type 4 return first character of string in small letter.
	 *
	 * @param
	 *       	 type 5 return first character of all word in capital letter
	 *       	 (also convert other characters in small).
	 *
	 */
	public function textstyler($string, $type) {

		$str = trim ( preg_replace ( '/[^A-Za-z0-9\-]/', ' ', $string ) ); // Removes
		                                                                   // special
		                                                                   // chars.

		if ($type == 0) {
			return ucfirst ( $str );
		} elseif ($type == 1) {
			return ucwords ( $str );
		} elseif ($type == 2) {
			return strtolower ( $str );
		} elseif ($type == 3) {
			return strtoupper ( $str );
		} elseif ($type == 4) {
			return lcfirst ( $str );
		} elseif ($type == 5) {
			return ucwords ( strtolower ( $str ) );
		}
	}
	/**
	 *
	 * @param $string is
	 *       	 string
	 * @param $replacer is
	 *       	 the replace character which replace space from string.
	 */
	public function space_replacer($string, $replacer) {
		return str_replace ( ' ', $replacer, $string );
	}
	/**
	 *
	 * @param $string is
	 *       	 the string
	 * @return where new line in your string it replace with spaces string
	 *         return
	 */
	public function remove_newline($string) {
		return trim ( preg_replace ( '/\s+/', ' ', $string ) );
	}
	// distance calculator
	function getDistanceFromLatLonInKm($lat1, $lon1, $lat2, $lon2) {
		$R = 6371; // Radius of the earth in km
		$dLat = deg2rad ( $lat2 - $lat1 ); // deg2rad below
		$dLon = deg2rad ( $lon2 - $lon1 );
		$a = sin ( $dLat / 2 ) * sin ( $dLat / 2 ) + cos ( deg2rad ( $lat1 ) ) * cos ( deg2rad ( $lat2 ) ) * sin ( $dLon / 2 ) * sin ( $dLon / 2 );
		$c = 2 * (atan2 ( sqrt ( $a ), sqrt ( 1 - $a ) ));
		$distance = $R * $c; // Distance in km
		return $distance;
	}
	// get areas less than given kilometers and returns array
	function getcoveredareas_array($lat1, $lon1, $deliveryareasarray = array(), $kms) {
		foreach ( $deliveryareasarray as $key => $val ) {
			$dis = $this->getDistanceFromLatLonInKm ( $lat1, $lon1, $val ['lat'], $val ['lng'] );
			if ((($dis * .17) + $dis) <= $kms) {
				$getselected [] = $val ['id'];
				$getregion [] = $val ['region'];
			}
		}
		return (array_combine ( $getselected, $getregion ));
	}

	function getOS() {

		$user_agent=$_SERVER['HTTP_USER_AGENT'];

		$os_platform    =   "Unknown OS Platform";

		$os_array       =   array(
				'/windows nt 6.2/i'     =>  'Windows 8',
				'/windows nt 6.1/i'     =>  'Windows 7',
				'/windows nt 6.0/i'     =>  'Windows Vista',
				'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
				'/windows nt 5.1/i'     =>  'Windows XP',
				'/windows xp/i'         =>  'Windows XP',
				'/windows nt 5.0/i'     =>  'Windows 2000',
				'/windows me/i'         =>  'Windows ME',
				'/win98/i'              =>  'Windows 98',
				'/win95/i'              =>  'Windows 95',
				'/win16/i'              =>  'Windows 3.11',
				'/macintosh|mac os x/i' =>  'Mac OS X',
				'/mac_powerpc/i'        =>  'Mac OS 9',
				'/linux/i'              =>  'Linux',
				'/ubuntu/i'             =>  'Ubuntu',
				'/iphone/i'             =>  'iPhone',
				'/ipod/i'               =>  'iPod',
				'/ipad/i'               =>  'iPad',
				'/android/i'            =>  'Android',
				'/blackberry/i'         =>  'BlackBerry',
				'/webos/i'              =>  'Mobile'
		);

		foreach ($os_array as $regex => $value) {

			if (preg_match($regex, $user_agent)) {
				$os_platform    =   $value;
			}

		}

		return $os_platform;

	}
	/* get all time zones in an array
	 * */
	function get_timezones() {
		$zones_array = array();
		$timestamp = time();
		foreach(timezone_identifiers_list() as $key => $zone) {
			date_default_timezone_set($zone);
			$zones_array[$key]['zone'] = $zone;
			$zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
		}
		return $zones_array;
	}

	function getBrowser() {

		$user_agent=$_SERVER['HTTP_USER_AGENT'];

		$browser        =   "Unknown Browser";

		$browser_array  =   array(
				'/msie/i'       =>  'IE',
				'/firefox/i'    =>  'Firefox',
				'/safari/i'     =>  'Safari',
				'/chrome/i'     =>  'Chrome',
				'/opera/i'      =>  'Opera',
				'/netscape/i'   =>  'Netscape',
				'/maxthon/i'    =>  'Maxthon',
				'/konqueror/i'  =>  'Konqueror',
				'/mobile/i'     =>  'Handheld Browser'
		);

		foreach ($browser_array as $regex => $value) {

			if (preg_match($regex, $user_agent)) {
				$browser    =   $value;
			}

		}

		return $browser;

	}


	function createDateRangeArray($strDateFrom,$strDateTo)
	{
		// takes two dates formatted as YYYY-MM-DD and creates an
		// inclusive array of the dates between the from and to dates.

		// could test validity of dates here but I'm already doing
		// that in the main script

		$aryRange=array();

		$iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
		$iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

		if ($iDateTo>=$iDateFrom)
		{
			array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
			while ($iDateFrom<$iDateTo)
			{
				$iDateFrom+=86400; // add 24 hours
				array_push($aryRange,date('Y-m-d',$iDateFrom));
			}
		}
		return $aryRange;
	}
	public function rrmdir($dir) {
		if (is_dir($dir)) {
			$objects = scandir($dir);
			foreach ($objects as $object) {
				if ($object != "." && $object != ".." ){
					if (filetype($dir."/".$object) == "dir")
							self::rrmdir($dir."/".$object);
					else unlink   ($dir."/".$object);
				}
			}
			reset($objects);
			rmdir($dir);
		}
	}
	public function forecast($address)
	{
	    $BASE_URL = "http://query.yahooapis.com/v1/public/yql";
	    $yql_query = 'select * from weather.forecast where woeid in (select woeid from geo.places(1) where text="'.$address.'")';
	    $yql_query_url = $BASE_URL . "?q=" . urlencode($yql_query) . "&format=json&store=env";
	    // Make call with cURL
	    $session = curl_init($yql_query_url);
	    curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
	    $json = curl_exec($session);
	    // Convert JSON to PHP object
	    $phpObj =  (array)(json_decode($json));
	    $query=(array)$phpObj['query'];
	    $results=(array)$query['results'];
	    // print_r($results);
	    $channel=(array)$results['channel'];
	    $item=(array)$channel['item'];
	   return($item['forecast']);
	}


/**
 * @param
 * encrypt('192', md5($encryptkey,true));
 */
	public function encrypt($id, $key=NULL)
	{
	    if($key==NULL)
	    {
	        $key= md5($encryptkey,true);
	    }
	    $id = base_convert($id,10, 36); // Save some space
	    $data = mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $id, 'ecb');
	    $data = bin2hex($data);

	    return $data;
	}
	/**
	 * @param
	 * decrypt($e, md5($encryptkey,true));
	 */
	public function decrypt($encrypted_id, $key=NULL)
	{
	    if($key==NULL)
	    {
	        $key= md5($encryptkey,true);
	    }
	    $data = pack('H*', $encrypted_id); // Translate back to binary
	    $data = mcrypt_decrypt(MCRYPT_BLOWFISH, $key, $data, 'ecb');
	    $data = base_convert($data, 36, 10);

	    return $data;
	}

	public function convertPHPSizeToBytes($sSize)
	{
	    if ( is_numeric( $sSize) ) {
	        return $sSize;
	    }
	    $sSuffix = substr($sSize, -1);
	    $iValue = substr($sSize, 0, -1);
	    switch(strtoupper($sSuffix)){
	        case 'P':
	            $iValue *= 1024;
	        case 'T':
	            $iValue *= 1024;
	        case 'G':
	            $iValue *= 1024;
	        case 'M':
	            $iValue *= 1024;
	        case 'K':
	            $iValue *= 1024;
	            break;
	    }
	    return $iValue;
	}

	public function getMaximumFileUploadSize()
	{
	    return min(self::convertPHPSizeToBytes(ini_get('post_max_size')), self::convertPHPSizeToBytes(ini_get('upload_max_filesize')));
	}
	public static function verifyPurchase($userName, $apiKey , $purchaseCode, $itemId = false) {

	    // Open cURL channel
	    $ch = curl_init();

	    // Set cURL options
	    curl_setopt($ch, CURLOPT_URL, "http://marketplace.envato.com/api/edge/$userName/$apiKey/verify-purchase:$purchaseCode.json");
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_USERAGENT, 'ENVATO-PURCHASE-VERIFY'); //api requires any user agent to be set

	    // Decode returned JSON
	    $result = json_decode( curl_exec($ch) , true );

	    //check if purchase code is correct
	    if ( !empty($result['verify-purchase']['item_id']) && $result['verify-purchase']['item_id'] ) {
	        //if no item name is given - any valid purchase code will work
	        if ( !$itemId ) return true;
	        //else - also check if purchased item is given item to check
	        return $result['verify-purchase']['item_id'] == $itemId;
	    }

	    //invalid purchase code
	    return false;

	}
	function cardType($number)
	{
	    $number=preg_replace('/[^\d]/','',$number);
	    if (preg_match('/^3[47][0-9]{13}$/',$number))
	    {
	        return 'american_express';
	    }
	    elseif (preg_match('/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/',$number))
	    {
	        return 'diners_club';
	    }
	    elseif (preg_match('/^6(?:011|5[0-9][0-9])[0-9]{12}$/',$number))
	    {
	        return 'discover';
	    }
	    elseif (preg_match('/^(?:2131|1800|35\d{3})\d{11}$/',$number))
	    {
	        return 'jcb';
	    }
	    elseif (preg_match('/^5[1-5][0-9]{14}$/',$number))
	    {
	        return 'mastercard';
	    }
	    elseif (preg_match('/^4[0-9]{12}(?:[0-9]{3})?$/',$number))
	    {
	        return 'visa';
	    }
	    else
	    {
	        return 'Unknown';
	    }
	}
	public function getcountry_list()
	{
		return $countryList = array(
				"AF" => "Afghanistan",
				"AL" => "Albania",
				"DZ" => "Algeria",
				"AS" => "American Samoa",
				"AD" => "Andorra",
				"AO" => "Angola",
				"AI" => "Anguilla",
				"AQ" => "Antarctica",
				"AG" => "Antigua and Barbuda",
				"AR" => "Argentina",
				"AM" => "Armenia",
				"AW" => "Aruba",
				"AU" => "Australia",
				"AT" => "Austria",
				"AZ" => "Azerbaijan",
				"BS" => "Bahamas",
				"BH" => "Bahrain",
				"BD" => "Bangladesh",
				"BB" => "Barbados",
				"BY" => "Belarus",
				"BE" => "Belgium",
				"BZ" => "Belize",
				"BJ" => "Benin",
				"BM" => "Bermuda",
				"BT" => "Bhutan",
				"BO" => "Bolivia",
				"BA" => "Bosnia and Herzegovina",
				"BW" => "Botswana",
				"BV" => "Bouvet Island",
				"BR" => "Brazil",
				"BQ" => "British Antarctic Territory",
				"IO" => "British Indian Ocean Territory",
				"VG" => "British Virgin Islands",
				"BN" => "Brunei",
				"BG" => "Bulgaria",
				"BF" => "Burkina Faso",
				"BI" => "Burundi",
				"KH" => "Cambodia",
				"CM" => "Cameroon",
				"CA" => "Canada",
				"CT" => "Canton and Enderbury Islands",
				"CV" => "Cape Verde",
				"KY" => "Cayman Islands",
				"CF" => "Central African Republic",
				"TD" => "Chad",
				"CL" => "Chile",
				"CN" => "China",
				"CX" => "Christmas Island",
				"CC" => "Cocos [Keeling] Islands",
				"CO" => "Colombia",
				"KM" => "Comoros",
				"CG" => "Congo - Brazzaville",
				"CD" => "Congo - Kinshasa",
				"CK" => "Cook Islands",
				"CR" => "Costa Rica",
				"HR" => "Croatia",
				"CU" => "Cuba",
				"CY" => "Cyprus",
				"CZ" => "Czech Republic",
				"CI" => "Cote d Ivoire",
				"DK" => "Denmark",
				"DJ" => "Djibouti",
				"DM" => "Dominica",
				"DO" => "Dominican Republic",
				"NQ" => "Dronning Maud Land",
				"DD" => "East Germany",
				"EC" => "Ecuador",
				"EG" => "Egypt",
				"SV" => "El Salvador",
				"GQ" => "Equatorial Guinea",
				"ER" => "Eritrea",
				"EE" => "Estonia",
				"ET" => "Ethiopia",
				"FK" => "Falkland Islands",
				"FO" => "Faroe Islands",
				"FJ" => "Fiji",
				"FI" => "Finland",
				"FR" => "France",
				"GF" => "French Guiana",
				"PF" => "French Polynesia",
				"TF" => "French Southern Territories",
				"FQ" => "French Southern and Antarctic Territories",
				"GA" => "Gabon",
				"GM" => "Gambia",
				"GE" => "Georgia",
				"DE" => "Germany",
				"GH" => "Ghana",
				"GI" => "Gibraltar",
				"GR" => "Greece",
				"GL" => "Greenland",
				"GD" => "Grenada",
				"GP" => "Guadeloupe",
				"GU" => "Guam",
				"GT" => "Guatemala",
				"GG" => "Guernsey",
				"GN" => "Guinea",
				"GW" => "Guinea-Bissau",
				"GY" => "Guyana",
				"HT" => "Haiti",
				"HM" => "Heard Island and McDonald Islands",
				"HN" => "Honduras",
				"HK" => "Hong Kong SAR China",
				"HU" => "Hungary",
				"IS" => "Iceland",
				"IN" => "India",
				"ID" => "Indonesia",
				"IR" => "Iran",
				"IQ" => "Iraq",
				"IE" => "Ireland",
				"IM" => "Isle of Man",
				"IL" => "Israel",
				"IT" => "Italy",
				"JM" => "Jamaica",
				"JP" => "Japan",
				"JE" => "Jersey",
				"JT" => "Johnston Island",
				"JO" => "Jordan",
				"KZ" => "Kazakhstan",
				"KE" => "Kenya",
				"KI" => "Kiribati",
				"KW" => "Kuwait",
				"KG" => "Kyrgyzstan",
				"LA" => "Laos",
				"LV" => "Latvia",
				"LB" => "Lebanon",
				"LS" => "Lesotho",
				"LR" => "Liberia",
				"LY" => "Libya",
				"LI" => "Liechtenstein",
				"LT" => "Lithuania",
				"LU" => "Luxembourg",
				"MO" => "Macau SAR China",
				"MK" => "Macedonia",
				"MG" => "Madagascar",
				"MW" => "Malawi",
				"MY" => "Malaysia",
				"MV" => "Maldives",
				"ML" => "Mali",
				"MT" => "Malta",
				"MH" => "Marshall Islands",
				"MQ" => "Martinique",
				"MR" => "Mauritania",
				"MU" => "Mauritius",
				"YT" => "Mayotte",
				"FX" => "Metropolitan France",
				"MX" => "Mexico",
				"FM" => "Micronesia",
				"MI" => "Midway Islands",
				"MD" => "Moldova",
				"MC" => "Monaco",
				"MN" => "Mongolia",
				"ME" => "Montenegro",
				"MS" => "Montserrat",
				"MA" => "Morocco",
				"MZ" => "Mozambique",
				"MM" => "Myanmar [Burma]",
				"NA" => "Namibia",
				"NR" => "Nauru",
				"NP" => "Nepal",
				"NL" => "Netherlands",
				"AN" => "Netherlands Antilles",
				"NT" => "Neutral Zone",
				"NC" => "New Caledonia",
				"NZ" => "New Zealand",
				"NI" => "Nicaragua",
				"NE" => "Niger",
				"NG" => "Nigeria",
				"NU" => "Niue",
				"NF" => "Norfolk Island",
				"KP" => "North Korea",
				"VD" => "North Vietnam",
				"MP" => "Northern Mariana Islands",
				"NO" => "Norway",
				"OM" => "Oman",
				"PC" => "Pacific Islands Trust Territory",
				"PK" => "Pakistan",
				"PW" => "Palau",
				"PS" => "Palestinian Territories",
				"PA" => "Panama",
				"PZ" => "Panama Canal Zone",
				"PG" => "Papua New Guinea",
				"PY" => "Paraguay",
				"YD" => "People's Democratic Republic of Yemen",
				"PE" => "Peru",
				"PH" => "Philippines",
				"PN" => "Pitcairn Islands",
				"PL" => "Poland",
				"PT" => "Portugal",
				"PR" => "Puerto Rico",
				"QA" => "Qatar",
				"RO" => "Romania",
				"RU" => "Russia",
				"RW" => "Rwanda",
				"RE" => "Reunion",
				"BL" => "Saint Barthelemy",
				"SH" => "Saint Helena",
				"KN" => "Saint Kitts and Nevis",
				"LC" => "Saint Lucia",
				"MF" => "Saint Martin",
				"PM" => "Saint Pierre and Miquelon",
				"VC" => "Saint Vincent and the Grenadines",
				"WS" => "Samoa",
				"SM" => "San Marino",
				"SA" => "Saudi Arabia",
				"SN" => "Senegal",
				"RS" => "Serbia",
				"CS" => "Serbia and Montenegro",
				"SC" => "Seychelles",
				"SL" => "Sierra Leone",
				"SG" => "Singapore",
				"SK" => "Slovakia",
				"SI" => "Slovenia",
				"SB" => "Solomon Islands",
				"SO" => "Somalia",
				"ZA" => "South Africa",
				"GS" => "South Georgia and the South Sandwich Islands",
				"KR" => "South Korea",
				"ES" => "Spain",
				"LK" => "Sri Lanka",
				"SD" => "Sudan",
				"SR" => "Suriname",
				"SJ" => "Svalbard and Jan Mayen",
				"SZ" => "Swaziland",
				"SE" => "Sweden",
				"CH" => "Switzerland",
				"SY" => "Syria",
				"ST" => "Sao Tome and Principe",
				"TW" => "Taiwan",
				"TJ" => "Tajikistan",
				"TZ" => "Tanzania",
				"TH" => "Thailand",
				"TL" => "Timor-Leste",
				"TG" => "Togo",
				"TK" => "Tokelau",
				"TO" => "Tonga",
				"TT" => "Trinidad and Tobago",
				"TN" => "Tunisia",
				"TR" => "Turkey",
				"TM" => "Turkmenistan",
				"TC" => "Turks and Caicos Islands",
				"TV" => "Tuvalu",
				"UM" => "U.S. Minor Outlying Islands",
				"PU" => "U.S. Miscellaneous Pacific Islands",
				"VI" => "U.S. Virgin Islands",
				"UG" => "Uganda",
				"UA" => "Ukraine",
				"SU" => "Union of Soviet Socialist Republics",
				"AE" => "United Arab Emirates",
				"GB" => "United Kingdom",
				"US" => "United States",
				"ZZ" => "Unknown or Invalid Region",
				"UY" => "Uruguay",
				"UZ" => "Uzbekistan",
				"VU" => "Vanuatu",
				"VA" => "Vatican City",
				"VE" => "Venezuela",
				"VN" => "Vietnam",
				"WK" => "Wake Island",
				"WF" => "Wallis and Futuna",
				"EH" => "Western Sahara",
				"YE" => "Yemen",
				"ZM" => "Zambia",
				"ZW" => "Zimbabwe",
				"AX" => "Aland Islands",
		);
	}
	function time_elapsed_string($datetime, $full = false) {
	   // date_default_timezone_set(new_timezone);
	    $now = new DateTime;
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);

	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;

	    $string = array(
	        'y' => 'year',
	        'm' => 'month',
	        'w' => 'week',
	        'd' => 'day',
	        'h' => 'hour',
	        'i' => 'minute',
	        's' => 'second',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	        } else {
	            unset($string[$k]);
	        }
	    }

	    if (!$full) $string = array_slice($string, 0, 1);
	    return $string ? implode(', ', $string) . ' ago' : 'just now';
	}



	function convertTimeZone($oTime,$var=null)
	{

		/*
		 * otime must be in 2017-03-25 H:i:s format
		 */
		$nTimeZone=new_timezone;
		$oTimeZone=default_timezone;

		date_default_timezone_set($oTimeZone);

		$originalTime = new DateTime($oTime);

		$originalTime->setTimeZone(new DateTimeZone($nTimeZone));
		date_default_timezone_set($oTimeZone);

		if(SITE_DATE_FORMAT==1 && $var==null)
		{
		return $originalTime->format('d-m-Y');
		}elseif(SITE_DATE_FORMAT==2 && $var==null)
		{
			return $originalTime->format('m-d-Y');
		}
		elseif(SITE_DATE_FORMAT==3 && $var==null)
		{
			return $originalTime->format('d-M-Y');
		}
		elseif($var=='appdate')
		{
			return $originalTime->format('Y-m-d');
		}
		elseif($var=='time')
		{
			return $originalTime->format('H:i:s');
		}

elseif($var=='false'){
		return $originalTime->format('F-d-Y H:i:s');
	}

}
}
?>