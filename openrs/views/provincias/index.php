<div class="page-header">
    <div class="row">
        <div class="col-xs-12">
            <h1>
                Provincias
            </h1>
        </div>
    </div>
</div>

<?php $this->load->view('common/message', $this->data); ?>

<div class="row">
    <div class="col-lg-4 col-md-3"></div>
    <div class="center col-lg-4 col-md-6 col-xs-12">
        <table class="table table-striped table-bordered table-hover" id="tabgrid">
            <thead>
                <tr>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($provincias as $provincia)
                {
                ?>
                <tr>
                    <td>
                        <a class="blue" href="<?php echo site_url("poblaciones/index/" . $provincia->id); ?>" title="Ver poblaciones de <?php echo $provincia->provincia; ?>"><?php echo $provincia->provincia; ?></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>