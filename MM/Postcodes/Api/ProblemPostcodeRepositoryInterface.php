<?php
/*
* @author      MM Team
* @category    MM
* @package     MM_Postcodes
*/
namespace MM\Postcodes\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use MM\Postcodes\Api\Data\ProblemPostcodeInterface;

/**
 * @api
 */
interface ProblemPostcodeRepositoryInterface
{
    public function save(ProblemPostcodeInterface $data);

    public function getById($Id);

    public function delete(ProblemPostcodeInterface $data);

    public function deleteById($Id);
}
