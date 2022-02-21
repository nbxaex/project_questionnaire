/* For Check Confirm Password */
$('#userpassword, #userpassword2').on('keyup', function () {
    if ($('#userpassword2').val() != '') {
        if ($('#userpassword').val() == $('#userpassword2').val()) {
            $('#message').html('รหัสผ่านตรงกัน').css('color', 'green');
        } else
            $('#message').html('รหัสผ่านไม่ตรงกัน').css('color', 'red');
    }
});

/* For Check Strong Password */
$(document).ready(function () {
    $('#userpassword').keyup(function () {
        $('#result').html(checkStrength($('#userpassword').val()))
    })

    function checkStrength(password) {
        var strength = 0
        if (password.length < 6) {
            $('#result').removeClass()
            $('#result').addClass('short alert-danger')
            return 'รหัสผ่านสั้นไป'
        }
        if (password.length > 7) strength += 1
        // If password contains both lower and uppercase characters, increase strength value.
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
        // If it has numbers and characters, increase strength value.
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
        // If it has one special character, increase strength value.
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
        // If it has two special characters, increase strength value.
        if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
        // Calculated strength value, we can return messages
        // If value is less than 2
        if (strength < 2) {
            $('#result').removeClass()
            $('#result').addClass('weak alert-warning')
            return 'รหัสผ่านเดาง่าย'
        } else if (strength == 2) {
            $('#result').removeClass()
            $('#result').addClass('good alert-info')
            return 'รหัสผ่านเดายาก'
        } else {
            $('#result').removeClass()
            $('#result').addClass('strong alert-success')
            return 'รหัสผ่านสมบูรณ์แบบ'
        }
    }
});

/* Confirm Delete Button */
$('.confirm-delete').on('show.bs.modal', function (e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    //$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr("href") + '</strong>');
    $('.debug-url').html('ยืนยันลบ <strong>' + $(document.activeElement).data('value') + '</strong>');

});

/* Confirm Note Button */
$('.confirm-note').on('show.bs.modal', function (e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    //$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr("href") + '</strong>');
    $('.debug-url').html('<strong>' + $(document.activeElement).data('value') + '</strong>');

});

/*  For Select Form */
$(document).ready(function () {
    $('.js-example-basic-single').select2();
});

/* For Select Multiple */
$(document).ready(function () {
    $('.js-example-basic-multiple').select2();
});

/* Before Upload */
$(".file-3").fileinput({
    'theme': 'explorer-fas',
    language: 'th',
    showUpload: false,
    overwriteInitial: false,
    initialPreviewAsData: true,
});

/* SummerNote */
$(document).ready(function () {
    $('.summernote').summernote({
        height: 500,
        lang: 'th-TH'
    });
});

/* Date picker */
$(document).ready(function () {
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: "linked",
        language: 'th',
        autoclose: true, //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
        thaiyear: true //Set เป็นปี พ.ศ.
    }).datepicker("setDate", "0"); //กำหนดเป็นวันปัจุบัน
});

/* Random Token */
function makeid(length) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    $("#invite_name").val(result);
}

/* Copy Link */
function CopyToClipboard(containerid, afterid) {
    // Create a new textarea element and give it id='temp_element'
    var textarea = document.createElement('textarea')
    textarea.id = 'temp_element'
    // Optional step to make less noise on the page, if any!
    textarea.style.height = 0
    // Now append it to your page somewhere, I chose <body>
    document.body.appendChild(textarea)
    // Give our textarea a value of whatever inside the div of id=containerid
    textarea.value = document.getElementById(containerid).innerText
    // Now copy whatever inside the textarea to clipboard
    var selector = document.querySelector('#temp_element')
    selector.select()
    document.execCommand('copy')
    // Remove the textarea
    document.body.removeChild(textarea)
    //alert("Text has been copied, now paste in the text-area")
    var show = '#' + afterid;
    $(show).show();
    setTimeout(function () {
        $(show).hide();
    }, 1500);
}

// test

function membernote(x) {
    if (x == "") {
        var note = "ไม่ระบุ";
    } else {
        var note = x;
    }
    Swal.fire({
        title: '<strong>หมายเหตุ</strong>',
        icon: 'warning',
        html: note,
        confirmButtonText: 'ตกลง',
    })
}

function banknote(x) {
    if (x == "") {
        var note = "ไม่ระบุ";
    } else {
        var note = x;
    }
    /*swal({
        title: "หมายเหตุ",
        text: note,
        icon: "warning",
        button: "ตกลง",
    });*/
    Swal.fire({
        title: '<strong>หมายเหตุ</strong>',
        icon: 'info',
        html: "<p align='justify'>" + note + "</p>",
        confirmButtonText: 'ตกลง',
    })
}

function cdelte(val1, link1) {
    Swal.fire({
        title: 'คุณต้องการลบข้อมูลใช่หรือไม่?',
        text: "ยืนยันการลบ " + val1,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ยืนยันลบ',
        cancelButtonText: 'ยกเลิก',
    }).then((result) => {
        if (result.isConfirmed) {
            location.href = link1;
        }
    })
}
$('#accordionSidebar').addClass(localStorage.getItem("show1"));
$('#page-top').addClass(localStorage.getItem("show2"));
$('#sidebarToggle, #sidebarToggleTop').click(
    function () {
        if (localStorage.getItem("show1") != 'toggled') {
            $('#accordionSidebar').addClass('toggled');
            $('#page-top').addClass('sidebar-toggled');
            localStorage.setItem("show1", "toggled");
            localStorage.setItem("show2", "sidebar-toggled");
        } else {
            $('#accordionSidebar').removeClass('toggled');
            $('#page-top').removeClass('sidebar-toggled');
            localStorage.setItem("show1", "");
            localStorage.setItem("show2", "");
        }
    });

// tooltip
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

/*  Data Table Deposit_branch Ajax */
$(document).ready(function () {
    var datatableAjax = $('#score-grid').dataTable({
        "processing": true,
        "serverSide": true,
        "order": [
            [0, "ASC"]
        ],
        "ajax": {
            "url": "admin_score/score_ajax.php",
            "type": "POST"
        },
        // Thai lang
        "oLanguage": {
            "sEmptyTable": "ไม่มีข้อมูลในตาราง",
            "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
            "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
            "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "แสดง _MENU_ แถว",
            "sLoadingRecords": "กำลังโหลดข้อมูล...",
            "sProcessing": "กำลังดำเนินการ...",
            "sSearch": "ค้นหา: ",
            "sZeroRecords": "ไม่พบข้อมูล",
            "oPaginate": {
                "sFirst": "หน้าแรก",
                "sPrevious": "ก่อนหน้า",
                "sNext": "ถัดไป",
                "sLast": "หน้าสุดท้าย"
            },
            "oAria": {
                "sSortAscending": ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
                "sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
            }
        }
    });
});

/*  Data Table Deposit_branch Ajax */
$(document).ready(function () {
    var datatableAjax = $('#vote-grid').dataTable({
        "processing": true,
        "serverSide": true,
        "order": [
            [0, "ASC"]
        ],
        "ajax": {
            "url": "admin_vote/vote_ajax.php",
            "type": "POST"
        },
        // Thai lang
        "oLanguage": {
            "sEmptyTable": "ไม่มีข้อมูลในตาราง",
            "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
            "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
            "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "แสดง _MENU_ แถว",
            "sLoadingRecords": "กำลังโหลดข้อมูล...",
            "sProcessing": "กำลังดำเนินการ...",
            "sSearch": "ค้นหา: ",
            "sZeroRecords": "ไม่พบข้อมูล",
            "oPaginate": {
                "sFirst": "หน้าแรก",
                "sPrevious": "ก่อนหน้า",
                "sNext": "ถัดไป",
                "sLast": "หน้าสุดท้าย"
            },
            "oAria": {
                "sSortAscending": ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
                "sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
            }
        }
    });
});

/*  Data Table Deposit_branch Ajax */
$(document).ready(function () {
    var datatableAjax = $('#voter-grid').dataTable({
        "processing": true,
        "serverSide": true,
        "order": [
            [0, "ASC"]
        ],
        "ajax": {
            "url": "admin_voter/voter_ajax.php",
            "type": "POST"
        },
        // Thai lang
        "oLanguage": {
            "sEmptyTable": "ไม่มีข้อมูลในตาราง",
            "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
            "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
            "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "แสดง _MENU_ แถว",
            "sLoadingRecords": "กำลังโหลดข้อมูล...",
            "sProcessing": "กำลังดำเนินการ...",
            "sSearch": "ค้นหา: ",
            "sZeroRecords": "ไม่พบข้อมูล",
            "oPaginate": {
                "sFirst": "หน้าแรก",
                "sPrevious": "ก่อนหน้า",
                "sNext": "ถัดไป",
                "sLast": "หน้าสุดท้าย"
            },
            "oAria": {
                "sSortAscending": ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
                "sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
            }
        }
    });
});