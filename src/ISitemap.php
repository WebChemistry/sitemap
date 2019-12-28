<?php declare(strict_types = 1);

namespace WebChemistry\Sitemap;

interface ISitemap {

	public function add(ISitemapItem $item): ISitemap;

	public function toString(): string;

	public function close(): void;

}
