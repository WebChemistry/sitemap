<?php

use Codeception\Test\Unit;
use WebChemistry\Sitemap\GoogleNewsUrl;
use WebChemistry\Sitemap\Sitemap;
use WebChemistry\Sitemap\SitemapUrl;

class GoogleNewsUrlTest extends Unit {

	public function testFull(): void {
		$sitemap = new Sitemap();

		$date = new DateTime('2019-01-01');
		$date->setTimezone(new DateTimeZone('UTC'));
		$date->setTime(0, 0);

		$sitemap->add(new GoogleNewsUrl(
			new SitemapUrl('http://example.com'),
			'Foo', 'en', 'Bar', $date
		));

		$this->assertStringEqualsFile(__DIR__ . '/expects/googleNews/full.xml', $sitemap->toString());
	}

}