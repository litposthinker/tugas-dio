var barang = [
    ["Nasi Goreng", "Rp 5.000", "https://img-global.cpcdn.com/recipes/8979ffdea7759481/400x400cq70/photo.jpg"],
    ["Mie Instan", "Rp 5.000", "https://upload.wikimedia.org/wikipedia/commons/7/7f/Korea_Ramyeon.jpg"],
    ["Es Cincau", "Rp 8.000", "https://www.resepkuerenyah.com/wp-content/uploads/2016/01/es_cincau_hijau_700.jpg"],
    ["Nasi Kuning", "Rp 5.000", "https://ecs7.tokopedia.net/img/cache/700/product-1/2019/10/6/494062/494062_dd40d962-0b4e-4132-baf6-8727627f414a_1358_1358.jpg"],
    ["Ramen", "Rp 10.000", "https://upload.wikimedia.org/wikipedia/commons/f/fc/Soy_ramen.jpg"],
    ["Tamagoyaki", "Rp 8.000", "https://img-global.cpcdn.com/recipes/72e064886d1d570c/1200x630cq70/photo.jpg"],
    ["Chiken Katsu", "Rp 12.000", "https://cdn.yummy.co.id/content-images/images/20200115/UxI3zfZJmFGB29jlA7pBT0cxcNEdFuhW-31353739303638363838d41d8cd98f00b204e9800998ecf8427e_800x800.jpg"],
    ["Ebi Furai", "Rp 16.000", "https://img-global.cpcdn.com/recipes/c60cbbb2086da76d/751x532cq70/ebi-furai-salad-mayonaise-ala-ala-hokben-foto-resep-utama.jpg"],
    ["Takoyaki", "Rp 12.000", "https://upload.wikimedia.org/wikipedia/commons/c/cb/Takoyaki.jpg"],
    ["Manju", "Rp 7.000", "https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Carinto_manjyu.JPG/1200px-Carinto_manjyu.JPG"],
    ["Daifuku", "Rp 8.000", "https://upload.wikimedia.org/wikipedia/commons/a/a5/Daifuku_1.jpg"],
    ["Dorayaki", "Rp 6.000", "https://blog.tokowahab.com/wp-content/uploads/2019/11/Resep-Kue-Dorayaki-Isi-Cokelat.jpg"]
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

function reSearch(strSearch) {
    barang.forEach(function (item, i) {
        let titlelower = item[0].toLowerCase()
        if (strSearch.toLowerCase() == titlelower.slice(0, strSearch.length)) {
            $('#' + i).show();
        } else if (strSearch) {
            $('#' + i).hide();
        } else {
            $('#' + i).show();
        }
    })
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

function tampilBayar(idBayar, countBayar) {
    var tampil = document.getElementById("table-bayar");
    tampil.innerHTML = "";
    var filtered = idBayar.reduce(function (a, b) {
        if (a.indexOf(b) < 0) a.push(b);
        return a;
    }, []);

    for (i = 0; i < filtered.length; i++) {
        var hargaakhir = Number(countBayar[filtered[i]]) * Number(barang[filtered[i]][1].replace(/\R\S+/g, '').replace(/\./g, ""));
        no = i + 1
        tampil.innerHTML += '<tr>' +
            '<td>' + no + '</td>' +
            '<td>' + barang[filtered[i]][0] + '</td>' +
            '<td>' + barang[filtered[i]][1] + '</td>' +
            '<td>' + countBayar[filtered[i]] + '</td>' +
            '<td>Rp ' + giveRupiah(hargaakhir) + '</td>' +
            '</tr>'
    }
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
        var hargaakhir = Number(count[filtered[i]]) * Number(barang[filtered[i]][1].replace(/\R\S+/g, '').replace(/\./g, ""));
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
    var discount = hargatotal * 0.05;

    var hasilnya = hargatotal + tax;
    if (hargatotal > 10000) {
        $("#discount").html("Rp " + giveRupiah(discount));
        hasilnya = hasilnya - discount;
    } else {
        $("#discount").html("Rp  0");
    }

    $('#total').html('Rp ' + giveRupiah(hargatotal));
    $('#tax').html('Rp ' + giveRupiah(tax));
    $('#totalamount').html('Rp ' + giveRupiah(hasilnya));
    if (hargatotal > 0) {
        $('#bayar').prop('disabled', false)
        $('#bayar span').html(filtered.length)
    } else {
        $('#bayar').prop('disabled', true)
        $('#bayar span').html('')
    }
    // hargatotal > 0 ? $('#bayar').prop('disabled', false) : $('#bayar').prop('disabled', true);
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
    var idBayar = idbarang;
    var countBayar = count;
    idbarang = [];
    hitungBarang();
    tampilBayar(idBayar, countBayar);
    setTimeout(function () {
        $('#modalanimate').hide();
        $('#modalsucces').show();
    }, 3000);
});

setInterval(function () {
    var now = new Date();
    var mins = ('0' + now.getMinutes()).slice(-2);
    var hr = now.getHours() % 12 || 12;
    var Time = hr + " : " + mins;
    Time += now.getHours() >= 12 ? " PM" : " AM"
    $(".jam").html(Time);
}, 1000);