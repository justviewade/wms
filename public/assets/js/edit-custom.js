$('#simpan').on('click', function () {
    swal({
        title: 'Yakin simpan perubahan?',
        text: 'Data akan diganti',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Simpan',
        cancelButtonText: 'Batal',
        padding: '2em'
    }).then(function(result) {
        if (result.value) {
            $('#update').submit();
        }
    })
})

$('.foto').on('click', function () {
    $src = $(this).attr('foto_src');
    $nama = $(this).attr('foto_nama');
    swal({
        title: '<p>Foto barang : '+$nama+'</p>',
        html: '<div style="max-height: 500px; overflow-x: auto;"><img src="'+$src+'" alt="Foto tidak ditemukan!"></div>',
        // imageUrl: $src,
        // imageWidth: 600,
        // imageHeight: 400,
        padding: '2em'
    })
})

$('#simpanpassword').on('click', function () {
    swal({
        title: 'Yakin simpan perubahan?',
        text: 'Password akan diganti',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Simpan',
        cancelButtonText: 'Batal',
        padding: '2em'
    }).then(function(result) {
        if (result.value) {
            $('#updatepassword').submit();
        }
    })
})