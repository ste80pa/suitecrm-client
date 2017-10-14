<?php
if (version_compare(phpversion(), '5.4.0', '<')) {
    interface JsonSerializable {
        
        public function jsonSerialize();
        
    }
}