<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Exchange
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Exchange\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\Query\Column;
use phpOMS\DataStorage\Database\RelationType;

/**
 * Mapper class.
 *
 * @package    Modules\Exchange
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class InterfaceManagerMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'exchange_id'      => ['name' => 'exchange_id', 'type' => 'int', 'internal' => 'id'],
        'exchange_title'   => ['name' => 'exchange_title', 'type' => 'string', 'internal' => 'info/name'],
        'exchange_path'    => ['name' => 'exchange_path', 'type' => 'string', 'internal' => 'info/path'],
        'exchange_version' => ['name' => 'exchange_version', 'type' => 'string', 'internal' => 'info/version'],
        'exchange_export'  => ['name' => 'exchange_export', 'type' => 'bool', 'internal' => 'info/export'],
        'exchange_import'  => ['name' => 'exchange_import', 'type' => 'bool', 'internal' => 'info/import'],
        'exchange_website' => ['name' => 'exchange_website', 'type' => 'string', 'internal' => 'info/website'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'exchange';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $createdAt = 'exchange_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'exchange_id';
}