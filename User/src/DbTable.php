<?php
namespace User;

use Database\Table\AbstractTable;

class DbTable extends AbstractTable
{
	const NAME = "users";
	
	public function defaultName() { return self::NAME; }
}