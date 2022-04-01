<?php
class Image {
    protected $image = "";
    protected $imageInfo = array();
    protected $fileInfo = array();
    protected $tmpfile = array();
    protected $pathToTempFiles = "";
    protected $Watermark;
    protected $newFileType;

    public function __construct($image)
    {
        if(function_exists("sys_get_temp_dir")){
            $this->setPathToTempFiles(sys_get_temp_dir());
        }else{
            $this->setPathToTempFiles($_SERVER["DOCUMENT_ROOT"]);
        }

        if(file_exists($image)){
            $this->image  = $image;
            $this->readImageInfo();
        }else{
            // throw new Exception("File does not exist: ".$image);
        }
    }
    
    function createThumb($thumb_path_url, $width, $height, $crop = 'crop' ){
        $this->resize($width, $height,$crop);
        $thumb_path = pathinfo($thumb_path_url);
        if($thumb_path_url != ""){
            $this->save($thumb_path['filename'], $thumb_path['dirname']);
        }
    }

    public function __destruct()
    {
        if(file_exists($this->tmpfile)){
            unlink($this->tmpfile);
        }
    }

    protected function readImageInfo()
    {
        $data = getimagesize($this->image);

        $this->imageInfo["width"] = $data[0];
        $this->imageInfo["height"] = $data[1];
        $this->imageInfo["imagetype"] = $data[2];
        $this->imageInfo["htmlWidthAndHeight"] = $data[3];
        $this->imageInfo["mime"] = $data["mime"];
        $this->imageInfo["channels"] = ( isset($data["channels"]) ? $data["channels"] : NULL );
        $this->imageInfo["bits"] = $data["bits"];

        return true;
    }

    public function setPathToTempFiles($path)
    {
        $path = realpath($path).DIRECTORY_SEPARATOR;
        $this->pathToTempFiles = $path;
        $this->tmpfile = tempnam($this->pathToTempFiles, "classImagePhp_");

        return true;
    }

    public function setNewFileType($newFileType)
    {
        $this->newFileType = strtolower( $newFileType );

        return true;
    }

    protected function setNewMainImage($pathToImage)
    {
        $this->image = $pathToImage;
        $this->readImageInfo();

        return true;
    }

    public function resize($max_width, $max_height, $method="fit", $cropAreaLeftRight="c", $cropAreaBottomTop="c", $jpgQuality=75)
    {
        $width  = $this->getWidth();
        $height = $this->getHeight();

        $newImage_width  = $max_width;
        $newImage_height = $max_height;
        $srcX = 0;
        $srcY = 0;

        $ratioOfMaxSizes = $max_width / $max_height;
        if($method == "fit"){

            if($ratioOfMaxSizes >= $this->getRatioWidthToHeight()){
                $max_width = $max_height * $this->getRatioWidthToHeight();
            }else{
                $max_height = $max_width * $this->getRatioHeightToWidth();
            }

            $newImage_width = $max_width;
            $newImage_height = $max_height;

        }elseif($method == "crop"){

            if($ratioOfMaxSizes > $this->getRatioWidthToHeight()){
                $max_height = $max_width * $this->getRatioHeightToWidth();
            }else{
                $max_width = $max_height * $this->getRatioWidthToHeight();
            }

            if (is_array($cropAreaLeftRight)) {
                $srcX    = $cropAreaLeftRight[0];
                if($ratioOfMaxSizes > $this->getRatioWidthToHeight()){
                    $width = $cropAreaLeftRight[1];
                }else{
                    $width = $cropAreaLeftRight[1] * $this->getRatioWidthToHeight();
                }
            } elseif ($cropAreaLeftRight == "r") {
                $srcX = $width - (($newImage_width / $max_width) * $width);
            } elseif ($cropAreaLeftRight == "c") {
                $srcX = ($width/2) - ((($newImage_width / $max_width) * $width) / 2);
            }

            if (is_array($cropAreaBottomTop)) {
                $srcY    = $cropAreaBottomTop[0];
                if ($ratioOfMaxSizes > $this->getRatioWidthToHeight()) {
                    $height = $cropAreaBottomTop[1] * $this->getRatioHeightToWidth();
                } else {
                    $height = $cropAreaBottomTop[1];
                }
            } elseif ($cropAreaBottomTop == "b") {
                $srcY = $height - (($newImage_height / $max_height) * $height);
            } elseif ($cropAreaBottomTop == "c") {
                $srcY = ($height/2) - ((($newImage_height / $max_height) * $height) / 2);
            }
        }

        list($image_create_func, $image_save_func) = $this->getFunctionNames();
        $imageC = ImageCreateTrueColor($newImage_width, $newImage_height);
        $newImage = $image_create_func($this->image);

        if($image_save_func == 'ImagePNG'){
            imagealphablending($imageC, false);
            imagesavealpha($imageC, true);
            $transparent = imagecolorallocatealpha($imageC, 255, 255, 255, 127);
            imagefilledrectangle($imageC, 0, 0, $newImage_width, $newImage_height, $transparent);
        }
        ImageCopyResampled($imageC, $newImage, 0, 0, $srcX, $srcY, $max_width, $max_height, $width, $height);
        if($image_save_func == "imageJPG" || $image_save_func == "ImageJPEG"){
            if(!$image_save_func($imageC, $this->tmpfile, $jpgQuality)){
                // throw new Exception("Cannot save file ".$this->tmpfile);
            }
        }else{
            if(!$image_save_func($imageC, $this->tmpfile)){
                // throw new Exception("Cannot save file ".$this->tmpfile);
            }
        }

        $this->setNewMainImage($this->tmpfile);
        imagedestroy($imageC);
    }

    public function addWatermark($imageWatermark)
    {
        $this->Watermark = new self($imageWatermark);
        $this->Watermark->setPathToTempFiles($this->pathToTempFiles);

        return $this->Watermark;
    }

    public function writeWatermark($opacity=50, $marginH=0, $marginV=0, $positionWatermarkLeftRight="c", $positionWatermarkTopBottom="c")
    {
        list($image_create_func, $image_save_func) = $this->Watermark->getFunctionNames();
        $watermark = $image_create_func($this->Watermark->getImage());

        list($image_create_func, $image_save_func) = $this->getFunctionNames();
        $baseImage = $image_create_func($this->image);

        if($positionWatermarkLeftRight == "r"){
            $marginH = imagesx($baseImage) - imagesx($watermark) - $marginH;
        }

        if($positionWatermarkLeftRight == "c"){
            $marginH = (imagesx($baseImage)/2) - (imagesx($watermark)/2) - $marginH;
        }

        if($positionWatermarkTopBottom == "b"){
            $marginV = imagesy($baseImage) - imagesy($watermark) - $marginV;
        }

        if($positionWatermarkTopBottom == "c"){
            $marginV = (imagesy($baseImage)/2) - (imagesy($watermark)/2) - $marginV;
        }

        $cut = imagecreatetruecolor(imagesx($watermark), imagesy($watermark));

        imagecopy($cut, $baseImage, 0, 0, $marginH, $marginV, imagesx($watermark), imagesy($watermark));

        imagecopy($cut, $watermark, 0, 0, 0, 0, imagesx($watermark), imagesy($watermark));
        imagecopymerge($baseImage, $cut, $marginH, $marginV, 0, 0, imagesx($watermark), imagesy($watermark), $opacity);

        if(!$image_save_func($baseImage, $this->tmpfile)){
            // throw new Exception("Cannot save file ".$this->tmpfile);
        }

        $this->setNewMainImage($this->tmpfile);

        imagedestroy($baseImage);
        unset($Watermark);
    }

    public function rotate($degrees, $jpgQuality=75)
    {
        list($image_create_func, $image_save_func) = $this->getFunctionNames();

        $source = $image_create_func($this->image);
        if(function_exists("imagerotate")){
            $imageRotated = imagerotate($source, $degrees, 0, true);
        }else{
            $imageRotated = $this->rotateImage($source, $degrees);
        }

        if($image_save_func == "ImageJPEG"){
            if(!$image_save_func($imageRotated, $this->tmpfile, $jpgQuality)){
                // throw new Exception("Cannot save file ".$this->tmpfile);
            }
        }else{
            if(!$image_save_func($imageRotated, $this->tmpfile)){
                // throw new Exception("Cannot save file ".$this->tmpfile);
            }
        }

        $this->setNewMainImage($this->tmpfile);

        return true;
    }

    public function display()
    {
        $mime = $this->getMimeType();
        header("Content-Type: ".$mime);
        readfile($this->image);
    }

    public function displayHTML($alt=false, $title=false, $class=false, $id=false, $extras=false)
    {
        print $this->getHTML($alt, $title, $class, $id, $extras);
    }

    public function getHTML($alt=false, $title=false, $class=false, $id=false, $extras=false)
    {
        $path = str_replace($_SERVER["DOCUMENT_ROOT"], "", $this->image);

        $code = '<img src="/'.$path.'" width="'.$this->getWidth().'" height="'.$this->getHeight().'"';
        if($alt   ){ $code .= ' alt="'.$alt.'"';}
        if($title ){ $code .= ' title="'.$title.'"';}
        if($class ){ $code .= ' class="'.$class.'"';}
        if($id    ){ $code .= ' id="'.$id.'"';}
        if($extras){ $code .= ' '.$extras;}
        $code .= ' />';

        return $code;
    }

    public function save($filename, $path="", $extension="")
    {
        if($extension == ""){
            $filename .= $this->getExtension(true);
        }else{
            $filename .= ".".$extension;
        }

        if($path != ""){
            $path = realpath($path).DIRECTORY_SEPARATOR;
        }

        $fullPath = $path.$filename;

        if(!copy($this->image, $fullPath)){
            // throw new Exception("Cannot save file ".$fullPath);
        }

        $this->setNewMainImage($fullPath);

        return true;
    }

    public function isRGB()
    {
        if($this->imageInfo["channels"] == 3){
            return true;
        }
        return false;
    }

    public function isCMYK()
    {
        if($this->imageInfo["channels"] == 4){
            return true;
        }
        return false;
    }

    public function checkRatio($ratio1, $ratio2, $ignoreOrientation=false)
    {
        $actualRatioWidthToHeight = $this->getRatioWidthToHeight();
        $shouldBeRatio = $ratio1 / $ratio2;

        if($actualRatioWidthToHeight == $shouldBeRatio){
            return true;
        }

        $actualRatioHeightToWidth = $this->getRatioHeightToWidth();
        if($ignoreOrientation && $actualRatioHeightToWidth == $shouldBeRatio){
            return true;
        }

        return false;
    }

    protected function getFunctionNames()
    {
        if (null == $this->newFileType) {
            $this->setNewFileType($this->getType());
        }

        switch ($this->getType()) {
            case 'jpg':
            case 'jpeg':
                $image_create_func = 'ImageCreateFromJPEG';
                break;

            case 'png':
                $image_create_func = 'ImageCreateFromPNG';
                break;

            case 'bmp':
                $image_create_func = 'ImageCreateFromBMP';
                break;

            case 'gif':
                $image_create_func = 'ImageCreateFromGIF';
                break;

            case 'vnd.wap.wbmp':
                $image_create_func = 'ImageCreateFromWBMP';
                break;

            case 'xbm':
                $image_create_func = 'ImageCreateFromXBM';
                break;

            default:
                $image_create_func = 'ImageCreateFromJPEG';
        }

        switch ($this->newFileType) {
            case 'jpg':
            case 'jpeg':
                $image_save_func = 'ImageJPEG';
                break;

            case 'png':
                $image_save_func = 'ImagePNG';
                break;

            case 'bmp':
                $image_save_func = 'ImageBMP';
                break;

            case 'gif':
                $image_save_func = 'ImageGIF';
                break;

            case 'vnd.wap.wbmp':
                $image_save_func = 'ImageWBMP';
                break;

            case 'xbm':
                $image_save_func = 'ImageXBM';
                break;

            default:
                $image_save_func = 'ImageJPEG';
        }

        return array($image_create_func, $image_save_func);
    }

    protected function getImage()
    {
        return $this->image;
    }

    public function getImageInfo()
    {
        return $this->imageInfo;
    }

    public function getFileInfo()
    {
        return $this->fileInfo;
    }

    public function getWidth()
    {
        return $this->imageInfo["width"];
    }

    public function getHeight()
    {
        return $this->imageInfo["height"];
    }

    public function getExtension($withDot=false)
    {
        $extension = image_type_to_extension($this->imageInfo["imagetype"]);
        $extension = str_replace("jpeg", "jpg", $extension);
        if(!$withDot){
            $extension = substr($extension, 1);
        }

        return $extension;
    }

    public function getMimeType()
    {
        return $this->imageInfo["mime"];
    }

    public function getType()
    {
        return substr(strrchr($this->imageInfo["mime"], '/'), 1);
    }

    public function getFileSizeInBytes()
    {
        return filesize($this->image);
    }

    public function getFileSizeInKiloBytes()
    {
        $size = $this->getFileSizeInBytes();
        return $size/1024;
    }

    public function getFileSize()
    {
        $size = $this->getFileSizeInBytes();

        $mod = 1024;
        $units = explode(' ','B KB MB GB TB PB');
        for ($i = 0; $size > $mod; $i++) {
            $size /= $mod;
        }

        if($i < 2){
            $size = round($size);
        }else{
            $size = round($size, 2);
        }

        return $size . ' ' . $units[$i];
    }

    public function getRatioWidthToHeight()
    {
        return $this->imageInfo["width"] / $this->imageInfo["height"];
    }

    public function getRatioHeightToWidth()
    {
        return $this->imageInfo["height"] / $this->imageInfo["width"];
    }

    protected function rotateImage($img, $rotation)
    {
        $width = imagesx($img);
        $height = imagesy($img);
        switch($rotation) {
            case 90: $newimg= @imagecreatetruecolor($height , $width );break;
            case 180: $newimg= @imagecreatetruecolor($width , $height );break;
            case 270: $newimg= @imagecreatetruecolor($height , $width );break;
            case 0: return $img;break;
            case 360: return $img;break;
        }

        if($newimg) {
            for($i = 0;$i < $width ; $i++) {
                for($j = 0;$j < $height ; $j++) {
                    $reference = imagecolorat($img,$i,$j);
                    switch($rotation) {
                        case 90: if(!@imagesetpixel($newimg, ($height - 1) - $j, $i, $reference )){return false;}break;
                        case 180: if(!@imagesetpixel($newimg, $width - $i, ($height - 1) - $j, $reference )){return false;}break;
                        case 270: if(!@imagesetpixel($newimg, $j, $width - $i, $reference )){return false;}break;
                    }
                }
            }
            return $newimg;
        }
        return false;
    }
}