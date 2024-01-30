<?php

declare(strict_types=1);

namespace PayNL\Sdk\Model;

/**
 * Class CreateTransactionResponse
 *
 * @package PayNL\Sdk\Model
 */
class CreateTransactionResponse implements ModelInterface
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $serviceId;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $reference;

    /**
     * @var string
     */
    protected $manualTransferCode;

    /**
     * @var string
     */
    protected $orderId;

    /**
     * @var string
     */
    protected $paymentUrl;

    /**
     * @var string
     */
    protected $statusUrl;

    /**
     * @var string
     */
    protected $orderStatusUrl;

    /**
     * @var Amount
     */
    protected $amount;

    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var int
     */
    protected $expire;

    /**
     * @var string
     */
    protected $expiresAt;

    /**
     * @var string
     */
    protected $created;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $createdBy;

    /**
     * @var string
     */
    protected $modified;

    /**
     * @var string
     */
    protected $modifiedAt;

    /**
     * @var string
     */
    protected $modifiedBy;

    /**
     * @var array
     */
    protected $_links;

    /**
     * @var string
     */
    protected $hash;

    /**
     * @return string
     */
    public function getId(): string
    {
        return (string)$this->id;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getServiceId(): string
    {
        return (string)$this->serviceId;
    }

    /**
     * @param string $serviceId
     * @return $this
     */
    public function setServiceId(string $serviceId): self
    {
        $this->serviceId = $serviceId;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return (string)$this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return (string)$this->reference;
    }

    /**
     * @param string $reference
     * @return $this
     */
    public function setReference(string $reference): self
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @return string
     */
    public function getManualTransferCode(): string
    {
        return (string)$this->manualTransferCode;
    }

    /**
     * @param string $manualTransferCode
     * @return $this
     */
    public function setManualTransferCode(string $manualTransferCode): self
    {
        $this->manualTransferCode = $manualTransferCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return (string)$this->orderId;
    }

    /**
     * @param string $orderId
     * @return $this
     */
    public function setOrderId(string $orderId): self
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentUrl(): string
    {
        return (string)$this->paymentUrl;
    }

    /**
     * @param string $paymentUrl
     * @return $this
     */
    public function setPaymentUrl(string $paymentUrl): self
    {
        $this->paymentUrl = $paymentUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatusUrl(): string
    {
        return (string)$this->statusUrl;
    }

    /**
     * @param string $statusUrl
     * @return $this
     */
    public function setStatusUrl(string $statusUrl): self
    {
        $this->statusUrl = $statusUrl;
        return $this;
    }


    /**
     * @return string
     */
    public function getUuid(): string
    {
        return (string)$this->uuid;
    }

    /**
     * @param string $uuid
     * @return $this
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     *
     * @return int timestamp
     */
    public function getExpire(): int
    {
        return (int)$this->expire;
    }

    /**
     * @param int $expire
     * @return $this
     */
    public function setExpire(int $expire): self
    {
        $this->expire = $expire;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreated(): string
    {
        return (string)$this->created;
    }

    /**
     * @param string $created
     * @return $this
     */
    public function setCreated(string $created): self
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return string
     */
    public function getModified(): string
    {
        return (string)$this->modified;
    }

    /**
     * @param string $modified
     * @return $this
     */
    public function setModified(string $modified): self
    {
        $this->modified = $modified;
        return $this;
    }

    /**
     * @return array
     */
    public function get_links(): array
    {
        return (array)$this->_links;
    }

    /**
     * @param array $_links
     * @return $this
     */
    public function set_links(array $_links): self
    {
        $this->_links = $_links;
        return $this;
    }

    /**
     * @return Amount
     */
    public function getAmount(): Amount
    {
        return $this->amount;
    }

    /**
     * @param Amount $amount
     */
    public function setAmount(Amount $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedBy(): string
    {
        return (string)$this->createdBy;
    }

    /**
     * @param string $createdBy
     */
    public function setCreatedBy(string $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return string
     */
    public function getExpiresAt(): string
    {
        return (string)$this->expiresAt;
    }

    /**
     * @param string $expiresAt
     */
    public function setExpiresAt(string $expiresAt): void
    {
        $this->expiresAt = $expiresAt;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return (string)$this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getModifiedAt(): string
    {
        return (string)$this->modifiedAt;
    }

    /**
     * @param string $modifiedAt
     */
    public function setModifiedAt(string $modifiedAt): void
    {
        $this->modifiedAt = $modifiedAt;
    }

    /**
     * @return string
     */
    public function getModifiedBy(): string
    {
        return (string)$this->modifiedBy;
    }

    /**
     * @param string $modifiedBy
     */
    public function setModifiedBy(string $modifiedBy): void
    {
        $this->modifiedBy = $modifiedBy;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return (string)$this->hash;
    }

    /**
     * @param string $hash
     * @return void
     */
    public function setHash(string $hash): void
    {
        $this->hash = $hash;
    }

    /**
     * @return string
     */
    public function getOrderStatusUrl(): string
    {
        return (string)$this->orderStatusUrl;
    }

    /**
     * @param string $orderStatusUrl
     * @return void
     */
    public function setOrderStatusUrl(string $orderStatusUrl): void
    {
        $this->orderStatusUrl = $orderStatusUrl;
    }

}
