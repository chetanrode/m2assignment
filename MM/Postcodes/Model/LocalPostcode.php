<?php
/*
* @author      MM Team
* @category    MM
* @package     MM_Postcodes
*/
namespace MM\Postcodes\Model;

use Magento\Framework\Model\AbstractModel;
use MM\Postcodes\Api\Data\LocalPostcodeInterface;

class LocalPostcode extends AbstractModel implements LocalPostcodeInterface
{

    const CACHE_TAG = 'Postcodes_data';

    protected function _construct()
    {
        $this->_init(\MM\Postcodes\Model\ResourceModel\LocalPostcode::class);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
    public function getId()
    {
        return $this->getData(LocalPostcodeInterface::ID);
    }

    public function setId($id)
    {
        return $this->setData(LocalPostcodeInterface::ID, $id);
    }
    public function getLocalPostcode()
    {
        return $this->getData(LocalPostcodeInterface::LOCAL_POSTCODE);
    }

    public function setLocalPostcode($local_postcode)
    {
        return $this->setData(LocalPostcodeInterface::LOCAL_POSTCODE, $local_postcode);
    }

}
