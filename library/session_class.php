<?php
/**
 * Usage in login controller page
 * $session->Open();
		if(isset($_SESSION))
		{
		$_SESSION['email']=$email; //you can also pass id , name etc
		$session->redirect('page','');
		}
		in header.php use
		if($session->Check())
 * @author Varun M
 *
 */
class session extends links {
	// Include browser name in fingerprint?
	var $check_browser = true;

	// How many numbers from IP use in fingerprint?
	var $check_ip_blocks = 0;

	// Number of requests
	var $number_of_requests = 0;

	// Control word - any word you want.
	var $secure_word = 'CHIMPU_SESSION';

	// Regenerate session ID to prevent fixation attacks?
	var $regenerate_id = true;

	// Call this when init session.
	function Open() {
		$_SESSION ['ss_fprint'] = $this->_Fingerprint ();
		$_SESSION ['nofrequest'] = $this->number_of_requests;
		
	}

	// Call this to check session. (
	function Check() {
		$_SESSION ['nofrequest'] = $_SESSION ['nofrequest'] + 1;
		$nofrequests = $_SESSION ['nofrequest'];
		if ($nofrequests > 100) {
			$_SESSION ['nofrequest'] = $this->number_of_requests;
			
		}
		return (isset ( $_SESSION ['ss_fprint'] ) && $_SESSION ['ss_fprint'] == $this->_Fingerprint ());
	}

	// Internal function. Returns Hash from fingerprint.
	private function _Fingerprint() {
		$fingerprint = $this->secure_word;
		if ($this->check_browser) {
			$fingerprint .= $_SERVER ['HTTP_USER_AGENT'];
		}
		if ($this->check_ip_blocks) {
			$num_blocks = abs ( intval ( $this->check_ip_blocks ) );
			if ($num_blocks > 4) {
				$num_blocks = 4;
			}
			$blocks = explode ( '.', $_SERVER ['REMOTE_ADDR'] );
			for($i = 0; $i < $num_blocks; $i ++) {
				$fingerprint .= $blocks [$i] . '.';
			}
		}
		return hash ( "sha512", $fingerprint . SITE_URL );
	}

	// Internal function. Regenerates session ID if possible.
	private function _RegenerateId() {
		if ($this->regenerate_id && function_exists ( 'session_regenerate_id' )) {
			if (version_compare ( phpversion (), '5.1.0', '>=' )) {
				//session_regenerate_id ( true );
			} else {
				//session_regenerate_id ();
			}
		}
	}
	public function destroy($page, $panel = NULL) {
		session_unset ();
		session_destroy ();
		if (empty ( $_SESSION ))
			self::redirect ( $page, $panel );
		else
			echo "There is a problem";
	}
	public function redirect($pURL, $panel = NULL) {
		if (strlen ( $pURL ) > 0) {
			if (headers_sent ()) {
				?>
<script type="text/javascript">window.location="<?php echo self::link($pURL,$panel);?>"</script>
<?php
			} else {
				header ( "Location: " . self::link ( $pURL, $panel ) );
			}
			
		}
	}
	public function String2Hex($string) {
		$hex = '';
		for($i = 0; $i < strlen ( $string ); $i ++) {
			$hex .= dechex ( ord ( $string [$i] ) );
		}
		return $hex;
	}
	public function Hex2String($hex) {
		$string = '';
		for($i = 0; $i < strlen ( $hex ) - 1; $i += 2) {
			$string .= chr ( hexdec ( $hex [$i] . $hex [$i + 1] ) );
		}
		return $string;
	}
	public function chimpu() {
		echo self::Hex2String ( '26636f70793b20323031343c6120687265663d22687474703a2f2f7777772e6977636e617070732e636f6d22207461726765743d225f626c616e6b22207469746c653d22476976656e204269727468204279204957434e2053595354454d5320494e432e223e20537461726b2043524d2076312e303c2f613e' );
	}
}
?>