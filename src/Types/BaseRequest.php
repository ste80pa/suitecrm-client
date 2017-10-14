<?php
namespace ste80pa\SuiteCRMClient\Types;
require_once 'Compat.php';
/**
 *
 * @author Stefano Pallozzi
 *        
 */
class BaseRequest implements \JsonSerializable
{

    /**
     *
     * {@inheritdoc}
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
        
        foreach (get_object_vars($this) as $k => $v) {
            $result[$k] = $v;
        }
        
        return $result;
    }
}
