<?php
class form_validations extends links{
	/**
	 *
	 * @param Check only numeric (integer) value in string
	 * @param if exist numeric value return true otherwise return false
	 * @param $detail1 field and $detail2 description of error message
	 */
	public function check_numeric($value,$detail1 = NULL,$detail2 = NULL) {
		if($value=='')
			return true;
		elseif (preg_match ( '/^[0-9][0-9\s]*$/', $value )) {
			return true;
		} else {
			echo $this->form_error($detail1,$detail2);
			return false;
		}

	}
	/**
	 *
	 * @param Check only alphabets in string
	 * @param if exist alphabets return true otherwise return false
	 * $detail1 field and $detail2 description of error message
	 *
	 */
	public function check_alphabets($value,$detail1 = NULL,$detail2 = NULL) {

		if (preg_match ( '/^[a-zA-Z]+$/', $value )) {

			return true;

		} else {
			echo $this->form_error($detail1,$detail2);
			return false;
		}

	}
	/**
	 * @param $value = string to be checked
	 * @package $detail1 and $detail2 are for displaying error
	 * @return returns true when string is b/w 4 to 8 in length and has at least 3 alphabets and 2 numbers
	 **/

	public function check_length($value){
		if (preg_match ( '/^(?=(?:.*?[A-Za-z]){3})(?=(?:.*?[0-9]){2})[A-Za-z0-9#,.\-_]{5,}$/x', $value )) {
			return true;
		} else {

			return false;
		}
	}
	/**
	 *
	 * @param Check alphabets(a-z,A-Z) and numeric(0-9) value in string
	 * @param detail1 field and detail2 description of error message
	 * @param returns true when string  is perfectly alphanumeric , space is allowed in alphanumeric by us so empty string will return true
	 * returns false when string has special characters
	 */
	public function check_alphanumeric($value,$detail1 = NULL,$detail2 = NULL) {

		if(!empty($value))
		{
		if (preg_match ( '/^([0-9a-zA-Z ])+$/', trim ( $value ) ))
			return true;
		else
		{
			echo $this->form_error($detail1,$detail2);
			return false;
		}
		}
		else
		return true;


	}
	/**
	 *
	 * @param Check email format if valid return true otherwise false
	 * @param $detail1 field and $detail2 description of error message
	 *
	 */
	public function check_email($value,$detail1 = NULL,$detail2 = NULL) {

		if (filter_var ( $value, FILTER_VALIDATE_EMAIL )) {
			return true;
		} else {
			echo $this->form_error($detail1,$detail2);
			return false;
		}
	}
	/**
	 *
	 * @param Check special characters in string
	 * @param if special characters exist in string return true otherwise false
	 * @param detail1 field and detail2 description of error message.
	 *
	 */
	public function check_specialcharacters($value,$detail1 = NULL,$detail2 = NULL) {

		if (preg_match ( '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $value )) {
			return true;
		} else {
			echo $this->form_error($detail1,$detail2);
			return false;
		}
	}
	/**
	 *
	 * @param Check spaces in string
	 * @param Shows error message
	 * @param detail1 is field and detail2 is description of error message
	 * returns true and error popup when there is space in $value
	 * returns false when there is no space
	 */
	public function check_space($value,$detail1 = NULL,$detail2 = NULL) {

		if (preg_match ( '/\\s/', $value )) {
			echo $this->form_error($detail1,$detail2);
			return true;
		} else {


			return false;
		}
	}

	/**
	 *
	 * @param Remove spaces from everywhere in string
	 */
	public function removespace($value) {

		return preg_replace ( '/\s+/', '', $value );
	}

	/**
	 *
	 * @param sting type $value
	 * remove space from start and end of the string.
	 */
	public function trim($value) {
		return trim ( $value );
	}


	/**
	 * @param array type $value
	 * @param optional $display, must be set when data needs to be displayed
	 * @return true or false
	 */
	public function emptyfields($value, $display = NULL) {
		$newarray = array ();
		if(is_array($value)){
		foreach ( $value as $key => $val ) {
			if ($val=='')

				$newarray [] = $key;

		}
		}
		if ($display != NULL && count($newarray)!=0)
			echo $this->form_warning ( $newarray, 'Following fields are empty ! <br>please correct them', 'array' );
		if (count ( $newarray ) != 0)
		{
		foreach ($newarray as $a)
      	{
      		$empty.= $a."".'<br>';
      	}
      	  return $empty;
		}
		else
		{
			return false;
		}
	}

	/**
	 *
	 * @param Shows warning alert for a given field or array of fields (fields will be displayed in alert)
	 * @param Alert is in yellow color
	 * @param type is null by default (optional), must be set when first parameter is an array
	 * @return Html code
	 */

	public function form_warning($detail1, $detail2, $type = NULL) {

		$value1 = "<div id='gritter-notice-wrapper'>
		<div id='gritter-item-3' class='gritter-item-wrapper gritter-warning' style=''>
		<div class='gritter-center'></div><div class='gritter-item'>
		<div id='close' class='gritter-close' style='display: inline;'></div>
		<span class='gritter-title'><strong>" . $detail2 . "</strong></span>";

		if ($type != NULL) {
			foreach ( $detail1 as $arr ) {
				$value2 .= '<p><strong>' . $arr . '</strong></p>';
			}
		} else
			$value2 = '<p><strong>' . $detail1 . '</strong></p>';

		$value3 = "
		<div style='clear:both'></div></div>
		<div class='gritter-bottom'></div></div></div><br />";

		return $value1 . $value2 . $value3;
	}

	/**
	 *
	 * @param Shows error in alert format
	 * @param $detail1 field and $detail2 description
	 */
	public function form_error($detail1=NULL, $detail2=NULL) {

		if($detail1!=NULL || $detail2!=NULL)
		{
		$value = "<div id='gritter-notice-wrapper'>
		<div id='gritter-item-3' class='gritter-item-wrapper gritter-error' style=''>
		<div class='gritter-center'></div><div class='gritter-item'>
		<div id='close' class='gritter-close' style='display: inline;'></div>
		<span class='gritter-title'><strong>" . $detail1 . "</strong><p>" . $detail2 . "</p></span>
		<div style='clear:both'></div></div>
		<div class='gritter-bottom'></div></div></div>";
		return $value;
		}
	}
	/**
	 *
	 * @param Shows success message
	 * @param $detail1 field and $detail2 description
	 */
	public function form_success($detail1, $detail2) {

		$value = "<div id='gritter-notice-wrapper'>
		<div id='gritter-item-3' class='gritter-item-wrapper gritter-success' style=''>
		<div class='gritter-center'></div><div class='gritter-item'>
		<div id='close' class='gritter-close' style='display: inline;'></div>
		<span class='gritter-title'><strong>" . $detail1 . "</strong><p>" . $detail2 . "</p></span>
		<div style='clear:both'></div></div>
		<div class='gritter-bottom'></div></div></div>";
		return $value;
	}


	public function form_success_popup($detail1,$nameofbutton,$pagename,$panel,$query)
	{
		$link=$this->link($pagename,$panel,$query);
		echo $value='<div id="myModal" data-backdrop="static"
		class="modal gritter-item-wrapper gritter-info gritter-center">
		<div class="gritter-top"></div><div class="gritter-item">
		<div class="gritter-without-image">
		<span class="center gritter-title bigger-150">'.$detail1.'</span>
		<br>
		<p class="center"><a href="'.$link.'" class="btn btn-warning btn-small" >
		<i class="icon-check"></i>'.$nameofbutton.'</a></p>
		</div>
		<div style="clear:both"></div></div>
		<div class="gritter-bottom"></div></div>';
	}

	public function form_delete_popup($detail1,$nameofbutton,$pagename,$panel,$query)
	{
		 $link=$this->link($pagename,$panel,$query);
		echo $value='<div id="myModal" data-backdrop="static"
		class="modal gritter-item-wrapper gritter-error gritter-center">
		<div class="gritter-top"></div><div class="gritter-item">

		<div class="gritter-without-image">
		<span class="center gritter-title bigger-150">'.$detail1.'</span>
		<br>
		<p class="center"><a href="'.$link.'" class="btn btn-warning btn-small" >
		<i class="icon-trash"></i>'.$nameofbutton.'</a>
		<a href="#" class="btn btn-info btn-small"onclick="closeModal ();"><i class="icon-undo"></i>Cancel</a></p>
		</div>
		<div style="clear:both"></div></div>
		<div class="gritter-bottom"></div></div>';
	}
	/**
	 *
	 * @param check if the value of time is between 00:00 to 23:59
	 * @return true or false
	 */
	public function time_checker($value,$detail1=NULL,$detail2=NULL) {

		 if(preg_match('/(2[0-3]|[01][0-9]):[0-5][0-9]/', $value))
		 {
		 	return true;
		 }
		 else{
		 	echo $this->form_error($detail1,$detail2);
		 	return false;
		 }
	}

}
?>