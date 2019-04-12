<?php declare(strict_types = 1);

namespace WebChemistry\Sitemap;

use DateTime;
use Nette\SmartObject;
use XMLWriter;

class SitemapUrl implements ISitemapUrl {

	use SmartObject;

	/** @var string */
	private $location;

	/** @var DateTime|null */
	private $lastModification;

	/** @var ChangeFrequency|null */
	private $changeFrequency;

	/** @var int|null */
	private $priority;

	public function __construct(string $location, ?DateTime $lastModification = null, ?ChangeFrequency $changeFrequency = null,
								?int $priority = null) {
		$this->location = $location;
		$this->lastModification = $lastModification;
		$this->changeFrequency = $changeFrequency;
		$this->priority = $priority;
	}

	public static function create(string $location): SitemapUrl {
		return self::create($location);
	}

	public function setLastModification(?DateTime $lastModification): void {
		$this->lastModification = $lastModification;
	}

	public function setChangeFrequency(?ChangeFrequency $changeFrequency): void {
		$this->changeFrequency = $changeFrequency;
	}

	public function setPriority(?int $priority): void {
		$this->priority = $priority;
	}

	public static function install(ISitemap $sitemap): void {
		$sitemap->addSchema('xmlns', 'https://www.sitemaps.org/schemas/sitemap/0.9');
	}

	public static function install(ISitemap $sitemap): void {
		$sitemap->addSchema('xmlns', 'https://www.sitemaps.org/schemas/sitemap/0.9');
	}

	public function write(XMLWriter $writer): void {
		$writer->writeElement('loc', $this->location);
		if ($this->priority) {
			$writer->writeElement('priority', (string) round(($this->priority / 100), 2));
		}
		if ($this->lastModification) {
			$writer->writeElement('lastmod', $this->lastModification->format(DATE_W3C));
		}
		if ($this->changeFrequency) {
			$writer->writeElement('changefreq', (string) $this->changeFrequency);
		}
	}

}
