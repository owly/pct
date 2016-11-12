<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require('Marker.php');
 
/**
 * Model class for Markers
 * Cruds marker objects, searches, and calculates distance
 */
class Marker_model extends CI_Model {
    public $table_name = 'markers';
 
	public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    /**
     * Find marker using marker mile
     * returns one mile marker or null if none found
     */
    function findMarkerByMile($marker_mile) {
        $query = $this->db->from("markers");
        $query = $this->db->where('mile_marker', $marker_mile);
        $result = $this->db->get()->result();

    	// Check if the query was successful
    	if(!$result){
    		return null;
    	}else{
    		return new Marker($result[0]);
    	}
    }
 
    /**
     * get marker based on ID
     */
    function get($id){
        $query = $this->db->from($this->table_name);
        $query = $this->db->where('id', $id);
        $result = $this->db->get()->result();

    	// Check if the query was successful
    	if(!$result){
    		return null;
    	}else{
    		return new Marker($result[0]);
    	}
    }

    /**
     * Deletes the marker using the id
     */
    function delete($marker){
        $result = $this->db->delete($this->table_name, array('id' => $marker->id));
        return $result;
    }
    
    /**
     * Add a marker or updates an existing one
     */
    function addOrUpdate($marker){
        if (!array_key_exists('id', $marker)) {
            // var_dump($marker);die;
            return $this->db->insert('markers', $marker);
        } else {
            $this->db->where('id', $marker['id']);
            return $this->db->update('markers', $marker);
        }

    }
    
    /**
     *  Finds the marker in the database 
     *    with the smallest distance to $long and $lat
     */
    function findClosestMarker($long, $lat) {
        $query = $this->db->get($this->table_name);
        $results = $query->result();
        $shortest_distance = null;
        $closest_marker = null;
        foreach ($results as $marker) {
            $distance = $this->getDistance($lat, $long, $marker->latitude, $marker->longitude);
            // if $distance is the smallest or it's the first comparison set shortest distnace
            if ($distance < $shortest_distance || !$closest_marker) {
                $shortest_distance = $distance;
                $closest_marker = $marker;
            }
        }
        if ($closest_marker) {
            return new Marker($closest_marker);
        } else {
            return null;
        }
    }
    
    
    /**
     * Returns distnace between two coordinates
     */
    function getDistance($latitude1, $longitude1, $latitude2, $longitude2) {
        $earth_radius = 6371;
     
        $dLat = deg2rad($latitude2 - $latitude1);
        $dLon = deg2rad($longitude2 - $longitude1);
     
        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * asin(sqrt($a));
        $d = $earth_radius * $c;
     
        return $d;
    }
    
}