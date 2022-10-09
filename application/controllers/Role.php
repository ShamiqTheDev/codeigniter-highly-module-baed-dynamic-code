<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->check_auth();

        $this->load->vars('base_url', base_url());
        $this->load->vars('includes_dir', base_url() . 'assets/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));
        $this->load->helper('debug');
        $this->load->helper('ui');

        $this->data = null;

        $this->module = strtolower(__CLASS__);
    }


    public function index($pageNo='')
    {


        $this->isPermission($this->uri->segment(1));

        if ($this->input->post('get_data')) {
            $post = $this->input->post();
            $data = [];

            if (!empty($pageNo)) {
                $post['currentPage'] = base64_decode($pageNo);
            }
            $post = array_merge($post,$this->config->item('listing'));

            $response = $this->postData($this->module.'_listing_filter',$post,1,1);
            $token = $this->security->get_csrf_hash();

            $data["get_data"] = $response;
            $data["get_csrf_hash"] = $token;
            echo json_encode($data);
            return TRUE;
        }


        $SearchFilters = array(

            array(
                'label'         => 'Role Name',
                'placeholder'   => 'Enter Role Name',
                'name'          => 'name',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,

            ),
        );

        $ListingConfig = [];
        $ListingConfig['URl'] = current_url();
        $ListingConfig['DataColumns'] = json_encode([
            'name'    => $this->lang->line('col_roleName'),
        ]);
        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['ActionButtons'] = array(
            "View"   => $this->isPermission('role/view',false,true),
            "Insert" => $this->isPermission('role/create',false,true),
            "Edit"   => $this->isPermission('role/edit',false,true),
            "Delete" => $this->isPermission('role/delete',false,true)
        );

        $ListingConfig['PageTitle'] = $this->lang->line('menu_roles');
        $ListingConfig['SearchFilters'] = $SearchFilters;
        $ListingConfig['BtnAddNewRecordTitle'] = $this->lang->line('btn_add_new_role');
        $module = $this->module;
        $this->data = compact('module','ListingConfig');
        $this->load->view('listing', $this->data);
    }

    public function create()
    {
        $this->data["action"] = "add_record";

        if ($this->input->post('name'))
        {
            $sendData = array(
                "name" => $this->input->post('name'),
                "financialLimit" => $this->input->post('financialLimit'),
                "description" => $this->input->post('description'), 
            );

            $modules = $this->input->post('moduleId');
            $aPermissions = $this->input->post('permission')?$this->input->post('permission'):[];
            for ($i=0;$i<count($modules);$i++)
            {
                $moduleId = $modules[$i];
                $sendData['moduleDTOS['.$i.'].id'] = $modules[$i];
                $sendData['moduleDTOS['.$i.'].isCheckedfront'] = true;
                 
                $counter = 0;
                for($a = 0;$a<count($aPermissions);$a++)
                {
                    $PermissionCheck = explode("_",$aPermissions[$a]); 
                    if($PermissionCheck[0] == $moduleId)
                    {
                        $sendData["moduleDTOS[".$i."].permissionDTOList[".$counter."].id"] = $PermissionCheck[1];
                        $sendData["moduleDTOS[".$i."].permissionDTOList[".$counter."].isChecked"] = true;
                        $counter++;
                    }
                    
                }
                 
            } 

            $sendData = http_build_query($sendData);
            $response = $this->restservice->post($this->config->item("role_create"), $this->headers, $sendData);
            $response->token = $this->security->get_csrf_hash();

            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('Role');
            }
            echo json_encode($response);
            return TRUE;
        }
        $this->data['Modules'] = $this->restservice->get($this->config->item("module_getAll"), $this->headers);
        $this->load->view('roles_form', $this->data);

    }


    public function view($id)
    {
        $this->data["action"] = "view_record";
        $this->data['Modules'] = $this->restservice->get($this->config->item("module_getAll"), $this->headers);
        $this->data['data'] = $this->restservice->get($this->config->item("role_view")."/".base64_decode($id),$this->headers);
        $RoleModules  = json_decode(json_encode($this->data['data']->moduleDTOS), true);
        $this->RemoveArrayColumn($RoleModules, 'description');
        $this->data['data']->moduleDTOS = json_decode(json_encode($RoleModules));
        $this->load->view('roles_form', $this->data);
 
    }

    public function edit($id)
    {
        $this->data["action"] = "edit_record";

        if ($this->input->post('name'))
        {
            $sendData = array(
                "id" => base64_decode($id),
                "name" => $this->input->post('name'),
                "financialLimit" => $this->input->post('financialLimit'),
                "description" => $this->input->post('description')
            );
            
            $modules = $this->input->post('moduleId');
            $aPermissions  = $this->input->post('permission');
            for ($i=0;$i<count($modules);$i++)
            {
                $moduleId = $modules[$i];
                $sendData['moduleDTOS['.$i.'].id'] = $modules[$i];
                $sendData['moduleDTOS['.$i.'].isCheckedfront'] = true;
                 
                $counter = 0;
                for($a = 0;$a<count($aPermissions);$a++)
                {
                    $PermissionCheck = explode("_",$aPermissions[$a]); 
                    if($PermissionCheck[0] == $moduleId)
                    {
                        $sendData["moduleDTOS[".$i."].permissionDTOList[".$counter."].id"] = $PermissionCheck[1];
                        $sendData["moduleDTOS[".$i."].permissionDTOList[".$counter."].isChecked"] = true;
                        $counter++;
                    }
                    
                }
                 
            } 

            $sendData = http_build_query($sendData);
            $response = $this->restservice->post($this->config->item("role_update"), $this->headers, $sendData);
            $response->token = $this->security->get_csrf_hash();

            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('Role');
            }
            echo json_encode($response);
            return TRUE;
        }

        $this->data['data'] = $this->restservice->get($this->config->item("role_view")."/".base64_decode($id),$this->headers);
        $this->data['Permissions'] = $this->restservice->get($this->config->item("permission_listing"), $this->headers);
        $this->data['Modules'] = $this->restservice->get($this->config->item("module_getAll"), $this->headers);
        $RoleModules  = json_decode(json_encode($this->data['data']->moduleDTOS), true);
        $this->RemoveArrayColumn($RoleModules, 'description');
        $this->data['data']->moduleDTOS = json_decode(json_encode($RoleModules));

        $this->load->view('roles_form', $this->data);
    }



    // Service#3 (Delete Role)
    public function delete()
    {
        if ($this->input->post('id')) {
            $id = base64_decode($this->input->post('id'));
            $response = $this->getData($this->module.'_delete',$id,0,0,0);
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;
        }
    }

    // Service#5 (View All Roles)
    public function get()
    {
        $response = $this->getData($this->module.'_listing');
        return $response;
    }

    public function getWorkFlowRolesByTretierId($id='')
    {
        $response = $this->postData('treater_get_previous_roles_by_id',['id' => $id],1,1);
        // debug($response);
        $parsedResponse=[];
        if (isset($response->code) && $response->code == 1) {
            $roles = $response->response;
            foreach ($roles as $role) {
                $row = [
                    'id' => $role->roleDTO->id,
                    'name' => $role->roleDTO->name,
                ];

                $parsedResponse['data'][] = $row;
            }
        }
        $parsedResponse['token'] = $this->security->get_csrf_hash();
        $parsedResponse = json_encode($parsedResponse);
        echo $parsedResponse;
        return true;
    }




}