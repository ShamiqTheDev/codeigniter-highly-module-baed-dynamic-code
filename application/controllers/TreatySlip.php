<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TreatySlip extends CI_Controller {

    protected $module;
	protected $headers; 

    function __construct() {
        parent::__construct();
        $this->check_auth();

        $this->load->vars('base_url', base_url());
        $this->load->vars('includes_dir', base_url() . 'assets/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));

        $this->data = null;

        $this->module = strtolower(__CLASS__);
    }

    /*
     *
     *  Treaty Slip Listing Service 
     *
     */
    public function index()
    {
        if ($this->input->post('get_data')) {

            $response = $this->postData($this->module.'_listing_filter',$this->input->post(),true);
            $token = $this->security->get_csrf_hash();
            $this->data['get_data'] = $response['data'];
            $this->data['token'] = $token;

            toJson($this->data);
            return TRUE;
        }

       
        $ListingConfig = array();
        $ListingConfig['URl'] = current_url();
        $ListingConfig['DataColumns'] = json_encode(array("name"=>"Treaty Name","treatyDate"=>"Treaty Date","year"=>"Treaty Year","rate"=>"Rate"));
        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['ActionButtons'] = array(
            "View"   => $this->isPermission('treatyslip/view',false,true),
            "Insert" => $this->isPermission('treatyslip/create',false,true),
            "Edit"   => $this->isPermission('treatyslip/edit',false,true),
            "Delete" => $this->isPermission('treatyslip/delete',false,true)
        );
        $ListingConfig['PageTitle'] = "Treaty Slip";

        $this->data['ListingConfig'] = $ListingConfig;
        $this->load->view('listing', $this->data);
    }


}