$(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
	// Kita sembunyikan dulu untuk loadingnya
	$("#loading").hide();
	
	$("#provinsi").change(function(){ // Ketika user mengganti atau memilih data provinsi
		$("#kota").hide(); // Sembunyikan dulu combobox kota nya
		$("#loading").show(); // Tampilkan loadingnya
	
		$.ajax({
			type: "POST", // Method pengiriman data bisa dengan GET atau POST
			url: "option_kota.php", // Isi dengan url/path file php yang dituju
			data: {provinsi : $("#provinsi").val()}, // data yang akan dikirim ke file yang dituju
			dataType: "json",
			beforeSend: function(e) {
				if(e && e.overrideMimeType) {
					e.overrideMimeType("application/json;charset=UTF-8");
				}
			},
			success: function(response){ // Ketika proses pengiriman berhasil
				$("#loading").hide(); // Sembunyikan loadingnya

				// set isi dari combobox kota
				// lalu munculkan kembali combobox kotanya
				$("#kota").html(response.data_kota).show();
			},
			error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
				alert(thrownError); // Munculkan alert error
			}
		});
    });
});

$(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
	// Kita sembunyikan dulu untuk loadingnya
	$("#loading2").hide();
	
	$("#buku").change(function(){ // Ketika user mengganti atau memilih data provinsi
		$("#kohir").hide(); // Sembunyikan dulu combobox kota nya
		$("#loading2").show(); // Tampilkan loadingnya
	
		$.ajax({
			type: "POST", // Method pengiriman data bisa dengan GET atau POST
			url: "option_kohir.php", // Isi dengan url/path file php yang dituju
			data: {buku : $("#buku").val()}, // data yang akan dikirim ke file yang dituju
			dataType: "json",
			beforeSend: function(e) {
				if(e && e.overrideMimeType) {
					e.overrideMimeType("application/json;charset=UTF-8");
				}
			},
			success: function(response){ // Ketika proses pengiriman berhasil
				$("#loading2").hide(); // Sembunyikan loadingnya

				// set isi dari combobox kota
				// lalu munculkan kembali combobox kotanya
				$("#kohir").html(response.data_kohir).show();
			},
			error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
				alert(thrownError); // Munculkan alert error
			}
		});
    });
});
