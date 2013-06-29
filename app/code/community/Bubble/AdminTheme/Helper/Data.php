<?php

class Bubble_AdminTheme_Helper_Data extends Mage_Core_Helper_Abstract
{
	var $_rtl_locale_codes = array('he_IL', 'ar', 'ur', 'ur_PK', );	
	
	public function isRtlLocale() {
	
		$_store_locale_code = Mage::app()->getLocale()->getLocaleCode();
			
		return in_array($_store_locale_code, $this->_rtl_locale_codes);
	
	}
}