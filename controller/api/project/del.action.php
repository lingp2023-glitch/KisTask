<?php
$modelProject = init_submodel("project", "project");
$modelProject->__bindQUery("id", $this->in["id"]);
$modelProject->__del();
$this->__exit(0);