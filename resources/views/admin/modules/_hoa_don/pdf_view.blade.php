<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ public_path('admin/pdf/assets/css/style.css') }}">
</head>

<body>
    <header>
        {{-- <img src="{{ url('admin/img/logo.png') }}" width="100px"> --}}
        <div class="left">
            <h3 class="Ten">Đại lý Linh Chi</h3>
            <p>ĐC: Ấp Thuận Long, xã Tân Tiến, Đầm Dơi, Cà Mau</p>
            <p>SĐT: 0918.396.041 (Linh) - 0917.852.210 (Chi)</p>
        </div>
        <div class="right">
            <p>Ngày in: {{ $NgayIn }}</p>
            <p>Số phiếu: XH{{ $MaHoaDon }}</p>
            <p>Toa trước: XH{{ $MaHoaDon }}</p>
        </div>
    </header>
    <h2>HÓA ĐƠN BÁN HÀNG</h2>
    <section>
        <div class="thongTinKhachHang">
            <h6>Tên khách hàng: {{ $TenKhachHang }}</h6>
            <p>Số điện thoại: {{ $SoDienThoai }}</p>
            <p>Địa chỉ: {{ $DiaChi }}</p>
        </div>
        <div class="test"></div>
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Loại hàng hóa</th>
                    <th>Tên hàng hóa</th>
                    <th>ĐVT</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php
                function numberToString($a)
                {
                    $result = '';
                    // please write your code here
                    $a = (string) $a;
                    $leng = strlen($a);
                
                    if ($leng == 1) {
                        return $map[$a];
                    }
                    $convert = chunkStringToArray($a);
                
                    $count = count($convert);
                    $j = $count;
                    for ($i = 0; $i < $count; $i++) {
                        if ($convert[$i] == '000') {
                            $j--;
                            continue;
                        }
                        if ($j % 4 == 0) {
                            $result .= ' ' . numberToThousand($convert[$i]) . ' tỷ';
                        } elseif ($j % 3 == 0) {
                            $result .= ' ' . numberToThousand($convert[$i]) . ' triệu';
                        } elseif ($j % 2 == 0) {
                            $result .= ' ' . numberToThousand($convert[$i]) . ' nghìn';
                        } else {
                            $result .= ' ' . numberToThousand($convert[$i]);
                        }
                        $j--;
                    }
                    //replace if end number is 4
                    $result = trim($result);
                    if (substr($result, -3) == 'bốn') {
                        $result = substr($result, 0, -3) . 'tư';
                    }
                    return $result;
                }
                
                function numberToThousand($a)
                {
                    $a = (string) $a;
                    $map = ['0' => 'không', '1' => 'một', '2' => 'hai', '3' => 'ba', '4' => 'bốn', '5' => 'năm', '6' => 'sáu', '7' => 'bảy', '8' => 'tám', '9' => 'chín'];
                    $leng = strlen($a);
                    $str = '';
                    $j = $leng;
                    if ($a == '10') {
                        return 'mười';
                    }
                    if ($leng == 2 && $a[0] == '1') {
                        return trim("mười {$map[$a[1]]}");
                    }
                    for ($i = 0; $i < $leng; $i++) {
                        if ($j == 3) {
                            $str .= " {$map[$a[$i]]} trăm";
                        } elseif ($j == 2) {
                            if ($a[$i] == '0' && $leng == 3 && $a[2] != '0') {
                                $str .= ' linh';
                            } elseif ($a[$i] != '0') {
                                $str .= " {$map[$a[$i]]} mươi";
                            }
                        } else {
                            if ($a[$i] != '0') {
                                $str .= " {$map[$a[$i]]} ";
                            }
                        }
                
                        $j--;
                    }
                
                    return trim($str);
                }
                
                function chunkStringToArray($a)
                {
                    $a = number_format((int) $a, 0);
                    return explode(',', $a);
                }
                
                // echo numberToString($_GET['n']);
                
                ?>
                <?php
                $i = 1;
                $tongThanhTien = 0;
                
                ?>
                @foreach ($HangHoa as $hh)
                    <?php
                    $GiaChietKhau = ($ChietKhau * $hh->GiaBan) / 100;
                    $DonGiaCK = $hh->GiaBan - $GiaChietKhau;
                    $tong = $hh->SoLuong * $DonGiaCK;
                    $tongThanhTien += $tong;
                    ?>
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $hh->LoaiHangHoa }}</td>
                        <td>{{ $hh->TenHangHoa }}</td>
                        <td>{{ $hh->DonViTinh }}</td>
                        <td>{{ $hh->SoLuong }}</td>
                        <td style="text-align: right;">
                            {{ number_format($DonGiaCK, 0, '', '.') }} đ</td>
                        <td style="text-align: right;">
                            {{ number_format($tong, 0, '', '.') }}
                            đ</td>
                    </tr>
                @endforeach
            </tbody>
            @if ($LoaiHoaDon == 1)
                <tr class="noneBorder">
                    <td class="noneBorder1 italic" rowspan='2' colspan='5'>
                        Ghi chú: {{ $GhiChu }}</td>
                    <th>Tổng: </th>
                    <th style="text-align: right;">{{ number_format($tongThanhTien, 0, '', '.') }} đ</th>
                </tr>
                <tr class="noneBorder">
                    <td>Nợ cũ: </td>
                    <td style="text-align: right;">{{ number_format($NoCu, 0, '', '.') }} đ</td>
                </tr>
                <tr class="noneBorder">
                    <td class="noneBorder1 italic" colspan="5">
                        (Bằng chữ: {{ numberToString($NoCu + $tongThanhTien) }} đồng)
                    </td>
                    <td>Tổng công nợ: </td>
                    <td style="text-align: right;">{{ number_format($NoCu + $tongThanhTien, 0, '', '.') }} đ</td>
                </tr>
            @else
                <tr class="noneBorder">
                    <td class="noneBorder1 italic" colspan="5">
                        (Bằng chữ: {{ numberToString($tongThanhTien) }} đồng)
                    </td>
                    <th>Tổng: </th>
                    <th style="text-align: right;">{{ number_format($tongThanhTien, 0, '', '.') }} đ</th>
                </tr>
                <tr class="noneBorder noneBorder2">
                    <td class="noneBorder1 italic" colspan='7'>
                        Ghi chú: {{ $GhiChu }}</td>
                </tr>
            @endif
        </table>
    </section>
    <footer>
        <div class="leftFooter">
            <h6>Người nhận</h6>
            <p>(Ký và ghi rõ họ tên)</p>
        </div>
        <div class="rightFooter">
            <h6>Người Lập phiếu</h6>
            <p>(Ký và ghi rõ họ tên)</p>
{{--            <p class="DoanThaoVy">Đoàn Thảo Vy</p>--}}
        </div>
    </footer>
</body>

</html>
