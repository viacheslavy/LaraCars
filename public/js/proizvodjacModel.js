/**
 * Created by Lazar on 16.1.2016..
 */
$(document).ready(function() {
    $("#proizvodjacSearch").change(function() {
        var model_json_file = $(this).find(':selected').attr('data-modelcode') + '.json';
        //var url = $("#model_jsonSearch").val() + model_json_file;
        // var url = $("#proizvodjacSearch").val();
        var url = $(this).find(':selected').attr('data-modelcode');
        if($(this).find(':selected').attr('data-modelcode') == "00") {
            var $el = $("#modelSearch");
            $el.empty();
            $el.append($("<option></option>").attr("value", "").text("Tous les modèles"));
            return;
        }
        var $el = $("#modelSearch");
        $el.prop('disabled', 'disabled');
        $("#ajaxLoader").show();
        $el.empty();
        $el.append($("<option></option>").attr("value", "").text("Tous les modèles"));
        $.ajax({
            url: '/getMakes/' + url,
            data: {},
            type: 'GET',
            success: function (response) {
                var newOptions = response;
                var $el = $("#modelSearch");
                $.each(newOptions, function (index, value, key) {
                    $el.append($("<option></option>").attr("value", value.label).text(value.label));
                });
                $el.prop('disabled', false);
                $("#ajaxLoader").hide();
            }
        });

    });

    if($("#proizvodjacSearch").find(":selected").attr('data-modelcode') != "00") {
        // var model_json_file = $("#proizvodjacSearch").find(':selected').attr('data-modelcode') + '.json';
        // var url = $("#model_jsonSearch").val() + model_json_file;
        var url = $(this).find(':selected').attr('data-modelcode');

        if($("#proizvodjacSearch").find(':selected').attr('data-modelcode') == "00") {
            var $el = $("#modelSearch");
            $el.empty();

            $el.append($("<option></option>")
                .attr("value", "").text("Tous les modèles"));

            return;
        }

        var $el = $("#modelSearch");
        $el.prop('disabled', 'disabled');
        $("#ajaxLoader").show();
        $el.empty();
        $el.append($("<option></option>").attr("value", "").text("Tous les modèles"));
        $.ajax({
            url: '/getMakes/' + url,
            data: {},
            type: 'GET',
            success: function (response) {
                var newOptions = response;
                console.log(response);
                var $el = $("#modelSearch");
                $.each(newOptions, function (index, value, key) {
                    if($("#selectThisModel").val() != value.label){
                        $el.append($("<option></option>").attr("value", value.label).text(value.label));
                    }
                });
                $el.prop('disabled', false);
                if($("#selectThisModel").val() != ''){
                    $el.append($("<option></option>").attr("value", $("#selectThisModel").val()).text($("#selectThisModel").val()).prop('selected', true));
                }
                $("#ajaxLoader").hide();
            }
        });




    }


});
