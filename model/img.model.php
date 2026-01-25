<?php
class Image_class
{
    private $image;
    private $info;

    /**
     * @param $src:图片路径
     * 加载图片到内存中
     */
    function __construct($src){
        $info = getimagesize($src);
        $type = image_type_to_extension($info[2],false);
        $this -> info =$info;
        $this->info['type'] = $type;
        $fun = "imagecreatefrom" .$type;
        $this -> image = $fun($src);
    }

    /**
     * @param $fontsize: 字体大小
     * @param $x: 字体在图片中的x位置
     * @param $y: 字体在图片中的y位置
     * @param $color: 字体的颜色是一个包含rgba的数组
     * @param $text: 想要添加的内容
     * 操作内存中的图片,给图片添加文字水印
     */
    public function fontMark($fontsize,$x,$y,$color,$text,$font){
    	$col = imagecolorallocatealpha($this->image,$color[0],$color[1],$color[2],$color[3]); 
      $black = imagecolorallocate($this->image, $color[0],$color[1],$color[2]);    		
    	imagettftext($this->image, $fontsize, 0, $x, $y, $black, $font, $text);		    	
    }
    /*
     * 输出图片到浏览器中
     */
    public function show($to){
       //header('content-type:' . $this -> info['mime']);
       // $fun='image' . $this->info['type'];
       // $fun($this->image);
       imagepng($this->image, $to);
    }

    /**
     * 销毁图片
     */
    function __destruct(){
        imagedestroy($this->image);
    }
    
    public function w()
    {
    	return $this->info[0];
    }
    
    public function h()
    {
    	return $this->info[1];
    }   
}

class imgModel extends tableModel
{
    protected function __init()   
	{
		$this->__setTable("sys_res_image");
	}

	/**
    * @method 图片等比缩放
    * @param string $srcImage   源图片路径
    * @param string $toFile     目标图片路径
    * @param integer $maxWidth   最大宽
    * @param integer $maxHeight  最大高
    * @param integer $imgQuality 图片质量
    * @return 
    */    
     function resize($srcImage,$toFile,$maxWidth = 600,$maxHeight = 600,$imgQuality=100)
     { 
     		//ini_set("memory_limit", "240M");  
     		
         list($width, $height, $type, $attr) = getimagesize($srcImage);   
         if($width < $maxWidth  || $height < $maxHeight) return ;
         switch ($type) {
             case 1: $img = imagecreatefromgif($srcImage); break;
             case 2: $img = imagecreatefromjpeg($srcImage); break;
             case 3: $img = imagecreatefrompng($srcImage); $imgQuality=9; break;
         } 
         $scale = min($maxWidth/$width, $maxHeight/$height); //求出绽放比例
         
         if($scale < 1) { 
             $newWidth = floor($scale*$width);
             $newHeight = floor($scale*$height);
             
             $newImg = imagecreatetruecolor($newWidth, $newHeight);    
 
             //以下三行代码是解决图片缩放后背景变成黑色的。
             $color=imagecolorallocate($newImg,255,255,255);  //颜色
             imagecolortransparent($newImg,$color);
             imagefill($newImg,0,0,$color);
             
             imagecopyresampled($newImg, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
             $newName = "";
             $toFile = preg_replace("/(.gif|.jpg|.jpeg|.png)/i","",$toFile);
     					
             switch($type) {
                 case 1: if(imagegif($newImg, "$toFile$newName.gif", $imgQuality))
                     return "$toFile$newName.gif"; break;
                 case 2: if(imagejpeg($newImg, "$toFile$newName.jpg", $imgQuality))
                     return "$toFile$newName.jpg"; break;
                 case 3: if(imagepng($newImg, "$toFile$newName.png", $imgQuality))
                     return "$toFile$newName.png"; break;
                 default: if(imagejpeg($newImg, "$toFile$newName.jpg", $imgQuality))
                     return "$toFile$newName.jpg"; break;
             }    
             //imagedestroy() 释放与 image 关联的内存。image 是由图像创建函数返回的图像标识符，例如 imagecreatetruecolor()。
             imagedestroy($newImg);
             
             return true;
         }
         /*else {
             $bgimg = imagecreatetruecolor($maxWidth, $maxHeight);
 
             //以下三行代码是解决图片缩放后背景变成黑色的。
             $color=imagecolorallocate($bgimg,255,255,255);  //颜色
             imagecolortransparent($bgimg,$color);
             imagefill($bgimg,0,0,$color);    
                     
             imagedestroy($img);
         }*/
         
         return false;
     }
    
     //图片入库
     public function stockIn($temp_img, $name, $group_id, $userid=0, $is_cut=1, $shop_id=0)
     {
        $file_name = basename($temp_img);
        $dir = date("Y")."/".date("m")."/";
        
        //将头图片从临时目录移到正式图片目录
        $imgdir = "upload/image/".$dir;
        mk_dir($imgdir);
        $img = $imgdir.$file_name;

        if(!$is_cut)
            rename(DOCUMENT_ROOT.$temp_img, DOCUMENT_ROOT.$img);
        elseif(!$this->resize($temp_img, $img, 800, 800)) 
            rename(DOCUMENT_ROOT.$temp_img, DOCUMENT_ROOT.$img);

        $file_size = filesize(DOCUMENT_ROOT.$img);
        
        //保存缩略图
        $min_imgdir = "upload/image/thumb/".$dir;
        mk_dir($min_imgdir);
        $min_img = $min_imgdir.$file_name;
        if(!$this->resize(DOCUMENT_ROOT.$img, $min_img, 100, 100)) 
            $min_img = $img;
        
        $this->__bind("userid", $userid);
        $this->__bind("group_id", $group_id);
        $this->__bind("shop_id", $shop_id);
        $this->__bind("src_file", $img);
        $this->__bind("min_file", $min_img);
        $this->__bind("file_name", $name);
        $this->__bind("file_size", $file_size);
        $this->__bind("create_time", showtime());
        $image_id = $this->__add();
        
        //$this->__bindQuery("userid", $userid);
        //$image_id = $this->__max("image_id");

        $data = ["image_id"=>$image_id, "img"=>$img, "min_img"=>$min_img];
        return $data;
     }
}
