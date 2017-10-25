var base_url = 'http://awaan.ae/';
var base_path = 'http://awaan.ae/';
var image_name = 'ajax-loader.gif';
var imagespath = base_path + '/images';

window.sharedFunctions = function () {
    function requestAjax(methodParam, urlParam, dataParam, loadingId, contentId, datatype, options) {

        var call;
        //var datatype = 'html';
        /* Check if value = 1 just to ensure background compatibility with previous code */
        if(datatype == 1) {
            datatype = 'html';
        }
        if(typeof datatype == "undefined") {
            datatype = 'xml'
        }
        if(typeof datatype == 2) {
            datatype = 'json'
        }
        //var image_name = 'loading-bar.gif';
        call = $.ajax({
            type: methodParam,
            url: urlParam,
            data: dataParam,
            headers: {
                'X-CSRF-TOKEN': $(document).find('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                $("div[id='" + loadingId + "'],span[id='" + loadingId + "']").html("<img style='padding: 5px;' src='" + imagespath + "/ajax-loader.gif" + "''   border='0' />");
                return;
            },
            complete: function () {
                if(loadingId != contentId) {
                    $("#" + loadingId).empty();
                }
            },
            success: function (returnedData) {
//                    alert(returnedData);
                $("div[id='" + contentId + "'").html('');
                if(datatype == 'xml') {

                    $("div[id='" + contentId + "'],a[id='" + contentId + "'],span[id='" + contentId + "']").html(returnedData).dialog();
                } else {
                    $("#" + contentId).html($.trim(returnedData));
                }

                jQuery('#cateogries-videos-list').owlCarousel({
                    navText: ['<i class="ion-ios-arrow-left"></i>', '<i class="ion-ios-arrow-right"></i>'],
                    rtl: true,
                    loop: true,
                    margin: 0,
                    nav: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        470: {
                            items: 2
                        },
                        767: {
                            items: 2
                        },
                        991: {
                            items: 2
                        },
                        1200: {
                            items: 2
                        }
                    }
                });
            },
            dataType: datatype
        });

        return call;
    }

    return {
        "requestAjax": requestAjax
    }
}();
/*-----------------------ajax Form integration begin -----------------------------*/
