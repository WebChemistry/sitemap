<?php declare(strict_types = 1);

namespace WebChemistry\Sitemap;

use DateTime;
use Nette\SmartObject;
use XMLWriter;

class GoogleNewsUrl implements ISitemapUrl {

	use SmartObject;

	private const DATE_FORMAT = 'Y-m-d\TH:i:sT';

	/** @var SitemapUrl */
	private $sitemapUrl;

	/** @var string */
	private $name;

	/** @var string */
	private $language;

	/** @var string|null */
	private $title;

	/** @var DateTime|null */
	private $publicationDate;

	public function __construct(ISitemapUrl $sitemapUrl, string $name, string $language, string $title, DateTime $publicationDate) {
		$this->sitemapUrl = $sitemapUrl;
		$this->name = $name;
		$this->language = $language;
		$this->title = $title;
		$this->publicationDate = $publicationDate;
	}

	public static function install(ISitemap $sitemap): void {
		SitemapUrl::install($sitemap);

		$sitemap->addSchema('xmlns:news', 'https://www.google.com/schemas/sitemap-news/0.9');
	}

	public function write(XMLWriter $writer): void {
		$this->sitemapUrl->write($writer);

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
