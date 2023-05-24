<div id="modal-maintenance-history" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="momdal-title">Riwayat Perbaikan</h5>
            </div>
            <form action="{{ route('asset_data-history', [$data->id, 'maintenance']) }}" class="post-action"
                method="post">
                <div class="modal-body">
                    <label>Tanggal</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="date" name="date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <label>Keterangan</label>
                    <textarea class="form-control" name="maintenance_message" rows="4"></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
