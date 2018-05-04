<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 19.12.2017
 * Time: 20:12
 */

namespace helper;

use services\Sessionmanagement;

class FileUploader
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function upload($file,$mimetype)
    {
        if($file['size'] &&
            preg_match('/'.$mimetype.'/',mime_content_type($file['tmp_name'])))
        {
            $this->path .= basename($file['name']);
            if (move_uploaded_file($file['tmp_name'], $this->path))
            {
            }
        }
        else {

        }
    }

}