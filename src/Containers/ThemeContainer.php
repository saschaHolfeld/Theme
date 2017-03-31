<?php

namespace Theme\Containers;

use Plenty\Plugin\Controller;
use Plenty\Plugin\Templates\Twig;
use Plenty\Modules\Item\DataLayer\Contracts\ItemDataLayerRepositoryContract;

class ThemeContainer extends Controller
{
	public function call(Twig $twig, ItemDataLayerRepositoryContract $itemRepository):string
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

		$topItems = array();
		foreach ($resultItems as $item)
		{
			$topItems[] = $item;
		}


		$templateData = array(
				'topItems' => $topItems
		);

		return $twig->render('Theme::content.Theme', $templateData);
	}
}

?>