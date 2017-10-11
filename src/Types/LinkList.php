<?php
namespace ste80pa\SuiteCRMClient\Types;

use ArrayAccess;

/**
 *
 * @author Stefano Pallozzi
 *        
 */
class LinkList implements ArrayAccess
{
    /**
     *
     * @var array
     */
    protected $link_list = array();

    /**
     *
     * @param object|array|NULL
     */
    public function __construct($data = null)
    {
        if ($data == null)
            return;
        
        if (is_array($data)) {
        
            throw new \Exception(__CLASS__ . '::' . __FUNCTION__ . ' not implemented');
            return;
        }
        
        if (is_object($data)) {
            
            foreach ($data->link_list as $v)
                $this->link_list[] = new LinkNameValue($v);
            return;
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see ArrayAccess::offsetExists()
     */
    public function offsetExists($offset)
    {
        return isset($this->link_list[$offset]);
    }

    /**
     *
     * {@inheritdoc}
     * @see ArrayAccess::offsetGet()
     */
    public function offsetGet($offset)
    {
        return isset($this->link_list[$offset]) ? $this->link_list[$offset] : null;    
    }

    /**
     *
     * {@inheritdoc}
     * @see ArrayAccess::offsetSet()
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->link_list[] = $value;
        } else {
            $this->link_list[$offset] = $value;
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see ArrayAccess::offsetUnset()
     */
    public function offsetUnset($offset)
    {
        unset($this->link_list[$offset]);
    }
}
    /*
[0] => stdClass Object
(
    [name] => accounts
    [records] => Array
    (
        [0] => stdClass Object
        (
            [link_value] => stdClass Object
            (
                [id] => stdClass Object
                (
                    [name] => id
                    [value] => 1dad1b5e-3719-15d5-7616-5773e51596ea
                    )
                
                [name] => stdClass Object
                (
                    [name] => name
                    [value] => Hotel Windrose
                    )
                
                )
            
            )
        
        )
    
    )*/