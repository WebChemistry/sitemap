<?php declare(strict_types = 1);

namespace WebChemistry\Sitemap\DataSources;

final class ArrayDataSource implements IDataSource {

	/** @var mixed[] */
	private $data;

	public function __construct(array $data) {
		$this->data = $data;
	}

	public function count(): int {
		return count($this->data);
	}

	public function toIterable(int $limit, int $offset): iterable {
		return array_slice($this->data, $offset, $limit);
	}

}
