<?php
/*
* @author      MM Team
* @category    MM
* @package     MM_Postcodes
*/
namespace MM\Postcodes\Model\ResourceModel\LocalPostcode;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Collection initialisation
     */
    protected function _construct()
    {
        $this->_init(
            \MM\Postcodes\Model\LocalPostcode::class,
            \MM\Postcodes\Model\ResourceModel\LocalPostcode::class
        );
    }
}
