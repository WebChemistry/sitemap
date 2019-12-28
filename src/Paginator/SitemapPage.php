<?php declare(strict_types = 1);

namespace WebChemistry\Sitemap\Paginator;

use Nette\SmartObject;
use WebChemistry\Sitemap\ISitemap;

final class SitemapPage {

	use SmartObject;

	/** @var SitemapPageItem[] */
	private $items = [];

	/** @var int */
	private $capacity;

	/** @var int */
	private $index;

	public function __construct(int $capacity, int $index) {
		$this->capacity = $capacity;
		$this->index = $index;
	}

	public function getIndex(): int {
		return $this->index;
	}

	public function addItem(SitemapPageItem $item, int $count): void {
		$this->capacity -= $count;

		$this->items[] = $item;
	}

	public function getCapacity(): int {
		return $this->capacity;
	}

	public function isFull(): bool {
		return $this->capacity <= 0;
	}

	public function build(ISitemap $sitemap): void {
		foreach ($this->items as $item) {
			$index = $item->getOffset();
			foreach ($item->getDataSource()->toIterable($item->getLimit(), $item->getOffset()) as $row) {
				$returns = ($item->getFactory())($row, $index);

				if ($returns) {
					$sitemap->add($returns);
				}

				$index++;
			}
		}
	}

}
