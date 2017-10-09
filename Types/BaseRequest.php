<?php
namespace ste80pa\SuiteCRMClient\Types;

use JsonSerializable;

/**
 *
 * @author Stefano Pallozzi
 *
 */
class BaseRequest implements \JsonSerializable 
{
     /**
      * 
      * {@inheritDoc}
      * @see JsonSerializable::jsonSerialize()
      */
     public function jsonSerialize()
     {
         return $this->toArray();
     }
    
    /**
     *
     * @return array
     */
    public function toArray()
    {
        $result = array();
        
        foreach(get_object_vars($this) as $k => $v)
                $result[$k] = $v;
            
        return $result;
    }
}
