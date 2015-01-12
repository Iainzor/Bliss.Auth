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
	{}
}