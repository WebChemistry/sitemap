<?php declare(strict_types = 1);

namespace WebChemistry\Sitemap;

use Nette\SmartObject;

final class GoogleNewsSchema implements ISitemapSchema {

	use SmartObject;

	public function getName(): string {
		return 'xmlns:news';
	}

	public function getValue(): string {
		return 'https://www.google.com/schemas/sitemap-news/0.9';
	}

}
