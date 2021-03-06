<?php
class CssMin{
	function minify( $css ) {
		$css = preg_replace('#\s+#', ' ', $css);
		$css = preg_replace('#/\*.*?\*/#s', '', $css);
		$css = str_replace('; ', ';', $css);
		$css = str_replace(': ', ':', $css);
		$css = str_replace(' {', '{', $css);
		$css = str_replace('{ ', '{', $css);
		$css = str_replace(', ', ',', $css);
		$css = str_replace('} ', '}', $css);
		$css = str_replace(';}', '}', $css);

		return trim($css);
	}
}