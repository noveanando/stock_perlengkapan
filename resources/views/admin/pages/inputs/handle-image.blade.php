<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <i class="{{ getAttributPage($menu, $routeName, 'icon') }} position-left"></i>
                <span class="text-semibold">{{ getAttributPage($menu, $routeName, 'label') }}</span>
            </h4>
        </div>
    </div>
</div>
<div class="content">

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">
                {{ $data ? 'Edit' : 'Tambah' }} {{ getAttributPage($menu, $routeName, 'label') }}
            </h5>
        </div>
        <div class="panel-body">
            <form class="form-horizontal post-action" action="{{ route('handle-image-save', id_exist($data)) }}"
                method="post">
                <div class="row">
                    <div class="col-md-10">
                        <div class="row">
                            <label class="col-md-2 control-label">Nama Kunci <span class="required">*</span></label>
                            <div class="col-md-3 form-group">
                                <input type="text" name="key" value="{{ val_exist($data, 'key') }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-2 control-label">Lebar <span class="required">*</span></label>
                            <div class="col-md-2 form-group">
                                <input type="number" name="width" value="{{ getValueSetting($data, 'width') }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-2 control-label">Tinggi <span class="required">*</span></label>
                            <div class="col-md-2 form-group">
                                <input type="number" name="height" value="{{ getValueSetting($data, 'height') }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-2 control-label">Status <span class="required">*</span></label>
                            <div class="col-md-2 form-group">
                                <select class="form-control" name="status">
                                    <option value="1" {{ val_exist($data, 'status') == '1' ? 'selected' : '' }}>
                                        Aktif</option>
                                    <option value="0" {{ val_exist($data, 'status') == '0' ? 'selected' : '' }}>
                                        Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="icon-floppy-disk position-left"></i> Simpan
                        </button>
                        <a href="{{ route('handle-image') }}" class="btn btn-default me btn-block">
                            <i class="icon-undo2 position-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
