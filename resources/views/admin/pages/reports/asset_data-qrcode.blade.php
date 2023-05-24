<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 12px;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            a {
                text-decoration: unset;
                color: black;
            }
        }
    </style>
</head>

<body>
    <div class="no-print">
        <select name="location_id">
            <option value="">Pilih Lokasi</option>
            @foreach ($locations as $location)
                <option value="{{ $location->id }}" {{ request()->location_id == $location->id ? 'selected' : '' }}>
                    {{ $location->location_name }}</option>
            @endforeach
        </select>

        @if (count($datas) == 0)
            Data tidak ditemukan
        @endif

        @if (count($datas) > 0)
            <div style="margin:20px;">
                <b>DAFTAR QRCODE</b>
            </div>
            @php
                $count = 1;
            @endphp
            <div style="display:inline;">
                @foreach ($datas->chunk(20) as $key => $chunk)
                    <div style="width:200px;border:1px solid black;float:left;margin-right:10px;">
                        <input type="checkbox" name="all_detail_row"> Pilih Semua
                        <ul style="margin-left:-40px;list-style-type:none;">
                            @foreach ($chunk as $data)
                                <li style="border-top:1px solid black;">
                                    <input type="checkbox" name="details[]" value="{{ $data->id }}"
                                        {{ in_array($data->id, $details) ? 'checked' : '' }}>
                                    <b>{{ $data->asset_code }}</b>
                                    <br>
                                    {{ $data->item_name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @php
                        $count++;
                    @endphp
                    @if ($count % 7 == 0)
                        <div style="clear: left;height:30px;"></div>
                    @endif
                @endforeach
            </div>

            <div style="margin:20px;clear: left;float: none;">
                <button type="button" class="show_qrcode">Tampilkan QRcode</button>
            </div>
        @endif
    </div>

    @if (count($prints) > 0)
        <div style="width:10cm;padding:0px 5px 0px 10px;">
            @foreach ($prints->chunk(2) as $print)
                <div
                    style="display: flex; flex-direction:row;justify-content:space-between;page-break-after: void;padding-bottom:10px;padding-top:10px;">
                    @foreach ($print as $item)
                        <div style="width:4.8cm;height:1.5cm;display:flex;">
                            <div style="margin:5px 10px 5px 5px;">
                                {!! DNS2D::getBarcodeSVG($item->asset_code, 'QRCODE', 2.3, 2.3) !!}
                            </div>

                            <div style="line-height: 1.2;padding-top:3px;">
                                <label
                                    style="font-weight:bold;text-decoration:underline;font-size: 12px;">{{ $item->asset_code }}</label><br>
                                <label style="font-size: 11px;font-weight:bold;">{{ $item->item_name }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <div class="no-print">
            <button class="print">Cetak</button>
        </div>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let link = '{{ route('asset_data-qrcode') }}'
        $('[name="location_id"]').change(function() {
            window.location.href = link + '?location_id=' + $(this).val()
        })

        $('.show_qrcode').click(function() {
            let details = []
            $('[name="details[]"]').each(function(i, v) {
                if ($(v).is(':checked')) {
                    let id = $(v).val()
                    details.push(id)
                }
            })

            window.location.href = link + '?location_id=' + $('[name="location_id"]').val() + '&details=' + JSON
                .stringify(details)
        })

        $('.print').click(function() {
            window.print()
        })

        $('[name="all_detail_row"]').change(function() {
            let child = $(this).next().find('[name="details[]"]');
            if ($(this).is(':checked')) {
                child.each(function(i, v) {
                    $(v).prop('checked', true)
                })
            } else {
                child.each(function(i, v) {
                    $(v).prop('checked', false)
                })
            }
        })
    </script>
</body>

</html>
