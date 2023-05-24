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
    <form class="form-horizontal post-action" action="{{ route('category-save', id_exist($data)) }}" method="post">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="row">
                            <label class="col-md-3 control-label">Nama kategori <span class="required">*</span></label>
                            <div class="col-md-5 form-group">
                                <input type="text" name="category_name"
                                    value="{{ val_exist($data, 'category_name') }}" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 control-label">Induk </label>
                            <div class="col-md-4 form-group">
                                <select name="parent_id" class="form-control">
                                    @if (val_exist($data, 'parent_id'))
                                        <option value="{{ $data->parent_id }}">
                                            {{ $data->parent->category_name }}
                                        </option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 control-label">Status <span class="required">*</span></label>
                            <div class="col-md-2 form-group">
                                <select class="form-control" name="category_status">
                                    <option value="1"
                                        {{ val_exist($data, 'category_status') == '1' ? 'selected' : '' }}>
                                        Aktif</option>
                                    <option value="0"
                                        {{ val_exist($data, 'category_status') == '0' ? 'selected' : '' }}>
                                        Tidak Aktif</option>
                                </select>
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
                        <a href="{{ route('category') }}" class="btn btn-default me btn-block">
                            <i class="icon-undo2 position-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@if (!request()->ajax())
    @push('scripts')
    @endif
    <script>
        $('[name="parent_id"]').select2({
            ajax: {
                url: "{{ route('category-autocomplete') }}",
                dataType: 'json',
                delay: 100,
                data: function(params) {
                    return {
                        search: params.term,
                        parent_id: null,
                    }
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                }
            }
        });
    </script>
    @if (!request()->ajax())
    @endpush
@endif
