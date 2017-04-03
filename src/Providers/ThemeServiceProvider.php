<?php

namespace Theme\Providers;

use IO\Helper\TemplateContainer;
use IO\Extensions\Functions\Partial;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Templates\Twig;
use Plenty\Modules\Item\DataLayer\Contracts\ItemDataLayerRepositoryContract;

class ThemeServiceProvider extends ServiceProvider
{

	/**
	 * Register the service provider.
	 */
	public function register()
	{

	}

	public function boot(Twig $twig, Dispatcher $eventDispatcher, ItemDataLayerRepositoryContract $itemRepository)
	{

		$eventDispatcher->listen('IO.init.templates', function(Partial $partial)
		{
			$partial->set('footer', 'Theme::content.ThemeFooter');
			$partial->set('header', 'Theme::content.ThemeHeader');
		}, 99);

		// provide template to use for homepage
		$eventDispatcher->listen('IO.tpl.home', function(TemplateContainer $container, $templateData) {

			//$topItems = self::showTopItems($itemRepository);

			$topItems = array("Test", "Test2", "Test3", "Test4");
			$data = array(
					'topItems' => $topItems
			);

			$container->setTemplate("Theme::Homepage.Homepage");
			$container->setTemplateData($data);

			return false;
		}, 99);


		/*
		 *         'tpl.home'               => 'Homepage.Homepage',                // provide template to use for homepage
		 *         'tpl.category.content'   => 'Category.Content.CategoryContent', // provide template to use for content categories
		 *         'tpl.category.item'      => 'Category.Item.CategoryItem',       // provide template to use for item categories
		 */
		$eventDispatcher->listen('IO.tpl.category.item', function(TemplateContainer $container, $templateData) {

			//$topItems = self::showTopItems($itemRepository);

			$topItems = array("Test", "Test2", "Test3", "Test4");
			$data = array(
					'topItems' => $topItems
			);

			$container->setTemplate("Theme::Category.Item.CategoryItem");
			$container->setTemplateData($data);

			return false;
		}, 99);


	}
}
?>