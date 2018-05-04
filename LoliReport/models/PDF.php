<?php
/**
 * Created by PhpStorm.
 * User: zwerm
 * Date: 24.03.2018
 * Time: 13:06
 */

namespace models;


class PDF
{
    //***************************************************************************************
    //****************************************FIELDS*****************************************
    //***************************************************************************************
    private $name;
    private $width;
    private $height;
    private $pageCount;
    private $currentPage;
    private $language;
    private $cover;
    private $author;
    private $date;
    private $genre;
    private $tags;
    private $text;
    private $document;
    private $image;

    private $colors;
    //****************************************************************************************
    //***************************************METHODS******************************************
    //****************************************************************************************
    public function __construct()
    {
        $this->name = "";
        $this->width = 0;
        $this->height = 0;
        $this->pageCount = 0;
        $this->currentPage = null;
        $this->language = "";
        $this->cover = null;
        $this->author = "";
        $this->date = "";
        $this->genre = "";
        $this->tags = array();
        $this->text = "";
        $this->document = null;
        $this->image = null;
        $colors = new Collection();
    }


    public function drawDoc(){

    }
    public function nextPage(){}
    public function prevPage(){}



    public function _drawLine(){}
    public function _drawRect(){}
    public function _createImage($w, $h, $opaque=false){
        $this->image = imagecreatetruecolor($w, $h);
        $color_white = imagecolorallocate($this->image, 255, 255, 255);
        $color_black = imagecolorallocate($this->image, 0, 0, 0);
        $color_grey = imagecolorallocate($this->image, 100, 100, 100);
        $color_red = imagecolorallocate($this->image, 232, 24, 29);
        $color_blue = imagecolorallocate($this->image, 15, 29, 237);
        $color_green = imagecolorallocate($this->image, 18, 243, 25);
        $color_orange = imagecolorallocate($this->image, 255, 185, 18);
    }
    //****************************************************************************************
    //*********************************GETTERS AND SETTERS************************************
    //****************************************************************************************
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width): void
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height): void
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getPageCount()
    {
        return $this->pageCount;
    }

    /**
     * @param mixed $pageCount
     */
    public function setPageCount($pageCount): void
    {
        $this->pageCount = $pageCount;
    }

    /**
     * @return mixed
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @param mixed $currentPage
     */
    public function setCurrentPage($currentPage): void
    {
        $this->currentPage = $currentPage;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language): void
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * @param mixed $cover
     */
    public function setCover($cover): void
    {
        $this->cover = $cover;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre): void
    {
        $this->genre = $genre;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags): void
    {
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @param mixed $document
     */
    public function setDocument($document): void
    {
        $this->document = $document;
    }
}