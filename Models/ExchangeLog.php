<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Exchange\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Exchange\Models;

use phpOMS\Contract\ArrayableInterface;

/**
 * Exchange class.
 *
 * @package Modules\Exchange\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class ExchangeLog implements \JsonSerializable, ArrayableInterface
{
    /**
     * Article ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Message.
     *
     * @var string
     * @since 1.0.0
     */
    private string $message = '';

    /**
     * Fields.
     *
     * @var array
     * @since 1.0.0
     */
    private array $fields = [];

    /**
     * Log type.
     *
     * @var int
     * @since 1.0.0
     */
    private int $type = ExchangeType::IMPORT;

    /**
     * Date type.
     *
     * @var int
     * @since 1.0.0
     */
    private \DateTimeImmutable $createdAt;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutableImmutable('now');
    }

    /**
     * Get type.
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getType() : int
    {
        return $this->type;
    }

    /**
     * Set type.
     *
     * @param int $type Exchange type
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setType(int $type) : void
    {
        $this->type = $type;
    }

    /**
     * Get id
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return string
     *
     * @since 1.0.0
     */
    public function getMessage() : string
    {
        return $this->message;
    }

    /**
     * Set message
     *
     * @param string $message Log message
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setMessage(string $title) : void
    {
        $this->message = $message;
    }

    /**
     * Get fields.
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getFields() : array
    {
        return $this->fields;
    }

    /**
     * Set fields.
     *
     * @param array $fields Exchange fields
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setFields(array $fields) : void
    {
        $this->fields = $fields;
    }

    /**
     * Get created at.
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getCreatedAt() : \DateTimeInterfaceInterface
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'       => $this->id,
            'message'  => $this->message,
            'type'     => $this->type,
            'fields'   => $this->fields,
            'datetime' => $this->createdAt,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}