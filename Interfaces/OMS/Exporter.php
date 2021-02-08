<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   Interfaces
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Exchange\Interfaces\OMS;

use phpOMS\DataStorage\Database\Connection\ConnectionAbstract;
use phpOMS\DataStorage\Database\Connection\ConnectionFactory;
use phpOMS\DataStorage\Database\DatabaseStatus;
use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\Localization\ISO3166TwoEnum;
use phpOMS\Localization\ISO639x1Enum;
use phpOMS\Message\RequestAbstract;
use phpOMS\System\File\Local\Directory;
use phpOMS\Utils\IO\Zip\Zip;
use Modules\Exchange\Models\ExporterAbstract;
use phpOMS\Utils\StringUtils;

/**
 * OMS export class
 *
 * @package Modules\Exchange\Models\Interfaces\OMS
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class Exporter extends ExporterAbstract
{
    /**
     * Database connection.
     *
     * @var ConnectionAbstract
     * @since 1.0.0
     */
    private ConnectionAbstract $remote;

    /**
     * Account
     *
     * @var int
     * @since 1.0.0
     */
    private int $account = 1;

    /**
     * Export all data in time span
     *
     * @param \DateTime $start Start time (inclusive)
     * @param \DateTime $end   End time (inclusive)
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function export(\DateTime $start, \DateTime $end) : void
    {
        $this->exportLanguage($start, $end);
    }

    /**
     * Export data from request
     *
     * @param RequestAbstract $request Request
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function exportFromRequest(RequestAbstract $request) : array
    {
        $start = new \DateTime($request->getData('start') ?? 'now');
        $end   = new \DateTime($request->getData('end') ?? 'now');

        $this->account = $request->header->account;

        if ($request->getData('type') === 'language') {
            return $this->exportLanguage();
        }

        return [];
    }

    /**
     * Export language
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function exportLanguage() : array
    {
        $languageArray = [];
        $supportedLanguages = [];

        $basePath = __DIR__ . '/../../../';
        $modules = \scandir($basePath);
        foreach ($modules as $module) {
            $themePath = $basePath . $module . '/Theme/';

            if (!\is_dir($basePath . $module) || $module === '.' || $module === '..'
                || !\is_dir($themePath)
            ) {
                continue;
            }

            $themes = \scandir($themePath);
            foreach ($themes as $theme) {
                $langPath = $themePath . $theme . '/Lang/';
                if (!\is_dir($themePath . $theme) || $theme === '.' || $theme === '..'
                    || !\is_dir($langPath)
                ) {
                    continue;
                }

                $languages = \scandir($themePath . $theme . '/Lang/');
                foreach ($languages as $language) {
                    if (\stripos($language, '.lang.') === false || $language === '.' || $language === '..') {
                        continue;
                    }

                    $components = \explode('.', $language);
                    if (\strlen($components[0]) === 2) {
                        // normal language file
                        $supportedLanguages[] = $components[0];
                        $array = include $themePath . $theme . '/Lang/' . $language;
                        $array = \reset($array);

                        if ($array === false) {
                            continue;
                        }

                        foreach ($array as $key => $value) {
                            $languageArray[\trim($module, '/')][\trim($theme, '/')][$key][$components[0]] = $value;
                        }
                    }
                }
            }

            // search for translations in tpl files which are not included in the language fieles
            foreach ($themes as $theme) {
                if (!\is_dir($themePath . $theme) || $theme === '.' || $theme === '..') {
                    continue;
                }

                $iterator = new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator($themePath . $theme . '/', \RecursiveDirectoryIterator::SKIP_DOTS),
                    \RecursiveIteratorIterator::SELF_FIRST
                );

                foreach ($iterator as $item) {
                    if ($item->isDir() || !StringUtils::endsWith($item->getFilename(), '.tpl.php')) {
                        continue;
                    }

                    $template = \file_get_contents($item->getPathname());
                    $keys = [];
                    \preg_match_all('/(\$this\->getHtml\(\')([a-zA-Z:]+)(\'\))/', $template, $keys, \PREG_PATTERN_ORDER);

                    foreach ($keys[2] ?? [] as $key) {
                        if (!isset($languageArray[\trim($module, '/')][\trim($theme, '/')][$key])) {
                            $languageArray[\trim($module, '/')][\trim($theme, '/')][$key]['en'] = '';
                        }
                    }
                }
            }
        }

        $supportedLanguages = \array_unique($supportedLanguages);

        $content = '"Module";"Theme";"ID";"' . \implode('";"', $supportedLanguages) . '"';
        foreach ($languageArray as $module => $themes) {
            foreach ($themes as $theme => $keys) {
                foreach ($keys as $key => $value) {
                    $content .= "\n\"" . $module . '";"' . $theme . '";"' . $key . '"';

                    foreach ($supportedLanguages as $language) {
                        $content .= ';"' . ($value[$language] ?? '') . '"';
                    }
                }
            }
        }

        return [
            'type'    => 'file',
            'name'    => 'languages.csv',
            'content' => $content
        ];
    }
}