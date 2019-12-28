<?php declare(strict_types = 1);

namespace WebChemistry\Sitemap\Paginator;

use Doctrine\ORM\Query;
use Nette\SmartObject;
use WebChemistry\Sitemap\DataSources\IDataSource;

final class SitemapPageItem {

	use SmartObject;

	/** @var IDataSource */
	private $dataSource;

	/** @var int */
	private $limit;

	/** @var int */
	private $offset;

	/** @var callable */
	private $factory;

	public function __construct(IDataSource $dataSource, int $limit, int $offset, callable $factory) {
		$this->dataSource = $dataSource;
		$this->limit = $limit;
		$this->offset = $offset;
		$this->factory = $factory;
	}

	public function getFactory(): callable {
		return $this->factory;
	}

	public function getDataSource(): IDataSource {
		return $this->dataSource;
	}

	public function getLimit(): int {
		return $this->limit;
	}

	public function getOffset(): int {
		return $this->offset;
	}

}
