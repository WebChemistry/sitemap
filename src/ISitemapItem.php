<?php declare(strict_types = 1);

namespace WebChemistry\Sitemap;

use XMLWriter;

interface ISitemapItem {

	public function write(XMLWriter $writer): void;

}
