<style>
    #bcBtn {
        font-size: 35px;
        margin-left: 50px;
    }

</style>
<div class="container-fluid">
    <a href="<?= base_url('rankings')?>" id="bcBtn">
        <i class="fa fa-arrow-left" aria-hidden="true"></i>
    </a>
    <div class="card shadow mb-4 mx-5" id="dataTableResultCon">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLongTitle">
                <b><?= $doamin_data['name']?></b> keywords rankings
            </h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableKeywords" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th style="text-align:center;">key word</th>
                            <!-- <th style="text-align:center;"></th> -->
                            <!-- <th style="text-align:center;"></th> -->
                            <th style="text-align:center;">previous ranking</th>
                            <th style="text-align:center;">current ranking</th>
                            <th style="text-align:center;">progress</th>
                        </tr>
                    </thead>
                    <tbody class="" id="table_keywords">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>