<?php declare(strict_types = 1);

namespace WebChemistry\Sitemap\DataSources;

use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Nette\SmartObject;

final class DoctrineDataSource implements IDataSource {

	use SmartObject;

	/** @var Query */
	private $query;

	public function __construct(Query $query) {
		$this->query = $query;
	}

	public function count(): int {
		return (new Paginator($this->query))->setUseOutputWalkers(false)->count();
	}

	public function toIterable(int $limit, int $offset): iterable {
		return $this->query->setMaxResults($limit)->setFirstResult($offset)->getArrayResult();
	}

}
