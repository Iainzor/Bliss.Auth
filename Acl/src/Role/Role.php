<?php
namespace Acl\Role;

use Acl\Acl;

class Role extends Acl implements RoleInterface
{
	/**
	 * @var string
	 */
	protected $name;
	
	/**
	 * Constructor
	 * 
	 * @param string $name An optional name for the role
	 */
	public function __construct($name = null)
	{
		$this->name = $name;
	}
	
	/**
	 * Get or set the name of the role
	 * 
	 * @param string $name
	 */
	public function name($name = null)
	{
		if ($name !== null) {
			$this->name = $name;
		}
		return $this->name;
	}
}