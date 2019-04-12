## Sitemap usage

```php
$sitemap = new Sitemap();

$sitemap->add(
	new SitemapUrl('http://example.com', $date, ChangeFrequency::ALWAYS(), 90)
);

echo $sitemap->toString()
```

#### Google news

```php
$sitemap = new Sitemap();

$sitemap->add(new GoogleNewsUrl(
	new SitemapUrl('http://example.com'),
	'Foo', 'en', 'Bar', $date
));

echo $sitemap->toString();
```
