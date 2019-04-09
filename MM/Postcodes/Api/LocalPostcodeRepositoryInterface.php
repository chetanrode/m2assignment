<?php
/*
* @author      MM Team
* @category    MM
* @package     MM_Postcodes
*/
namespace MM\Postcodes\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use MM\Postcodes\Api\Data\LocalPostcodeInterface;

/**
 * @api
 */
interface LocalPostcodeRepositoryInterface
{
    public function save(LocalPostcodeInterface $data);

    public function getById($Id);

    public function delete(LocalPostcodeInterface $data);

    public function deleteById($Id);
}
