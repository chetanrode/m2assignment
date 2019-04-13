<?php
namespace Osc\MinOrder\Plugin\Model\Quote;

/**
 * Class ValidationUpdater
 * If the current customer is from special customer group then MinimumOrderAmount should not be applied.
 * @package Osc\MinOrder\Plugin\Model\Quote
 */
class ValidationUpdater {

	/**
	 * @var \Osc\MinOrder\Helper\Data
	 */
	private $_helper;

	/**
	 * ValidationUpdater constructor.
	 *
	 * @param \Osc\MinOrder\Helper\Data $data
	 */
	public function __construct(\Osc\MinOrder\Helper\Data $data ) {
		$this->_helper = $data;
	}

	/**
	 * @param \Magento\Quote\Model\Quote $subject
	 * @param $result
	 * @param bool $multishipping
	 *
	 * @return bool
	 */
	public function aftervalidateMinimumAmount(\Magento\Quote\Model\Quote $subject, $result, $multishipping = false)
    {
	    /**
	     * Compare the current customer group id & disabled customer group id.
	     */
        if ( $this->_helper->getCustomerGroupId() == $this->_helper->minimumOrderAmountDisableId() ) {
            $result = true;
            return $result;
        }
        return $result;
    }
}
