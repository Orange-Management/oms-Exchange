<?php declare(strict_types=1);

$lang = $this->getData('lang');
?>
<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="portlet">
            <form id="fImport" method="POST" action="<?= \phpOMS\Uri\UriFactory::build('{/api}admin/exchange/export/profile?{?}&id={?id}&type=language&csrf={$CSRF}'); ?>">
                <div class="portlet-head"><?= $this->printHtml($lang['Language']); ?> - OMS</div>
                <div class="portlet-body">
                </div>
                <div class="portlet-foot">
                    <input type="submit" value="<?= $this->getHtml('Export'); ?>">
                </div>
            </form>
        </section>
    </div>
</div>
