<?php
/**
 * Created by PhpStorm.
 * User: zwerm
 * Date: 20.03.2018
 * Time: 11:18
 */

namespace controller;

use helper\FileUploader;
use models\User;
use MongoDB\Driver\Query;
use PDO;
use services\Cookiemanagement;
use services\DBConnection;
use services\QueryBuilder;
use services\Sessionmanagement;

class ReportController extends BaseController
{
    public function addLoli()
    {

        if ($this->httpHandler->isPost()) {
            $data = $this->httpHandler->getData();
            $imagename = $_FILES['Image']['name'];

            if ($data) {
                if ($_FILES['Image']['name'])
                {
                    mkdir($_SERVER['DOCUMENT_ROOT'] . '/assets/lolis/' . strtolower($data['lastname']), 0777, true);

                    $uploader = new FileUploader( $_SERVER['DOCUMENT_ROOT'] . '/assets/lolis/' . strtolower($data['lastname']) . '/');
                    $uploader->upload($_FILES['Image'], 'image');
                    $query = new QueryBuilder();
                    $user = unserialize(\services\Sessionmanagement::get('user'))['id'];

                    $query
                        ->insert("loli")
                        ->addField("user_fk")
                        ->addField("firstname")
                        ->addField("lastname")
                        ->addField("age")
                        ->addField("deretype")
                        ->addField("image")

                        ->addValue("".$user."")
                        ->addValue("".$data['firstname']."")
                        ->addValue("".$data['lastname']."")
                        ->addValue("".$data['age']."")
                        ->addValue("".$data['deretype']."")
                        ->addLastValue("".strtolower($data['lastname'])."/".$imagename."");

                }
                header("Location:/LoliReport/Loli-Index");
            }
        }
    }

    public function addVideoLoli()
    {
        if ($this->httpHandler->isPost()) {
            $data = $this->httpHandler->getData();
            $query = new QueryBuilder();
            $videoname = $_FILES['Video']['name'];

            $query = new QueryBuilder();
            $user = unserialize(\services\Sessionmanagement::get('user'))['id'];

            $query
                ->insert("media")
                ->addField("name")
                ->addField("user_fk")
                ->addField("loli_fk")
                ->addField("mediatype")
                ->addField("hidden")

                ->addValue("".$videoname."")
                ->addValue("".$user."")
                ->addValue("".$data['id']."")
                ->addValue("".$data['mediatype']."")
                ->addLastValue("".$data['hidden']."");

            if ($data) {
                if ($_FILES['Video']['name'])
                {

                    $videoname_damn = explode(".",$videoname);
                    $lastEl = array_values(array_slice($videoname_damn, -1))[0];

                    if ($lastEl == "mp4" || $lastEl == "ogg") {
                        mkdir($_SERVER['DOCUMENT_ROOT'] . '/assets/lolis/' . strtolower($data['lastname']) . '/videos', 0777, true);
                        $uploader = new FileUploader($_SERVER['DOCUMENT_ROOT'] . '/assets/lolis/' . strtolower($data['lastname']) . '/videos' . '/');
                        $uploader->upload($_FILES['Video'], 'video');
                    } elseif($lastEl == "mp3"){
                        mkdir($_SERVER['DOCUMENT_ROOT'] . '/assets/lolis/' . strtolower($data['lastname']) . '/audio', 0777, true);
                        $uploader = new FileUploader($_SERVER['DOCUMENT_ROOT'] . '/assets/lolis/' . strtolower($data['lastname']) . '/audio' . '/');
                        $uploader->upload($_FILES['Video'], 'audio');
                    }

                }
                header("Location:/BossBay/Loli?id=" . $data['id']);
            }
        }
    }

    public function deleteVideo()
    {
        if ($this->httpHandler->isPost()){
            $data = $this->httpHandler->getData();

            if ($data){
                unlink($_SERVER['DOCUMENT_ROOT'] . '/assets/lolis/' . strtolower($data['lastname']) . '/videos/' . $data['filename']);
            }
            header("Location:/BossBay/Loli?id=" . $data['id']);
        }
    }

}