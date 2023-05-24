<style>
    .border-select {
        border: 1px solid blue;
    }

    .label-media-library {
        position: absolute;
        left: 10px;
        top: 10px;
        width: 87%;
    }
</style>
<div id="modal-media-library" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="pull-right">
                    <form method="post" enctype="multipart/form-data"
                        action="{{ route('media-library-save', ['image', 'true']) }}" class="save-media-ajax">
                        <input type="file" name="media[]" style="opacity: 0;display: none" multiple="multiple">
                        <button class="btn btn-primary btn-upload-media" type="button">
                            <i class="icon-upload position-left"></i> Unggah
                        </button>
                    </form>
                </span>
                <h4 class="modal-title">Perpustakaan Media</h4>
                <div class="progress" style="margin-top: 10px;display: none;">
                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                        style="width:0%">
                        0%
                    </div>
                </div>
            </div>
            <div class="modal-body" style="max-height: 300px;overflow: auto;">
                <div class="row">

                </div>
            </div>
            <div class="modal-footer" style="margin-top: 10px;">
                <button type="button" class="btn btn-success" id="save-media-container">
                    <i class="icon-check"></i>
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="icon-cross"></i>
                </button>
            </div>
        </div>

    </div>
</div>
