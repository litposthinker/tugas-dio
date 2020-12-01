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