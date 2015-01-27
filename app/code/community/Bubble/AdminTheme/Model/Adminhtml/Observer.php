<?php

class Bubble_AdminTheme_Model_Adminhtml_Observer {
	public function setTheme() {
		$theme = Mage::getStoreConfig( 'bubble_admintheme/config/theme' );
		Mage::getDesign()->setTheme( $theme );
		foreach ( array( 'layout', 'template', 'skin', 'locale' ) as $type ) {
			Mage::getDesign()->setTheme( $type, $theme );
		}

	}


	public function controllerActionLayoutLoadBefore( Varien_Event_Observer $observer ) {
		$_head = $observer->getEvent()->getLayout()->getBlock( 'head' );

		if ( Mage::helper( 'bubble_admintheme' )->isRtlLocale() ) {
			$_head->addItem( 'skin_css', 'dist/app-rtl.css' );
		} else {
			$_head->addItem( 'skin_css', 'dist/app.css' );
		}


	}
}