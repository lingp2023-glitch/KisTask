<?php

/**
  	* @api {post}    /resource/uploadFile      上传文件
    * @param {Int}          type               0 图片 1语音 2视频
    * @param {varchar}      file_dir           图片目录
    * @param {varchar}      file_name          图片名
    * @param {varchar}      group_id           图片组 默认0 未分组
    * @param {Int}          is_delete          0 未删除 1 已删除
    *
*/

	// 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
    $tmp_file  = $_FILES["file"]["tmp_name"];
    $file = $_FILES["file"]["name"];
    $size = $_FILES["file"]["size"];
    $sExtension = strtolower(substr($file, (strrpos($file, '.') + 1)));//找到扩展名
    write_log(json_encode($_FILES));
    $model = init_model('resource');
  
    if($size<1024)
        $size .= "b";
    else {
        $size = $size/1024;
        if($size<1024)
            $size = number_format($size,2) . "KB";
        else {
            $size = $size/1024;
            $size = number_format($size, 2)."MB";
        }
    }
    
    if ($_POST['type'] == RES_TYPE_IMG && in_array($_FILES["file"]["type"], array('image/bmp','image/jpeg','image/png') )) 
    {
        $new_file_name = createRandFileName().".".$sExtension;
        
        //$img_dir = $this->user["userid"]."/".date("Y")."/".date("m")."/"; //个人用户上传目录
        //$dir = "upload/image/".$img_dir;
        //mk_dir($dir);
        //$src_file = $dir.$new_file_name;
        $file = "upload/temp/image/".$new_file_name;
        move_uploaded_file($tmp_file, $file);
        
        $file_name = $_FILES["file"]["name"];
        
        //生成缩略图
        //$dir = "upload/image/min/".$img_dir;
        //mk_dir($dir);
        //$min_file = $dir.$new_file_name;		
        //$modelImg = init_model("img");	
        //if(!$modelImg->resize($src_file, $min_file,300,300)) $min_file=$src_file;
                
        //$data = array("userid"=>$this->user["userid"],
        //	"group_id"=>$this->in["group_id"],
        //	"min_file"=>$min_file,
        //	"src_file"=>$src_file,
        //	"file_name"=>$file,
        //	"file_size"=>$size);
        //$retCode = $model -> uploadImage($data);
        $this->__exit(0, "上传成功", ["file"=>$file, "name"=>$file_name]);
    } 
    elseif ($_POST['type'] == RES_TYPE_AUDIO && in_array($_FILES["file"]["type"], array('audio/x-m4a','audio/mp3','audio/mpeg'))) 
    {
        $ret_url ="upload/temp/".createRandFileName().".".$sExtension;
        move_uploaded_file($tmp_file, $ret_url);
        $data = array('url'=>$ret_url,
            "file_size"=>$size,
            "file_name"=>$file);
        $this->__exit(0, "上传成功", $data);             
    } 
    elseif ($_POST['type'] == RES_TYPE_VIDEO) // && $_FILES["file"]["type"] == 'video/mp4') 
    {
        $ret_url ="upload/temp/video/".createRandFileName().".".$sExtension;;
        move_uploaded_file($tmp_file, $ret_url);
    
        $data = array('url'=>$ret_url,
            "file_size"=>$size,
            "file_name"=>$file);
        $this->__exit(0, "上传成功", $data);
    } 
    elseif ($_POST['type'] == RES_TYPE_FILE 
            && in_array($_FILES["file"]["type"], array('application/msword', 
                'application/vnd.ms-powerpoint', 
                'application/vnd.ms-excel',
                'application/octet-stream',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/octet-stream',
                'application/x-zip-compressed',
                'text/plain',
                'application/pdf'))) 
    {
        $ret_url ="upload/temp/video/".createRandFileName().".".$sExtension;;
        move_uploaded_file($tmp_file, $ret_url);
    
        $data = array('url'=>$ret_url,
            "file_size"=>$size,
            "file_name"=>$file,
            "file_type"=>$sExtension);
        $this->__exit(0, "上传成功", $data);
    } 
    else 
          $this->__exit(-1, "上传失败,文件格式不符合");