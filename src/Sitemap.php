<?php declare(strict_types = 1);

namespace WebChemistry\Sitemap;

use Nette\SmartObject;
use XMLWriter;

class Sitemap implements ISitemap {

	use SmartObject;

	/** @var XMLWriter */
	protected $writer;

	/** @var ISitemapUrl[] */
	protected $elements = [];

	/** @var string[] */
	protected $attributes = [];

	/** @var bool[] */
	private $used = [];

	/** @var string[] */
	private $schema = [];

	public function __construct() {
		$this->writer = new XMLWriter();
		$this->writer->openMemory();
		$this->writer->setIndent(true);
		$this->writer->setIndentString("\t");
	}

	public function addSchema(string $name, string $value): ISitemap {
		$this->schema[$name] = $value;

		return $this;
 	}

	public function add(ISitemapUrl $url) {
		$class = get_class($url);
		if (!isset($this->used[$class])) {
			$url->install($this);

			$this->used[$class] = true;
		}

		$this->writer->startElement('url');

		$url->write($this->writer);

		$this->writer->endElement();

		return $this;
	}

	public function toString(): string {
		$writer = new XMLWriter();
		$writer->openMemory();
		$writer->setIndentString("\t");
		$writer->setIndent(true);
		$writer->startDocument('1.0', 'utf-8');
		$writer->startElement('urlset');

		foreach ($this->schema as $name => $value) {
			$writer->writeAttribute($name, $value);
		}

		$writer->writeRaw("\n" . $this->writer->outputMemory());

		$writer->endElement();

		return $writer->outputMemory();
	}

}
