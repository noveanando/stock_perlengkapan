<style>
    th {
        font-weight: bold;
    }

    #reader {
        width: 400px;
        margin-bottom: 30px;
    }

    @media screen and (max-width: 441px) {
        #reader {
            width: 100%;
        }
    }
</style>
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="{{ getAttributPage($menu,request()->route()->getName(),'icon') }} position-left"></i> <span
                    class="text-semibold">{{ getAttributPage($menu,request()->route()->getName(),'label') }}</span></h4>
        </div>
    </div>
</div>
<div class="content">
    <div class="panel panel-flat">
        <div class="panel-body">
            <center>
                <div id="reader"></div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3" style="display:flex;justify-content:space-between;">
                        <button class="btn btn-primary btn-active-scan">
                            <i class="icon-qrcode position-left"></i> Scan
                        </button>
                        <div class="input-group" style="width:70%;">
                            <input type="text" name="search-qrcode" class="form-control"
                                placeholder="Input kode aset">
                            <div class="input-group-btn">
                                <button class="btn btn-info btn-search">
                                    <i class="icon-search4 position-left"></i> Cari
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin-top:30px;">
                    <table id="targetHtml" class="table">

                    </table>
                </div>
            </center>
        </div>
    </div>

</div>

@if (!request()->ajax())
    @push('scripts')
    @endif
    <script src="{{ asset('js/html5-qrcode.min.js') }}"></script>
    <script src="{{ asset('js/fancybox.min.js') }}"></script>
    <script>
        var audiobarcode = new Audio("{{ asset('files/scan.mp3') }}");
        $('.btn-search').click(function() {
            let self = $('[name="search-qrcode"]').val()
            searchAsset(self)
        })

        function searchAsset(string) {
            let html = ''
            $('#targetHtml').html(html)
            $.ajax({
                url: '{{ route('asset_data-search-asset') }}',
                type: 'get',
                data: {
                    search: string
                },
                success: function(res) {
                    html += '<tr><th width="150">Kode Asset</th><td>: ' + res.asset_code + '</td></tr>';
                    html += '<tr><th>Nama Barang</th><td>: ' + res.item_name + '</td></tr>';
                    html += '<tr><th>Kategori</th><td>: ' + res.category + '</td></tr>';
                    html += '<tr><th>Lokasi</th><td>: ' + res.location + '</td></tr>';
                    html += '<tr><th>Status</th><td>: ' + res.status + '</td></tr>';
                    html += '<tr><th>Keterangan</th><td>: ' + res.desc + '</td></tr>';
                    html += '<tr><th>Gambar</th><td>: <a href="' + res.image +
                        '" data-popup="lightbox"> <img src="' + res.image +
                        '" class="profile-img"> </a></td></tr>';

                    $('#targetHtml').html(html)
                    $('[name="search-qrcode"]').val('')
                    $('[data-popup="lightbox"]').fancybox({
                        padding: 0
                    });
                },
                error: function(error) {
                    toastr.error(error.hasOwnProperty('responseJSON') ? error.responseJSON.message : error
                        .statusText)
                }
            })
        }

        let html5QrcodeScanner = new Html5QrcodeScanner("reader", {
            fps: 10,
            qrbox: 250
        });

        function onScanSuccess(decodedText, decodedResult) {
            audiobarcode.play();
            $('[name="search-qrcode"]').val(decodedText)
            $('.btn-search').click()
            html5QrcodeScanner.clear();
            $('.btn-active-scan').show()
        }

        function onScanError(errorMessage) {
            toastr.error(JSON.strignify(errorMessage))
        }

        $('.btn-active-scan').click(function() {
            html5QrcodeScanner.render(onScanSuccess, onScanError);
            $('.btn-active-scan').hide()
        })
    </script>
    @if (!request()->ajax())
    @endpush
@endif
