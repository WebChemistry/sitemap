<?php declare(strict_types = 1);

namespace WebChemistry\Sitemap;

use DateTime;
use Nette\SmartObject;
use XMLWriter;

class GoogleNewsItem implements ISitemapItem {

	use SmartObject;

	private const DATE_FORMAT = 'Y-m-d\TH:i:sP';

	/** @var SitemapItem */
	private $sitemapItem;

	/** @var string */
	private $name;

	/** @var string */
	private $language;

	/** @var string|null */
	private $title;

	/** @var DateTime|null */
	private $publicationDate;

	public function __construct(SitemapItem $sitemapItem, string $name, string $language, string $title, DateTime $publicationDate) {
		$this->sitemapItem = $sitemapItem;
		$this->name = $name;
		$this->language = $language;
		$this->title = $title;
		$this->publicationDate = $publicationDate;
	}

	public function write(XMLWriter $writer): void {
		$this->sitemapItem->write($writer);

		$writer->startElement('news:news');

		$writer->startElement('news:publication');
		$writer->writeElement('news:name', $this->name);
		$writer->writeElement('news:language', $this->language);
		$writer->endElement();

		$writer->writeElement('news:publication_date', $this->publicationDate->format(self::DATE_FORMAT));
		$writer->writeElement('news:title', $this->title);

		$writer->endElement();
	}

}
