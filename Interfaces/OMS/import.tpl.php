<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="portlet">
            <form id="fImport" method="POST" action="<?= \phpOMS\Uri\UriFactory::build('{/api}admin/exchange/import/profile?{?}&exchange=OMS&type=language&csrf={$CSRF}'); ?>">
                <div class="portlet-head"><?= $this->getHtml('Langauge'); ?> - OMS</div>
                <div class="portlet-body">
                    <table class="layout wf-100" style="table-layout: fixed">
                        <tbody>
                        <tr><td><label for="iFile"><?= $this->getHtml('File'); ?></label>
                        <tr><td><input type="file" id="iFile" name="file" placeholder="&#xf040; <?= $this->getHtml('File'); ?>" required>
                    </table>
                </div>
                <div class="portlet-foot">
                    <input type="submit" value="<?= $this->getHtml('Import'); ?>">
                </div>
            </form>
        </section>
    </div>
</div>
