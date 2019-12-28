<?php

use Codeception\Test\Unit;
use WebChemistry\Sitemap\GoogleNewsItem;
use WebChemistry\Sitemap\GoogleNewsSchema;
use WebChemistry\Sitemap\Sitemap;
use WebChemistry\Sitemap\SitemapItem;

class GoogleNewsUrlTest extends Unit {

	public function testFull(): void {
		$sitemap = new Sitemap([
			new GoogleNewsSchema()
		]);

		$date = new DateTime('2019-01-01');
		$date->setTimezone(new DateTimeZone('UTC'));
		$date->setTime(0, 0);

		$sitemap->add(new GoogleNewsItem(
			new SitemapItem('http://example.com'),
			'Foo', 'en', 'Bar', $date
		));

		$this->assertStringEqualsFile(__DIR__ . '/expects/googleNews/full.xml', $sitemap->toString());
	}

}