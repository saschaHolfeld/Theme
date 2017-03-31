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
			$templateData = array(
					'topItems' => $topItems
			);

			$container->setTemplateData($templateData);
			$container->setTemplate("Theme::Homepage.Homepage");

			return false;
		}, 99);
	}

/*
	public function showTopItems(ItemDataLayerRepositoryContract $itemRepository):array
	{
		$itemColumns = [
				'itemDescription' => [
						'name1',
						'description'
				],
				'variationBase' => [
						'id'
				],
				'variationRetailPrice' => [
						'price'
				],
				'variationImageList' => [
						'path',
						'cleanImageName'
				]
		];

		$itemFilter = [
				'itemBase.isStoreSpecial' => [
						'shopAction' => [3]
				]
		];

		$itemParams = [
				'language' => 'de'
		];

		$resultItems = $itemRepository
		->search($itemColumns, $itemFilter, $itemParams);

		$items = array();
		foreach ($resultItems as $item)
		{
			$items[] = $item;
		}

		return $items;
	}
*/
}
?>