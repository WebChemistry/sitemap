<?php declare(strict_types = 1);

namespace WebChemistry\Sitemap;

use Nette\SmartObject;
use XMLWriter;

class Sitemap implements ISitemap {

	use SmartObject;

	/** @var XMLWriter */
	protected $writer;

	/** @var bool */
	private $closed = false;

	/**
	 * @param ISitemapSchema[] $schemas
	 */
	public function __construct(array $schemas = []) {
		$this->writer = new XMLWriter();
		$this->writer->openMemory();
		$this->writer->setIndent(true);
		$this->writer->setIndentString("\t");
		$this->writer->startDocument('1.0', 'utf-8');
		$this->writer->startElement('urlset');

		$this->writer->writeAttribute('xmlns', 'https://www.sitemaps.org/schemas/sitemap/0.9');

		foreach ($schemas as $schema) {
			$this->addSchema($schema);
		}
	}

	protected function addSchema(ISitemapSchema $schema): void {
		$this->writer->writeAttribute($schema->getName(), $schema->getValue());
	}

	public function add(ISitemapItem $item): ISitemap {
		$this->writer->startElement('url');

		$item->write($this->writer);

		$this->writer->endElement();

		return $this;
	}

	public function close(): void {
		$this->closed = true;
	}

	protected function checkClose(): void {
		if ($this->closed) {
			throw new SitemapClosedException('Sitemap is closed');
		}
	}

	public function toString(): string {
		if (!$this->closed) {
			$this->writer->endElement();
			$this->close();
		}

		return $this->writer->outputMemory();
	}

}
