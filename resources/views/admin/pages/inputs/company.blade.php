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
    <h6 class="content-group text-semibold">
        {{ $data ? 'Edit' : 'Tambah' }} {{ getAttributPage($menu, $routeName, 'label') }}
    </h6>
    <form class="form-horizontal post-action" action="{{ route('company-save', id_exist($data)) }}" method="post">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-flat">
                    <div class="panel-body">

                        <div class="row">
                            <label class="col-md-3 control-label">Nama Perusahaan <span
                                    class="required">*</span></label>
                            <div class="col-md-8 form-group">
                                <input type="text" name="company_name" value="{{ val_exist($data, 'company_name') }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 control-label">Kode </label>
                            <div class="col-md-8 form-group">
                                <input type="text" name="company_code" value="{{ val_exist($data, 'company_code') }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 control-label">Status <span class="required">*</span></label>
                            <div class="col-md-4 form-group">
                                <select class="form-control" name="status">
                                    <option value="1" {{ val_exist($data, 'status') == '1' ? 'selected' : '' }}>
                                        Aktif</option>
                                    <option value="0" {{ val_exist($data, 'status') == '0' ? 'selected' : '' }}>
                                        Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 control-label">Gambar </label>
                            <div class="col-md-8 form-group parent-media">
                                <img src="{{ asset(val_exist_object($data, 'media', 'path', 'img/placeholder.jpg', 'mini')) }}"
                                    class="profile-img">
                                <div class="not-img" style="margin-top: 10px;">
                                    <input type="hidden" name="media_id" class="attr-id form-control"
                                        value="{{ val_exist($data, 'media_id') }}" readonly="">
                                    <a href="javascript:void(0)"
                                        class="btn btn-danger remove-media-container label-rounded"
                                        style="{{ val_exist($data, 'media_id') ? 'display: block' : 'display: none' }}"><i
                                            class="icon-cross"></i> Hapus</a>
                                    <a href="javascript:void(0)" data-url="{{ route('get-modal-media', 'image') }}"
                                        class="btn btn-default add-media-container label-rounded"
                                        style="{{ val_exist($data, 'media_id') ? 'display: none' : 'display: block' }}"><i
                                            class="icon-image5"></i> Tambah
                                        Media</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="icon-floppy-disk position-left"></i>Simpan
                        </button>
                        <a href="{{ route('company') }}" class="btn btn-default me btn-block">
                            <i class="icon-undo2 position-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

@include('admin.components.modal-media')

@if (!request()->ajax())
    @push('scripts')
    @endif
    <script defer type="text/javascript" src="{{ asset('js/media.js') }}"></script>
    @if (!request()->ajax())
    @endpush
@endif
