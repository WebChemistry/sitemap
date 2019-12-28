## Sitemap usage

```php
$sitemap = new Sitemap();

$sitemap->add(
	new SitemapItem('http://example.com', new DateTime(), ChangeFrequency::ALWAYS(), 90)
);

echo $sitemap->toString()
```

#### Google news

```php
$sitemap = new Sitemap();

$sitemap->add(new GoogleNewsItem(
	new SitemapItem('http://example.com'),
	'Example', 'en', 'Subject', new DateTime()
));

echo $sitemap->toString();
```
