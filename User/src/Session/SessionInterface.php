<?php
namespace User\Session;

interface SessionInterface
{
	public function id($id = null);
	
	public function isValid($isValid = null);
	
	public function load();
	
	public function save();
	
	public function delete();
}