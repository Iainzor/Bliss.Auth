<?php
namespace User\Controller;

use Bliss\Controller\AbstractController,
	User\DbTable as UserDbTable,
	User\Session\Manager as SessionManager;

class AuthController extends AbstractController
{
	public function signInAction()
	{
		if ($this->request()->isPost()) {
			$email = $this->param("email");
			$password = $this->param("password");
			$remember = (boolean) $this->param("remember", 0);
			$manager = new SessionManager(
				new UserDbTable($this->database())
			);
			$session = $manager->createSession($email, $password);
			
			if (!$session->isValid()) {
				throw new \Exception("Invalid credentials provided", 401);
			}
			
			$session->save();
			
			return $session->toArray();
		}
	}
}