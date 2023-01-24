<script type="text/javascript">
//    $('#body').keyup(updateCount);
//    $('#body').keydown(updateCount);
//    $(function () {
//        updateCount();
//    });
//    function updateCount() {
//        var limit_en = 160;
//        var limit_bn = 70;
//        var write = $('#body').val().length;
//        $('#write_en').text(write);
//        $('#write_bn').text(write);
//        $('#limit_en').text(limit_en - write);
//        $('#limit_bn').text(limit_bn - write);
//    }

    $(document.body).on('change', '#division_id', function () {
        var division_id = $(this).val();
        jQuery.ajax({
            url: 'user/getDivision/' + division_id,
            type: 'get',
            dataType: "json",
            beforeSend: function () {
                jQuery('#ajax_respond').html('<p class="ajax_processing">Loading....</p>');
            },
            success: function (jsonRespond) {

                if (jsonRespond.Status === 'OK') {

                    jQuery('#district_id').html(jsonRespond.Msg);
                } else {
                    jQuery('#ajax_respond').html(jsonRespond.Msg);
                }
            }
        });
    });

    $(document.body).on('change', '#district_id', function () {
        var district_id = $(this).val();
        jQuery.ajax({
            url: 'user/getDistrict/' + district_id,
            type: 'get',
            dataType: "json",
            beforeSend: function () {
                jQuery('#ajax_respond').html('<p class="ajax_processing">Loading....</p>');
            },
            success: function (jsonRespond) {

                if (jsonRespond.Status === 'OK') {

                    jQuery('#upazilla_id').html(jsonRespond.Msg);
                } else {
                    jQuery('#ajax_respond').html(jsonRespond.Msg);
                }
            }
        });
    });

    $(document.body).on('change', '#upazilla_id', function () {
        var upazilla_id = $(this).val();
        jQuery.ajax({
            url: 'user/getUpazilla/' + upazilla_id,
            type: 'get',
            dataType: "json",
            beforeSend: function () {
                jQuery('#ajax_respond').html('<p class="ajax_processing">Loading....</p>');
            },
            success: function (jsonRespond) {
                if (jsonRespond.Status === 'OK') {

                    jQuery('#union_id').html(jsonRespond.Msg);
                } else {
                    jQuery('#ajax_respond').html(jsonRespond.Msg);
                }
            }
        });
    });
</script>