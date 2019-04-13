<?php
namespace OscpModule\MinOrder\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

/**
 * Class Data
 * @package Osc\MinOrder\Helper
 */
class Data extends AbstractHelper {

	/**
	 * Customer session
	 *
	 * @var \Magento\Customer\Model\Session
	 */
	protected $_customerSession;

	/**
	 * @var \Magento\Framework\App\Http\Context
	 */
	protected $_httpContext;

	/**
	 * Data constructor.
	 *
	 * @param Context $context
	 * @param \Magento\Customer\Model\Session $_customerSession
	 * @param \Magento\Framework\App\Http\Context $httpContext
	 */
	public function __construct (
		Context $context,
		\Magento\Customer\Model\Session $_customerSession,
		\Magento\Framework\App\Http\Context $httpContext ) {

		$this->_customerSession    = $_customerSession;
		$this->_httpContext = $httpContext;
		parent::__construct($context);
	}

	/**
	 * Get the current customer group Id
	 * @return int
	 */
	public function getCustomerGroupId(  ) {
		if ($this->_customerSession->isLoggedIn()){
			$customerGroupId = $this->_customerSession->getCustomer()->getGroupId();
			return $customerGroupId;
		}
	}

}