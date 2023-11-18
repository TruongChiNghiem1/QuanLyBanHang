// {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script> --}}
// {{-- <script type="text/javascript">
//     var route = "{{ url('admin/hang-hoa/autocomplete-search') }}";
//     $('#search').typeahead({
//         source: function(query, process) {
//             return $.get(route, {
//                 query: query
//             }, function(data) {
//                 return process(data);
//             });
//         },
//         // templates: {
//         //     empty: [
//         //         '<div class="list-group search-results-dropdown"><div class="list-group-item">Không có kết quả phù hợp.</div></div>'
//         //     ],
//         //     header: [
//         //         '<div class="list-group search-results-dropdown">'
//         //     ],
//         //     suggestion: function(data) {
//         //         return '<a href="customer/' + data.MaKhachHang + '" class="list-group-item">' + data.TenKhachHang + data.SoDienThoai+ '</a>'
//         //     }
//         // }
//     });
// </script> --}}

$(document).ready(function () {
    //---------SEARCH KHÁCH HÀNG---------------
    // $("#searchKhachHang").keyup(function () {
    //     var query = $(this).val();
    //     if (query != "") {
    //         var _token = $('input[name="_token"]').val();
    //         $.ajax({
    //             url: "fetchKhachHang",
    //             method: "POST",
    //             data: {
    //                 query: query,
    //                 _token: _token,
    //             },
    //             success: function (data) {
    //                 $("#searchList").fadeIn();
    //                 let out = `<ul class="dropdown-menu scrollable-menu" style="display:block; position:absolute;width:36%;">`;
    //                 data.forEach((row) => {
    //                     out += row.output;
    //                 });
    //                 out += `</ul>`;
    //                 $("#searchList").html(out);
    //                 return data;
    //             },
    //         });
    //     }
    // });

    $("#searchKhachHang").keyup(function () {
        var noCu = 0;
        var tongTruChieKhau = 0;

        var query = $(this).val();
        var HoaDon = $('#HoaDon').val();
        if (query != "") {
            $.ajaxSetup({
                header: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                url: "fetchKhachHang",
                method: "GET",
                data: {
                    query: query,
                    HoaDon: HoaDon,
                },
                success: function (data) {
                    $("#searchListKhachHang").fadeIn();
                    let out = `<ul class="dropdown-menu scrollable-menu" style="display:block; position:absolute;width:36%;">`;
                    data.forEach((row) => {
                        out +=
                            `<li class="dropdown-item searchKhachHang"><input type="hidden" id="searchKhachHangInput" class="searchKhachHangInput" value="` +
                            row.MaKH +
                            `"/>` +
                            row.TenKhachHang +
                            ` - ` +
                            row.SoDienThoai +
                            `</li>`;
                    });
                    out += `</ul>`;
                    $("#searchListKhachHang").html(out);
                },
            });
        } else {
            var out = `<input type="hidden" id="NoCuLay" name="NoCu" value="0">Nợ cũ: <strong>0 VNĐ</strong>`;
            $("#noCu").html(out);
            NoMoiLay = parseInt($("#NoMoiLay").val());
            $(".tongCongNo").text(NoMoiLay.toLocaleString("fi-FI") + " VNĐ");
        }
        if ($("#searchKhachHangInput']").is(":empty")) {
            $("#inputPhone").val("");
            $("#diaChi").val("");
            var out = `<input type="hidden" id="NoCuLay" name="NoCu" value="0">Nợ cũ: <strong>0 VNĐ</strong>`;
            $("#noCu").html(out);
            NoMoiLay = parseInt($("#NoMoiLay").val());
            $(".tongCongNo").text(NoMoiLay.toLocaleString("fi-FI") + " VNĐ");
        }
    });

    $(document).on("click", "div", function () {
        $("#searchListKhachHang").fadeOut();
    });

    $(document).on("click", ".searchKhachHang", function () {
        var ids = $("#searchKhachHangInput", this).val();
        $("#searchKhachHang").val($(this).text());
        $("#khachHang").val(ids);
        $.ajaxSetup({
            header: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: "fetchChonKhachHang",
            method: "GET",
            data: {
                id: ids,
            },
            success: function (data) {
                $("#inputPhone").val(data.SoDienThoai);
                $("#diaChi").val(data.DiaChi);

                var soTien = data.SoTien;
                var daThanhToan = data.DaThanhToan;
                noCu = soTien - daThanhToan;
                let chietKhau =
                    (tong * $("input[name='ChietKhau']").val()) / 100;
                tongTruChieKhau = tong - chietKhau;
                if (isNaN(noCu)) {
                    $("#vu").text("vụ 1");
                    var out = `<input type="hidden" id="NoCuLay" name="NoCu" value="0">Nợ cũ: <strong>0 VNĐ</strong>`;
                } else {
                    $("#vu").text("vụ " + data.Vu);
                    var out =
                        `<input type="hidden" id="NoCuLay" name="NoCu" value="` +
                        noCu +
                        `">Nợ cũ: <strong>` +
                        noCu.toLocaleString("fi-FI") +
                        " VNĐ" +
                        `</strong>`;
                }
                $("#noCu").html(out);

                NoMoiLay = parseInt($("#NoMoiLay").val());
                NoCuLay = parseInt($("#NoCuLay").val());
                $(".tongCongNo").text(
                    (NoCuLay + NoMoiLay).toLocaleString("fi-FI") + " VNĐ"
                );
            },
        });
        $("#searchListKhachHang").fadeOut();
    });

    //---------SEARCH HANG HOA---------------
    $.ajaxSetup({
        header: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: "fetchFullHangHoa",
        method: "GET",
        success: function (data) {
            hienGia(data[0].MaHang);
            let out = ``;
            data.forEach((row) => {
                out +=
                    '<option id="' +
                    row.MaHang +
                    '" class="dropdown-item searchHangHoa" value="' +
                    row.MaHang +
                    '">' +
                    row.TenHangHoa +
                    "</option>";
            });
            $("select[name='idHangHoa']").html(out);
        },
    });

    $("#searchHangHoa").keyup(function () {
        var query = $(this).val();
        if (query != "") {
            $.ajaxSetup({
                header: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                url: "fetchHangHoa",
                method: "GET",
                data: {
                    query: query,
                },
                success: function (data) {
                    hienGia(data[0].MaHang);
                    // $('#searchListHangHoa').fadeIn();
                    let out = ``;
                    data.forEach((row) => {
                        //     out += row.output;
                        out +=
                            '<option id="' +
                            row.MaHang +
                            '" class="dropdown-item searchHangHoa" value="' +
                            row.MaHang +
                            '">' +
                            row.TenHangHoa +
                            "</option>";
                    });
                    $("select[name='idHangHoa']").html(out);
                    // return data;
                    // $("select[name='idHangHoa']").html(data);
                },
            });
        } else {
            $.ajaxSetup({
                header: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                url: "fetchFullHangHoa",
                method: "GET",
                success: function (data) {
                    hienGia(data[0].MaHang);
                    let out = ``;
                    data.forEach((row) => {
                        out +=
                            '<option id="' +
                            row.MaHang +
                            '" class="dropdown-item searchHangHoa" value="' +
                            row.MaHang +
                            '">' +
                            row.TenHangHoa +
                            "</option>";
                    });
                    $("select[name='idHangHoa']").html(out);
                },
            });
        }
    });

    $("select[name='idHangHoa']").change(function () {
        var ids = $(this).find(":selected")[0].id;

        $.ajax({
            type: "GET",
            url: "fetchHangHoaHien/{id}",
            data: {
                id: ids,
            },
            dataType: "json",
            success: function (data) {
                data.forEach((resp) => {
                    $("input[name='HangHoa']").val(resp.TenHangHoa);
                    $("#dongia").text(resp.DonGia);
                    var tamTinh =
                        resp.DonGia * $("input[name='SoLuong']").val();
                    if (!isNaN(tamTinh)) {
                        $("#tong").text(
                            tamTinh.toLocaleString("fi-FI") + " VNĐ"
                        );
                    }
                });
            },
        });
    });

    function hienGia(idBanDauHangHoa) {
        var ids = idBanDauHangHoa;
        $.ajax({
            type: "GET",
            url: "fetchHangHoaHien/{id}",
            data: {
                id: ids,
            },
            dataType: "json",
            success: function (data) {
                data.forEach((resp) => {
                    $("#dongia").text(resp.DonGia);
                    var tamTinh =
                        resp.DonGia * $("input[name='SoLuong']").val();
                    if (!isNaN(tamTinh)) {
                        $("#tong").text(
                            tamTinh.toLocaleString("fi-FI") + " VNĐ"
                        );
                    }
                });
            },
        });
    }

    $("input[name='SoLuong']").change(function () {
        let tong = 0;
        let soLuong = $(this).val();
        let donGia = parseInt($("#dongia").text(), this);
        tong = donGia * soLuong;
        if (!isNaN(tong)) {
            $("#tong").text(tong.toLocaleString("fi-FI") + " VNĐ");
        }
    });

    //-------------Add
    var tong = 0;
    $("#add").on("click", function () {
        var MaHang = $('select[name="idHangHoa"]').val();
        var qty = $("#SoLuong").val();
        $.ajaxSetup({
            header: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: "fetchHangHoaTable",
            method: "GET",
            data: {
                MaHang: MaHang,
            },

            success: function (data) {
                var total = qty * data.DonGia;
                if (!data.image) {
                    data.image = "default.png";
                }
                let table =
                    "<tr class='hangHoaHoaDon'><input type='hidden' name='hangHoaThem[]' value='" +
                    data.MaHang +
                    "'/><td class='color_beige' id='soThuTu'></td><td >" +
                    data.LoaiHangHoa +
                    "</td><td class='color_beige'>" +
                    data.TenHangHoa +
                    "</td><td>" +
                    data.CongDung +
                    "</td><td class='color_beige'>" +
                    data.DonGia.toLocaleString("fi-FI") +
                    "</td><td><input type='hidden' name='soLuongHangHoaThem[]' class='soLuongHoaDon' value='" +
                    qty +
                    "'>" +
                    qty +
                    "</td><td class='color_beige'>" +
                    data.DonViTinh +
                    "</td><td><strong><input type='hidden' id='total' value='" +
                    total +
                    "'>" +
                    total.toLocaleString("fi-FI") +
                    "</strong></td><td class='color_beige'><button class='remove'><i class='ti-trash font_size13 color_red'></i></button></td></tr>";
                $("#new").append(table);

                tienHangCongNo();
            },
        });
    });

    //hàm tính tiền hàng và công nợ
    function tienHangCongNo() {
        var countSoLuong = 0;
        var tamTinh = 0;
        var count = 0;
        $("tbody tr td").each(function () {
            var value = parseInt($("input[id='total']", this).val());
            var soLuongHoaDon = parseInt(
                $("input[class='soLuongHoaDon']", this).val()
            );
            if (!isNaN(value)) {
                tamTinh += value;
            }
            if (!isNaN(soLuongHoaDon)) {
                countSoLuong += soLuongHoaDon;
            }
        });
        $("tbody tr").each(function () {
            count++;
            $("#soThuTu", this).text(count);
        });
        tong = tamTinh;
        $("#totalPayment").text(tong.toLocaleString("fi-FI") + " VNĐ");
        $("#TongTien").text(tong.toLocaleString("fi-FI") + " VNĐ");
        $("#TongSoLuong").text(countSoLuong);
        let chietKhau = (tong * $("input[name='ChietKhau']").val()) / 100;
        tongTruChieKhau = tong - chietKhau;

        var out =
            `<input type="hidden" value="` +
            tongTruChieKhau +
            `">Tổng cộng: <strong>` +
            tongTruChieKhau.toLocaleString("fi-FI") +
            " VNĐ" +
            `</strong>`;
        $(".tongCong1").html(out);

        var out2 =
            `<input type="hidden" id="NoMoiLay" name="NoMoi" value="` +
            tongTruChieKhau +
            `">Nợ mới: <strong>` +
            tongTruChieKhau.toLocaleString("fi-FI") +
            " VNĐ" +
            `</strong>`;
        $(".tongCong2").html(out2);

        NoMoiLay = parseInt($("#NoMoiLay").val());
        NoCuLay = parseInt($("#NoCuLay").val());
        $(".tongCongNo").text(
            (NoCuLay + NoMoiLay).toLocaleString("fi-FI") + " VNĐ"
        );

        // var query = $("#searchHangHoa").val();
        // if (query != "") {
        //     $(".tongCongNo").text(
        //         (tongTruChieKhau + noCu).toLocaleString("fi-FI") + " VNĐ"
        //     );
        // }
    }

    $("body").on("click", ".remove", function (e) {
        $(this).parents(".hangHoaHoaDon").remove();
        tienHangCongNo();
    });

    $("input[name='ChietKhau']").change(function () {
        let chietKhau = (tong * $(this).val()) / 100;
        tongTruChieKhau = tong - chietKhau;
        var out =
            `<input type="hidden" value="` +
            tongTruChieKhau +
            `">Tổng cộng: <strong>` +
            tongTruChieKhau.toLocaleString("fi-FI") +
            " VNĐ" +
            `</strong>`;
        $(".tongCong1").html(out);
        var out2 =
            `<input type="hidden" id="NoMoiLay" name="NoMoi" value="` +
            tongTruChieKhau +
            `">Nợ mới: <strong>` +
            tongTruChieKhau.toLocaleString("fi-FI") +
            " VNĐ" +
            `</strong>`;
        $(".tongCong2").html(out2);

        NoCuLay = parseInt($("#NoCuLay").val());
        NoMoiLay = parseInt($("#NoMoiLay").val());
        $(".tongCongNo").text(
            (NoCuLay + NoMoiLay).toLocaleString("fi-FI") + " VNĐ"
        );
    });
});

$("#my_table").DataTable();

// {{-- <script>
//     $("input.money").each((i,ele)=>{
//         let clone=$(ele).clone(false)
//         clone.attr("type","text")
//         let ele1=$(ele)
//         clone.val(Number(ele1.val()).toLocaleString("en"))
//         $(ele).after(clone)
//         $(ele).hide()
//         clone.mouseenter(()=>{

//         ele1.show()
//         clone.hide()
//         })
//         setInterval(()=>{
//         let newv=Number(ele1.val()).toLocaleString("en")
//         if(clone.val()!=newv){
//             clone.val(newv)
//         }
//         },10)

//         $(ele).mouseleave(()=>{
//         $(clone).show()
//         $(ele1).hide()
//         })

//     })
// </script> --}}

//---------------Alert------------
// Alert Modal Type
$("#success").html(function (e) {
    var thanhCong = $(this).val();
    swal("Thành công!", thanhCong, "success");
});

$("#error").html(function (e) {
    var loi = $(this).val();
    swal("Lỗi!", loi, "error");
});

$(document).on("click", "#warning", function (e) {
    swal(
        "Warning!",
        'You clicked the <b style="color:coral;">warning</b> button!',
        "warning"
    );
});

$(document).on("click", "#info", function (e) {
    swal(
        "Info!",
        'You clicked the <b style="color:cornflowerblue;">info</b> button!',
        "info"
    );
});

$(document).on("click", "#question", function (e) {
    swal(
        "Question!",
        'You clicked the <b style="color:grey;">question</b> button!',
        "question"
    );
});


function show_message(message, status = 'success', title = '') {
    var text_html = '';
    if (message) {
        if(Array.isArray(message)){
            for(var i = 0; i < message.length; i++){
                text_html += '<p>'+ message[i] +'</p>';
            };
        }else{
            text_html = message;
        }

        Swal.fire({
            title: title,
            text: text_html,
            icon: status,
            /*'timer': 1500,*/
        });
    }
}
$('body').on('submit', '.form-ajax', function(event) {
    if (event.isDefaultPrevented()) {
        return false;
    }

    event.preventDefault();
    var form = $(this).closest('form');
    var formData = new FormData(form[0]);
    var btnsubmit = form.find("button:focus");
    var oldText = btnsubmit.text();
    var currentIcon = btnsubmit.find('i').attr('class');
    var submitSuccess = form.data('success');
    var exists = btnsubmit.find('i').length;
    if (exists>0)
        btnsubmit.find('i').attr('class', 'fa fa-spinner fa-spin');
    else
        btnsubmit.html('<i class="fa fa-spinner fa-spin"></i> '+oldText);

    btnsubmit.prop("disabled", true);
    $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        dataType: 'json',
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    }).done(function(data) {
        if (data.status === 'error'){
            Swal.fire({
                icon: data.status,
                text: data.message,
                focusConfirm: false,
                confirmButtonText: "OK",
            }).then((result) => {
                if (result.value) {
                    if (data.redirect) {
                        window.location = data.redirect
                    }
                    return false;
                }
            });
        }else{
            show_message(
                data.message,
                data.status
            );

            if (data.redirect) {
                setTimeout(function () {
                    window.location = data.redirect;
                }, 1000);
                return false;
            }
        }

        if (exists>0)
            btnsubmit.find('i').attr('class', currentIcon);
        else
            btnsubmit.html(oldText);
        btnsubmit.prop("disabled", false);

        if (data.status === "error") {
            return false;
        }

        if (submitSuccess) {
            eval(submitSuccess)(form);
        }

        return false;
    }).fail(function(data) {
        if (exists>0)
            btnsubmit.find('i').attr('class', currentIcon);
        else
            btnsubmit.html(oldText);
        btnsubmit.prop("disabled", false);

        show_message('Lỗi dữ liệu', 'error');
        return false;
    });
});

$('.select2').select2();
