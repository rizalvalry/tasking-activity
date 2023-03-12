<div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalAddLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id="form" class="form-horizontal">
            <input type="hidden" value="" name="id_project"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-6">Nama project</label>
                            <div class="col-md-12">
                                <input name="nama_project" placeholder="project" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Mulai</label>
                            <div class="col-md-9">
                                <input name="tanggal_mulai" placeholder="Title" class="form-control" type="date">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="seeAnotherFieldGroup">Status</label>
                            <select class="form-control" name="status" id="seeAnotherFieldGroup">
                                <option value="Done">Done</option>
                                <option value="Unfinished">Unfinished</option>
                            </select>
                        </div>

                        <div class="form-group m-2" id="otherFieldGroupDiv">
                            <div class="row">
                            <div class="form-group col-md-4">
                                <label for="otherField1">Durasi Pengerjaan</label>
                                <select class="form-control" name="cicilan_ke" id="seeAnotherFieldGroup">
                                <?php foreach($tempo as $row){ ?>
                                    <option value="<?php echo $row->tempo ?>"> <?php echo ($row->tempo) ?></option>
                                <?php } ?>
                            </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="otherField2">Sisa Pengerjaan</label>
                                <input type="text" name="sisa_pengerjaan" class="form-control w-100" id="otherField2">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="otherField2">Jatuh Tempo</label>
                                <input type="date" name="jatuh_tempo" class="form-control w-100" id="otherField2">
                            </div>
                            </div>
                        </div>

                        <div class="form-group col-md-8">
                                <label for="otherField2">Jumlah resource project</label>
                                <input type="text" name="jumlah_project" class="form-control w-100" id="otherField2">
                        </div>

                    </div>
                </form>
        <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>