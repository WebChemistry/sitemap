<?php declare(strict_types = 1);

namespace WebChemistry\Sitemap\Paginator;

use Nette\SmartObject;
use WebChemistry\Sitemap\DataSources\DoctrineDataSource;
use WebChemistry\Sitemap\DataSources\IDataSource;
use XMLWriter;

final class SitemapPaginator {

	use SmartObject;

	/** @var int */
	private $limit;

	/** @var SitemapPage[] */
	private $pages = [];

	/** @var SitemapPage */
	private $page;

	/** @var int */
	private $pageIndex = 0;

	public function __construct(int $limit) {
		$this->limit = $limit;

		$this->createPage();
	}

	public function getPageCount(): int {
		return $this->pageIndex;
	}

	/**
	 * @return SitemapPage[]
	 */
	public function getPages(): array {
		return $this->pages;
	}

	protected function createPage(): void {
		$this->page = $this->pages[$this->pageIndex] = new SitemapPage($this->limit, $this->pageIndex);

		$this->pageIndex++;
	}

	public function addDataSource(IDataSource $source, callable $factory): void {
		$count = $source->count();

		$offset = 0;
		while ($count > 0) {
			$capacity = $this->page->getCapacity();

			if ($capacity > $count) {
				$items = $count;
			} else {
				$items = $capacity;
			}

			$this->page->addItem(new SitemapPageItem($source, $items, $offset, $factory), $items);
			$offset += $items;
			$count -= $items;
			if ($this->page->isFull()) {
				$this->createPage();
			}
		}
	}

	public function build(callable $factory): string {
		$writer = new XMLWriter();

		$writer->openMemory();
		$writer->setIndent(true);
		$writer->setIndentString("\t");
		$writer->startDocument('1.0', 'utf-8');
		$writer->startElement('sitemapindex');

		$writer->writeAttribute('xmlns', 'https://www.sitemaps.org/schemas/sitemap/0.9');

		foreach ($this->pages as $page) {
			$writer->startElement('sitemap');

			$factory($writer, $page);

			$writer->endElement();
		}

		$writer->endElement();

		return $writer->outputMemory();
	}

}
