<?php declare(strict_types = 1);

namespace WebChemistry\Sitemap;

interface ISitemap {

	public function addSchema(string $name, string $value): ISitemap;

}
