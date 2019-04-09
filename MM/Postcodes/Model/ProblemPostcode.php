<?php
/*
* @author      MM Team
* @category    MM
* @package     MM_Postcodes
*/
namespace MM\Postcodes\Model;

use Magento\Framework\Model\AbstractModel;
use MM\Postcodes\Api\Data\ProblemPostcodeInterface;

class ProblemPostcode extends AbstractModel implements ProblemPostcodeInterface
{

    const CACHE_TAG = 'Postcodes_data';

    protected function _construct()
    {
        $this->_init(\MM\Postcodes\Model\ResourceModel\ProblemPostcode::class);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
    public function getId()
    {
        return $this->getData(ProblemPostcodeInterface::ID);
    }

    public function setId($id)
    {
        return $this->setData(ProblemPostcodeInterface::ID, $id);
    }
    public function getProblemPostcode()
    {
        return $this->getData(ProblemPostcodeInterface::PROBLEM_POSTCODE);
    }

    public function setProblemPostcode($problem_postcode)
    {
        return $this->setData(ProblemPostcodeInterface::PROBLEM_POSTCODE, $problem_postcode);
    }

}
