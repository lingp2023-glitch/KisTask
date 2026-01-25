<?php
$model= init_model("resourceDoc");
$data = $model->__getRow("doc_id", $this->in["doc_id"]);
$data["doc_url"] = DOMAIN."?h5/index&doc_id=".$data["doc_id"];
$this->__exit(0, "", $data);