<?php
$modelProject = init_submodel("project", "project");
$modelProject->__bind("name", $this->in["name"]);
if($this->in["intro"]) $modelProject->__bind("intro", $this->in["intro"]);
if($this->in["logo"]) $modelProject->__bind("logo", $this->in["logo"]);
$modelProject->__bind("create_time", showtime());
$modelProject->__add();
$this->__exit(0);