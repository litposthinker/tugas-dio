//function that display value 
function angka(val) {
    x = document.getElementById("hasil").value
    y = x.substring(x.length - 1)
    z = x.substring(0,1)
    if (Number.isInteger(val)) {
        if (val != 0) {
            document.getElementById("hasil").value += val   
        } else {
            if (z != 0) {
                document.getElementById("hasil").value += val
            }
        }
    } else if (isNaN(x) == false) {
        if (typeof x !== 'undefined' && x !== '') {
            document.getElementById("hasil").value += val
        } else {
            document.getElementById("hasil").value = ''
        }
    } else if ( y == '-' || y == '/' || y == '*' || y == '+' ) {
        document.getElementById("hasil").value = x.substring(0, x.length - 1)
        document.getElementById("hasil").value += val
    }
}

function hasil() {
    let x = document.getElementById("hasil").value
    let y = eval(x)
    if (typeof y !== 'undefined') {
        document.getElementById("hasil").value = y
    } else if (typeof y === 'undefined') {
        document.getElementById("hasil").value = ''
    } else {
        document.getElementById("hasil").value = ''
    }
}

//function clear
function clr() {
    document.getElementById("hasil").value = ""
}
//function remove 1 character
function remove() {
    var exp = document.getElementById('hasil').value;
    document.getElementById("hasil").value = exp.substring(0, exp.length - 1)
}

document.onkeydown = function (e) {
    $("#body").click(function(){
        $(document).on('keydown', function(e) { e.preventDefault(); });
    });
    $(".form-control").click(function(){
        $(document).off('onkeydown');
    });

    var keyCode = e.keyCode;
    if (keyCode == 8) {
        remove()
    } else if (keyCode == 187 && e.shiftKey) {
        angka('+')
    } else if (keyCode == 56 && e.shiftKey) {
        angka('*')
    } else if (keyCode == 27) {
        clr()
    } else if (keyCode == 48) {
        angka(0)
    } else if (keyCode == 49) {
        angka(1)
    } else if (keyCode == 50) {
        angka(2)
    } else if (keyCode == 51) {
        angka(3)
    } else if (keyCode == 52) {
        angka(4)
    } else if (keyCode == 53) {
        angka(5)
    } else if (keyCode == 54) {
        angka(6)
    } else if (keyCode == 55) {
        angka(7)
    } else if (keyCode == 56) {
        angka(8)
    } else if (keyCode == 57) {
        angka(9)
    } else if (keyCode == 191) {
        angka('/')
    } else if (keyCode == 189) {
        angka('-')
    } else if (keyCode == 187 || keyCode == 13) {
        hasil()
    }
};