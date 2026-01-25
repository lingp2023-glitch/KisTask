<?php
class h5 extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->tpl  = TEMPLATE  . 'h5/';       
    }

    /**
     * 显示主页面
     */
    public function index()
    {
        $doc_id = $this->in["doc_id"];
        $model= init_model("resourceDoc");
        $doc = $model->__getRow("doc_id", $doc_id); 
        $this->__exit(0,"", $doc);
    }
    
    
}
