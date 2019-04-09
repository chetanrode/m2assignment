<?php
/*
* @author      MM Team
* @category    MM
* @package     MM_Postcodes
*/
namespace MM\Postcodes\Api\Data;

interface LocalPostcodeInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID = 'id';
    const LOCAL_POSTCODE = 'local_postcode';
    
    public function getId();
    public function setId($id);

    public function getLocalPostcode();
    public function setLocalPostcode($local_postcode);
}
