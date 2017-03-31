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
		$newItems = self::showNewItems($itemRepository);
		$offerItems = self::showOfferItems($itemRepository);

		$templateData = array(
				'topItems' => $topItems,
				'newItems' => $newItems,
				'offerItems' => $offerItems,
		);

		return $twig->render('Theme::content.Theme', $templateData);
	}


	public function showTopItems(Twig $twig, ItemDataLayerRepositoryContract $itemRepository):string
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
		$templateData = array(
				'resultCount' => $resultItems->count(),
				'currentItems' => $items
		);

		return $templateData;
	}

	public static function showNewItems(ItemDataLayerRepositoryContract $itemRepository):array
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
						'shopAction' => [1]
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

	public static function showOfferItems(ItemDataLayerRepositoryContract $itemRepository):array
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
						'shopAction' => [2]
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