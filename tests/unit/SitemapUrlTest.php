<?php declare(strict_types = 1);

use Codeception\Test\Unit;
use WebChemistry\Sitemap\ChangeFrequency;
use WebChemistry\Sitemap\Sitemap;
use WebChemistry\Sitemap\SitemapItem;

class SitemapUrlTest extends Unit {

	public function testSimple(): void {
		$sitemap = new Sitemap();
		$sitemap->add(new SitemapItem('http://example.com'));

		$this->assertStringEqualsFile(__DIR__ . '/expects/sitemapUrl/simple.xml', $sitemap->toString());
	}

	public function testFull(): void {
		$sitemap = new Sitemap();

		$date = new DateTime('2019-01-01');
		$date->setTimezone(new DateTimeZone('UTC'));
		$date->setTime(0, 0);

		$sitemap->add(new SitemapItem('http://example.com', $date, ChangeFrequency::ALWAYS(), 90));

		$this->assertStringEqualsFile(__DIR__ . '/expects/sitemapUrl/full.xml', $sitemap->toString());
	}

}