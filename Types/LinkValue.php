<?php
namespace ste80pa\SuiteCRMClient\Types;

/**
 * 
 * @author Stefano Pallozzi
 *
 */
class LinkValue {
    /**
     * 
     * @var string
     */
    public $name;
   
    /**
     * 
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        if($name =='link_value')
        {
            foreach($value as $o)
                $this->{$o->name} = $o->value;
            
             return;
        }

        $this->{$name} = $value;      
    }
}