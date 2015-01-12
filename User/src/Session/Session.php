<?php
namespace User\Session;

use Bliss\Component;

class Session extends Component implements SessionInterface
{
	const KEY = "USER_SESSION";
	
	private $key = self::KEY;
	
	/**
	 * @var string
	 */
	protected $id;
	
	/**
	 * @var boolean
	 */
	protected $isValid = false;
	
	/**
	 * Constructor
	 */
	public function __construct() 
	{
		$this->id = md5(uniqid(self::KEY));
	}
	
	/**
	 * Get or set the session's ID
	 * 
	 * @param string $id
	 * @return string
	 */
	public function id($id = null) 
	{
		if ($id !== null) {
			$this->id = $id;
		}
		return $this->id;
	}
	
	/**
	 * Get or set whether the session is valid
	 * 
	 * @param boolean $isValid
	 * @return boolean
	 */
	public function isValid($isValid = null) 
	{
		if ($isValid !== null) {
			$this->isValid = (boolean) $isValid;
		}
		return $this->isValid;
	}
	
	/**
	 * Attempt to load the session
	 */
	public function load()
	{
		if (isset($_SESSION[self::KEY])) {
			$this->isValid(true);
			$this->id($_SESSION[self::KEY]);
		}
	}
	
	/**
	 * Save the session data
	 */
	public function save() 
	{
		$_SESSION[self::KEY] = $this->id();
	}
	
	/**
	 * Delete the session data
	 */
	public function delete() 
	{
		unset($_SESSION[self::KEY]);
	}
}