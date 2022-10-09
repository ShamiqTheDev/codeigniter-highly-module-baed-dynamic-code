<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	/**
	 * CI_Loader
	 *
	 * @var	CI_Loader
	 */
	public $load;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
		log_message('info', 'Controller Class Initialized');

		$this->user = $this->config->item("pakre_username"); // check constant Auth_model.php Line# 79
        $this->pass = $this->config->item("pakre_password");
        $this->headers = array( "user" => $this->user, "pass" => $this->pass );

	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}


    public function check_auth()
    {
        if (!$this->session->userdata('logged_in'))
        {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>Please login first </div>');
            redirect(base_url());
        }
    }

    function is_Logged_in()
    {
        if ($this->session->userdata('logged_in'))
        {
            redirect(base_url('Dashboard'));
        }
    }


    public function getData($serviceUrl,$id='',$echo=true,$json=true,$coreData=true)
    {
        $url = $this->config->item($serviceUrl).(!empty($id)?'/'.$id:'');
        $data['data'] = $this->restservice->get($url, $this->headers);
        $data['token'] = $this->security->get_csrf_hash();

		if (!$coreData) {
			return $data['data'];
		}  

		if (!$json) {
			return $data;
		}

		if (!$echo) {
		    return json_encode($data);
		}
		
		echo json_encode($data); 
		return TRUE;
    }

    public function postData($serviceUrl,$post,$arayData=false,$coreData=false)
    {
    	$sendData = http_build_query($post);
        $url = $this->config->item($serviceUrl);

        $data['data'] = $this->restservice->post($url, $this->headers,$sendData);
        $data['token'] = $this->security->get_csrf_hash();
     
		if ($coreData) {
			return $data['data'];
		}   
        if ($arayData) {
        	return $data;
        }
    	return json_encode($data);	

    }

    public function deleteData($serviceUrl,$id='',$echo=true,$json=true,$coreData=true)
    {
        $url = $this->config->item($serviceUrl).(!empty($id)?'/'.$id:'');
        $data['data'] = $this->restservice->delete($url, $this->headers,compact('id'));
        $data['token'] = $this->security->get_csrf_hash();

        if (!$coreData) {
            return $data['data'];
        }  

        if (!$json) {
            return $data;
        }

        if (!$echo) {
            return json_encode($data);
        }
        
        echo json_encode($data); 
        return TRUE;
    }

    public function postJsonData($serviceUrl,$post,$arayData=false,$coreData=false)
    {
    	$sendData = json_encode($post);
        $url = $this->config->item($serviceUrl);

        $data['data'] = $this->restservice->postJson($url, $this->headers,$sendData);
        $data['token'] = $this->security->get_csrf_hash();
     
		if ($coreData) {
			return $data['data'];
		}   
        if ($arayData) {
        	return $data;
        }
    	return json_encode($data);	

    }

    public function docUpload($serviceUrl,$post,$file,$arayData=false,$coreData=false)
    {
	    if (isset($file)) {        
    	    $fileName = $file['name'];
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    	    $newFileName = uniqid().'.'.$ext;
    	    $post['file'] = new CurlFile($file['tmp_name'], $file['type'], $newFileName);
        }

	    $sendData = $post;

	    $sourceLocation = $this->config->item($serviceUrl);
	    $response['data'] = $this->restservice->docs_uploading_function($sourceLocation, $this->headers, $sendData);
	    $response['token'] = $this->security->get_csrf_hash();


		if ($coreData) {
			return $response['data'];
		}   
        if ($arayData) {
        	return $response;
        }
    	return json_encode($response);
    }

    function debug($Array)
    {
        echo "<pre>";
        print_r($Array);
        echo "</pre>";
        die;
    }


    function isPermission($url,$ReturnRedirect=true,$returnBoolean=false)
    {
        $userData = $this->session->userdata('userData');

        $moduleDTOS = $userData->roles_permissions->moduleDTOS;
 
//        Static Condition For Admin User give All Permissions & Modules
        if($userData->userName =="superadmin"){
            return true;
        } 
        foreach ($moduleDTOS as $ObjModule)
        {

            $permissions = json_decode(json_encode($ObjModule->permissionDTOList), true);



            $PermissionIndex = (string)array_search($url,array_column($permissions, 'url'));

            if($PermissionIndex >= 0 AND $PermissionIndex !='')
            {

                return true;
            }else
            {
                if($ReturnRedirect)
                {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>Sorry Access Denied.!</div>');
                    return redirect(base_url('Dashboard'));
                }
                if($returnBoolean){
                    return false;
                }
            }

        }

    }


    function RemoveArrayColumn(&$array, $key)
    {
        return array_walk($array, function (&$v) use ($key) {
            unset($v[$key]);
        });
    }


    public function listingFilter($postParams, $filterKeyVals = [])
    {
        $post = [
            'controllerName' => $postParams['service'],
            'currentPage' => isset($postParams['currentPage'])?$postParams['currentPage']:0,
            'itemsPerPages' => isset($postParams['itemsPerPages'])?$postParams['itemsPerPages']:10,
            'sortBy' => isset($postParams['sortBy'])?$postParams['sortBy']:'id',
            'direction' => isset($postParams['direction'])?$postParams['direction']:'DESC',
        ];

        $filters = [];
        $filterKeyVals = replaceInArrayKey($filterKeyVals,'_','.');
        foreach ($filterKeyVals as $filter => $value) {
            $filters[$filter] = $value;
        }
        $postData = array_merge($post,$filters);
        if ($postParams['service'] == 'treatier') {
            $resp = $this->postData('treater_get_group_by_agreement_id',$postData,true)['data'];
            // $resp = $this->restservice->post($this->config->item("treater_get_group_by_agreement_id"), $this->headers, $sendData);
        } else {
            $resp = $this->postData('listingFilter',$postData,true);
        }
        // dd($resp);
        return $resp;
    }

}
