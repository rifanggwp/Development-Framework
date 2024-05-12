//Kelurahan
$(document).ready(function() {
    $('select[name="Kecamatan"]').on('change', function() {
        var kecamatanID = $(this).val();
        if(kecamatanID) {
            $.ajax({
                url: '/user/form/laporan/getkel/'+kecamatanID,
                type: "GET",
                dataType: "json",
                success:function(data) {                      
                    $('select[name="Kelurahan"]').empty();
                    $('select[name="Kelurahan"]').append('<option selected="true" disabled="disabled">--Pilih Kelurahan--</option>');
                    $.each(data, function(key, value) {
                    $('select[name="Kelurahan"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                }
            });
        }else{
            $('select[name="Kelurahan"]').empty();
        }
    });
 });