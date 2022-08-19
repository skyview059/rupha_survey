function DigitOnly(e) {
    var unicode = e.charCode ? e.charCode : e.keyCode;
//    alert(unicode);
    if (unicode !== 8 && unicode !== 9 && unicode !== 45){
        if (unicode < 46 || unicode > 57 || unicode === 47){
            return false;
        }
    }
}

function instantPhotoPreview(input, target) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(target + ' img').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
    $(target).show();
}