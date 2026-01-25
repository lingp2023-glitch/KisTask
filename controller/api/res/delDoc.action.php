<?php
$docs = json_decode($this->in["docs"], true);
$model= init_model("resourceDoc");
$model->__bindQuery("doc_id", implode(",", $docs), "in");
$model->__bind("is_del", 1);
$model->__bind("del_time", showtime());
$model->__mod();
$this->__exit(0);