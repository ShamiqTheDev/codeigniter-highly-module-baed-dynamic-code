<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	protected $headers = [];
    function __construct() {
        parent::__construct();
        $this->check_auth();

        $this->load->vars('base_url', base_url());
        $this->load->vars('includes_dir', base_url() . 'assets/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));

        $this->data = null;

        $this->user = $this->config->item("pakre_username"); // check constant Auth_model.php Line# 79
        $this->pass = $this->config->item("pakre_password");

        $this->headers = array("user" => $this->user, "pass" => $this->pass);

    }
	

    // Service#1 (User Listing)
    public function index($pageNo='')
    {
        $this->isPermission($this->uri->segment(1));

        $this->data['roles'] = $this->restservice->get($this->config->item("role_listing"), $this->headers,'');

        if ($this->input->post('search_data'))
        {
            $sourceLocation = $this->config->item("user_listing");
            $sendData = http_build_query($_POST);

            $get_response = array();

            $response = $this->restservice->post($sourceLocation, $this->headers, $sendData);
            $token = $this->security->get_csrf_hash();

            $get_response["search_data"] = $response;
            $get_response["get_csrf_hash"] = $token;
            toJson($get_response,1);
            
            echo $sendData;
            return TRUE;
            
        }


        if (isset($_POST["get_data"])) {
            if (!empty($pageNo)) {
                $_POST['currentPage'] = base64_decode($pageNo);
            }
            $_POST = array_merge($_POST,$this->config->item('listing'));

            $sourceLocation = $this->config->item("user_listing");
            // $headers = array("user" => $this->user, "pass" => $this->pass);

            $sendData = http_build_query($_POST);

            $get_response = array();
            $response = $this->restservice->post($sourceLocation, $this->headers, $sendData);

            $token = $this->security->get_csrf_hash();

            $get_response["get_data"] = $response;
            $get_response["get_csrf_hash"] = $token;
            toJson($get_response,1);
            return TRUE;
        }

        $SearchFilters = array(

            array(
                'label'         => 'User Name',
                'placeholder'   => 'Enter User Name',
                'name'          => 'userName',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,

            ),
            array(
                'label'         => 'User Email',
                'placeholder'   => 'Enter User Email',
                'name'          => 'email',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,

            ),
            array(
                'label'         => 'Role Name',
                'name'          => 'rollName',
                'type'          => 'dropdown',
                'class'         => 'form-control',
                'required'      => false,
                "optionValueColumn" =>"name",
                "optionTextColumn" =>"name",
                "options"       => $this->restservice->get($this->config->item('role_listing'), $this->headers),

            ),
        );
        $ListingConfig = array();
        $ListingConfig['URl'] = current_url();
        $ListingConfig['DataColumns'] = json_encode(array(
                                            "userName"=>$this->lang->line('col_username'),
                                            "email"=>$this->lang->line('col_email'),
                                            "roleDTO_name"=>$this->lang->line('col_roleName'),
                                            )
                                        );
        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['ActionButtons'] = array(
            "View"   => $this->isPermission('user/view',false,true),
            "Insert" => $this->isPermission('user/create',false,true),
            "Edit"   => $this->isPermission('user/edit',false,true),
            "Delete" => $this->isPermission('user/delete',false,true)
        );
        $ListingConfig['PageTitle'] = $this->lang->line('menu_users');
        $ListingConfig['BtnAddNewRecordTitle'] = $this->lang->line('add_users');
        $ListingConfig['SearchFilters'] = $SearchFilters;
        $this->data['ListingConfig'] = $ListingConfig;

        $this->load->view('listing', $this->data);


    }

	// Service#2 (Create User)
    public function create() 
    {
        $post = replaceInArrayKey($_POST,'_','.');
        $this->data["action"] = "add_record";

        $this->data['roles'] = $this->restservice->get($this->config->item("role_listing"), $this->headers,'');

        if ($this->input->post('email'))
        {
            $imageFieldName = 'userImage';
            $imgPath = isset($_POST['userImagePath'])?$_POST['userImagePath']:'';
            
            $uploadData = [
                'file'          => $_FILES,
                'name'          => $imageFieldName,
                'extensions'    => 'jpg|jpeg|png',
            ];
            $file = uploadImage($uploadData);
            $getFileName = $file['imagePath'];
            $newFileName = pathinfo($getFileName, PATHINFO_BASENAME);
            $post['file'] = new CurlFile($_FILES['userImage']['tmp_name'], $_FILES['userImage']['type'], $newFileName);
            $postData = $post;
            $response = $this->restservice->post_multipart($this->config->item("user_create"), $this->headers, $postData);
            $response->token = $this->security->get_csrf_hash();

            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('user');
            }
            echo json_encode($response);
            return TRUE;
        }

        $this->load->view('user/create', $this->data);
    }

    // Service#4 (Update User)
    public function edit($id='')
    {
        $this->data["action"] = "edit_record";
        $this->data['roles'] = $this->restservice->get($this->config->item("role_listing"), $this->headers,'');
        // $_POST = array_filter($this->input->post());

        if ($this->input->post('email')) {
            $imageFieldName = 'userImage';
        	$post = replaceInArrayKey($_POST,"_",".");
            
            if (!empty($_FILES['userImage']['name'])) {
                $uploadData = [
                    'file'          => $_FILES,
                    'name'          => $imageFieldName,
                    'extensions'    => 'jpg|jpeg|png',
                ];
                $file = uploadImage($uploadData);
                $getFileName = $file['imagePath'];
                $newFileName = pathinfo($getFileName, PATHINFO_BASENAME);
                $post['file'] = new CurlFile($_FILES['userImage']['tmp_name'], $_FILES['userImage']['type'], $newFileName);
                
            }

            $sourceLocation = $this->config->item("user_update");
            $response = $this->restservice->post_multipart($sourceLocation, $this->headers, $post);
            $response->token = $this->security->get_csrf_hash();
            if($response->code == 1) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('user');
            }
            echo json_encode($response);

            return TRUE;
        }

        $this->data['response'] = $this->restservice->get($this->config->item("user_view").'/'.base64_decode($id), $this->headers);
        $this->load->view('user/create', $this->data);
    }

    // Service#3 (View User)
    public function view($id)
    {
        $this->data["action"] = "view_record";
        $this->data['response'] = $this->restservice->get($this->config->item("user_view").'/'.base64_decode($id), $this->headers);
        $this->data['roles'] = $this->restservice->get($this->config->item('role_listing'), $this->headers);

        $this->load->view('user/create', $this->data);
    }


    // Service#3 (Delete User)
    public function delete() 
    {
        if ($this->input->post('id')) {
            $id = base64_decode($this->input->post('id'));
            $sourceLocation = $this->config->item("user_delete");
            // $headers = array("user" => $this->user, "pass" => $this->pass);
            $sendData = $id;
            $sourceLocation = $sourceLocation . "/" . $sendData;
            $response = $this->restservice->get($sourceLocation, $this->headers, $sendData);
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;
        }
    }


    public function docUpload($serviceUrl,$post,$file,$arayData=false,$coreData=false)
    {
        $fileName = $file['name'];
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $newFileName = uniqid().'.'.$ext;
        $post['file'] = new CurlFile($file['tmp_name'], $file['type'], $newFileName);

        $sendData = $post;

        $response = $this->restservice->docs_uploading_function($serviceUrl, $this->headers, $sendData);
        $response['token'] = $this->security->get_csrf_hash();

        echo json_encode($response);
    }
}