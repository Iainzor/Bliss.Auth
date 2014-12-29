<?php
namespace User;

use Bliss\Module\AbstractModule,
	View\Partial\InjectorInterface,
	View\Partial\InjectableInterface,
	View\Partial\Partial,
	UnifiedUI\Module as UI;

class Module extends AbstractModule implements InjectorInterface
{
	public function initPartialInjector(InjectableInterface $injectable) 
	{
		return;
		$accountWidget = new Partial($this->resolvePath("layouts/partials/user-menu-widget.html.phtml"));
		$injectable->inject(UI::AREA_MENU, $accountWidget, -1);
	}
}