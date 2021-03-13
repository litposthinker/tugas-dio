<?php
require 'koneksi.php';

if (isset($_GET['search'])) :
    $data = $_GET['search'];
    $barang = query("SELECT * FROM stockbarang WHERE nama LIKE '%$data%'");
    $i = 1;
    foreach ($barang as $brg) :
?>
        <div class="card rounded <?= ($brg['stock'] < 1) ? 'bg-danger text-white' : '' ?> mb-2 ml-3 mr-1 mt-2 drag" id="brg<?= $brg['id'] ?>" onclick="tambahBarang(this.id)">
            <img class="card-img-top" src="  <?= $brg['gambar'] ?>  ">
            <div class="card-body text-center">
                <p class="card-title text-truncate"> <?= $brg['nama'] ?> </p>
                <p class="card-text <?= ($brg['stock'] < 1) ? 'text-white' : '' ?>">
                    <?= rupiah($brg['harga']) ?>
                </p>
            </div>
        </div>
<?php
        $i++;
    endforeach;
endif;
?>
<script>
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
        drop: function(event, ui) {
            $(ui.helper).remove();
            $(this).css("border", "");
            $(this).addClass("border");
            tambahBarang(ui.draggable[0].id);
        },
        over: function() {
            $(this).removeClass("border");
            $(this).css("border", "2px dashed rgb(72, 160, 255)");
        },
        out: function() {
            $(this).css("border", "");
            $(this).addClass("border");
        },
    });
</script>