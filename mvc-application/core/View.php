<?php
	class View {

		/**
		*	Header and footer are supplied automatically
		*
		*
		* @uses call presentation resources 
		* @param supply just the file name
		*/
		public static function render($fileName, $data = []) {
			/**
			* @param extract converts array to simple variable
			*/
			extract($data);
			require_once 'mvc-public/layout_template/default/header' . EXT;
			require_once 'mvc-public/views_template/' . $fileName . EXT;
			require_once 'mvc-public/layout_template/default/footer' . EXT;
		}
}