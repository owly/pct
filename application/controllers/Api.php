<?php

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
		$this->load->view('welcome_message');
    }
    
    /**
     * Add a marker -- post request processing
     * parameters: mile_marker, longitude, latitude
     */
    public function add_or_update_marker() {
        $marker = array(
            'mile_marker' => $this->input->post('mile_marker'),
            'longitude' => $this->input->post('longitude'),
            'latitude' => $this->input->post('latitude')
        );
        $this->load->model('marker_model', 'markermodel');
        $result = $this->markermodel->addorupdate($marker);
        if ($result) {
            // created
            http_response_code(201);
        } else {
            // conflict
            http_response_code(409);
        }
    }
    
    /**
     * display marker in json for a specific id
     */
    public function get($id) {
        $this->load->model('marker_model', 'markermodel');
        $marker = $this->markermodel->get($id);
        if (!$marker) {
            header("HTTP/1.1 404 Not Found");
        } else {
            $data['marker'] = $marker;
            $this->load->view('api_get', $data);
        }
    }

    /**
     * display marker in json for a specific marker mile
     */
    public function get_by_marker($marker_mile){
        $this->load->model('marker_model', 'markermodel');
        $marker = $this->markermodel->findMarkerByMile($marker_mile);

        if (!$marker) {
            header("HTTP/1.1 404 Not Found");
        } else {
            $data['marker'] = $marker;
            $this->load->view('api_get', $data);
        }
    }
    
    /**
     * Delete marker based on mile
     */
    public function delete_marker($marker_mile) {
        $this->load->model('marker_model', 'markermodel');
        $marker = $this->markermodel->findMarkerByMile($marker_mile);

        if (!$marker) {
            header("HTTP/1.1 404 Not Found");
        } else {
            $result = $this->markermodel->delete($marker);
            if ($result) {
                http_response_code(204);
                echo '{success}';
            } else {
                http_response_code(500);
            }
        }
    }
    
    /**
     * gets the nearest marker for a specific GPS coordinate
     */
    public function get_nearest() {
        $this->load->model('marker_model', 'markermodel');
        $long = $this->input->get('longitude');
        $lat = $this->input->get('latitude');
        $marker = $this->markermodel->findClosestMarker($long, $lat);
        if (!$marker) {
            header("HTTP/1.1 404 Not Found");
        } else {
            $data['marker'] = $marker;
            $this->load->view('api_get', $data);
        }
    }
}

?>