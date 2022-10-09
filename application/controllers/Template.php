<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends CI_Controller {

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

    /**
     *
     *  WorkFlow Listing Service 
     *
    */
    public function index()
    {
        $this->isPermission($this->uri->segment(1));
        if ($this->input->post('get_data')) {

            $post = $this->input->post();
            $post = array_merge($post,$this->config->item('listing'));
            $response = $this->postData($this->module.'_listing_filter',$post,true);
            $token = $this->security->get_csrf_hash();

            $this->data['get_data'] = $response['data'];
            $this->data['token'] = $token;

            toJson($this->data);
            return TRUE;
        }

        $dataColumns = [
            'name'      => $this->lang->line('col_templatenName'),
            'title'     => $this->lang->line('col_title'),
            'date'      => $this->lang->line('col_date'),
        ];
        
        $module = $this->module;

        $ListingConfig = [
            'PageTitle'     => $this->lang->line('menu_template'),
            'URl'           => current_url(),
            'DataColumns'   => json_encode($dataColumns),
            'ActionButtons' => array(
                "View"   => $this->isPermission('template/view',false,true),
                "Insert" => $this->isPermission('template/create',false,true),
                "Edit"   => $this->isPermission('template/edit',false,true),
                "Delete" => $this->isPermission('template/delete',false,true)
            ),
            'currentPage'   => 0,
            'ItemPerpage'   => 10,
            'BtnAddNewRecordTitle'  => $this->lang->line('btn_add_new_template')
        ];

        $SearchFilters = array(

            array(
                'label'         => 'Template Name',
                'placeholder'   => 'Enter Template Name',
                'name'          => 'name',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,

            ),
        );

        $ListingConfig['SearchFilters'] = $SearchFilters;
        $this->load->view('listing', compact('module','ListingConfig'));
    }

    /**
     *
     *   This Module Create Form
     *
    */
    public function moduleFormData($formValues='')
    {
        $saveButton = '<span class="cke_button_icon cke_button__save_icon" style="background-image:url(\'https://cdn.ckeditor.com/4.14.0/full/plugins/icons.png?t=K24B\');background-position:0 -1728px;background-size:auto;">&nbsp;</span>';
        $dateFormat = $this->config->item('backend_date_format');
        $data = [
            'pageTitle' => 'Template',
            'form' => [
                'action' => base_url($this->module."/create"),
                'attributes' => [
                    'class' => 'form-horizontal', 
                    'id'    => $this->module.'_form',
                ],
                'inputs' => [ // START: Inputs


                    [ //name
                        'label'         => 'Name',
                        'placeholder'   => 'Enter template name',
                        'name'          => 'name',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    => [
                            'required'      => true,
                            // 'email'         => false,
                            // 'number'        => true,
                            'minlength'     => 4,
                            'maxlength'     => 40,

                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],
                    [ //Title
                        'label'         => 'Title',
                        'placeholder'   => 'Enter title',
                        'name'          => 'title',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => true,
                            // 'email'         => false,
                            // 'number'        => true,
                            'minlength'     => 4,
                            'maxlength'     => 40,

                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],

                    [ // module dpdn
                        'type'          => 'select',
                        'label'         => 'Module',

                        'attributes'    =>[
                            'placeholder'   => 'Select Module',
                            'name'          => 'moduleDTO.id',
                            'class'         => 'form-control select2 moduleOptions',
                        ],
                        'validation'    =>[
                            'required'      => true,
                            // 'email'         => false,
                            // 'number'        => false,
                            // 'minlength'     => 0,
                            // 'maxlength'     => 0,
                        ],
                        // 'validationMessage' => 'Please select a module',
                    ],

                    [ //header
                        'label'         => 'Header',
                        'placeholder'   => 'Enter header content',
                        'name'          => 'header',
                        'type'          => 'textarea',
                        'rows'          => '3',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => true,
                            // 'email'         => true,
                            // 'number'        => true,
                            'minlength'     => 4,
                            'maxlength'     => 40,

                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],
                    [ //footer
                        'label'         => 'footer',
                        'placeholder'   => 'Enter footer',
                        'name'          => 'footer',
                        'type'          => 'textarea',
                        'rows'          => '3',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => true, 
                            'minlength'     => 4,
                            'maxlength'     => 100,

                        ],
                    ],
                    [ //content
                        'label'         => 'Content',
                        'placeholder'   => 'Enter Content',
                        'name'          => 'content',
                        'type'          => 'textarea',
                        'rows'          => '3',
                        'class'         => 'form-control cke_editor',
                        'id'            => 'content',
                        'column'        => 'col-lg-12',
                        'validation'    =>[
                            'required'      => true, 
                            'minlength'     => 4,
                            // 'maxlength'     => 500,
                        ],
                        // 'validationMessage' => "Please enter content and click <b>Save</b> button",
                    ],                    
                    [ //date
                        'name'  => 'date',
                        'type'  => 'hidden',
                        'value' => date($dateFormat),
                    ],


                ], // END: Inputs
            ],
        ];

        if ($formValues instanceof stdClass) {
            $formValues = (array) $formValues;
        }
        if (is_array($formValues)) {
            $inputs = $data['form']['inputs'];
            $inputWithValues = [];
            foreach ($inputs as $input) {
                if ($input['type'] == 'text' || $input['type'] == 'textarea') {
                    
                    $input['value'] = $formValues[$input['name']];
                }elseif($input['type'] == 'select'){

                    $fieldName = $input['attributes']['name'];
                    $fieldValue = getArrayChildObject($fieldName,$formValues);
                    $input['attributes']['data-select'] = !empty($fieldValue)?$fieldValue:$fieldName;
                }
                $inputWithValues[] = $input;
            }
            $data['form']['inputs'] = $inputWithValues;
        }
        return $data;
    }

    /**
     *
     *  WorkFlow Create Service 
     *
    */
    public function create()
    {
        if ($this->input->post('name')) {
            $post = replaceInArrayKey($this->input->post(),"_",".");
            // dd($post);
            $response = $this->postData($this->module.'_create',$post,1,1);
            $token = $this->security->get_csrf_hash();

            $this->data['data'] = $response;
            $this->data['token'] = $token;

            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');

            }
            toJson($this->data);
            // redirect(base_url($this->module.'/'));
            return TRUE;
        }

        $html = $this->moduleFormData();
        $module = $this->module;
        
        $this->load->view('/form',compact('module','html'));
    }


    /**
     *
     *  WorkFlow Edit Service 
     *
    */
    public function edit($id=NULL)
    {
        $id = base64_decode($id);

        if ($this->input->post('id')) {
            $post = replaceInArrayKey($this->input->post(),"_",".");
        // dd($post);
            $response = $this->postData($this->module.'_update',$post,1,1);
            $token = $this->security->get_csrf_hash();

            $this->data['data'] = $response;
            $this->data['token'] = $token;

            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');

            }
            
            toJson($this->data);
            // redirect(base_url($this->module.'/'));
            return TRUE;
        }
        $response = $this->getData($this->module.'_view', $id, false, false);

        $response = $response['data'];
        $module = $this->module;
        $html = $this->moduleFormData($response);

        $this->data =  compact('module','html','response');
        $this->load->view('form',$this->data);
    }

    /**
     *
     *  WorkFlow View Service 
     *
    */
    public function view($id=NULL)
    {
        $id = base64_decode($id);

        $response = $this->getData($this->module.'_view',$id,0,0,0);
        $module = $this->module;
        $html = $this->moduleFormData($response);

        $this->load->view('/form',compact('module','html','response'));

    }

    /**
     *
     *  WorkFlow Delete Service 
     *
    */
    public function delete() 
    {
        if ($this->input->post('id')) {
            $id = base64_decode($this->input->post('id'));
            // method getData is used now instead of deleteData
            $response = $this->getData($this->module.'_delete',$id,0,0,0);
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;
        }
    }

    public function fileUpload()
    {
        $baseUrl = base_url('uploads/templateImages');


        // ------------------------
        // Data processing
        // ------------------------

        $url = '' ;
        if (isset($_FILES['upload'])) {

            $uploadData = [
                'file'          => $_FILES, 
                'name'          => 'upload',
                'extensions'    => 'jpg|jpeg|png',
                'inUploadsFolder'   => 'templateImages',
            ];
            $file = uploadFile($uploadData);
            $ext = pathinfo($file['imagePath'], PATHINFO_EXTENSION);
            $fileName = basename($file['imagePath']);
            $url = base_url('uploads/'.$uploadData['inUploadsFolder'].'/'.$fileName);

            $response = [
                'uploaded'  => 1,
                'fileName'  => $fileName,
                'url'       => $url,
            ];
        }
        else
        {
            $response = [
                'uploaded'  => 0,
                'fileName'  => ''   ,
                'url'       => '',
            ];
        }

        echo json_encode($response);        
    }

}