<?php
namespace User;

use Bliss\ResourceComponent;

class User extends ResourceComponent
{
	const RESOURCE_NAME = "user";
	
	/**
	 * @var string
	 */
	protected $email;
	
	/**
	 * @var string
	 */
	private $password;
	
	/**
	 * @var string
	 */
	protected $displayName;
	
	/**
	 * @var boolean
	 */
	protected $isActive = true;
	
	/**
	 * @return string
	 */
	public function getResourceName() { return self::RESOURCE_NAME; }
	
	/**
	 * Get or set the user's email address
	 * 
	 * @param string $email
	 * @return string
	 */
	public function email($email = null)
	{
		if ($email !== null) {
			$this->email = $email;
		}
		return $this->email;
	}
	
	/**
	 * Get or set the user's hashed password
	 * 
	 * @param string $password
	 * @return string
	 */
	public function password($password = null)
	{
		if ($password !== null) {
			$this->password = $password;
		}
		return $this->password;
	}
	
	/**
	 * Get or the set user's display name
	 * 
	 * @param string $displayName
	 * @return string
	 */
	public function displayName($displayName = null)
	{
		if ($displayName !== null) {
			$this->displayName = $displayName;
		}
		return $this->displayName;
	}
	
	/**
	 * Get or set whether the user is active 
	 * 
	 * @param boolean $flag
	 * @return boolean
	 */
	public function isActive($flag = null)
	{
		if ($flag !== null) {
			$this->isActive = (boolean) $flag;
		}
		return $this->isActive;
	}
			
}