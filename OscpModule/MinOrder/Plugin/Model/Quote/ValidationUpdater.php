<?php
namespace OscpModule\MinOrder\Plugin\Model\Quote;

/**
 * Class ValidationUpdater
 * If the current customer is from special customer group then MinimumOrderAmount should not be applied.
 * @package Osc\MinOrder\Plugin\Model\Quote
 */
class ValidationUpdater {

	/**
	 * @var \OscpModule\MinOrder\Helper\Data
	 */
	private $_helper;

	/**
	 * ValidationUpdater constructor.
	 *
	 * @param \OscpModule\MinOrder\Helper\Data $data
	 */
	public function __construct(\OscpModule\MinOrder\Helper\Data $data ) {
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
        if ( $this->_helper->getCustomerGroupId() == 4 ) {
            $result = true;
            return $result;
        }

        return $result;
    }
}
