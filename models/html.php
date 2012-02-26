<?php
    /**
     * Function html
	 * Converts the special characters of a string to HTML entities and limits its length
	 * 
	 * @param String $text The string to be converted/ truncated
	 * @param bool $truncate A flag whether the string shall be truncated
	 * @param int $length The length of the truncated string
	 * @return String
     */
    function html( $text, $truncate = false, $length = 100 ) {
        $html = htmlspecialchars( $text, ENT_QUOTES );
		if ( $truncate && strlen($html) > $length) {
			$html = substr($html, 0, $length);
			$html = $html . "...";
		}
		return $html;
    }
?>
