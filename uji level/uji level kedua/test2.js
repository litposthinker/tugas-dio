var barang = [
    ["Nasi Goreng", "Rp 5.000", "https://img-global.cpcdn.com/recipes/8979ffdea7759481/400x400cq70/photo.jpg"],
    ["Mie Instan", "Rp 5.000", "https://upload.wikimedia.org/wikipedia/commons/7/7f/Korea_Ramyeon.jpg"],
    ["Es Cincau", "Rp 8.000", "https://www.resepkuerenyah.com/wp-content/uploads/2016/01/es_cincau_hijau_700.jpg"],
    ["Nasi Kuning", "Rp 5.000", "https://ecs7.tokopedia.net/img/cache/700/product-1/2019/10/6/494062/494062_dd40d962-0b4e-4132-baf6-8727627f414a_1358_1358.jpg"],
    ["Nasi Kuning", "Rp 5.000", "https://ecs7.tokopedia.net/img/cache/700/product-1/2019/10/6/494062/494062_dd40d962-0b4e-4132-baf6-8727627f414a_1358_1358.jpg"]
]

for (i = 0; i < barang.length; i++) {
    document.getElementById("main").innerHTML += '<div class="card rounded mb-2 ml-3 mr-1 mt-2 drag" id="' + i + '" onclick="tambahBarang(this.id)">' +
        '<img class="card-img-top" src="' + barang[i][2] + '">' +
        '<div class="card-body text-center">' +
        '<p class="card-title text-truncate">' + barang[i][0] + '</p>' +
        '<p class="card-text">' + barang[i][1] + '</p>' +
        '</div>' +
        '</div>'
}

var scrollContent = document.querySelector('.main');
if (scrollContent.offsetHeight < scrollContent.scrollHeight) {
    scrollContent.style.overflowY = "scroll";
} else {
    Basket.style.overflowY = "";
}

const resizeObserver = new ResizeObserver(entries => {
    var Basket = document.querySelector('.keranjang');
    if (entries[0].target.clientHeight > Basket.offsetHeight) {
        Basket.style.overflowY = "scroll"
    } else {
        Basket.style.overflowY = ""
    }
})
resizeObserver.observe(document.querySelector('#keranjang'));

var idbarang = [];
var count = {};

function hitungBarang() {
    var counting = {};
    idbarang.forEach(function (i) {
        counting[i] = (counting[i] || 0) + 1;
    });

    for (var key in counting) {
        count[key] = counting[key];
        delete counting[key];
    }
    tampilBarang();
}

function giveRupiah(number) {
    number = number.toString();
    var sisa = number.length % 3;
    var rupiah = number.substr(0, sisa);
    var ribuan = number.substr(sisa).match(/\d{3}/g);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    return rupiah;
}

function tampilBarang() {
    var tampil = document.getElementById("keranjang");
    tampil.innerHTML = "";

    var filtered = idbarang.reduce(function (a, b) {
        if (a.indexOf(b) < 0) a.push(b);
        return a;
    }, []);

    var hargatotal = [];
    for (i = 0; i < filtered.length; i++) {
        var hargaakhir = Number(count[filtered[i]]) * Number(barang[filtered[i]][1].replace(/\R\S+/g, '').replace(".", ""));
        hargatotal.push(hargaakhir);

        tampil.innerHTML += '<div class="w-100 border mt-1">' +
            '<div class="row mt-1">' +
            '<div class="col">' + barang[filtered[i]][0] + '</div>' +
            '<div class="col-4"> Rp ' + giveRupiah(hargaakhir) + '</div>' +
            '</div>' +
            '<div class="row">' +
            '<div class="col">' +
            '<div class="row">' +
            '<div class="col-4 mt-1">' +
            '<div>Unit Price:</div>' +
            '</div>' +
            '<div class="col-8">' +
            '<span>' + barang[filtered[i]][1] + '</span>' +
            '</div>' +
            '</div>' +
            '<div class="row">' +
            '<div class="col-4 mt-1">' +
            '<div>Quantity:</div>' +
            '</div>' +
            '<div class="col-8">' +
            '<div class="input-group mb-2">' +
            '<div class="input-group-prepend">' +
            '<button class="btn input-group-text" onclick="barangBerkurang(' + filtered[i] + ')"><i class="fas fa-minus"></i></button>' +
            '</div>' +
            '<div class="inputan">' +
            '<input type="text" class="form-control text-center shadow-none" value="' + count[filtered[i]] + '" autocomplete="off" maxlength="2" oninput="ubahNilai(' + filtered[i] + ',this.value)">' +
            '</div>' +
            '<div class="input-group-append">' +
            '<button class="btn input-group-text" onclick="barangBertambah(' + filtered[i] + ')">' +
            '<i class="fas fa-plus"></i>' +
            '</button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="col-3 ">' +
            '<button class="btn shadow-none" onclick="deleteBasket(' + filtered[i] + ')">' +
            '<i class="far fa-trash-alt fa-2x"></i>' +
            '</button>' +
            '</div>' +
            '</div>' +
            '</div>'
    }
    hargatotal = hargatotal.reduce((a, b) => a + b, 0);
    var tax = hargatotal * 0.10;
    var discount = hargatotal * 0.02;

    var hasilnya = hargatotal + tax;

    if (hargatotal > 10000) {
        $("#discount").html("Rp " + giveRupiah(discount));
        hasilnya = hargatotal + tax - discount;
    } else {
        $("#discount").html("Rp  0");
    }

    $('#total').html('Rp ' + giveRupiah(hargatotal));
    $('#tax').html('Rp ' + giveRupiah(tax));
    $('#totalamount').html('Rp ' + giveRupiah(hasilnya));

    hargatotal > 0 ? $('#bayar').prop('disabled', false) : $('#bayar').prop('disabled', true);
}

function ubahNilai(id, val) {
    id = id.toString();
    val = Number(val);

    var awal = [];
    var i = 0;
    while (i < idbarang.length) {
        if (idbarang[i] === id) {
            awal.push(idbarang[i])
            if (awal.length > 1) {
                idbarang.splice(i, 1);
            } else {
                ++i;
            }
        } else {
            ++i;
        }
    }

    if (val >= 1) {
        for (let i = 0; i < val - 1; i++) {
            idbarang.push(id);
        }
    } else {
        delete count[id];
    }

    $(document).keydown(function (objEvent) {
        if (objEvent.keyCode == 13) {
            hitungBarang();
        }
    });
}

function tambahBarang(id) {
    idbarang.push(id);
    hitungBarang();
}

function barangBertambah(val) {
    if (count[val] < 99) {
        idbarang.push(val.toString());
    }
    hitungBarang();
}

function barangBerkurang(val) {
    if (count[val] > 1) {
        var awal = [];
        var i = 0;
        while (i < idbarang.length) {
            if (idbarang[i] === val.toString()) {
                awal.push(idbarang[i]);
                if (awal.length > 1) {
                    idbarang.splice(i, 1);
                    break;
                } else {
                    ++i;
                }
            } else {
                ++i;
            }
        }
    }
    hitungBarang();
}

function deleteBasket(val) {
    var i = 0;
    while (i < idbarang.length) {
        if (idbarang[i] === val.toString()) {
            idbarang.splice(i, 1);
        } else {
            ++i;
        }
    }
    hitungBarang()
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
        idbarang.push(ui.draggable[0].id);
        $(ui.helper).remove();
        $(this).css("border", "");
        $(this).addClass("border");
        hitungBarang();
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
    setTimeout(function () {
        $('#modalanimate').hide();
        $('#modalsucces').show();
    }, 3000);
});

function closePage() {
    $('#modalanimate').show();
    $('#modalsucces').hide();
}

setInterval(function () {
    var now = new Date();
    var mins = ('0' + now.getMinutes()).slice(-2);
    var hr = now.getHours() % 12 || 12;
    var Time = hr + " : " + mins;
    Time += now.getHours() >= 12 ? " PM" : " AM"
    $(".jam").html(Time);
}, 1000);