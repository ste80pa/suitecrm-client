<?php
namespace ste80pa\SuiteCRMClient\Types;

/**
 *
 * @author Stefano Pallozzi
 *        
 */
class LinkValue
{

    /**
     *
     * @param object|array|NULL $data
     */
    public function __construct($data = null)
    {
        if ($data == null) {
            return;
        }
        
        if (is_array($data)) {
            $this->link_value = $data['link_value'];
            return;
        }
        
        if (is_object($data)) {
            $this->link_value = $data->link_value;
            return;
        }
    }

    /**
     *
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        if ($name == 'link_value') {
            foreach ($value as $o) {
                $this->{$o->name} = $o->value;
            }
            return;
        }
        
        $this->{$name} = $value;
    }
}