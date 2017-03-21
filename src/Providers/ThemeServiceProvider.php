<?php

namespace Theme\Providers;

use IO\Extensions\Functions\Partial;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Templates\Twig;

class ThemeServiceProvider extends ServiceProvider
{

	/**
	 * Register the service provider.
	 */
	public function register()
	{

	}

	/**
	 * Boot Template Footer
	 */
	public function boot(Twig $twig, Dispatcher $dispatcher)
	{
		$eventDispatcher->listen("IO.init.templates", function(Partial $partial){
			$partial->set("footer", "Theme::content.ThemeFooter");
		}, 0);
	}
}

?>