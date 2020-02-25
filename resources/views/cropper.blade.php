<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A basic demo of Cropper.">
    <meta name="keywords" content="HTML, CSS, JS, JavaScript, jQuery plugin, image cropping, image crop, image move, image zoom, image rotate, image scale, front-end, frontend, web development">
    <meta name="author" content="Fengyuan Chen">
    <title>Cropper</title>
    <link rel="stylesheet" href="{{ asset('cropper/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cropper/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cropper/css/cropper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Code Google de la balise de remarketing -->
    <!--
        ------------------------------------------------
        Les balises de remarketing ne peuvent pas être associées aux informations personnelles ou placées sur des pages liées aux catégories à caractère sensible. Pour comprendre et savoir comment configurer la balise, rendez-vous sur la page http://google.com/ads/remarketingsetup.
        ------------------------------------------------
    -->
    <script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 868623742;
    var google_custom_params = window.google_tag_params;
    var google_remarketing_only = true;
    /* ]]> */
    </script>
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
    <div style="display:inline;">
    <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/868623742/?guid=ON&amp;script=0"/>
    </div>
    </noscript>
</head>
<body>



<img id="image" src="{{ asset('cropper/img/picture.jpg') }}" alt="Picture">

<div class="col-md-9 docs-buttons">

    <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, 0.1)">
          <span class="fa fa-search-plus"></span>
        </span>
    </button>
    <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, -0.1)">
          <span class="fa fa-search-minus"></span>
        </span>
    </button>


    <button type="button" class="btn btn-primary" data-method="getCroppedCanvas">
        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;)">
          Get Cropped Canvas
        </span>
    </button>

    <!-- Show the cropped image in modal -->
    <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="getCroppedCanvasTitle">Cropped</h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
</div><!-- /.docs-buttons -->


<!-- Scripts -->
<script src="{{ asset('cropper/js/jquery.min.js') }}"></script>
<script src="{{ asset('cropper/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('cropper/js/cropper.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script type="text/javascript" src="http://assets.freshdesk.com/widget/freshwidget.js"></script>
<script type="text/javascript">
    FreshWidget.init("", {"queryString": "&widgetType=popup&formTitle=Utilisez+le+bouton+photo", "utf8": "✓", "widgetType": "popup", "buttonType": "text", "buttonText": "Reporter un problème à l'aide d'une capture de l'écran.", "buttonColor": "white", "buttonBg": "#204489", "alignment": "1", "offset": "600px", "formHeight": "500px", "url": "https://prediseo.freshdesk.com"} );
</script>
</body>
</html>
