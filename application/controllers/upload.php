<?php
error_reporting(E_ALL | E_STRICT);

class Upload extends Controller {
  
    private $options;

     function __construct($options=null) 
     {
	   	global $config;
		$filepath = $config['filepath'];
        parent::__construct();
        $this->options = array(
            'script_url' => BASE_URL.$config['base_file'] .'/upload/',
            'upload_dir' => $filepath.'/images/',
            'upload_url' => BASE_URL.'files/images/',
            'param_name' => 'files',
            'filesystem' => 'ftp',
            'max_file_size' => null,
            'min_file_size' => 1,
            'accept_file_types' => '/.+$/i',
            'max_number_of_files' => null,
            'discard_aborted_uploads' => true,
            'image_versions' => array(
                'thumbnail' => array(
                    'upload_dir' => $filepath.'/files/images/thumbnails/',
                    'upload_url' => BASE_URL.'files/images/thumbnails/',
                    'max_width' => 100,
                    'max_height' => 100
                )
            )
        );
        if ($options) {
            $this->options = array_merge_recursive($this->options, $options);
        }
    }

    public function index()
    {
        $this->loadPlugin('uploadhandler');
        $upload_handler = new UploadHandler($this->options);
        exit();
    }
    
    public function upload_completed()
    {
        $str_files = '';
        foreach ($_POST as $filename => $value) {
			$str_files .= "<br/> &nbsp;&nbsp;&nbsp;&nbsp; File Name : ".$filename."<br/>"; 
		}
		$strBody = "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><title>contact</title></head><body><font face=\"Verdana\" size=\"2\">";
		$strBody = $strBody . "EMail: <b>".$_SESSION['username']."@".$config['server_domain']." </b><br><br>";
		$strBody = $strBody . $config['email_message']." : <br/><b>".$str_files."</b> <br><br>";
		$strBody = $strBody . "</font>";
		$strBody = $strBody . '<br></body></html>';

	    $subject = $config['email_message'] .' '.$_SESSION['username'];
	    $mensage = $strBody;
		$to      = $_SESSION['username']."@".$config['server_domain'];
        $headers = 'From: '.$config['server_email'] . "\r\n" .
            'Reply-To: '.$config['server_email'] . "\r\n" .
            'Content-type: text/html; charset=iso-8859-1' . "\r\n".
            'X-Mailer: PHP/' . phpversion();
		if( mail($to, $subject, $mensage, $headers)){
			echo "ok";
		} else {
			echo "Error";
		}
        exit();
    }
}
