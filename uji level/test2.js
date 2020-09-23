var barang = [
    ["Nasi Goreng", "Rp 5.000", "Makanan", "https://img-global.cpcdn.com/recipes/8979ffdea7759481/400x400cq70/photo.jpg"],
    ["Mie Instan", "Rp 5.000", "Makanan", "https://upload.wikimedia.org/wikipedia/commons/7/7f/Korea_Ramyeon.jpg"],
    ["Es Cincau", "Rp 8.000", "Minuman", "https://www.resepkuerenyah.com/wp-content/uploads/2016/01/es_cincau_hijau_700.jpg"],
    ["Nasi Kuning", "Rp 5.000", "Makanan", "https://ecs7.tokopedia.net/img/cache/700/product-1/2019/10/6/494062/494062_dd40d962-0b4e-4132-baf6-8727627f414a_1358_1358.jpg"],
    ["Nasi Kuning", "Rp 5.000", "Makanan", "https://ecs7.tokopedia.net/img/cache/700/product-1/2019/10/6/494062/494062_dd40d962-0b4e-4132-baf6-8727627f414a_1358_1358.jpg"]
]

var tampil = document.getElementById("main");
for (i = 0; i < barang.length; i++) {
    tampil.innerHTML += '<div class="card rounded mb-2 ml-3 mr-1 mt-2 drag" id="' + i + '" onclick="tambahBarang(this.id)">' +
        '<img class="card-img-top" src="' + barang[i][3] + '">' +
        '<div class="card-body text-center">' +
        '<p class="card-title text-truncate">' + barang[i][0] + '</p>' +
        '<p class="card-text">' + barang[i][1] + '</p>' +
        '</div>' +
        '</div>'
}
var idbarang = []
var count = {};

function hitungBarang() {
    var counting = {};
    idbarang.forEach(function (i) {
        counting[i] = (counting[i] || 0) + 1;
    });
    for (var key in counting) {
        var obj = counting[key];
        count[key] = obj;
        delete counting[key];
    }
    tampilBarang()
}

function tampilBarang() {
    var Basket = document.querySelector('.keranjang');
    var scrollBasket = document.querySelector('#keranjang');
    if ((scrollBasket.offsetHeight + 24) > Basket.offsetHeight) {
        Basket.style.overflowY = "scroll"
    } else {
        Basket.style.overflowY = ""
    }
    var tampil = document.getElementById("keranjang");
    tampil.innerHTML = ""

    var filtered = idbarang.reduce(function (a, b) {
        if (a.indexOf(b) < 0) a.push(b);
        return a;
    }, []);
    console.log(filtered)
    console.log(count)
    console.log(idbarang)

    for (i = 0; i < filtered.length; i++) {
        if (Number(count[filtered[i]]) >= 100) {
            count[filtered[i]] = "99";
        }
        harga = barang[filtered[i]][1].split(" ")
        harga = harga[1]
        harga = harga.split(".")
        harga = harga.join("")
        hargaakhir = Number(count[filtered[i]]) * Number(harga)
        var number_string = hargaakhir.toString()
        var sisa = number_string.length % 3
        var rupiah = number_string.substr(0, sisa)
        var ribuan = number_string.substr(sisa).match(/\d{3}/g)

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        tampil.innerHTML += '<div class="w-100 border mt-1">' +
            '<div class="row mt-1">' +
            '<div class="col">' + barang[filtered[i]][0] + '</div>' +
            '<div class="col-4"> Rp ' + rupiah + '</div>' +
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
}
// 
function ubahNilai(value, val) {
    value = value.toString()
    val = Number(val)
    if (val >= 1) {
        var i = 0
        while (i < idbarang.length) {
            if (idbarang[i] === value) {
                idbarang.splice(i, 1);
            } else {
                ++i;
            }
        }
        for (let i = 0; i < val; i++) {
            idbarang.push(value)
        }
        count[value] = val
        $(document).keydown(function (objEvent) {
            if (objEvent.keyCode == 13) {
                tampilBarang()
            }
        });
    } else if (val === 0) {
        var i = 0
        while (i < idbarang.length - 1) {
            if (idbarang[i] === value) {
                idbarang.splice(i, 1);
            } else {
                ++i;
            }
        }
        delete count[value]
        $(document).keydown(function (objEvent) {
            if (objEvent.keyCode == 13) {
                hitungBarang()
            }
        });
    }
}

function tambahBarang(id) {
    idbarang.push(id);
    hitungBarang()
}

function barangBertambah(val) {
    if (Number(count[val]) < 99) {
        idbarang.push(val.toString());
        count[val] = count[val] + 1
    }
    tampilBarang()
}

function barangBerkurang(val) {
    if (Number(count[val]) > 1) {
        while (i < idbarang.length) {
            if (idbarang[i] === val.toString()) {
                idbarang.splice(i, 1);
                break;
            } else {
                ++i;
            }
        }
        count[val] = count[val] - 1
    }
    tampilBarang()
}

function deleteBasket(val) {
    var i = 0
    while (i < idbarang.length) {
        if (idbarang[i] === val.toString()) {
            idbarang.splice(i, 1);
        } else {
            ++i;
        }
    }
    delete count[val]
    tampilBarang()
}

var scrollContent = document.querySelector('.main');
if (scrollContent.offsetHeight < scrollContent.scrollHeight) {
    scrollContent.style.overflowY = "scroll"
} else {
    Basket.style.overflowY = ""
}

$('.drag').draggable({
    handle: '.card-img-top',
    revert: true,
    scroll: false,
    zIndex: 10,
    appendTo: 'body',
    helper: 'clone',
    cursor: 'grabbing'
});
$('.keranjang').droppable({
    tolerance: "pointer",
    drop: function (event, ui) {
        idbarang.push(ui.draggable[0].id);
        hitungBarang();
        $(ui.helper).remove();
        $(this).css("border", "");
        $(this).addClass("border");
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

$(function () {
    $(document).keydown(function (objEvent) {
        if (objEvent.ctrlKey) {
            if (objEvent.keyCode == 73 || (objEvent.shiftKey && objEvent.keyCode == 74)) {
                return false;
            }
        }
    });
});
document.addEventListener('contextmenu', event => event.preventDefault());