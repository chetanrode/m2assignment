<?php
namespace Osc\MinOrder\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Data
 * @package Osc\MinOrder\Helper
 */
class Data extends AbstractHelper {

	const XML_PATH_ENABLE = 'minorder/general/enable';

	const XML_PATH_DiSABLE_MOA = 'minorder/cg_moa/config';
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

	protected $_groupRepository;

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
		\Magento\Customer\Api\GroupRepositoryInterface $groupRepository,
		\Magento\Framework\App\Http\Context $httpContext ) {

		$this->_customerSession    = $_customerSession;
		$this->_groupRepository = $groupRepository;
		$this->_httpContext = $httpContext;
		parent::__construct($context);
	}

	/**
	 * Get the current customer group Id
	 * @return int
	 */
	public function getCustomerGroupId(  ) {
			$customerGroupId = $this->_customerSession->getCustomer()->getGroupId();
			return $customerGroupId;
	}

	/**
	 * Checked Is Module enabled or disabled
	 * @return mixed
	 */
	public function isEnabled(  ) {
		return $this->scopeConfig->getValue(
			self::XML_PATH_ENABLE,
			ScopeInterface::SCOPE_STORE);
	}

	/**
	 * Returns the id of customer group from admin section
	 * @return mixed
	 */
	public function minimumOrderAmountDisableId(  ) {
		return $this->scopeConfig->getValue(
			self::XML_PATH_DiSABLE_MOA,
			ScopeInterface::SCOPE_STORE);
	}


}