<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   Modules\Exchange
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

use \phpOMS\Uri\UriFactory;

/** @var \Modules\Exchange\Models\ExchangeLog $log */
$log = $this->getData('log');

echo $this->getData('nav')->render();
?>
<div class="row">
    <div class="col-xs-12">
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Exchange'); ?></div>
            <div class="portlet-body">
                <table class="list w-100">
                    <tbody>
                        <tr><td><?= $this->getHtml('ID', '0', '0'); ?><td class="wf-100"><?= $log->getId(); ?>
                        <tr><td><?= $this->getHtml('Type'); ?><td class="wf-100"><?= $log->getType(); ?>
                        <tr><td><?= $this->getHtml('Subtype'); ?><td class="wf-100"><?= $log->subtype; ?>
                        <tr><td><?= $this->getHtml('Created'); ?><td><?= $log->createdAt->format('Y-m-d'); ?>
                        <tr><td><?= $this->getHtml('Creator'); ?><td><a href="<?= UriFactory::build('{/prefix}profile/single?for=' . $log->createdBy->getId()); ?>"><?= $log->createdBy->name1; ?></a>
                        <tr><td colspan="2"><?= $log->message; ?>
                </table>
            </div>
        </section>
    </div>
</div>
