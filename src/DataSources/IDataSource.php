<?php declare(strict_types = 1);

namespace WebChemistry\Sitemap\DataSources;

interface IDataSource {

	public function count(): int;

	public function toIterable(int $limit, int $offset): iterable;

}
