(function($) {
    "use strict";

    /*--------------------
            QrcodeChange
        ----------------------*/
    $('.select_qrcode').on('change',function(e){
            e.preventDefault();
            var qrcode_id = $('.select_qrcode').val();
            qrCodeSelectBox(qrcode_id);
        });
    $('.select_vcardqrcode').on('change',function(e){
        e.preventDefault();
        var vcard_id = $('.select_vcardqrcode').val();
        vcardQrCodeSelectBox(vcard_id);
        
    })


})(jQuery);	

/*-----------------------
        QrCodeSelectBox
    ------------------------*/
function qrCodeSelectBox(qrcode_id){
    const url = $('#qrcodeChange').val();
    $.ajax({
        type:'get',
        url:url,
        data:{qrcode_id:qrcode_id},
        success: function(response){ 
            $('#theme_qrcode').html(response);
        },
        error: function(xhr, status, error) 
        {
            $.each(xhr.responseJSON.errors, function (key, item) 
            {
                Sweet('error',item)
                $("#errors").html("<li class='text-danger'>"+item+"</li>")
            });
            errosresponse(xhr, status, error);
        }
    })
}

/*-----------------------
        QrCodeSelectBox
    ------------------------*/
function vcardQrCodeSelectBox(vcard_id){
    const url = $('#qrcodeChange').val();
    $.ajax({
        type:'get',
        url:url,
        data:{vcard_id:vcard_id},
        success: function(response){ 
            $('#vcard_qrcode').html(response);
        },
        error: function(xhr, status, error) 
        {
            $.each(xhr.responseJSON.errors, function (key, item) 
            {
                Sweet('error',item)
                $("#errors").html("<li class='text-danger'>"+item+"</li>")
            });
            errosresponse(xhr, status, error);
        }
    })
}

/*-----------------------
        ThemeUrl
    ------------------------*/
function themeUrl() {
  var copyText = document.getElementById("themeUrl").value;

    var input = document.createElement('input');
    input.setAttribute('value', copyText);
    document.body.appendChild(input);
    input.select();
    input.setSelectionRange(0, 99999);

    document.execCommand('copy');
    document.body.removeChild(input)
    Sweet('success','Copied the  theme url')
}

/*-----------------------
        VcardUrl
    ------------------------*/
function vcardUrl() {
    var copyText = document.getElementById("vcardUrl").value;

    var input = document.createElement('input');
    input.setAttribute('value', copyText);
    document.body.appendChild(input);
    input.select();
    input.setSelectionRange(0, 99999);

    document.execCommand('copy');
    document.body.removeChild(input)
    Sweet('success','Copied the  vcard url')
}

/*-----------------------
        CVURL
    ------------------------*/
    function cvUrl() {
        var copyText = document.getElementById("cvUrl").value;
    
        var input = document.createElement('input');
        input.setAttribute('value', copyText);
        document.body.appendChild(input);
        input.select();
        input.setSelectionRange(0, 99999);
    
        document.execCommand('copy');
        document.body.removeChild(input)
        Sweet('success','Copied the CV url')
    }


/*-----------------------
        DownloadPng
    ------------------------*/
function downloadPng(){
    var img = new Image();
    img.onload = function (){
        var canvas = document.createElement("canvas");
        canvas.width = img.naturalWidth;
        canvas.height = img.naturalHeight;
        var ctxt = canvas.getContext("2d");
        ctxt.fillStyle = "#fff";
        ctxt.fillRect(0, 0, canvas.width, canvas.height);
            ctxt.drawImage(img, 0, 0);
        var a = document.createElement("a");
        a.href = canvas.toDataURL("image/png");
        a.download = "qrcode.png"
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    };
    var innerSvg = document.querySelector(".theme_qrcode svg");
    var svgText = (new XMLSerializer()).serializeToString(innerSvg);
    img.src = "data:image/svg+xml;utf8," + encodeURIComponent(svgText);
}


/*-----------------------
        downloadVcardPng
    ------------------------*/
function downloadVcardPng()
{
    var img = new Image();
    img.onload = function (){
        var canvas = document.createElement("canvas");
        canvas.width = img.naturalWidth;
        canvas.height = img.naturalHeight;
        var ctxt = canvas.getContext("2d");
        ctxt.fillStyle = "#fff";
        ctxt.fillRect(0, 0, canvas.width, canvas.height);
            ctxt.drawImage(img, 0, 0);
        var a = document.createElement("a");
        a.href = canvas.toDataURL("image/png");
        a.download = "qrcode.png"
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    };
    var innerSvg = document.querySelector(".vcard_qrcode svg");
    var svgText = (new XMLSerializer()).serializeToString(innerSvg);
    img.src = "data:image/svg+xml;utf8," + encodeURIComponent(svgText);
}