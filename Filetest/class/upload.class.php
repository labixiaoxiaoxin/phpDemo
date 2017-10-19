<?php

class Upload {

    protected $fileName;
    protected $maxSize;
    protected $allowMime;
    protected $allowExt;
    protected $uploadPath;
    protected $imgFlag;
    protected $fileInfo;
    protected $error;
    protected $ext;

    /**
     * 构造函数
     * @var string
     */
    public function __construct($fileName = "myFile", $uploadPath = "./uploads", $imgFlag = true, $maxSize = 2097152, $allowExt = array('jpg', 'jpeg', 'png', 'gif'), $allowMime = array('image/jpeg', 'image/png', 'image/gif')) {
        $this->fileName   = $fileName;
        $this->maxSize    = $maxSize;
        $this->allowMime  = $allowMime;
        $this->allowExt   = $allowExt;
        $this->uploadPath = $uploadPath;
        $this->imgFlag    = $imgFlag;
        $this->fileInfo   = $_FILES[$this->fileName];
    }

    /**
     * 匹配错误号
     * @return boolean [true or false]
     */
    protected function checkError() {
    	// var_dump($this->fileInfo);exit;
        if (!is_null($this->fileInfo)) {
            if ($this->fileInfo['error'] > 0) {
                switch ($this->fileInfo['error']) {
                case 1:
                    $this->error = "上传文件超过了upload_max_filesize限制的值";
                    break;
                case 2:
                    $this->error = "上传文件超过了html表单中MAX_FILE_SIZE指定值";
                    break;
                case 3:
                    $this->error = "文件只有部分被上传";
                    break;
                case 4:
                    $this->error = "文件没有被上传";
                    break;
                case 6:
                    $this->error = "找不到临时文件夹";
                    break;
                case 7:
                    $this->error = "文件写入失败";
                    break;
                case 8:
                    $this->error = "上传的文件被PHP扩展程序中断";
                    break;
                }
                return false;
            } else {
                return true;
            }
        } else {
            $this->error = "文件上传出错";
            return false;
        }
    }

    /**
     * 检测上传文件大小
     * @return boolean [true or false]
     */
    protected function checkSize() {
        if ($this->fileInfo['size'] > $this->maxSize) {
            $this->error = "上传文件超过了规定大小";
            return false;
        }
        return true;
    }

    /**
     * 检测上传文件后缀名
     * @return boolean [true or false]
     */
    protected function checkExt() {
        $this->ext = strtolower(pathinfo($this->fileInfo['name'], PATHINFO_EXTENSION));
        if (!in_array($this->ext, $this->allowExt)) {
            $this->error = "非法文件类型";
            return false;
        }
        return true;
    }

    /**
     * 检测文件的类型
     * @return boolean [true or false]
     */
    protected function checkMime() {
        if (!in_array($this->fileInfo['type'], $this->allowMime)) {
            $this->error = "不允许的文件类型";
            return false;
        }
        return true;
    }

    /**
     * 检测文件是否为真实图片
     * @return boolean [true or false]
     */
    protected function checkTrueImg() {
        if ($this->imgFlag) {
            if (@!getimagesize($this->fileInfo['tmp_name'])) {
                $this->error = "不是真实的图片";
                return false;
            }
            return true;
        }
    }

    /**
     * 检测文件是否是通过HTTP POST方式上传的
     * @return boolean [true or false]
     */
    protected function checkHTTPPost() {
        if (!is_uploaded_file($this->fileInfo['tmp_name'])) {
            $this->error = "文件不是通过HTTP POST方式上传的";
            return false;
        }
        return true;
    }

    /**
     * 检测上传目录是否存在，不存在则创建
     */
    protected function checkUploadPath() {
        if (!file_exists($this->uploadPath)) {
            mkdir($this->uploadPath, 0777, true);
        }
    }

    /**
     * 显示错误信息
     */
    protected function showError() {
        exit("<span style='color:red'>" . $this->error . "</span>");
    }

    /**
     * 得到唯一字符串
     * @return string [返回唯一字符串]
     */
    protected function getUniName() {
        return md5(uniqid(microtime(true), true));
    }

    /**
     * 上传文件
     * @return string [返回保存路径]
     */
    public function uploadFile() {
        if ($this->checkError() && $this->checkSize() && $this->checkExt() && $this->checkMime() && $this->checkHTTPPost() && $this->checkTrueImg()) {
            $this->checkUploadPath();
            $this->uniName     = $this->getUniName();
            $this->destination = $this->uploadPath . "/" . $this->uniName . "." . $this->ext;
            if (move_uploaded_file($this->fileInfo['tmp_name'], $this->destination)) {
                return $this->destination;
            } else {
                $this->error = "文件移动失败";
                $this->showError();
            }
        } else {
            $this->showError();
        }
    }

}