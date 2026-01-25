<?php
$group_id=empty($this->in["group_id"])?0:$this->in["group_id"];		
$model= init_model("resourceDoc");
$model->__bind("userid", $this->user["userid"]);
$model->__bind("group_id", $this->in["group_id"]);
$model->__bind("author", $this->in["author"]);
$model->__bind("title", $this->in["title"]);
$model->__bind("summary", $this->in["summary"]);
$model->__bind("cover", $this->in["cover"]);
$model->__bind("content", $this->in["content"]);
$model->__bind("create_time", showtime());
$model->__add();
$this->__exit(0);	