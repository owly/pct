<?php

/**
 *  Marker class
 */
class Marker {
    public $id;
    public $mile_marker;
    public $longitude;
    public $latitude;
    public $update_date;
    
    function __construct($db_result) {
        $this->id = $db_result->id;
        $this->mile_marker = $db_result->mile_marker;
        $this->longitude = $db_result->longitude;
        $this->latitude = $db_result->latitude;
        $this->update_date = $db_result->update_date;
    }
}