function cekBrowser() {
				if(window.ActiveXObject) {
					try{
						//alert("IE versi lama");
						return new ActiveXObject("Microsoft.XMLHTTP");
					}catch(e){
						//alert("IE versi baru");
						return new ActiveXObject("Msxml2.XMLHTTP");
					}
				}else if(window.XMLHttpRequest){
					//alert("Chrome, Firefox, dll");
					return new XMLHttpRequest();
				}else{
					//alert("Browser gak support, muleh ae.");
				}
			}

			var tiar = cekBrowser();
			function panggilAjax(halaman, parameter, konten) {
				var objek = window.document.getElementById(konten);
				objek.innerHTML = "<img src='../images/loading.gif'/>";
				if(tiar.readyState == 4 || tiar.readyState == 0) {
					tiar.open("POST", halaman, true);
					tiar.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					tiar.onreadystatechange = function() {
						if(tiar.readyState == 4 && tiar.status == 200) {
							objek.innerHTML = parseScript(tiar.responseText);
						}
					}
					tiar.send(parameter);
				}
			}

function parseScript(_source){
	var source=_source;
	var scripts= new Array();
	while(source.indexOf("<script")> -1 || source.indexOf("</script")> -1 ){
		var s= source.indexOf("<script");
		var s_e= source.indexOf(">",s);
		var e=source.indexOf("</script",s);
		var e_e=source.indexOf(">",e);

		scripts.push(source.substring(s_e+1, e));
		source=source.substring(0,s) + source.substring(e_e+1);
	}
	for(var i=0; i<scripts.length;i++){
		try{
			eval(scripts[i]);
		}catch(ex){}
	}
	return source;
}