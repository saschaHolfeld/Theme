<?php

namespace Theme\Containers;

use Plenty\Plugin\Controller;
use Plenty\Plugin\Templates\Twig;
use Plenty\Modules\Item\DataLayer\Contracts\ItemDataLayerRepositoryContract;

class ThemeContainer extends Controller
{
	public function call(Twig $twig, ItemDataLayerRepositoryContract $itemRepository):string
	{
		$topItems = self::showTopItems($itemRepository);

		$templateData = array(
				'topItems' => $topItems,
		);

		return $twig->render('Theme::content.Theme', $topItems);
	}


	public static function showTopItems(ItemDataLayerRepositoryContract $itemRepository):array
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

		$resultItems = $itemRepository->search($itemColumns, $itemFilter, $itemParams);

		$items = array();
		foreach ($resultItems as $item)
		{
			$items[] = $item;
		}

		return $items;
	}
}

?>