<?php
protected $fileName;
protected $maxSize;
protected $allowMime;
protected $allowExt;
protected $uploadPath;
protected $imgFlag;
protected $fileInfo;

/**
 * 构造函数
 * @var string
 */
funtion__construct(public $fileName = "myFile", $uploadPath = "./uploads", $imgFlag = true, $maxSize = 2097152, $allowExt = array('jpg', 'jpeg', 'png', 'gif'), $allowMime = array('image/jpeg', 'image/png', 'image/gif')) {
    $this->fileName   = $fileName;
    $this->maxSize    = $maxSize;
    $this->allowMime  = $allowMime;
    $this->allowExt   = $allowExt;
    $this->uploadPath = $uploadPath;
    $this->imgFlag    = $imgFlag;
    $this->fileInfo   = $_FILES[$this->fileName];
}
