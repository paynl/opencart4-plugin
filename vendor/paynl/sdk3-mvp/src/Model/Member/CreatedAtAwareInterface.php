<?php

declare(strict_types=1);

namespace PayNL\Sdk\Model\Member;

use PayNL\Sdk\Common\DateTime;

/**
 * Interface CreatedAtAwareInterface
 *
 * @package PayNL\Sdk\Model\Member
 */
interface CreatedAtAwareInterface
{
    /**
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * @param string $createdAt
     *
     * @return static
     */
    public function setCreatedAt(string $createdAt);
}
