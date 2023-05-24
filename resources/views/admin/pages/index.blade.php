<style>
    th:last-child {
        width: 50px !important;
        text-align: center;
    }

    .l2 {
        padding-left: 1em;
    }

    .l1 {
        font-weight: bold;
    }

    .table>thead>tr>th {
        padding: 10px 10px 10px 10px;
    }

    .table>tbody>tr>td {
        padding: 10px 10px 10px 10px;
    }

    /* .select2-selection__rendered {
        line-height: 36px !important;
    } */

    .select2-container .select2-selection--single {
        height: 36px !important;
    }

    .select2-selection__arrow {
        height: 36px !important;
    }
</style>
@php
    $config = config('getdatatable.' . $type);
    $firstMenu = firstMenu($menu, $type);
@endphp
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="{{ getAttributPage($menu, $type, 'icon') }} position-left"></i> <span
                    class="text-semibold">{{ getAttributPage($menu, $type, 'label') }}</span></h4>
            @if (isset($firstMenu['desc']))
                <p>{{ $firstMenu['desc'] }}</p>
            @endif
        </div>
        <div class="heading-elements">
            @if (getRoleUser($routeName, 'create') && in_array('create', getAttributPage($menu, $type, 'activity')))
                <a href="{{ route($type . '-entry') }}" class="btn btn-primary me">
                    <i class="icon-plus2 position-left"></i> Buat {{ getAttributPage($menu, $type, 'label') }} Baru
                </a>
            @endif
        </div>
    </div>
</div>
<div class="content">
    <div class="panel panel-flat">
        @php
            $cols = $config['filter'];
        @endphp
        @if ((isset($cols['label']) && count(array_slice($cols['label'], 1)) > 0) || isset($cols['between']))
            <div class="panel-heading element-filter" style="display: none;">
                <div class="row">
                    @if (isset($cols['between']))
                        @foreach ($cols['between'] as $between)
                            <div class="col-md-6" style="margin-bottom:10px;">
                                <b>{{ $between['label'] }}</b>
                                <div class="row">
                                    @foreach ($between['value'] as $kb => $va)
                                        <div class="col-md-6" style="margin-bottom:10px;">
                                            <label for="">{{ $va }}</label>
                                            <input type="date" name="{{ $kb }}" value=""
                                                class="form-control between" style="height:34px;">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @php
                        $filterLabel = array_slice($cols['label'], 1);
                    @endphp
                    @foreach (array_slice($cols['table'], 1) as $klab => $lab)
                        @php
                            $lab = strpos($lab, 'as') > -1 ? explode(' as ', $lab)[1] : $lab;
                        @endphp

                        @if (${$lab}['type'] == 'select')
                            @if (isset(${$lab}['route']))
                                <div class="col-md-3">
                                    <label for="">{{ $filterLabel[$klab] }}</label>
                                    <select class="form-control filter-select2 select2ajax" name="{{ $lab }}"
                                        data-label="{{ $filterLabel[$klab] }}" data-route="{{ ${$lab}['route'] }}">
                                        <option value="all">Semua {{ $filterLabel[$klab] }}</option>
                                    </select>
                                </div>
                            @else
                                <div class="col-md-3">
                                    <label for="">{{ $filterLabel[$klab] }}</label>
                                    <select class="form-control filter-select2" name="{{ $lab }}"
                                        data-label="{{ $filterLabel[$klab] }}">
                                        <option value="all">Semua {{ $filterLabel[$klab] }}</option>
                                        @foreach (${$lab}['data'] as $fdata)
                                            <option value="{{ $fdata->id }}">{{ $fdata->text }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        @endif
                        @if (${$lab}['type'] == 'text')
                            <div class="col-md-3">
                                <label>{{ $filterLabel[$klab] }}</label>
                                <input type="text" name="{{ $lab }}" class="form-control text">
                            </div>
                        @endif
                        @if (${$lab}['type'] == 'date')
                            <div class="col-md-3">
                                <label>{{ $filterLabel[$klab] }}</label>
                                <input type="date" name="{{ $lab }}" class="form-control text">
                            </div>
                        @endif
                    @endforeach
                    <div class="col-md-3">
                        @if (count($filterLabel) > 0)
                            <a href="javascript:void(0)" class="btn btn-default btn-reset" style="margin-top:27px;">
                                Reset <i class="icon-reset"></i>
                            </a>
                        @endif
                        @if (isset($config['exportExcel']) && $config['exportExcel'])
                            <a href="{{ route($type . '-excel') }}" class="btn btn-success btn-export-excel"
                                style="margin-top:27px;" target="_blank">
                                Eksport <i class="icon-file-excel"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endif
        @if (isset($config['filterAuth']))
            @foreach ($config['filterAuth'] as $fh)
                <input type="hidden" name="{{ $fh }}">
            @endforeach
        @endif
        <div class="table-responsive">
            <table class="table datatable-basic" id="dataTable" style="width:100%;">
                <thead>
                    <tr>
                        @foreach ($config['labelTable'] as $kcol => $col)
                            <th class="no-sort" width="{{ $config['widthTable'][$kcol] }}"><b>{{ ucwords($col) }}</b>
                        @endforeach

                        @if (count($config['selectTable']) > count($config['labelTable']))
                            <th width="100" class="no-sort"><b>Action</b></th>
                        @endif
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@if (!request()->ajax())
    @push('scripts')
    @endif
    <script src="{{ asset('packages/datatables/datatables.min.js') }}"></script>
    <script>
        var type = "{{ $type }}";
        var key = "{{ isset($key) ? $key : '' }}";
        var baseUrl = "{{ url('/') }}";
        var getData = "{{ route('get-data') }}";
        var config = {!! json_encode($config) !!};
        var currentUrl = "{{ url()->current() }}";
        var configMenu = {!! json_encode(firstMenu($menu, $type)) !!};
        var company_id = "{{ in_array(session('userData')['roleId'], [1]) }}" ? '' : localStorage.getItem('company');
        var editable = "{{ getRoleUser($routeName, 'edit') }}";
        var removable = "{{ getRoleUser($routeName, 'delete') }}";
        var traceable = "{{ getRoleUser($routeName, 'trace') }}";
        var otherAccess = {!! getRoleUser($routeName) !!};
        @if (in_array('delete', firstMenu($menu, $type)))
            var multiDeleteUrl = "{{ route($type . '-multi-delete') }}";
        @endif
    </script>
    <script type="text/javascript" src="{{ asset('js/load-datatable.js') }}?v={{ date('YmdHis') }}"></script>
    @if (!request()->ajax())
    @endpush
@endif
