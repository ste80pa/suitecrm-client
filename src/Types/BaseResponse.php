<?php
namespace ste80pa\SuiteCRMClient\Types;

use JsonSerializable;

/**
 *
 * @author Stefano Pallozzi
 *        
 */
class BaseResponse
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

 