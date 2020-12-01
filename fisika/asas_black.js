var kalor = {
    air: {
        joule: 4200,
        kal: 1
    },
    es: {
        joule: 2100,
        kal: 0.5
    },
    uapAir: {
        joule: 2010,
        kal: 0.48
    },
    alumunium: {
        joule: 900,
        kal: 0.22
    },
    besiBaja: {
        joule: 450,
        kal: 0.11
    },
    emas: {
        joule: 130,
        kal: 0.03
    },
    gliserin: {
        joule: 2400,
        kal: 0.58
    },
    kaca: {
        joule: 670,
        kal: 0.16
    },
    kayu: {
        joule: 1700,
        kal: 0.4
    },
    kuningan: {
        joule: 380,
        kal: 0.09
    },
    marmer: {
        joule: 860,
        kal: 0.21
    },
    minyakTanah: {
        joule: 2200,
        kal: 0.58
    },
    perak: {
        joule: 230,
        kal: 0.06
    },
    raksa: {
        joule: 140,
        kal: 0.03
    },
    kustom: {
        joule: 0,
        kal: 0
    }
};

function gimmeChart(label1 = "Air", data1 = 0, label2 = "kustom", data2 = 0, dataAkhir = 0) {
    var ctx = document.getElementById('chart');
    let chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["awal", "akhir"],
            datasets: [{
                label: label1,
                data: [data1, dataAkhir]
            }, {
                label: label2,
                data: [data2, dataAkhir]
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'celcius'
                    },
                    gridLines: {
                        drawBorder: true,
                        display: true
                    }
                }]
            },
            animation: {
                onComplete: function () {
                    var ctx = this.chart.ctx;
                    ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'bottom';

                    this.data.datasets.forEach(function (dataset) {
                        for (var i = 0; i < dataset.data.length; i++) {
                            var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                                scale_max = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._yScale.maxHeight;
                            ctx.fillStyle = '#000';
                            var y_pos = model.y - 5;
                            if ((scale_max - model.y) / scale_max >= 0.5)
                                y_pos = model.y + 20;
                            ctx.fillText(dataset.data[i], model.x, y_pos);
                        }
                    });
                }
            }
        }
    });
}
gimmeChart()

function ubahKalor(pilihan) {
    if (pilihan != 'pilihKalor2') {
        ubahJoule($('#pilihJoule1').val(), 'pilihJoule1')
    } else {
        ubahJoule($('#pilihJoule2').val(), 'pilihJoule2')
    }
}

function ubahKalornya(angka, pilihan) {
    if (countKalor(Number(angka)).length === 0) {
        pilihan !== "kalorJenis2" ? $("#pilihKalor1").val('kustom') : $("#pilihKalor2").val('kustom')
    } else if (countKalor(Number(angka)).length >= 0) {
        pilihan !== "kalorJenis2" ? $("#pilihKalor1").val(countKalor(Number(angka), $('#pilihJoule1').val())) : $("#pilihKalor2").val(countKalor(Number(angka), $('#pilihJoule2').val()))
    }
}

function ubahKg(pilihan, id) {
    let massa1 = Number($("#massaBenda1").val())
    let massa2 = Number($("#massaBenda2").val())
    if (id === "pilihMassa1") {
        if (pilihan !== 'kg') {
            $("#massaBenda1").val(massa1 * 1000)
        } else {
            $("#massaBenda1").val(massa1 / 1000)
        }
    } else {
        if (pilihan !== "kg") {
            $("#massaBenda2").val(massa2 * 1000)
        } else {
            $("#massaBenda2").val(massa2 / 1000)
        }
    }
}

function ubahJoule(massa, pilihan) {
    if (pilihan != 'pilihJoule2') {
        let jenis = $("#pilihKalor1").val()
        $("#kalorJenis1").val(kalor[jenis][massa])
        if (countKalor(Number(massa)) == 0) {
            $("#pilihKalor1").val(jenis)
        }
    } else {
        let jenis = $("#pilihKalor2").val()
        $("#kalorJenis2").val(kalor[jenis][massa])
        if (countKalor(Number(massa)) == 0) {
            $("#pilihKalor2").val(jenis)
        }
    }
}

function countKalor(angka, pilihan = 0) {
    let objVal = new Array;
    for (key in kalor) {
        if (kalor.hasOwnProperty(key)) {
            objVal.push(Object.values(kalor[key]));
        }
    }
    let countKalor = new Array;
    let get = Object.entries(kalor).map(([key, value]) => value)
    var val = Object.entries(get).map(([keys, values]) => values[pilihan])
    for (let i = 0; i < objVal.length; i++) {
        for (let lem = 0; lem < objVal[0].length; lem++) {
            if (angka === objVal[i][lem]) {
                if (angka === objVal[i][lem] && pilihan === 0 || val[i] === objVal[i][lem]) {
                    countKalor = Object.keys(kalor)[i];
                } else if (angka === objVal[i][lem] && val[i] !== objVal[i][lem]) {
                    countKalor = "kustom"
                }
                break;
            }
        }
    }
    return countKalor
}

function hitung() {
    var massaBenda1 = Number($("#massaBenda1").val() === "" ? 0 : $("#massaBenda1").val());
    var massaBenda2 = Number($("#massaBenda2").val() === "" ? 0 : $("#massaBenda2").val());
    var kalorJenis1 = Number($("#kalorJenis1").val() === "" ? 0 : $("#kalorJenis1").val());
    var kalorJenis2 = Number($("#kalorJenis2").val() === "" ? 0 : $("#kalorJenis2").val());
    var suhuAwal1 = Number($("#suhuAwal1").val() === "" ? 0 : $("#suhuAwal1").val());
    var suhuAwal2 = Number($("#suhuAwal2").val() === "" ? 0 : $("#suhuAwal2").val());

    var mk1 = massaBenda1 * kalorJenis1
    var mk2 = massaBenda2 * kalorJenis2
    var mks1 = mk1 * suhuAwal1
    var mks2 = mk2 * suhuAwal2
    var deltaT = mks1 + mks2
    var deltaA = mk1 + mk2
    var hasil = deltaT / deltaA

    console.log(mk1, mk2, mks1, mks2, deltaT, deltaA, hasil)
    $('#hasil').val(hasil.toFixed(2))
    gimmeChart($("#pilihKalor1").val(), suhuAwal1, $("#pilihKalor2").val(), suhuAwal2, hasil.toFixed(2))
}

function buttonClicked() {
    if (document.getElementById('leftWing').style.transform === "translateX(-322px)") {
        document.getElementById('leftWing').style.transform = "";
        document.getElementById('leftWing').style.transition = "all 0.3s ease";
    } else {
        document.getElementById('butn').style.transform = '';
        document.getElementById('leftWing').style.transform = "translateX(-322px)";
        document.getElementById('leftWing').style.transition = "all 0.3s ease";
    }
}
document.getElementById('leftWing').style.transform = "translateX(-322px)";