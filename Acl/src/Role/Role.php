<?php
namespace Acl\Role;

class Role extends \Acl\Acl
{
	const RESOURCE_NAME = "acl-role";
	
	/**
	 * @var string
	 */
	protected $name;
	
	public function resourceName() { return self::RESOURCE_NAME; }
	
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
	 * Set the name of the role
	 * 
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}
	
	/**
	 * Get the name of the role
	 * 
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
}