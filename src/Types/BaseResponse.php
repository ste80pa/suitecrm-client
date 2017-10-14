<?php
namespace ste80pa\SuiteCRMClient\Types;

require_once 'Compat.php';

/**
 *
 * @author Stefano Pallozzi
 *        
 */
class BaseResponse implements \JsonSerializable
{

    /**
     *
     * @param object|array|NULL $data
     */
    public function __construct($data = null)
    {          
        $this->fromData($data);
    }

    /**
     * 
     * @param mixed $data
     * @return \ste80pa\SuiteCRMClient\Types\BaseResponse
     */
    public function fromData($data)
    {
        if ($data == null) {
            return $this;
        }
        
        foreach ($data as $name => $value) {
            if ($name == 'name_value_list') {
                foreach ($value as $k => $v) {
                    if (is_array($v)) {
                        $this->{$v['name']} = $v['value'];
                    } else {
                        $this->{$v->name} = $v->value;
                    }
                }
            } else if ($name == 'entry_list') {
                foreach ($value as $e) {
                    $this->entry_list[] = new EntryValue($e);
                }
            } else if ($name == 'relationship_list') {
                foreach ($value as $links) {
                    $this->relationship_list[] = new LinkList($links);
                }
            } else {
                $this->{$name} = $value;
            }
        }
         return $this;
    }

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

 