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
            <form class="form-horizontal post-action" action="{{ route('penggunaan-save', id_exist($data)) }}"
                method="post">
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <label class="col-md-3 control-label">Nama Pengguna <span class="required">*</span></label>
                            <div class="col-md-8 form-group">
                                <select class="form-control" name="id_user">
                                    @foreach ($userPengguna as $item)
                                        <option value="{{ $item->id }}"
                                            {{ val_exist($data, 'id_user') == $item->id ? 'selected' : '' }}>
                                            {{ $item->text }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 control-label">Nama Barang <span class="required">*</span></label>
                            <div class="col-md-8 form-group">
                                <select class="form-control" name="id_barang">
                                    @foreach ($barangs as $item)
                                        <option value="{{ $item->id }}"
                                            {{ val_exist($data, 'id_barang') == $item->id ? 'selected' : '' }}>
                                            {{ $item->text }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 control-label">
                                Jumlah <span class="required">*</span>
                            </label>
                            <div class="col-md-3 form-group">
                                <input type="number" class="form-control" name="qty"
                                    value="{{ val_exist($data, 'qty') }}">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 control-label">Keterangan </label>
                            <div class="col-md-8 form-group">
                                <textarea name="history_desc" rows="4" class="form-control">{{ val_exist($data, 'history_desc') }}</textarea>
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
                        <a href="{{ route('penggunaan') }}" class="btn btn-default me">
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
                                <h5>#{{ $data->id_penggunaan }}</h5>
                                <table style="width:100%">
                                    <tr>
                                        <td class="title-table">Nama Pengguna</td>
                                        <td class="barrier-table">:</td>
                                        <td>{{ $data->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="title-table">Nama Barang</td>
                                        <td class="barrier-table">:</td>
                                        <td>{{ $data->asset->item_name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="title-table">Jumlah</td>
                                        <td class="barrier-table">:</td>
                                        <td>{{ $data->qty }}</td>
                                    </tr>
                                    </tr>
                                    <tr>
                                        <td class="title-table">Keterangan</td>
                                        <td class="barrier-table">:</td>
                                        <td>{{ $data->history_desc }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <button class="btn btn-info btn-block btn-edit" type="button">
                            <i class="icon-pencil position-left"></i> Edit
                        </button>
                        <a href="{{ route('penggunaan') }}" class="btn btn-default me btn-block">
                            <i class="icon-undo2 position-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@if (!request()->ajax())
    @push('scripts')
    @endif
    <script>
        $('.btn-edit').click(function() {
            $(this).hide()
            $('.content-editor').show()
        })

        $('.btn-cancel').click(function() {
            $('.content-editor').hide()
            $('.btn-edit').show()
        })
    </script>
    @if (!request()->ajax())
    @endpush
@endif
