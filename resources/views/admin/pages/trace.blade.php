<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="{{ getAttributPage($menu, request()->route()->getName(),'icon') }} position-left"></i> <span class="text-semibold">Pelacakan {{ getAttributPage($menu, request()->route()->getName(),'label') }}</span></h4>
        </div>
    </div>
</div>
<div class="content" >
    <div class="panel panel-flat">
        <div class="panel-body">
            @if(count($logs) > 0)
            <ul class="list-feed">
                @foreach($logs as $log)
                <li>
                    <b>{{$log->description}}</b>
                    @if($log->extra_description)
                    ---- Perubahan {{ $log->extra_description }}
                    @endif
                    <br>
                    <span style="font-size: 11px;">
                        -- oleh {{$log->user->name}} pada {{ date('d/m/Y H:i:s', strtotime($log->created_at))}}</li>
                    </span>
                @endforeach
            </ul>
            @else
            Data Tidak Ditemukan
            @endif
        </div>
    </div>
</div>
