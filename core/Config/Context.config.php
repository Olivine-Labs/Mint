<?php
$this->Session = \Classes\SessionHandler::getSession();
$this->CurrentUser = (object)((array_key_exists(\Models\Session::FIELD_USER, ($this->Session)?$this->Session->Data:array()))?(object)$this->Session->Data[\Models\Session::FIELD_USER]:new \Models\User());
$this->CurrentUser->Profile = (object)$this->CurrentUser->Profile;
$this->CurrentUser->LoggedIn = ($this->CurrentUser->UserName)?true:false;
$this->CWD = getcwd();

$this->Debug = true;
?>
