<?php

class Bubble_AdminTheme_Model_Adminhtml_Observer
{
    public function setTheme()
    {
        $theme = Mage::getStoreConfig('bubble_admintheme/config/theme');
        Mage::getDesign()->setTheme($theme);
        foreach (array('layout', 'template', 'skin', 'locale') as $type) {
            Mage::getDesign()->setTheme($type, $theme);
        }
        
        
        $headBlock = Mage::getLayout()->getBlock('head');
        
        $headBlock->addCss('app.css');
        
    }
    
    public function setLessVariables(Varien_Event_Observer $observer) {
    	 
    	$response = $observer->getEvent()->getResponse();
    	 
    	if 	(Mage::helper('bubble_admintheme')->isRtlLocale()) {
    		$response->setLessVariables($this->_getRtlLessVariables());
    	}
    	 
    	else {
    		$response->setLessVariables($this->_getLtrLessVariables());
    	}
    
    	return $this;
    }
    
    private function _getRtlLessVariables() {
    	return array(
    			'bi-app-left'      		 => 'right',
    			'bi-app-right'     		 => 'left',
    			'bi-app-direction' 		 => 'rtl',
    			'bi-app-invert-direction' => 'ltr'
    	);
    }
    
    private function _getLtrLessVariables() {
    	return array(
    			'bi-app-left'      		 => 'left',
    			'bi-app-right'     		 => 'right',
    			'bi-app-direction' 		 => 'ltr',
    			'bi-app-invert-direction' => 'rtl'
    	);
    }
}