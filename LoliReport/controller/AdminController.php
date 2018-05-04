<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 21.12.2017
 * Time: 22:52
 */

namespace controller;

use helper\FileUploader;
use services\QueryBuilder;

class AdminController extends BaseController
{

    public function addArticle()
    {
        if ($this->httpHandler->isPost()) {
            $data = $this->httpHandler->getData();

            if ($data) {
                if ($_FILES['Image']['name']) {
                    $uploader = new FileUploader(__DIR__ . '/../assets/places/');

                    $uploader->upload($_FILES['Image'], 'image');

                    $Imagename = $_FILES['Image']['name'];

                    $query = new QueryBuilder();

                    $query
                        ->insert("article")
                        ->addField("title")
                        ->addField("titleDescription")
                        ->addField("image")
                        ->addField("text")
                        ->addField("date")
                        ->addValue("".$data['Title']."")
                        ->addValue("".$data['TitleDescription']."")
                        ->addValue("".$Imagename."")
                        ->addValue("".$data['text']."")
                        ->addLastValue("".$data['Date']."");
                }
                header("Location:/BossBay/Adventure");
            }
        }
    }
}