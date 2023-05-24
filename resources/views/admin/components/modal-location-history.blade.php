<div id="modal-location-history" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="momdal-title">Riwayat Lokasi Barang</h5>
            </div>
            <form action="{{ route('asset_data-history', [$data->id, 'location']) }}" class="post-action" method="post">
                <div class="modal-body">
                    <label>Lokasi Baru</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="location_id" class="form-control select2">
                                    @if (val_exist($data, 'location_id'))
                                        <option value="{{ val_exist($data, 'location_id') }}">
                                            {{ $data->location->location_name }}
                                        </option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group child_location"
                                style="{{ val_exist($data, 'location_id') ? 'display:block' : 'display:none' }}">
                                <select name="child_location_id" class="form-control select2">
                                    @if (val_exist($data, 'child_location_id'))
                                        <option value="{{ val_exist($data, 'child_location_id') }}">
                                            {{ $data->childlocation->location_name }}
                                        </option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
