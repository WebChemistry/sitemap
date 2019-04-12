<?php declare(strict_types = 1);

namespace WebChemistry\Sitemap;

use XMLWriter;

interface ISitemapUrl {

	public function write(XMLWriter $writer): void;

	/**
	 * @internal
	 */
	public static function install(ISitemap $sitemap): void;

}
