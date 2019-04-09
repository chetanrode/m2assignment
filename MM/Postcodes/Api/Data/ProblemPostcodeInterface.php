<?php
/*
* @author      MM Team
* @category    MM
* @package     MM_Postcodes
*/
namespace MM\Postcodes\Api\Data;

interface ProblemPostcodeInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID = 'id';
    const PROBLEM_POSTCODE = 'problem_postcode';

    public function getId();
    public function setId($id);

    public function getProblemPostcode();
    public function setProblemPostcode($problem_postcode);
}
