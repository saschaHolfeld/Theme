<?php

namespace Theme\Containers;

use Plenty\Plugin\Templates\Twig;

class ThemeContainer
{
	public function call(Twig $twig, ItemDataLayerRepositoryContract $itemRepository):string
	{
		return $twig->render('Theme::content.Theme');
	}
}

?>