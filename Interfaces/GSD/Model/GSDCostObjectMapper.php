<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Exchange\Interfaces\GSD\Model
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Exchange\Interfaces\GSD\Model;

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package    Modules\Exchange\Interfaces\GSD\Model
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class GSDCostObjectMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'ROW_ID'          => ['name' => 'ROW_ID', 'type' => 'int', 'internal' => 'id'],
        'row_create_time' => ['name' => 'row_create_time', 'type' => 'DateTime', 'internal' => 'createdAt'],
        'row_create_user' => ['name' => 'row_create_user', 'type' => 'int', 'internal' => 'createdBy'],
        'KTR'             => ['name' => 'KTR', 'type' => 'string', 'internal' => 'costobject'],
        'Bezeichnung'     => ['name' => 'Bezeichnung', 'type' => 'string', 'internal' => 'description'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'FiKostentraeger';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $createdAt = 'row_create_time';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'ROW_ID';
}
