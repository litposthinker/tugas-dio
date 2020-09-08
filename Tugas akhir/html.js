var hargabarang = ["9450000", "4000000", "691000", "60000", "2500000", "15000000", "8000000", "1899900"]
var barang = [{
    namabarang: "Emas Antam 10 Gram Logam Mulia",
    hargabarang: "Rp9.450.000",
    distributor: "Kilau Agung",
    srcgambar: "https://ecs7.tokopedia.net/img/cache/700/product-1/2020/6/19/74613810/74613810_e31b74e8-182b-4905-8c33-80e277576527_2048_2048.webp",
    berat: "10gr",
    kondisi: "Baru",
    asuransi: "Ya"
}, {
    namabarang: "PG Perfect Strike Gundam Bandai Original Perfect Grade",
    hargabarang: "Rp4.000.000",
    distributor: "Bandai Namco",
    srcgambar: "https://ecs7.tokopedia.net/img/cache/700/product-1/2020/5/12/6562530/6562530_d1763ff0-b63b-43f8-a949-c0441b0954f4_865_865.jpg.webp",
    berat: "900gr",
    kondisi: "Baru",
    asuransi: "Opsional"
}, {
    namabarang: "Headphone Kuping Kucing Wireless - LED Light Color Changing - Neko",
    hargabarang: "Rp691.000",
    distributor: "Yowu",
    srcgambar: "https://ecs7.tokopedia.net/img/cache/700/product-1/2020/7/31/batch-upload/batch-upload_fcc9dba1-089d-484c-926e-18fe56c77824.jpg.webp",
    berat: "750gr",
    kondisi: "Baru",
    asuransi: "Opsional"
}, {
    namabarang: "Topeng Megitsune Kitsune Half Setengah",
    hargabarang: "Rp60.000",
    distributor: "Daiso",
    srcgambar: "https://ecs7.tokopedia.net/img/cache/700/product-1/2019/11/18/4002206/4002206_4ebaaf0b-574e-4833-89c5-6ea3cd5ad90d_800_800.webp",
    berat: "150gr",
    kondisi: "Baru",
    asuransi: "Opsional"
}, {
    namabarang: "Jasa Mentoring dan debbuging kodingan anda",
    hargabarang: "Rp2.500.000",
    distributor: "Dio Selvinus",
    srcgambar: "https://ecs7.tokopedia.net/img/cache/700/product-1/2020/7/4/9016886/9016886_bd74409d-143a-4644-9c86-3ed6f1c0cfd3_576_576.jpg.webp",
    berat: "1gr",
    kondisi: "Baru",
    asuransi: "Opsional"
}, {
    namabarang: "Sony Playstation 5",
    hargabarang: "Rp15.000.000",
    distributor: "Sony",
    srcgambar: "https://ecs7.tokopedia.net/img/cache/700/product-1/2020/6/15/6924567/6924567_6b293614-fe07-4e44-9608-396246012fca_536_536.jpg.webp",
    berat: "5000gr",
    kondisi: "Baru",
    asuransi: "Opsional"
}, {
    namabarang: "Mouse Votre berhadiah laptop Acer Swift 7 i7",
    hargabarang: "Rp8.000.000",
    distributor: "Acer",
    srcgambar: "https://ecs7.tokopedia.net/img/cache/700/VqbcmM/2020/5/9/acd9d179-cd73-4a99-9522-0599ba022506.png.webp",
    berat: "2400gr",
    kondisi: "Baru",
    asuransi: "Opsional"
}, {
    namabarang: "Paket Raspberry Pi 4 8GB / 8 GB Mini PC - Full Set / Kit with Case Fan",
    hargabarang: "Rp1.899.900",
    distributor: "Arduino",
    srcgambar: "https://ecs7.tokopedia.net/img/cache/700/product-1/2020/7/18/15037198/15037198_0564be33-0b6a-492d-832e-fdfe1df3a5d5_1454_1454.webp",
    berat: "500gr",
    kondisi: "Baru",
    asuransi: "Ya"
}, ]
var nama = barang.map(function (barang) {
    return barang.namabarang
});
var harga = barang.map(function (barang) {
    return barang.hargabarang
});
var source = barang.map(function (barang) {
    return barang.srcgambar
});
var distributor = barang.map(function (barang) {
    return barang.distributor
});
var berat = barang.map(function (barang) {
    return barang.berat
});
var kondisi = barang.map(function (barang) {
    return barang.kondisi
});
var asuransi = barang.map(function (barang) {
    return barang.asuransi
});

function tampilinGambar() {
    var tampil = document.getElementById("main")
    for (i = 0; i < nama.length; i++) {
        tampil.innerHTML += '<div class="card rounded mr-auto ml-auto mb-3">' +
            '<a data-toggle="modal" data-target="#exampleModalCenter" href="#" onclick="addmodal(' + i + ')">' +
            '<img class="card-img-top" src="' + source[i] + '">' +
            '<div class="card-body">' +
            '<p class="card-title">' + nama[i] + '</p>' +
            '<p class="card-text">' + harga[i] + '</p>' +
            '<span class="icon-crown"><i class="fas fa-crown"></i> ' + distributor[i] + '</span>' +
            '<div class="row mr-auto ml-auto">' +
            '<span><i class="fas fa-star"></i></span>' +
            '<span><i class="fas fa-star"></i></span>' +
            '<span><i class="fas fa-star"></i></span>' +
            '<span><i class="fas fa-star"></i></span>' +
            '<span><i class="fas fa-star"></i></span>' +
            '</div>' +
            '</div>' +
            '</a>' +
            '</div>'
    }
}
tampilinGambar()

var index = []

function addmodal(l) {
    document.getElementById("namaModal").innerHTML = nama[l]
    document.getElementById("imgModal").src = source[l]
    document.getElementById("hargaModal").innerHTML = harga[l]
    document.getElementById("barangModal").innerHTML = kondisi[l]
    document.getElementById("garansiModal").innerHTML = asuransi[l]
    document.getElementById("beratModal").innerHTML = berat[l]
    if (index.length > 0) {
        index.splice(0, 1)
    }
    index.push(l)
}

nilai = []
var jumlahobj = []
var semuanya = []

function addtoBag() {
    var namaadd = nama.concat()
    var hargaadd = harga.concat()
    var sourceadd = source.concat()
    var jumlahbarang = document.getElementById("jumlahbarang").value
    nilai.push({
        namakeranjang: namaadd[index],
        hargakeranjang: hargaadd[index],
        srckeranjang: sourceadd[index]
    })
    var hargakeranjang = nilai.map(function (barang) {
        return barang.hargakeranjang
    });
    jumlahobj.push(jumlahbarang)
    index.pop

    for (i = 0; i < hargabarang.length; i++) {
        for (l = 0; l < hargakeranjang.length; l++) {
            var barang1 = Number(hargabarang[i])
            var barang2 = Number(jumlahobj[l])
            var baraang = hargakeranjang[l]
            var barang3 = baraang.substring(2, baraang.length)
            var barang4 = barang3.split('.').join("");
            if (barang1 == barang4) {
                var hargasemua = barang1 * barang2
                semuanya.push(hargasemua)
            }
        }
    }
    keranjangBelanja()
}

function kurangiBarang() {
    var jumlahbarang = document.getElementById("jumlahbarang")

    jumlahbarang.value--

    if (jumlahbarang.value <= 1) {
        jumlahbarang.value = 1
    }
    keranjangBelanja()
}

function tambahiBarang() {
    var jumlahbarang = document.getElementById("jumlahbarang")
    jumlahbarang.value++
    keranjangBelanja()
}


// html2
function keranjangBelanja() {
    var namakeranjang = nilai.map(function (barang) {
        return barang.namakeranjang
    });
    var hargakeranjang = nilai.map(function (barang) {
        return barang.hargakeranjang
    });
    var sourcekeranjang = nilai.map(function (barang) {
        return barang.srckeranjang
    });

    var tampilan = document.getElementById("keranjang")
    var beli = document.getElementById("belikeranjang")
    var totalhar = document.getElementById("totalharga")
    var button = document.getElementById('diskon')
    var button2 = document.getElementById('totaldiskons')
    var baayar = document.getElementById('totaldibayar')
    tampilan.innerHTML = ""
    for (i = 0; i < namakeranjang.length; i++) {
        tampilan.innerHTML += '<div class="row mt-3 border ml-2">' +
            '<img src="' + sourcekeranjang[i] + '" class="pull-left mr-3">' +
            '<div class="col">' +
            '<h6>' + namakeranjang[i] + '</h6>' +
            '<p>' + hargakeranjang[i] + '</p>' +
            '<div>' +
            '<div class="input-group mb-3">' + //w-50
            '<div class="input-group-prepend">' +
            '<button class="btn input-group-text" onclick="minkeranjang(' + i + ')"><i class="fas fa-minus"></i></button>' +
            '</div>' +
            '<input type="text" class="form-control text-center" value="' + jumlahobj[i] + '" autocomplete="off" id="jumlahbarangkeranjang' + i + '">' +
            '<div class="input-group-append">' +
            '<button class="btn input-group-text" onclick="pluskeranjang(' + i + ')"><i class="fas fa-plus"></i></button>' +
            '</div>' +
            '<button class="btn" onclick="delkeranjang(' + i + ')"><i class="fas fa-trash"></i></button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>'
        barangbeli = i + 1
        beli.innerHTML = 'Beli (' + barangbeli + ')'
        var ma = eval(semuanya.join('+'))
        if (ma > 10000000) {
            totalhar.innerHTML = "Rp" + ma
            button.style.display = "block";
            button2.style.display = "block";
            var asda = ma * 0.1
            var hasil = ma - asda
            baayar.innerHTML = "Rp" + hasil
        } else {
            button.style.display = "none";
            button2.style.display = "none";
            totalhar.innerHTML = "Rp" + ma
        }
    }
    semuanya = []
}

function delkeranjang(i) {
    nilai.splice(i, 1);
    keranjangBelanja()
}

function minkeranjang(val) {
    var hargakeranjang = nilai.map(function (barang) {
        return barang.hargakeranjang
    });
    var jumlahbarang1 = document.getElementById("jumlahbarangkeranjang" + val + "")

    jumlahbarang1.value--
    if (jumlahbarang1.value <= 1) {
        jumlahbarang1.value = 1
    }
    jumlahobj[val] = jumlahbarang1.value

    for (i = 0; i < hargabarang.length; i++) {
        for (l = 0; l < hargakeranjang.length; l++) {
            var barang1 = Number(hargabarang[i])
            var barang2 = Number(jumlahobj[l])
            var baraang = hargakeranjang[l]
            var barang3 = baraang.substring(2, baraang.length)
            var barang4 = barang3.split('.').join("");
            if (barang1 == barang4) {
                var hargasemua = barang1 * barang2
                semuanya.push(hargasemua)
            }
        }
    }
    keranjangBelanja()
}

function pluskeranjang(val) {
    var hargakeranjang = nilai.map(function (barang) {
        return barang.hargakeranjang
    });
    var jumlahbarang1 = document.getElementById("jumlahbarangkeranjang" + val + "")
    jumlahbarang1.value++
    jumlahobj[val] = jumlahbarang1.value

    for (i = 0; i < hargabarang.length; i++) {
        for (l = 0; l < hargakeranjang.length; l++) {
            var barang1 = Number(hargabarang[i])
            var barang2 = Number(jumlahobj[l])
            var baraang = hargakeranjang[l]
            var barang3 = baraang.substring(2, baraang.length)
            var barang4 = barang3.split('.').join("");
            if (barang1 == barang4) {
                var hargasemua = barang1 * barang2
                semuanya.push(hargasemua)
            }
        }
    }
    keranjangBelanja()
}