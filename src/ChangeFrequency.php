<?php declare(strict_types = 1);

namespace WebChemistry\Sitemap;

use Nette\StaticClass;

class ChangeFrequency {

	use StaticClass;

	protected const ALWAYS = 'always';
	protected const HOURLY = 'hourly';
	protected const DAILY = 'daily';
	protected const WEEKLY = 'weekly';
	protected const MONTHLY = 'monthly';
	protected const YEARLY = 'yearly';
	protected const NEVER = 'never';

	/** @var string */
	protected $constant;

	protected function __construct(string $constant) {
		$this->constant = $constant;
	}

	public static function ALWAYS(): self {
		return new static(self::ALWAYS);
	}

	public static function HOURLY(): self {
		return new static(self::HOURLY);
	}

	public static function DAILY(): self {
		return new static(self::DAILY);
	}

	public static function WEEKLY(): self {
		return new static(self::WEEKLY);
	}

	public static function MONTHLY(): self {
		return new static(self::MONTHLY);
	}

	public static function YEARLY(): self {
		return new static(self::YEARLY);
	}

	public static function NEVER(): self {
		return new static(self::NEVER);
	}

	public function __toString(): string {
		return $this->constant;
	}

}
