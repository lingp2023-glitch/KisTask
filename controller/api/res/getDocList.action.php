<?php
$page = empty($this->in["page"])?1:$this->in["page"];
$group_id=empty($this->in["group_id"])?0:$this->in["group_id"];
$model= init_model("resourceDoc");
$model->__bindQuery("userid", $this->user["userid"]);
$model->__bindQuery("is_del", 0);
$model->__bindQuery("group_id", $group_id, "=");
$model->__orderBy("doc_id desc");
$fds = array("doc_id", "cover", "title", "create_time");
$data = $model->__pageList($page, $fds);
if(!$data) $this->__exit(0);
for($i=0; $i<sizeof($data["list"]); $i++)
    $data["list"][$i]["doc_url"] = DOMAIN."h5/index.html?doc_id=".$data["list"][$i]["doc_id"];
$this->__exit(0, "", $data);