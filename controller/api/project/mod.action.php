<?php
$modelProject = init_submodel("project", "project");
$modelProject->__bind("name", $this->in["name"]);
if($this->in["intro"]) $modelProject->__bind("intro", $this->in["intro"]);
if($this->in["logo"]) $modelProject->__bind("logo", $this->in["logo"]);
$modelProject->__bindQuery("id", $this->in["id"]);
$modelProject->__mod();
$this->__exit(0);