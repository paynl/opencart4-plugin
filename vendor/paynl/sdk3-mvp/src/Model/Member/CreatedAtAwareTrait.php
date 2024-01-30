<?php

declare(strict_types=1);

namespace PayNL\Sdk\Model\Member;

use Exception;

/**
 * Trait CreatedAtAwareTrait
 *
 * @package PayNL\Sdk\Model\Member
 */
trait CreatedAtAwareTrait
{
    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @throws Exception
     *
     * @return string
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function getCreatedAt(): string
    {
        return (string)$this->createdAt;
    }

    /**
     * @param string $createdAt
     * @return self
     */
    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
