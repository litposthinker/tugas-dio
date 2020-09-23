function formOver() {
    dropdesc = document.getElementById("dropdesc")
    rotate = document.getElementById("span1")
    span = document.getElementById("span2")
    contentform = document.getElementById("box")
    dropdown = document.getElementById("drop")
    if (dropdown.offsetWidth == 50) {
        document.getElementById("consm").style.display = "none"
        dropdown.style.width = "100%"
        dropdown.style.transition = ".01s"
        dropdesc.style.transition = ".10s"
        dropdesc.style.overflow = "hidden"
        dropdesc.style.height = "49px"
        dropdesc.style.display = "block"
        dropdesc.style.paddingTop = "13px"
        dropdesc.style.paddingLeft = "50px"

        span.style.right = "500%"
        span.style.left = "0"
        span.style.transform = "rotate(90deg)"
        rotate.style.transform = "rotate(90deg)"

        contentform.style.display = "block"
        contentform.style.color = "#fff"
        contentform.style.fontSize = "1.6em"

        contentform.style.width = "100%"
        contentform.style.padding = "5px 50px 0 50px"
        contentform.style.backgroundColor = "#e74c3c"
        contentform.style.maxHeight = "max-content"
        contentform.style.transition = "0.25s"
        var val = document.getElementById("namaproduk").value
        if (val == "") {
            document.getElementById("simpan1").style.display = "inline"
            document.getElementById("simpan2").style.display = "none"
        } else {
            document.getElementById("simpan1").style.display = "none"
            document.getElementById("simpan2").style.display = "inline"
        }
    } else {
        document.getElementById("kodeproduk").value = ""
        document.getElementById("namaproduk").value = ""
        document.getElementById("hargaproduk").value = ""
        document.getElementById("satuanproduk").value = ""
        document.getElementById("kategoriproduk").value = ""
        document.getElementById("urlproduk").value = ""
        document.getElementById("stockproduk").value = "1"
        document.getElementById("consm").style.display = "block"
        dropdown.style.width = ""
        rotate.style.transform = ""
        rotate.style.visibility = ""
        rotate.style.opacity = ""
        rotate.style.transition = ""
        dropdesc.style.display = ""
        dropdesc.style.paddingTop = ""
        dropdesc.style.paddingLeft = ""
        span.style.right = ""
        span.style.left = ""
        span.style.transform = ""
        contentform.style.display = ""
        contentform.style.color = ""
        contentform.style.fontSize = ""
        contentform.style.width = ""
        contentform.style.padding = ""
        contentform.style.backgroundColor = ""
        contentform.style.maxHeight = ""
        contentform.style.transition = ""

        dropdown.style.transition = ""
        dropdesc.style.transition = ""
        dropdesc.style.overflow = ""
        dropdesc.style.height = ""
        document.getElementById("simpan1").style.display = ""
        document.getElementById("simpan2").style.display = ""
    }
}

var produk = []
var nama = []
var harga = []
var satuan = []
var kategori = []
var url = []
var stock = []

function show() {
    var data = document.getElementById('bodydata')
    data.innerHTML = ""

    for (i = 0; i < nama.length; i++) {
        no = i + 1
        data.innerHTML += "<tr>" +
            "<th>" + no + "</th>" +
            "<td>" + produk[i] + "</td>" +
            "<td>" + nama[i] + "</td>" +
            "<td>" + harga[i] + "</td>" +
            "<td>" + satuan[i] + "</td>" +
            "<td>" + kategori[i] + "</td>" +
            "<td id='kat" + no + "'>" + stock[i] + "</td>" +
            "<td> <img src='" + url[i] + "'> </td>" +
            "<td>" +
            '<button class="btn btn-warning mr-1" onclick="edit(' + i + ')">Edit</button>' +
            '<button class="btn btn-danger" onclick="remove(' + i + ')">hapus</button>' +
            '</td>' +
            '</tr>'
        var stocks = document.getElementById('kat' + no + '')
        if (Number(stocks.innerHTML) < 5) {
            stocks.style.backgroundColor = "#e74c3c"
            stocks.style.color = "#fff"
        } else {
            stocks.style.backgroundColor = ""
            stocks.style.color = ""
        }
    }
}

function remove(i) {
    produk.splice(i, 1);
    nama.splice(i, 1);
    harga.splice(i, 1);
    satuan.splice(i, 1);
    kategori.splice(i, 1);
    url.splice(i, 1);
    stock.splice(i, 1);
    show()
}
var ubah = []

function edit(i) {
    document.getElementById("kodeproduk").value = produk[i]
    document.getElementById("namaproduk").value = nama[i]
    document.getElementById("hargaproduk").value = harga[i]
    document.getElementById("satuanproduk").value = satuan[i]
    document.getElementById("kategoriproduk").value = kategori[i]
    document.getElementById("urlproduk").value = url[i]
    document.getElementById("stockproduk").value = stock[i]
    formOver()
    ubah.push(i)
}

function edited() {
    var editproduk = document.getElementById("kodeproduk").value
    var editnama = document.getElementById("namaproduk").value
    var editharga = document.getElementById("hargaproduk").value
    var editsatuan = document.getElementById("satuanproduk").value
    var editkategori = document.getElementById("kategoriproduk").value
    var editurl = document.getElementById("urlproduk").value
    var editstock = document.getElementById("stockproduk").value

    if (isNaN(editnama) && isNaN(editsatuan) && isNaN(editkategori) && editharga != "" && editurl != '' && editstock != '') {
        produk[ubah] = editproduk
        nama[ubah] = editnama
        harga[ubah] = editharga
        satuan[ubah] = editsatuan
        kategori[ubah] = editkategori
        url[ubah] = editurl
        stock[ubah] = editstock
        ubah.pop()
        formOver()
        show()
    } else {
        var pesan = document.createElement("div");
        pesan.setAttribute('class', 'alert alert-danger text-center');
        pesan.setAttribute('role', 'alert');
        pesan.setAttribute('id', 'alert-popup');
        pesan.innerHTML = 'Isi Semua dengan data yang sesuai';
        document.body.insertBefore(pesan, document.body.childNodes[0]);

        setTimeout(function () {
            document.getElementById('alert-popup').remove();
        }, 2000);
    }

}

function simpan() {
    var addproduk = document.getElementById("kodeproduk").value
    var addnama = document.getElementById("namaproduk").value
    var addharga = document.getElementById("hargaproduk").value
    var addsatuan = document.getElementById("satuanproduk").value
    var addkategori = document.getElementById("kategoriproduk").value
    var addurl = document.getElementById("urlproduk").value
    var addstock = document.getElementById("stockproduk").value
    if (isNaN(addnama) && isNaN(addsatuan) && isNaN(addkategori) && addharga != "" && addurl != '' && addstock != '') {
        produk.push(addproduk)
        nama.push(addnama)
        harga.push(addharga)
        satuan.push(addsatuan)
        kategori.push(addkategori)
        url.push(addurl)
        stock.push(addstock)
        formOver()
        show()
    } else {
        var pesan = document.createElement("div");
        pesan.setAttribute('class', 'alert alert-danger text-center');
        pesan.setAttribute('role', 'alert');
        pesan.setAttribute('id', 'alert-popup');
        pesan.innerHTML = 'Isi Semua dengan data yang sesuai';
        document.body.insertBefore(pesan, document.body.childNodes[0]);

        setTimeout(function () {
            document.getElementById('alert-popup').remove();
        }, 2000);
    }
}


function kodeprodukChange(value) {
    kode = []
    strkode = value.split(/(\s+)/).filter(function (e) {
        return e.trim().length > 0;
    });
    for (i = 0; i < strkode.length; i++) {
        if (strkode.length == 1) {
            code = strkode[i].slice(0, 2)
        } else {
            code = strkode[i].slice(0, 1)
        }
        kode.push(code)
    }
    kodepro = kode.join("")
    kodepro = kodepro.toUpperCase()
    if (kode.length == 0) {
        document.getElementById("kodeproduk").value = ''
    } else {
        var count = 1;
        for (var i = 0; i < kategori.length; ++i) {
            if (kategori[i].toLowerCase() == value.toLowerCase())
                count++;
        }
        if (count < 10) {
            document.getElementById("kodeproduk").value = kodepro + '-00' + count
        } else if (count < 100) {
            document.getElementById("kodeproduk").value = kodepro + '-0' + count
        } else {
            document.getElementById("kodeproduk").value = kodepro + '-' + count
        }
    }
}

var rupiah = document.getElementById("hargaproduk");
rupiah.addEventListener("keyup", function (e) {
    rupiah.value = formatDollar(this.value, "Rp ");
});

/* Fungsi formatRupiah */
function formatDollar(angka, prefix = "Rp ") {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        if (sisa) {
            separator = "."
        } else {
            separator = ""
        }
        rupiah += separator + ribuan.join(".");
    }

    if (split[1] != undefined) {
        rupiah = rupiah + "," + split[1]
    }

    if (prefix == undefined) {
        prefix = rupiah
    } else if (rupiah) {
        prefix = "Rp " + rupiah
    } else {
        prefix = ""
    }
    return prefix
}