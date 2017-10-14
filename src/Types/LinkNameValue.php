<?php
namespace ste80pa\SuiteCRMClient\Types;

/**
 *
 * @author Stefano Pallozzi
 *        
 */
class LinkNameValue
{

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var array
     */
    public $records = array();

    /**
     *
     * @param
     *            object|array|NULL
     */
    public function __construct($data = null)
    {
        if ($data == null)
            return;
        
        if (is_array($data)) {
            $this->name = $data['name'];
            
            foreach ($data['records'] as $record) {
                $this->records[] = new LinkValue($record);
            }
            return;
        }
        
        if (is_object($data)) {
            $this->name = $data->name;
            
            foreach ($data->records as $record) {
                $this->records[] = new LinkValue($record);
            }
            return;
        }
    }
}