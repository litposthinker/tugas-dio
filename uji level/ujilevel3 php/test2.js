function reSearch(strSearch) {
    $.ajax({
        url: 'searchdata.php?search=' + strSearch,
        success: function (data) {
            $('#main').html(data);
        }
    });
}

const resizeMain = new ResizeObserver(entries => {
    var scrollContent = document.querySelector('.main');
    if (entries[0].target.clientHeight > scrollContent.offsetHeight) {
        scrollContent.style.overflowY = "scroll";
    } else {
        scrollContent.style.overflowY = "";
    }
})
resizeMain.observe(document.querySelector('#main'));

const resizeKeranjang = new ResizeObserver(entries => {
    var Basket = document.querySelector('.keranjang');
    if (entries[0].target.clientHeight > Basket.offsetHeight) {
        Basket.style.overflowY = "scroll"
    } else {
        Basket.style.overflowY = ""
    }
})
resizeKeranjang.observe(document.querySelector('#keranjang'));


function confirmPembayaran(){
    Swal.fire({
        title: 'BERHASIL',
        text: 'barang berhasil dibeli!',
        icon: 'success',
        allowOutsideClick: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = "tambahkeranjang.php";
        }
    })
}

function ubahNilai(id, val) {
    $.get('ubahnilai.php?session=' + id + '&value=' + val);
    location.reload();
}

function tambahBarang(id) {
    $.ajax({
        url: 'setsession.php?session=' + id,
        type: 'get',
        dataType: 'json',
        async: false,
        success: (data) => {
            if (data == 'kelebihan') {
                Swal.fire({
                    title: 'stock out of range',
                    icon: 'warning',
                })
            } else if (data == 'ditambah') {
                location.reload();
            }
        }
    });
}

function barangBerkurang(id) {
    $.get('minsession.php?session=' + id);
    location.reload();
}

function deleteBasket(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover this product!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, keep it'
    }).then((result) => {
        if (result.value) {
            Swal.fire({
                title: 'Deleted!',
                text: 'Your imaginary product has been deleted.',
                icon: 'success',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.get('unsetsession.php?session=' + id);
                    location.reload();
                }
            })

        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire(
                'Cancelled',
                'Your imaginary product is safe :)',
                'error'
            )
        }
    })
}

$('.drag').draggable({
    handle: '.card-img-top',
    revert: true,
    scroll: false,
    zIndex: 10,
    helper: 'clone',
    cursor: 'grabbing'
});

$('.keranjang').droppable({
    cursor: 'pointer',
    tolerance: "pointer",
    drop: function (event, ui) {
        $(ui.helper).remove();
        $(this).css("border", "");
        $(this).addClass("border");
        tambahBarang(ui.draggable[0].id);
    },
    over: function () {
        $(this).removeClass("border");
        $(this).css("border", "2px dashed rgb(72, 160, 255)");
    },
    out: function () {
        $(this).css("border", "");
        $(this).addClass("border");
    },
});

$('#animatedberhasil').on('show.bs.modal', function (e) {
    setTimeout(() => {
        $('#modalanimate').hide();
        $('#modalsucces').show();
    }, 3000);
});

setInterval(() => {
    var now = new Date();
    var mins = ('0' + now.getMinutes()).slice(-2);
    var hr = now.getHours() % 12 || 12;
    var Time = hr + " : " + mins;
    Time += now.getHours() >= 12 ? " PM" : " AM"
    $(".jam").html(Time);
}, 100);