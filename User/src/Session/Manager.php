<?php
namespace User\Session;

use User\DbTable;

class Manager
{
	/**
	 * @var DbTable
	 */
	private $dbTable;
	
	/**
	 * Constructor
	 * 
	 * @param DbTable $userDbTable
	 */
	public function __construct(DbTable $userDbTable)
	{
		$this->dbTable = $userDbTable;
	}
	
	/**
	 * Check if credentials are valid
	 * 
	 * @param string $email
	 * @param string $password
	 * @return boolean
	 */
	public function isValid($email, $password)
	{
		$session = $this->createSession($email, $password);
		
		return $session->isValid();
	}
	
	/**
	 * Create a new session using the credentials provided
	 * 
	 * @param string $email
	 * @param string $password
	 * @return \User\Session\Session
	 */
	public function createSession($email, $password)
	{
		$session = new Session();
		$user = $this->dbTable->find("`email`=:email", [
			":email" => $email
		]);
		
		if (!empty($user)) {
			if ($user["password"] === $password) {
				$session->isValid(true);
			}
		}
		
		return $session;
	}
}