<?php 
/*
*
*	-----------------------------------------------------------------------------------------------------------------
*   |							Created and Worked By in Feb 2020  : Muhammad Shamiq Hussain						|
*	-----------------------------------------------------------------------------------------------------------------
*   Last Worked Person  	: Shamiq
*   Last Worked Info  		: Dropdown auto selected algorithm fixed.
*   Last Worked Function  	: (upd) getArrayChildObject, (new) returnFinalValue
*   Last Updated    		: 16-April-2020
*   Update History  		: 16-April-2020
*   WARNING         		: Updating/changing in any function without my permission may cause bugs in functions!
*
*/


function activeInput($type,$postVal,$formVal) {
	$data = '';
	if ($type == 'select') {
		if ($formVal == $postVal) {
			$data = "selected='selected'";
		}
	}
	if ($type == 'text') {
		if (!empty($postVal)) {
			$data = $postVal;
		}
	}

	return $data;
}


function replaceInArrayKey($arr,$search,$replaceWith) {
	$data='';
	if (is_array($arr)) {

		$newArr = array_filter($arr);
		$formedArr=[];
		foreach ($newArr as $key => $value) {
			$key = str_replace($search, $replaceWith, $key);
			$formedArr[$key] = $value;
		}
		$data = $formedArr;	
	}
	return $data;
}


function camelCaseToSnakeCase($inputData) {
	$data = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $inputData));
	return $data;
}

function camelCase($str) {
    $i = array("-","_");
    $str = preg_replace('/([a-z])([A-Z])/', "\\1 \\2", $str);
    $str = preg_replace('@[^a-zA-Z0-9\-_ ]+@', '', $str);
    $str = str_replace($i, ' ', $str);
    $str = str_replace(' ', '', ucwords(strtolower($str)));
    $str = strtolower(substr($str,0,1)).substr($str,1);
    return $str;
}

/*
 *
 *	For responses
 *
*/
function toJson($arr ,$exit = false ) {
	$data = json_encode($arr);
	ee($data,$exit);
}

function fromJson($str ,$exit = false ) {
	$data = json_decode($str,true);
	
	return $data;
}


/*
 *
 *	This is Image Upload function coded for CI.
 *
*/
function uploadFile($fileData) {
	if (is_array($fileData) && isset($fileData['file']) && $fileData['name']) {

		$files 				= $fileData['file'];
		$inputName 			= $fileData['name'];
		$inUploadsFolder 	= isset($fileData['inUploadsFolder'])?$fileData['inUploadsFolder']:''; 
		$extensions 		= isset($fileData['extensions'])?$fileData['extensions']:'jpg|jpeg';
		$unlinkPath 		= isset($fileData['unlinkPath'])?$fileData['unlinkPath']:'';

	}else{
		$data = [
			'!!! Function Docs !!!' => [
				'file' 				=> '$_FILES parameter from file upload',
				'name' 				=> 'this is input name',
				'inUploadsFolder' 	=> 'name of new folder you want to create in uploads folder',
				'extensions' 		=> 'extensions of file default is jpg|jpeg',
				'unlinkPath' 		=> 'for file update remove old file and place new different name',
            ],
			'Example Data' => [
				'file' 				=> '$_FILES',
				'name' 				=> 'inputName',
				'inUploadsFolder' 	=> 'newFolderName',
				'extensions' 		=> 'jpg|jpeg',
				'unlinkPath' 		=> './uploads/images',
        	],
			'requiredParameters' => 'name & file',
			'optionalParameters' => 'extensions & unlinkPath',
        ];

		dd($data);

	}

	$data = false;
	$CI = get_instance();

	if(isset($files[$inputName]["name"])){
		$file = $files[$inputName];
    	if (!file_exists('./uploads/'.$inUploadsFolder)) {
		    mkdir('./uploads/'.$inUploadsFolder, 0775, true);
		}
        if (!empty($unlinkPath) && file_exists($unlinkPath)) {
			unlink($unlinkPath);
        }

        $inUploadsFolder = '/'.$inUploadsFolder;
        $uploadPath = isset($fileData['uploadPath'])?$fileData['uploadPath']:'./uploads'.$inUploadsFolder;
        if (!file_exists($uploadPath)) {
        	mkdir($uploadPath, 0775, true);
        }
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = $extensions;
        $temp = explode(".", $file["name"]); 
        $ext = end($temp);
        $newName = uniqid().$ext;
		$config['file_name'] = $newName;

        $CI->load->library('upload', $config);  
        if(!$CI->upload->do_upload($inputName)){  
			echo $CI->upload->display_errors();  
        }else{  
			$uploadedData 	= $CI->upload->data();
			$fileName 		= $uploadedData['file_name'];
			$size 			= $uploadedData['file_size'];
			$fileDir 		= $uploadPath.'/'.$fileName;  
            $fileData 		= file_get_contents($fileDir);
			$encodedImg		= base64_encode($fileData);

            $data = [
            	// initially algo was deasigned for image updloading will be updated in upcoming projects. 
            	'imagePath'		=> $fileDir,
            	'imageEncoded' 	=> $encodedImg,
            	'imageSize' 	=> $size,
            ];

        }
    }
	return $data;
}

function uploadImage($fileData) {
	if (is_array($fileData) && isset($fileData['file']) && $fileData['name']) {

		$files 				= $fileData['file'];
		$inputName 			= $fileData['name'];
		$inUploadsFolder 	= isset($fileData['inUploadsFolder'])?$fileData['inUploadsFolder']:''; 
		$extensions 		= isset($fileData['extensions'])?$fileData['extensions']:'jpg|jpeg';
		$unlinkPath 		= isset($fileData['unlinkPath'])?$fileData['unlinkPath']:'';

	}else{
		$data = [
			'!!! Function Docs !!!' => [
				'file' 				=> '$_FILES parameter from file upload',
				'name' 				=> 'this is input name',
				'inUploadsFolder' 	=> 'name of new folder you want to create in uploads folder',
				'extensions' 		=> 'extensions of file default is jpg|jpeg',
				'unlinkPath' 		=> 'for file update remove old file and place new different name',
            ],
			'Example Data' => [
				'file' 				=> '$_FILES',
				'name' 				=> 'inputName',
				'inUploadsFolder' 	=> 'newFolderName',
				'extensions' 		=> 'jpg|jpeg',
				'unlinkPath' 		=> './uploads/images',
        	],
			'requiredParameters' => 'name & file',
			'optionalParameters' => 'extensions & unlinkPath',
        ];

		dd($data);

	}

	$data = false;
	$CI = get_instance();

	if(isset($files[$inputName]["name"])){
		$file = $files[$inputName];
    	if (!file_exists('./uploads/'.$inUploadsFolder)) {
		    mkdir('./uploads/'.$inUploadsFolder, 0775, true);
		}
        if (!empty($unlinkPath) && file_exists($unlinkPath)) {
			unlink($unlinkPath);
        }

        // $inUploadsFolder = '/'.$inUploadsFolder;
        $uploadPath = isset($fileData['uploadPath'])?$fileData['uploadPath']:'./uploads'.$inUploadsFolder;
        if (!file_exists($uploadPath)) {
        	mkdir($uploadPath, 0775, true);
        }
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = $extensions;
        $temp = explode(".", $file["name"]); 
        $ext = end($temp);
        $newName = uniqid().$ext;
		$config['file_name'] = $newName;

        $CI->load->library('upload', $config);  
        if(!$CI->upload->do_upload($inputName)){  
			echo $CI->upload->display_errors();  
        }else{  
			$uploadedData 	= $CI->upload->data();
			$fileName 		= $uploadedData['file_name'];
			$size 			= $uploadedData['file_size'];
			$fileDir 		= $uploadPath.'/'.$fileName;  
            $fileData 		= file_get_contents($fileDir);
			$encodedImg		= base64_encode($fileData);

            $data = [
            	// initially algo was deasigned for image updloading will be updated in upcoming projects. 
            	'imagePath'		=> $fileDir,
            	'imageEncoded' 	=> $encodedImg,
            	'imageSize' 	=> $size,
            ];

        }
    }
	return $data;
}

function getFileNameFromUrl($url,$extension='') {
	$file = basename($url);
	if (!empty($extension)) {
		$file = basename($path,$extension);
	}
	return $file;
}


function generateFields($input) { 
	$ci = get_instance();
	$col = isset($input['column'])?$input['column']:'col-lg-4';
	if ($input['type'] == 'hidden') {
		$field = form_input($input);
		echo $field;
	} else {
	?>
	<div class="<?php echo $col?>">
		<div class="form-group form-validate mg-b-10-force">
		  <label class="form-control-label"><?php echo isset($input['label'])?$input['label']:''?> 
			  <?php echo isset($input['validation']['required']) && $input['validation']['required'] == true ?'<span class="tx-danger">*</span>':''?>
		  </label>
		  <?php
		  	if(isset($input['label']))
		  		unset($input['label']);

		  	if(isset($input['validation']))
		  		unset($input['validation']);

		  	if ($ci->uri->segment(2) == 'view') {
		  		$input['disabled'] = 'disabled';
		  	}

		    if ($input['type'] == 'select') {
		    	unset($input['disabled']);
		    	if ($ci->uri->segment(2) == 'view') {
		    		$input['attributes']['disabled'] = 'disabled';
		    	}
		    	$options = isset($input['options'])?$input['options']:[];
		    	$attributes = isset($input['attributes'])?$input['attributes']:[];

		      	$field = form_dropdown($attributes,$options);
		    } elseif ($input['type'] == 'textarea') {
		    	$field = form_textarea($input);
		    } else {
		      $field = form_input($input); 
		    }
		    echo $field;
		  ?>
		</div>
	</div>
	<?php
	}
}

function years() {
    $years = array_replace_recursive(
        ['' => 'Please Select'],
        array_combine(range(date('Y')-5, date('Y')), range(date('Y')-5, date('Y')))
    );

    return $years;      
}

function getArrayChildObject($fieldName,$formValues) {
	$finalValue='';
	$for = $fieldName;

	if (strpos($fieldName,'.') !== false) {
		$fieldAncestors = explode('.', $fieldName);
		$n = count($fieldAncestors);
    }else{
    	$fieldAncestors = $fieldName;
    	$n = 0;
    }

    $finalValue = returnFinalValue($fieldAncestors,$formValues,$n);

    return $finalValue;
}

function returnFinalValue($fieldAncestors,$formValues,$n) {
	// this is beta function needs to be tested on $n > 2
	for ($i=0; $i < $n; $i++) {
		$member = $fieldAncestors[$i];

		if ($formValues[$member] instanceof stdClass) {
			$subFormValues = (array) $formValues[$member];
		}else{
			$subFormValues = $formValues[$member];
		}
		$nextKey = $i+1;
		if (isset($fieldAncestors[$nextKey]) && isset($subFormValues[$fieldAncestors[$nextKey]]) && !is_array($subFormValues[$fieldAncestors[$nextKey]]) ) {
			$finalValue = $subFormValues[$fieldAncestors[$nextKey]];
			return $finalValue;
		}
	}
}

function globalDateFormat($date) {
	$unixEpoch = strtotime($date);
	return $unixEpoch;
	$date = date('m/d/Y',strtotime($date));

	return $date;
}

function specialFormatting($string) {
	$encripted = preg_replace("/(\W)+/", '', $string);
	return $encripted;
}


function getSelectedOptions($val,$configKey) {
	$options='';
	$CI = get_instance();
	$ops = $CI->config->item($configKey);
	if(is_array($ops) && !empty($ops)) {
		foreach ($ops as $k => $v) {
			if ($val == $k) {
				$selected = 'selected="selected"';
			} else {
				$selected = '';
			}
			$options .= '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
		}
	}
	return $options;
}