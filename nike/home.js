$(document).ready(function () {
    $('.scroll').mousedown(function (event) {
        $(this)
            .data('down', true)
            .data('x', event.clientX)
            .data('scrollLeft', this.scrollLeft)
            .addClass("dragging");

        return false;
    }).mouseup(function (event) {
        $(this)
            .data('down', false)
            .removeClass("dragging");
    }).mousemove(function (event) {
        if ($(this).data('down') == true) {
            this.scrollLeft = $(this).data('scrollLeft') + $(this).data('x') - event.clientX;
        }
    }).mousewheel(function (event, delta) {
        this.scrollLeft -= (delta * 30);
    }).css({
        'overflow': 'hidden',
        'cursor': '-moz-grab'
    });
    $(window).mouseout(function (event) {
        if ($('.team-form-data').data('down')) {
            try {
                if (event.originalTarget.nodeName == 'BODY' || event.originalTarget.nodeName == 'HTML') {
                    $('.team-form-data').data('down', false);
                }
            } catch (e) {}
        }
    });
});

var header = document.getElementById("button");
var btns = header.getElementsByClassName("btn");

$(btns).on('click', function (event) {
    $target = $(event.target);
    $(btns).removeClass(" active")
    $target.addClass(" active")
});
$('#exampleModalCenter').on('show.bs.modal', function (e) {
    $(btns).removeClass(" active")
})

var judul, merk, harga, img1, img2
judul = document.getElementById("judulModal")
merk = document.getElementById("merkModal")
harga = document.getElementById("hargaModal")
img1 = document.getElementById("img1Modal")
img2 = document.getElementById("img2Modal")
// wanita
function nikeRevolution5() {
    judul.innerHTML = "Women's Running Shoe";
    merk.innerHTML = "Nike Revolution 5";
    harga.innerHTML = "Rp 799,000";
    img1.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/e5da568f-c9d3-4093-b3f8-fd1e916ddbdb/revolution-5-running-shoe-8P3bh3.jpg";
    img2.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/88d8c432-cd75-430c-9211-0f2175f661ce/revolution-5-running-shoe-8P3bh3.jpg";
}

function nikeFoundationEliteTR2() {
    judul.innerHTML = "Women's Training Shoe";
    merk.innerHTML = "Nike Foundation Elite TR 2";
    harga.innerHTML = "Rp 899,000";
    img1.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/e2a5b212-16c0-4c0c-910f-29ef929bfade/foundation-elite-tr-2-training-shoe-nvK5Gk.jpg";
    img2.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/db405a0e-d50b-46af-a09f-851ef6345000/foundation-elite-tr-2-training-shoe-nvK5Gk.jpg";
}

function nikeReactElement55() {
    judul.innerHTML = "Women's Shoe";
    merk.innerHTML = "Nike React Element 55";
    harga.innerHTML = "Rp 1,979,000";
    img1.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/9de99e4e-9f00-458d-952e-660325d35751/react-element-55-shoe-zsg7Kh.jpg";
    img2.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/cc4a0a49-a176-44f2-b509-1e4b3dfeca3a/react-element-55-shoe-zsg7Kh.jpg";
}

function nikeAirZoomPegasus37() {
    judul.innerHTML = "Women's Running Shoe";
    merk.innerHTML = "Nike Air Zoom Pegasus 37";
    harga.innerHTML = "Rp 1,979,000";
    img1.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/fffd5e3d-dc2e-4db3-b4d1-9559c6ff2dc4/air-zoom-pegasus-37-running-shoe-vN6Zs1.jpg";
    img2.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/73cf1317-f080-489d-9b28-27368ab442b6/air-zoom-pegasus-37-running-shoe-vN6Zs1.jpg";
}

function nikeDownshifter9() {
    judul.innerHTML = "Women's Running Shoe";
    merk.innerHTML = "Nike Downshifter 9";
    harga.innerHTML = "Rp 749,000";
    img1.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/ab685445-1e7b-4f5b-b06b-f2a1b2d0525c/downshifter-9-running-shoe-w9ZR7d.jpg";
    img2.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/2760d573-67d2-4814-8574-8b4bd7c1a4ff/downshifter-9-running-shoe-w9ZR7d.jpg";
}

function nikeDownshifter9() {
    judul.innerHTML = "Women's Running Shoe";
    merk.innerHTML = "Nike Downshifter 9";
    harga.innerHTML = "Rp 749,000";
    img1.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/ab685445-1e7b-4f5b-b06b-f2a1b2d0525c/downshifter-9-running-shoe-w9ZR7d.jpg";
    img2.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/2760d573-67d2-4814-8574-8b4bd7c1a4ff/downshifter-9-running-shoe-w9ZR7d.jpg";
}

function nikeNswReactVisionEssential() {
    judul.innerHTML = "Women's Shoe";
    merk.innerHTML = "Nike Nsw React Vision Essential";
    harga.innerHTML = "Rp 1,979,000";
    img1.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/5d781e23-84cf-4f80-9f32-d86d09cd8544/nsw-react-vision-essential-shoe-QxscPQ.jpg";
    img2.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/2d0fc2b1-b5da-411d-9f30-48fb63aba923/nsw-react-vision-essential-shoe-QxscPQ.jpg";
}

// pria
function nikeFlexControl4() {
    judul.innerHTML = "Men's Training Shoe";
    merk.innerHTML = "Nike Flex Control 4";
    harga.innerHTML = "Rp 899,000";
    img1.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/cbefc9b7-a3ce-46eb-92f8-dd18db21f0a3/flex-control-4-training-shoe-pQx7z1.jpg";
    img2.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/3f2aef74-af64-403c-89af-4fb1ac928871/flex-control-4-training-shoe-pQx7z1.jpg";
}

function nikeFlexmethodTR() {
    judul.innerHTML = "Men's Training Shoe";
    merk.innerHTML = "Nike Flexmethod TR";
    harga.innerHTML = "Rp 1,199,000";
    img1.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/mp2bqhke5vc02io89udx/flexmethod-tr-training-shoe-RP8PGD.jpg";
    img2.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/wutmv46pwygjcwpfz5na/flexmethod-tr-training-shoe-RP8PGD.jpg";
}

function nikeAirZoomSuperRep() {
    judul.innerHTML = "Men's HIIT Class Shoe";
    merk.innerHTML = "Nike Air Zoom SuperRep";
    harga.innerHTML = "Rp 1,799,000";
    img1.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/i1-c94469be-7e7e-4a85-ba54-6ef67878258b/air-zoom-superrep-hiit-class-shoe-4VjdKB.jpg";
    img2.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/i1-17d23cbb-5976-4ecc-a2e3-0a7880c5e00c/air-zoom-superrep-hiit-class-shoe-4VjdKB.jpg";
}

function nikeSuperRepGo() {
    judul.innerHTML = "Men's Training Shoe";
    merk.innerHTML = "Nike SuperRep Go";
    harga.innerHTML = "Rp 1,429,000";
    img1.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/7a90e53c-3349-427e-9b72-73f47e221b9b/superrep-go-training-shoe-SMnpt6.jpg";
    img2.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/886e801d-557d-416f-a0b8-24c0c18ff6ca/superrep-go-training-shoe-SMnpt6.jpg";
}

function nikeAirMaxAlphaSavage() {
    judul.innerHTML = "Men's Training Shoe";
    merk.innerHTML = "Nike Air Max Alpha Savage";
    harga.innerHTML = "Rp 1,649,000";
    img1.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/zdglmhgleyr182j5ucqm/air-max-alpha-savage-training-shoe-hJdbdr.jpg";
    img2.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/qclzn1osd3tisqzqjqsv/air-max-alpha-savage-training-shoe-hJdbdr.jpg";
}

function nikeMetcon6ByYou() {
    judul.innerHTML = "Custom Training Shoe";
    merk.innerHTML = "Nike Metcon 6 By You";
    harga.innerHTML = "Rp 2,279,000";
    img1.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/754d7490-7e37-4d69-b78d-86e6628342bf/custom-nike-metcon-6-by-you.jpg";
    img2.src = "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/411ba67e-5d15-4f99-8c60-3f2a4613b72c/custom-nike-metcon-6-by-you.jpg";
}