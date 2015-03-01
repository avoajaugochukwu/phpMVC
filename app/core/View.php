<?php
	class View {

		// function __construct() {
//      echo 'this is the view<br>';
		// }

		/**
		*	Header and footer are supplied automatically
		*
		*
		* @uses call presentation resources 
		* @param supply just the file name
		*/
		public static function render($fileName, $data = []) {
			extract($data);
			require_once 'public/layout_template/default/header' . EXT;
			require_once 'public/views_template/' . $fileName . EXT;
			require_once 'public/layout_template/default/footer' . EXT;
		}
}