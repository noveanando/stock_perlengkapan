<div id="modal-status-history" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="momdal-title">Riwayat Status Barang</h5>
            </div>
            <form action="{{ route('asset_data-history', [$data->id, 'status']) }}" class="post-action" method="post">
                <div class="modal-body">
                    <label>Status Baru</label>
                    <select class="form-control" name="asset_status">
                        <option value="">Pilih Status</option>
                        @foreach ($assetStatus as $kas => $status)
                            <option value="{{ $kas }}"
                                {{ val_exist($data, 'asset_status') == $kas ? 'selected' : '' }}>
                                {{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
