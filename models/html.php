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
		if ( $truncate && strlen( $html ) > $length ) {
            // TODO: There is an issue of potentially invalid HTML at this point.
            // If a special character is replaced by an entity and we are near the
            // borderline length, then the entity may be cut out causing invalid HTML
            // e.g. if the at character 98 we have "&amp;" and we cut at character 100,
            // the result will be "&am..." which is invalid. Fix this.
			$html = substr( $html, 0, $length );
			$html = $html . "...";
		}
		return $html;
    }
?>
