<?php
namespace User;

use Bliss\Module\AbstractModule,
	View\Partial\InjectorInterface,
	View\Partial\InjectableInterface,
	View\Partial\Partial,
	UnifiedUI\Module as UI,
	Config\PublicConfigInterface,
	Config\Config,
	Router\ProviderInterface as RouteProvider;

class Module extends AbstractModule implements InjectorInterface, PublicConfigInterface, RouteProvider
{
	/**
	 * @var \User\Session\SessionInterface
	 */
	private $session;
	
	/**
	 * @var \User\Session\Manager
	 */
	private $sessionManager;
	
	/**
	 * Get the user session
	 * 
	 * @return \User\Session\SessionInterface
	 */
	public function session()
	{
		if (!isset($this->session)) {
			$this->initSession();
		}
		return $this->session;
	}
	
	/**
	 * Get or set the user session manager
	 * 
	 * @param \User\Session\Manager $manager
	 * @return \User\Session\Manager
	 */
	public function sessionManager(Session\Manager $manager = null) 
	{
		if ($manager !== null) {
			$this->sessionManager = $manager;
			$this->session = null;
		}
		if (!isset($this->sessionManager)) {
			$db = $this->database();
			$this->sessionManager = new Session\Manager(
				new Session\DbTable($db),
				new DbTable($db),
				new Hasher\Blowfish()
			);
		}
		return $this->sessionManager;
	}
	
	public function initSession()
	{
		$this->session = new Session\Session();
		$this->session->load();
		
		if ($this->session->id()) {
			$manager = $this->sessionManager();
			$manager->attachUser($this->session);
		}
	}
	
	public function initRouter(\Router\Module $router) 
	{
		$router->when("/^sign-in\.?([a-z]+)?$/", [
			1 => "format"
		], [
			"module" => "user",
			"controller" => "auth",
			"action" => "sign-in"
		]);
	}
	
	public function initPartialInjector(InjectableInterface $injectable) 
	{
		$accountWidget = new Partial($this->resolvePath("layouts/partials/user-menu-widget.html.phtml"));
		$injectable->inject(UI::AREA_MENU, $accountWidget, -1);
	}
	
	public function populatePublicConfig(Config $config) 
	{
		$session = $this->session();
		
		if ($session->isValid()) {
			if ($session->user()) {
				$config->setData(
					$session->user()->toArray()
				);
			}
		}
	}
}