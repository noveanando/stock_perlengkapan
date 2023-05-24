<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <i class="{{ getAttributPage($menu,request()->route()->getName(),'icon') }} position-left"></i>
                <span class="text-semibold">{{ getAttributPage($menu,request()->route()->getName(),'label') }}</span>
            </h4>
        </div>
        @if (getRoleUser(request()->route()->getName(),
            'create'))
            <div class="heading-elements">
                <form class="form-horizontal post-action tag-library" action="{{ route('media-library-save', $type) }}"
                    method="post" enctype="multipart/form-data">
                    <div class="form-group-new {{ form_error($errors, 'media') }}">
                        <div class="input-group">
                            <input type="file" name="media[]" class="form-control" id="mediaupload"
                                multiple="multiple">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">Unggah</button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        @endif
    </div>
</div>
<div class="content">
    <div class="panel panel-flat">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <form action="{{ route($type) }}?type={{ $type }}" method="get" class="post-action">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="Search {{ $type }}" value="{{ request()->search }}">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary"><i
                                        class="icon-search4 position-left"></i> Cari</button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="col-md-8">
                    <div class="progress" style="margin-top: 10px;display: none;">
                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100" style="width:0%">
                            0%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @if (sizeof($datas) == 0)
            <div class="col-md-12 text-center">
                Data {{ $type }} tidak ditemukan.
            </div>
        @endif
        @foreach ($datas as $data)
            @if (in_array($data->type, ['video', 'audio']))
                <div class="col-lg-3 col-sm-6">
                    <div class="thumbnail">
                        <div class="thumb">
                            @php
                                $detail = unserialize($data->media_detail);
                            @endphp
                            <img src="{{ asset('img/placeholder.jpg') }}" alt="">
                            <div class="caption-overflow">
                                <span>
                                    <a href="{{ asset($data->path) }}" data-popup="lightboxvideo"
                                        class="btn border-white text-white btn-flat btn-icon btn-rounded"><i
                                            class="icon-image2"></i></a>
                                    @if (getRoleUser(request()->route()->getName(),
                                        'delete'))
                                        <a href="{{ route('media-library-delete', [$data->type, $data->id]) }}"
                                            class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5 delete-data"><i
                                                class="icon-trash"></i></a>
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="caption">
                            <h6 class="no-margin">
                                <a href="#" class="text-default">{{ str_limit($data->name, 15) }}</a>
                                <a href="javascript:void(0)" class="text-muted">
                                    <span class="pull-right"
                                        style="font-size: 12px;margin-top:5px;">{{ filesize_formatted($detail['size']) }}</span>
                                </a>
                            </h6>
                        </div>
                    </div>
                </div>
            @endif
            @if ($data->type == 'image')
                <div class="col-lg-3 col-sm-6">
                    <div class="thumbnail">
                        <div class="thumb">
                            @if ($data->show_media == '1')
                                <img src="{{ asset(getCropImage($data->path, 'mini')) }}" loading="lazy">
                            @else
                                <img src="{{ asset($data->path) }}" loading="lazy">
                            @endif
                            <div class="caption-overflow">
                                <span>
                                    <a href="{{ asset($data->path) }}" data-popup="lightbox"
                                        class="btn border-white text-white btn-flat btn-icon btn-rounded"><i
                                            class="icon-image2"></i></a>
                                    @if (getRoleUser(request()->route()->getName(),
                                        'delete'))
                                        <a href="{{ route('media-library-delete', [$data->type, $data->id]) }}?page={{ request()->page }}"
                                            class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5 delete-data"><i
                                                class="icon-trash"></i></a>
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="caption">
                            <h6 class="no-margin" style="display: flex;justify-content: space-between;">
                                <a href="#" class="text-default">{{ str_limit($data->name, 15) }}</a>
                                <a href="javascript:void(0)" class="text-muted">
                                    @php
                                        $detail = unserialize($data->media_detail);
                                    @endphp
                                    <span class="pull-right" style="font-size: 12px;margin-top:5px;">
                                        {{ filesize_formatted($detail['size']) }}
                                    </span>
                                </a>
                            </h6>
                        </div>
                    </div>
                </div>
            @endif
            @if ($data->type == 'application')
                <div class="col-lg-3 col-sm-6">
                    <div class="thumbnail">
                        <div class="thumb">
                            @php
                                $detail = unserialize($data->media_detail);
                            @endphp
                            <img src="{{ asset('img/placeholder.jpg') }}" alt="">
                            <div class="caption-overflow">
                                <span>
                                    <a href="{{ asset($data->path) }}" data-popup="lightboxfile"
                                        class="btn border-white text-white btn-flat btn-icon btn-rounded"><i
                                            class="icon-image2"></i></a>
                                    <a href="{{ route('media-library-delete', [$data->type, $data->id]) }}"
                                        class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5 delete-data"><i
                                            class="icon-trash"></i></a>
                                </span>
                            </div>
                        </div>

                        <div class="caption">
                            <h6 class="no-margin">
                                <a href="#" class="text-default">{{ str_limit($data->name, 15) }}</a>
                                <a href="javascript:void(0)" class="text-muted">
                                    <span class="pull-right"
                                        style="font-size: 12px;margin-top:5px;">{{ filesize_formatted($detail['size']) }}</span>
                                </a>
                            </h6>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="text-center">
        {{ $datas->appends(request()->input())->links() }}
    </div>
</div>

@include('admin.components.extra')

@if (!request()->ajax())
    @push('scripts')
    @endif
    <script src="{{ asset('js/fancybox.min.js') }}"></script>
    <script src="{{ asset('js/elevatezoom.min.js') }}"></script>
    <script>
        $('[data-popup="lightbox"]').fancybox({
            padding: 0
        });

        $('[data-popup="lightboxfile"]').fancybox({
            openEffect: 'elastic',
            closeEffect: 'elastic',
            autoSize: true,
            type: 'iframe',
            iframe: {
                preload: false
            }
        });

        $('[data-popup="lightboxvideo"]').fancybox({
            type: 'iframe',
        });

        $('.pagination').find('a').each(function(i, v) {
            $(v).addClass('me')
        })
    </script>
    @if (!request()->ajax())
    @endpush
@endif
