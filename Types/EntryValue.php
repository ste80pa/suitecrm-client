<?php
namespace ste80pa\SuiteCRMClient\Types;

/**
 * 
 * @author Stefano Pallozzi
 *
 */
class EntryValue {
   
    /**
     * 
     * @var string
     */
    public $id;
    /**
     * 
     * @var string
     */
    public $module_name;
    
    /**
     * 
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value){
        
        if($name =='name_value_list')
        {
            foreach($value as $o)
                $this->{$o->name} = $o->value;
            
             return;
        }

        $this->{$name} = $value;      
    }
}