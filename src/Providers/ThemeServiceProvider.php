<?php

namespace Theme\Providers;

use IO\Helper\TemplateContainer;
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
	 * Boot a template for the footer that will be displayed in the template plugin instead of the original footer.
	 */
	public function boot(Twig $twig, Dispatcher $eventDispatcher)
	{

		$eventDispatcher->listen('IO.init.templates', function(Partial $partial)
		{
			$partial->set('footer', 'Theme::content.ThemeFooter');
			$partial->set('header', 'Theme::content.ThemeHeader');
		}, 99);

		// provide template to use for homepage
		$eventDispatcher->listen('IO.tpl.home', function(TemplateContainer $container, $templateData) {
			$container->setTemplate("Theme::Homepage.Homepage");
			return false;
		}, 99);
	}
}
?>