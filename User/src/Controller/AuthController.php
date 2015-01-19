<?php
namespace User\Controller;

use Bliss\Controller\AbstractController;

class AuthController extends AbstractController
{
	public function signInAction()
	{
		if ($this->request()->isPost()) {
			$email = $this->param("email");
			$password = $this->param("password");
			$remember = (boolean) $this->param("remember", 0);
			$manager = $this->module->sessionManager();
			$session = $manager->createSession($email, $password);
			
			if (!$session->isValid()) {
				throw new \Exception("Invalid credentials provided", 401);
			}
			
			$manager->attachUser($session);
			$manager->save($session);
			
			return $session->toArray();
		}
	}
}