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
     * @param object|array|NULL 
     */
    public function __construct($data = null)
    {
        if($data == null)
            return;

        if(is_array($data))
        {
            $this->id = $data['id'];
            $this->module_name = $data['module_name'];
            $this->name_value_list = $data['name_value_list'];
            return;
        }

        if(is_object($data))
        {
            $this->id = $data->id;
            $this->module_name = $data->module_name;
            $this->name_value_list = $data->name_value_list;
            return;
        }
    }
    /**
     * 
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value){
        
        if($name =='name_value_list')
        {
            foreach($value as $o)
                if(is_array($o))
                    $this->{$o['name']} = $o['value'];
                else
                    $this->{$o->name} = $o->value;
            return;
        }

        $this->{$name} = $value;      
    }
}