// $('.hapus').on('click', function () {
// $id = $(this).attr('hapus_id');
// $nama = $(this).attr('hapus_nama');
// swal({
//     title: 'Yakin untuk menghapus '+$nama+' ?',
//     text: 'tidak dapat dikembalikan',
//     type: 'warning',
//     showCancelButton: true,
//     confirmButtonText: 'Delete',
//     padding: '2em'
//     }).then(function(result) {
//         if (result.value) {
//             window.location = '{{url ("deletegudang")}}'+'/'+$id;
//         }
//     })
// })

$('.hapus').on('click', function () {
$id = $(this).attr('hapus_id');
$nama = $(this).attr('hapus_nama');
swal({
    title: 'Yakin untuk menghapus '+$nama+'?',
    text: 'Data tidak dapat dikembalikan',
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Hapus',
    cancelButtonText: 'Batal',
    padding: '2em'
    }).then(function(result) {
        if (result.value) {
            $('#hapus-'+$id).submit();
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