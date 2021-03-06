<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   phpOMS\Module
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Exchange\Models;

use phpOMS\System\File\PathException;
use phpOMS\Utils\ArrayUtils;

/**
 * ModuleInfo class.
 *
 * Handling the info files for modules
 *
 * @package phpOMS\Module
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class InterfaceManager
{
    /**
     * Interface ID.
     *
     * @var int
     * @since 1.0.0
     */
    private int $id = 0;

    /**
     * File path.
     *
     * @var string
     * @since 1.0.0
     */
    private string $path = '';

    /**
     * Info data.
     *
     * @var array<string, mixed>
     * @since 1.0.0
     */
    private $info = [];

    /**
     * Object constructor.
     *
     * @param string $path Info file path
     *
     * @since 1.0.0
     */
    public function __construct(string $path = '')
    {
        $this->path = $path;
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
     * Get info path
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getPath() : string
    {
        return $this->path;
    }

    /**
     * Get info path
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getInterfacePath() : string
    {
        return $this->info['path'];
    }

    /**
     * Get info name
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getName() : string
    {
        return $this->info['name'];
    }

    /**
     * Provides import interface
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function hasImport() : bool
    {
        return $this->info['import'];
    }

    /**
     * Provides export interface
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function hasExport() : bool
    {
        return $this->info['export'];
    }

    /**
     * Load info data from path.
     *
     * @return void
     *
     * @throws PathException This exception is thrown in case the info file path doesn't exist
     *
     * @since 1.0.0
     */
    public function load() : void
    {
        if (!\is_file($this->path)) {
            throw new PathException($this->path);
        }

        $content    = \file_get_contents($this->path);
        $this->info = \json_decode($content !== false ? $content : '[]', true);
    }

    /**
     * Update info file
     *
     * @return void
     *
     * @throws PathException This exception is thrown in case the info file path doesn't exist
     *
     * @since 1.0.0
     */
    public function update() : void
    {
        if (!\is_file($this->path)) {
            throw new PathException($this->path);
        }

        \file_put_contents($this->path, \json_encode($this->info, \JSON_PRETTY_PRINT));
    }

    /**
     * Set data
     *
     * @param string $path  Value path
     * @param mixed  $data  Scalar or array of data to set
     * @param string $delim Delimiter of path
     *
     * @return void
     *
     * @throws \InvalidArgumentException This exception is thrown if the data is not scalar, array or jsonSerializable
     *
     * @since 1.0.0
     */
    public function set(string $path, $data, string $delim = '/') : void
    {
        if (!\is_scalar($data) && !\is_array($data) && !($data instanceof \JsonSerializable)) {
            throw new \InvalidArgumentException('Type of $data "' . \gettype($data) . '" is not supported.');
        }

        ArrayUtils::setArray($path, $this->info, $data, $delim, true);
    }

    /**
     * Get info data.
     *
     * @return array<string, mixed>
     *
     * @since 1.0.0
     */
    public function get() : array
    {
        return $this->info;
    }
}
