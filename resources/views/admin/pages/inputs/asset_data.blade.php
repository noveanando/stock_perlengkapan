<style>
    select[readonly].select2-hidden-accessible+.select2-container {
        pointer-events: none;
        touch-action: none;
    }

    .select2-selection {
        background: #eee;
        box-shadow: none;
    }

    th {
        background-color: #ddd;
    }

    td {
        padding: 8px;
    }

    .title-table {
        width: 150px;
        font-weight: bold;
        vertical-align: top;
    }

    .barrier-table {
        width: 20px;
        text-align: center;
        vertical-align: top;
    }
</style>
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
    <div class="panel panel-flat content-editor" style="{{ id_exist($data) ? 'display:none' : '' }}">
        <div class="panel-heading">
            <h5 class="panel-title">
                {{ $data ? 'Edit' : 'Tambah' }} {{ getAttributPage($menu, $routeName, 'label') }}
            </h5>
        </div>
        <div class="panel-body">
            <form class="form-horizontal post-action" action="{{ route('asset_data-save', id_exist($data)) }}"
                method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <label class="col-md-3 control-label">Kode Barang </label>
                            <div class="col-md-4 form-group">
                                <input type="text" name="asset_code" value="{{ val_exist($data, 'asset_code') }}"
                                    class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 control-label">
                                Nama Barang <span class="required">*</span>
                            </label>
                            <div class="col-md-9 form-group">
                                <input type="text" class="form-control" name="item_name"
                                    value="{{ val_exist($data, 'item_name') }}">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 control-label">Kategori</label>
                            <div class="col-md-6 form-group">
                                <select name="category_id" class="form-control select2">
                                    @if (val_exist($data, 'category_id'))
                                        <option value="{{ val_exist($data, 'category_id') }}">
                                            {{ $data->category->category_name }}
                                        </option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 control-label">Lokasi</label>
                            <div class="col-md-5 form-group" style="margin-right:5px;">
                                <select name="location_id" class="form-control select2">
                                    @if (val_exist($data, 'location_id'))
                                        <option value="{{ val_exist($data, 'location_id') }}">
                                            {{ $data->location->location_name }}
                                        </option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4 form-group child_location"
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
                        <div class="row">
                            <label class="col-md-3 control-label">Status <span class="required">*</span></label>
                            <div class="col-md-3 form-group">
                                <select class="form-control" name="location_status">
                                    <option value="1"
                                        {{ val_exist($data, 'location_status') == '1' ? 'selected' : '' }}>
                                        Aktif</option>
                                    <option value="0"
                                        {{ val_exist($data, 'location_status') == '0' ? 'selected' : '' }}>
                                        Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <label class="col-md-3 control-label">Keterangan </label>
                            <div class="col-md-9 form-group">
                                <textarea name="asset_desc" rows="4" class="form-control">{{ val_exist($data, 'asset_desc') }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 control-label">Gambar </label>
                            <div class="col-md-9 form-group">
                                <input type="file" class="form-control" name="file_upload"
                                    accept="image/png, image/jpeg">
                                <div id="result-list-file-upload"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <input type="hidden" name="company_id" value="">
                    <button type="submit" class="btn btn-primary">
                        <i class="icon-floppy-disk position-left"></i>Simpan
                    </button>
                    @if (!id_exist($data))
                        <a href="{{ route('asset_data') }}" class="btn btn-default me">
                            <i class="icon-undo2 position-left"></i> Kembali
                        </a>
                    @else
                        <button type="button" class="btn btn-default btn-cancel">
                            <i class="icon-cross position-left"></i>Batal
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
    @if (id_exist($data))
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h5>#{{ $data->asset_code }}</h5>
                                <table style="width:100%">
                                    <tr>
                                        <td class="title-table">Nama Barang</td>
                                        <td class="barrier-table">:</td>
                                        <td>{{ $data->item_name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="title-table">Kategori</td>
                                        <td class="barrier-table">:</td>
                                        <td>{{ isset($data->category) ? $data->category->category_name : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="title-table">Lokasi</td>
                                        <td class="barrier-table">:</td>
                                        <td>
                                            {{ isset($data->location) ? $data->location->location_name : '' }}
                                            {{ isset($data->childlocation) ? ' ( ' . $data->childlocation->location_name . ' ) ' : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="title-table">Tanggal Pembelian</td>
                                        <td class="barrier-table">:</td>
                                        <td>{{ $data->purchase_date ? date('d/m/Y', strtotime($data->purchase_date)) : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="title-table">Harga</td>
                                        <td class="barrier-table">:</td>
                                        <td>Rp {{ number_format($data->price) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="title-table">Keterangan</td>
                                        <td class="barrier-table">:</td>
                                        <td>{{ $data->asset_desc }}</td>
                                    </tr>
                                    <tr>
                                        <td class="title-table">Status</td>
                                        <td class="barrier-table">:</td>
                                        <td>{{ $data->assetstatus->status_name }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                {!! DNS2D::getBarcodeSVG($data->asset_code, 'QRCODE', 4.5, 4.5) !!}
                                <br>
                                <label>Gambar</label><br>
                                <a href="{{ isset($data->media) ? asset($data->media->path) : 'javascript:void(0)' }}"
                                    data-popup="lightbox">
                                    <img src="{{ asset(val_exist_object($data, 'media', 'path', 'img/placeholder.jpg', 'mini')) }}"
                                        class="profile-img">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        {{-- <button class="btn btn-danger btn-block btn-history" data-type="maintenance" type="button">
                            <i class="icon-cog position-left"></i> Pemeliharaan
                        </button> --}}
                        {{-- <a href="{{ route('asset_data-qrcode', $data->id) }}" class="btn btn-warning btn-block"
                            target="_blank">
                            <i class="icon-qrcode position-left"></i> Qrcode
                        </a> --}}
                        <button class="btn btn-info btn-block btn-edit" type="button">
                            <i class="icon-pencil position-left"></i> Edit
                        </button>
                        <a href="{{ route('asset_data') }}" class="btn btn-default me btn-block">
                            <i class="icon-undo2 position-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <h5>Perubahan Lokasi dan Status</h5>
                        <ul>
                            @foreach ($data->statushistories as $his)
                                <li>
                                    {{ $his->history_desc }} <br>
                                    <span style="font-size:10px;">
                                        {{ $his->user->name }} -
                                        {{ date('d/m/Y', strtotime($his->created_at)) }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-6">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <h5>Maintenance</h5>
                        <ul>
                            @foreach ($data->maintenances as $main)
                                <li>
                                    {{ $main->history_desc }} <br>
                                    <span style="font-size:10px;">
                                        {{ $main->user->name }} -
                                        {{ date('d/m/Y', strtotime($main->created_at)) }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div> --}}
        </div>
        {{-- @include('admin.components.modal-maintenance-history', [
            'data' => $data,
        ]) --}}
    @endif
</div>

@include('admin.components.modal-media')


@if (!request()->ajax())
    @push('scripts')
    @endif
    <script defer type="text/javascript" src="{{ asset('js/media.js') }}"></script>
    <script src="{{ asset('js/fancybox.min.js') }}"></script>
    <script>
        var autoCategory = "{{ route('category-autocomplete') }}";
        var autoLocation = "{{ route('location-autocomplete') }}";
    </script>
    <script src="{{ asset('js/asset_data.js') }}"></script>
    @if (!request()->ajax())
    @endpush
@endif
