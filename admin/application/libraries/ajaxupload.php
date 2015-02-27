<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajaxupload
{
	
	public function getUpload($config,$key='fileajax')
	{
	
	if ( ! isset($_FILES[$key])){
	
	return FALSE;
	
	}
	
			$name = $_FILES[$key]['name'];
			$size = $_FILES[$key]['size'];
		
		
		
			if(strlen($name))
				{
					list($txt, $ext) = explode(".", $name);
					if(in_array($ext,$config['format']))
					{
					if($size<(1024*$config['size']))
						{
							$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
							$tmp = $_FILES[$key]['tmp_name'];
							if(move_uploaded_file($tmp, $config['path'].$actual_image_name))
								{
						
						//echo "sukses";
									
								}
							else
						echo "failed";
						}
						else
						echo "Image file size big";					
						}
						else
						echo "Invalid file format..";	
				}
	
	
						$this->file_temp = $_FILES[$key]['tmp_name'];
						$this->file_size = $_FILES[$key]['size'];
						$this->file_name = $actual_image_name; //$_FILES[$key]['name']
						$this->file_ext	 = $ext;

	
	}
	
								
	public function query()
	{
	
	if ( ! isset($this->file_name)){
	
			return array (
						'file_name'			=> '',
						'file_temp'			=> '',
						'file_ext'			=> '',
						'file_size'			=> ''
					);
	
	}
		return array (
						'file_name'			=> $this->file_name,
						'file_temp'			=> $this->file_temp,
						'file_ext'			=> $this->file_ext,
						'file_size'			=> $this->file_size
					);
	}

}
?>