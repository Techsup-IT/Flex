<?php 
class password extends feature {
	// get a new hash for a password
	public function stringbreak ($postpassword)
	{
		$salt=sha1($postpassword);
		$arr= strlen($postpassword);
		$count=ceil($arr/2);
		$stringarr=str_split($postpassword,$count);
		$password1=hash("sha512", $stringarr['0']); 
		$password2=$salt . ( hash( 'whirlpool', $salt . $stringarr['1'] ) );
		return $password1.$password2.$_SERVER['REMOTE_ADDR'].self::getBrowser().self::getOS();
	} 
	
	/**
	 * Generates a bcrypt hash of a password, which can be stored in a database.
	 * @param string $password Password whose hash-value we need.
	 * @param int $cost Controls the number of iterations. Increasing the cost
	 *   by 1, doubles the needed calculation time. Must be in the range of 4-31.
	 * @param string $serverSideKey This key acts similar to a pepper, but
	 *   can be exchanged when necessary. In certain situations, encrypting
	 *   the hash-value can protect weak passwords from a dictionary attack.
	 * @return string Hash-value of the password. A random salt is included.
	 *   Without passing a $serverSideKey the result has a length of 60
	 *   characters, with a $serverSideKey the length is 108 characters.
	 */
	public static function hashBcrypt($password, $cost=10, $serverSideKey='')
	{
		$serverSideKey = 'PASSWORD_DEFAULT';
		if (!defined('CRYPT_BLOWFISH')) throw new Exception('The CRYPT_BLOWFISH algorithm is required (PHP 5.3).');
		if ($cost < 4 || $cost > 31) throw new InvalidArgumentException('The cost factor must be a number between 4 and 31');
	
		if (version_compare(PHP_VERSION, '5.3.7') >= 0)
			$algorithm = '2y'; // BCrypt, with fixed unicode problem
		else
			$algorithm = '2a'; // BCrypt
	
		// BCrypt expects nearly the same alphabet as base64_encode returns,
		// but instead of the '+' characters it accepts '.' characters.
		// BCrypt alphabet: ./0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz
		$salt = str_replace('+', '.', password::generateRandomBase64String(22));
	
		// Create crypt parameters: $algorithm$cost$salt
		$cryptParams = sprintf('$%s$%02d$%s', $algorithm, $cost, $salt);
		$hash = crypt($password, $cryptParams);
	
		// Encrypt hash with the server side key
		if ($serverSideKey != '')
		{
			$encryptedHash = password::encryptTwofish($hash, $serverSideKey);
			$hash = base64_encode($encryptedHash);
		}
		return $hash;
	}
	
	/**
	 * Checks, if the password matches a given hash value. This is useful when
	 * a user enters his password for login, to check if the password corresponds
	 * to the hash stored in the database.
	 * @param string $password Password to check.
	 * @param string $existingHash Stored hash-value from the database.
	 * @param string $serverSideKey Pass the same key that was used to encrypt
	 *   $existingHash, or omit this parameter if no key was used.
	 * @return bool Returns true, if the password matches the hash,
	 *   otherwise false.
	 */
	public static function verify($password, $existingHash, $serverSideKey='')
	{
		$serverSideKey = 'PASSWORD_DEFAULT';
		if (!defined('CRYPT_BLOWFISH')) throw new Exception('The CRYPT_BLOWFISH algorithm is required (PHP 5.3).');
	
		// Decrypt hash with the server side key
		if ($serverSideKey != '')
		{
			$encryptedHash = base64_decode($existingHash);
			$existingHash = password::decryptTwofish($encryptedHash, $serverSideKey);
		}
	
		// The parameters that where used to generate $existingHash, will be
		// extracted automatically from the first 29 characters of $existingHash.
		$newHash = crypt($password, $existingHash);
		return $newHash === $existingHash;
	}
	
	/**
	 * Allows to change the server-side key, or to add/remove the encryption.
	 * @param string $existingHash Encrypted or unencrypted hash-value.
	 * @param string $oldKey Pass the key, that was used to encrypt
	 *   $existingHash, or pass '' if the hash is not yet encrypted.
	 * @param string $newKey Pass a new key, to encrypt $existingHash, or
	 *   pass '' to remove the encryption.
	 * @return string New encrypted/decrypted hash-value.
	 */
	public static function changeServerSideKey($existingHash, $oldKey, $newKey)
	{
		// decrypt hash-value
		$hash = $existingHash;
		if ($oldKey != '')
		{
			$encryptedHash = base64_decode($hash);
			$hash = password::decryptTwofish($encryptedHash, $oldKey);
		}
	
		// encrypt hash-value
		if ($newKey != '')
		{
			$encryptedHash = password::encryptTwofish($hash, $newKey);
			$hash = base64_encode($encryptedHash);
		}
		return $hash;
	}
	
			
	/**
	 * Encrypts data with the TWOFISH algorithm. The IV vector will be
	 * included in the resulting binary string.
	 * @param string $data Data to encrypt. Trailing \0 characters will get lost.
	 * @param string $key This key will be used to encrypt the data. The key
	 *   will be hashed to a binary representation before it is used.
	 * @return string Returns the encrypted data in form of a binary string.
	 */
	public static function encryptTwofish($data, $key)
	{
		if (!defined('MCRYPT_DEV_URANDOM')) throw new Exception('The MCRYPT_DEV_URANDOM source is required (PHP 5.3).');
		if (!defined('MCRYPT_TWOFISH')) throw new Exception('The MCRYPT_TWOFISH algorithm is required (PHP 5.3).');
	
		// The cbc mode is preferable over the ecb mode
		$td = mcrypt_module_open(MCRYPT_TWOFISH, '', MCRYPT_MODE_CBC, '');
	
		// Twofish accepts a key of 32 bytes. Because usually longer strings
		// with only readable characters are passed, we build a binary string.
		$binaryKey = hash('sha256', $key, true);
	
		// Create initialization vector of 16 bytes
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_DEV_URANDOM);
	
		mcrypt_generic_init($td, $binaryKey, $iv);
		$encryptedData = mcrypt_generic($td, $data);
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
	
		// Combine iv and encrypted text
		return $iv . $encryptedData;
	}
	
	/**
	 * Decrypts data, formerly encrypted with @see encryptTwofish.
	 * @param string $encryptedData Binary string with encrypted data.
	 * @param string $key This key will be used to decrypt the data.
	 * @return string Returns the original decrypted data.
	 */
	public static function decryptTwofish($encryptedData, $key)
	{
		if (!defined('MCRYPT_TWOFISH')) throw new Exception('The MCRYPT_TWOFISH algorithm is required (PHP 5.3).');
	
		$td = mcrypt_module_open(MCRYPT_TWOFISH, '', MCRYPT_MODE_CBC, '');
	
		// Extract initialization vector from encrypted data
		$ivSize = mcrypt_enc_get_iv_size($td);
		$iv = substr($encryptedData, 0, $ivSize);
		$encryptedData = substr($encryptedData, $ivSize);
	
		$binaryKey = hash('sha256', $key, true);
	
		mcrypt_generic_init($td, $binaryKey, $iv);
		$decryptedData = mdecrypt_generic($td, $encryptedData);
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
	
		// Original data was padded with 0-characters to block-size
		return rtrim($decryptedData, "\0");
	}
	
	protected static function calculateTwofishLength($inputLength)
	{
		$td = mcrypt_module_open(MCRYPT_TWOFISH, '', MCRYPT_MODE_CBC, '');
		$ivSize = mcrypt_enc_get_iv_size($td);
		$blockSize = mcrypt_enc_get_block_size($td);
		mcrypt_module_close($td);
		return $ivSize + ceil($inputLength / $blockSize) * $blockSize;
	}
	/**
	 * Generates a new token, that can be used to build a password reset link.
	 * Like a password, the token itself should not be stored in the database,
	 * rather store its hash-value.
	 * @param string $tokenForLink This variable receives the new generated
	 *   random token. It will be used to build the password reset link.
	 * @param string $hashedTokenForDatabase This variable receives the hash-value
	 *   of the token (bcrypt). It can be safely stored in the database and
	 *   is always 60 characters in length.
	 */
	public static function generateNewToken(&$tokenForLink, &$hashedTokenForDatabase)
	{
		$tokenLength = 20;
		$tokenForLink = password::generateRandomBase62String($tokenLength);
		$hashedTokenForDatabase = password::hashTokenWithBcrypt($tokenForLink);
	}
	
	/**
	 * Builds a code that can be used as parameter in an email link URL.
	 * @param int $databaseRowId After storing the hash-value of the token to the
	 *   database, you know the id of the new created row. This id, is needed
	 *   later, to find the hash-value again.
	 * @param string $tokenForLink The token we generated before with
	 *   password::generateNewToken().
	 * @return string Code that can be used in an url.
	 */
	public static function buildLinkCode($databaseRowId, $tokenForLink)
	{
		$base62EncodedRowId = StoBase62Encoder::intToBase62($databaseRowId);
		return sprintf('%s-%s', $base62EncodedRowId, $tokenForLink);
	}
	
	/**
	 * This function extracts and validates the token and the id from a link code.
	 * @param string $linkCode The code from the user clicked link.
	 * @param int $databaseRowId Receives the extracted id of the database row.
	 * @param string $tokenFromLink Receives the extracted token.
	 * @return bool Returns true if the token could be extracted and is in
	 *   a valid form, otherwise false.
	 */
	public static function parseLinkCode($linkCode, &$databaseRowId, &$tokenFromLink)
	{
		$databaseRowId = null;
		$tokenFromLink = null;
		if (is_null($linkCode))
			return false;
	
		$codeParts = explode('-', $linkCode);
	
		// validate all parts of the link code
		if (count($codeParts) !== 2)
			return false; // needs 2 parts
		if (!ctype_alnum($codeParts[0]))
			return false; // only 0..9, a..z, A..Z allowed
		if (!ctype_alnum($codeParts[1]))
			return false; // only 0..9, a..z, A..Z allowed
	
		$databaseRowId = StoBase62Encoder::base62ToInt($codeParts[0]);
		$tokenFromLink = $codeParts[1];
		return true;
	}
	
	/**
	 * Checks if the token, matches the stored hash from the database.
	 * @param string $tokenFromLink Token that was extracted from the clicked link.
	 * @param string $hashedTokenFromDatabase The hash-value of the token, that
	 *   was stored in the database.
	 * @return bool Returns true, if the token matches the hash, otherwise false.
	 */
	public static function verifyToken($tokenFromLink, $hashedTokenFromDatabase)
	{
		if (!defined('CRYPT_BLOWFISH')) die('The CRYPT_BLOWFISH algorithm is required (PHP 5.3).');
	
		$hashedToken = crypt($tokenFromLink, $hashedTokenFromDatabase);
		return $hashedToken === $hashedTokenFromDatabase;
	}
	
	/**
	 * Generates a random string of a given length, using the random source of
	 * the operating system. The string contains only safe characters of this
	 * alphabet: 0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz
	 * @param int $length Number of characters the string should have.
	 * @return string A random base62 encoded string.
	 */
	protected static function generateRandomBase62String($length)
	{
		if (!defined('MCRYPT_DEV_URANDOM')) die('The MCRYPT_DEV_URANDOM source is required (PHP 5.3).');
	
		// Generate random bytes, using the operating system's random source.
		// Since PHP 5.3 this also uses the random source on a Windows server.
		// Unlike /dev/random, the /dev/urandom does not block the server, if
		// there is not enough entropy available.
		$randomBinaryString = mcrypt_create_iv($length, MCRYPT_DEV_URANDOM);
		$randomBase62String = StoBase62Encoder::base62encode($randomBinaryString);
		return substr($randomBase62String, 0, $length);
	}
	
	/**
	 * Generates a random string of a given length, using the random source of
	 * the operating system. The string contains only characters of this
	 * alphabet: +/0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz
	 * @param int $length Number of characters the string should have.
	 * @return string A random base64 encoded string.
	 */
	protected static function generateRandomBase64String($length)
	{
		if (!defined('MCRYPT_DEV_URANDOM')) die('The MCRYPT_DEV_URANDOM source is required (PHP 5.3).');
	
		// Generate random bytes, using the operating system's random source.
		// Since PHP 5.3 this also uses the random source on a Windows server.
		// Unlike /dev/random, the /dev/urandom does not block the server, if
		// there is not enough entropy available.
		$binaryLength = (int)($length * 3 / 4 + 1);
		$randomBinaryString = mcrypt_create_iv($binaryLength, MCRYPT_DEV_URANDOM);
		$randomBase64String = base64_encode($randomBinaryString);
		return substr($randomBase64String, 0, $length);
	}
	
	/**
	 * Hashes a token with BCrypt for storing in the database.
	 * @param string $tokenForLink Token to build the hash from.
	 * @param int $cost Cost factor for BCrypt. Unlike passwords, our
	 *   generated tokens are very strong, so the cost factor can be small.
	 * @return string Hash value of token, 60 characters in length.
	 */
	protected static function hashTokenWithBcrypt($tokenForLink, $cost=6)
	{
		if (!defined('CRYPT_BLOWFISH')) die('The CRYPT_BLOWFISH algorithm is required (PHP 5.3).');
	
		// Since $token never contains unicode characters, the BCrypt constant
		// '2a' suffices, it is supported by more PHP versions than '2y'.
		$algorithm = '2a';
	
		// BCrypt expects nearly the same alphabet as base64_encode returns,
		// but instead of the '+' characters it accepts '.' characters.
		// BCrypt alphabet: ./0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz
		$base64String = password::generateRandomBase64String(22);
		$salt = str_replace('+', '.', $base64String);
	
		// Create crypt parameters: $algorithm$cost$salt
		$cryptParams = sprintf('$%s$%02d$%s', $algorithm, $cost, $salt);
		return crypt($tokenForLink, $cryptParams);
	}
	}
	
	/**
	 * Like base64-encoding, base62-encoding allows to convert a string with any
	 * characters, to a string of a given alphabet. Base62 encoded data will contain
	 * only safe characters 0-9 A-Z a-z without any special characters, nevertheless
	 * it's a very compact format. Such strings can be safely used as tokens in an URL.
	 */
	class StoBase62Encoder
	{
		// The same alphabet as is used in the GMP library.
		protected static $base62Alphabet = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		protected static $asciiAlphabet = null; // Initialize before use
	
		/**
		 * Encodes a string to the base62 alphabet. The input string may contain any
		 * character, so the function can also be used with binary data. Leading "\0"
		 * characters are preserved.
		 * The length of the result is always in the range of 1 until 1.34 times the
		 * input length. The exact maximum is: ceil(log(pow(256, $inputLength), 62)).
		 * @param string $byteString String to encode, which may contain binary data.
		 * @return string Base62 encoded string.
		 */
		public static function base62encode($byteString)
		{
			if (is_null(StoBase62Encoder::$asciiAlphabet))
				StoBase62Encoder::initializeAsciiAlphabet();
	
			$decimalString = StoBase62Encoder::baseStringToDecimalString(
					$byteString, StoBase62Encoder::$asciiAlphabet);
			return StoBase62Encoder::decimalStringToBaseString(
					$decimalString, StoBase62Encoder::$base62Alphabet);
		}
	
		/**
		 * Decodes a base62 encoded string to its original form. The resulting string
		 * may contain binary data (including "\0" characters).
		 * Leading "0" characters are preserved.
		 * @param string $base62String String to decode.
		 * @return string Decoded string in its original form.
		 */
		public static function base62decode($base62String)
		{
			if (is_null(StoBase62Encoder::$asciiAlphabet))
				StoBase62Encoder::initializeAsciiAlphabet();
	
			$decimalString = StoBase62Encoder::baseStringToDecimalString(
					$base62String, StoBase62Encoder::$base62Alphabet);
			return StoBase62Encoder::decimalStringToBaseString(
					$decimalString, StoBase62Encoder::$asciiAlphabet);
		}
	
		/**
		 * Encodes an integer to the base62 alphabet. The result is always shorter or
		 * has the same length as the decimal representation of the number.
		 * @param int $number Number to encode.
		 * @return string Base62 encoded number.
		 */
		public static function intToBase62($number)
		{
			$decimalString = strval($number);
			return StoBase62Encoder::decimalStringToBaseString(
					$decimalString, StoBase62Encoder::$base62Alphabet);
		}
	
		/**
		 * Decodes a base62 encoded number to its original integer form.
		 * @param string $base62Number String to decode.
		 * @return int Decoded integer number.
		 */
		public static function base62ToInt($base62Number)
		{
			$decimalString = StoBase62Encoder::baseStringToDecimalString(
					strval($base62Number), StoBase62Encoder::$base62Alphabet);
			return 0 + $decimalString; // cast to int, or to float if > 2147483647
		}
	
		/**
		 * Takes a string of any alphabet, and converts it to a string of the decimal
		 * alphabet. This decimal string allows to use php's BCMath library.
		 * @param string $baseString String containing characters of a given alphabet.
		 *   Binary strings can be seen as strings with the ascii character alphabet.
		 * @param string $alphabet String containing the possible characters.
		 * @return string Converted string in decimal form.
		 */
		protected static function baseStringToDecimalString($baseString, $alphabet)
		{
			$base = strlen($alphabet);
			if ($base < 2)
				throw new InvalidArgumentException('The parameter $alphabet must contain at least 2 characters.');
			bcscale(0);
	
			// base conversion
			$result = '0';
			$baseStringLength = strlen($baseString);
			for ($index = 0; $index < $baseStringLength; $index++)
			{
				$baseStringCharacter = $baseString[$index];
				$posInAlphabet = strpos($alphabet, $baseStringCharacter);
				if ($posInAlphabet === false)
					throw new InvalidArgumentException('The parameter $baseString contains characters which are not part of the alphabet.');
	
				$result = bcmul($result, $base);
				$result = bcadd($result, $posInAlphabet);
			}
	
			// preserve leading 0 characters
			$result = ltrim($result, '0');
			for ($index = 0; $index < $baseStringLength; $index++)
			{
				if ($baseString[$index] == $alphabet[0])
					$result = '0' . $result;
				else
					break;
			}
			return $result;
		}
	
		/**
		 * Takes a string of the decimal alphabet, and converts it to a string of any
		 * alphabet. Together with baseStringToDecimalString() this allows conversions
		 * between alphabets.
		 * @param string $decimalString String containing decimal characters.
		 * @param string $alphabet String containing the allowed characters to convert
		 *   to. Binary strings can be created with the ascii character alphabet.
		 * @return string Converted string of the given alphabet.
		 */
		protected static function decimalStringToBaseString($decimalString, $alphabet)
		{
			if ($decimalString === '')
				return '';
			if (!ctype_digit($decimalString))
				throw new InvalidArgumentException('The parameter $decimalString contains non-decimal characters.');
			$base = strlen($alphabet);
			if ($base < 2)
				throw new InvalidArgumentException('The parameter $alphabet must contain at least 2 characters.');
			bcscale(0);
	
			// preserve leading 0 characters
			$leadingZeros = '';
			$decimalStringLength = strlen($decimalString);
			for ($index = 0; $index < $decimalStringLength; $index++)
			{
				if ($decimalString[$index] == '0')
					$leadingZeros .= $alphabet[0];
				else
					break;
			}
			$decimalString = ltrim($decimalString, '0');
	
			// base conversion
			$result = '';
			if ($decimalString !== '')
			{
				while ($decimalString !== '0')
				{
					$remainder = bcmod($decimalString, $base);
					$decimalString = bcdiv($decimalString, $base);
	
					$alphabetCharacter = $alphabet[$remainder];
					$result = $alphabetCharacter . $result;
				}
			}
			return $leadingZeros . $result;
		}
	
		/**
		 * Calculates the possible range, the length of an encoded string can be in.
		 * The maximal length is: ceil(log(pow(256, $inputLength), 62))
		 * The factor is constant: 1.3435902316563 the original length.
		 * @param int $inputLength Length of the unencoded input string.
		 * @param int $minimalLength Length of smallest possible encoded string.
		 * @param int $maximalLength Length of biggest possible encoded string.
		 */
		protected static function calculateBase62EncodeLength($inputLength, &$minimalLength, &$maximalLength)
		{
			$minimalLength = $inputLength;
			$maximalLength = ceil($inputLength * log(256, 62));
		}
	
		/**
		 * Initializes the alphabet of all ascii characters on demand.
		 */
		private static function initializeAsciiAlphabet()
		{
			StoBase62Encoder::$asciiAlphabet = '';
			for ($index = 0; $index < 256; $index++)
				StoBase62Encoder::$asciiAlphabet .= chr($index);
		}
	
}
?>