<?php
namespace ste80pa\SuiteCRMClient\Types;

/**
 *
 * @author Stefano Pallozzi
 *
 */
class BaseResponse
{
    /**
     * @param object|array|NULL $data
     */
    public function __construct( $data = null)
    {
        if($data == null)
            return;

        foreach($data as $name => $value)
        {   
            if($name =='name_value_list')
            {
                foreach($value as $k => $v)
                    if(is_array($v))
                        $this->{$v['name']} = $v['value'];
                    else
                        $this->{$v->name} = $v->value;
                
            }
            else if($name == 'entry_list')
            {
                foreach($value as $e)
                    $this->entry_list[] = new EntryValue($e);
            }
            else if($name == 'relationship_list')
            {
                foreach($value as $links)
                    $this->relationship_list[] = new LinkList($links);
            }
            else
            {
                $this->{$name} = $value; 
            }   
        }
    }
}

 