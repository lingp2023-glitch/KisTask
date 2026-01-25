<?php
$doc_id=empty($this->in["doc_id"])?0:$this->in["doc_id"];		
$model= init_model("resourceDoc");
$model->__bind("group_id", $this->in["group_id"]);
$model->__bind("author", $this->in["author"]);
$model->__bind("title", $this->in["title"]);
$model->__bind("summary", $this->in["summary"]);
$model->__bind("cover", $this->in["cover"]);
$model->__bind("content", $this->in["content"]);
$model->__bindQuery("doc_id", $doc_id);
$model->__mod();
$this->__exit(0);