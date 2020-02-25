<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <!-- Meta, title, CSS, favicons, etc. -->
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Control Panel</title>
	    <!-- Bootstrap -->
	    <link href="{{ asset('admin_assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
	    <!-- Font Awesome -->
	    <link href="{{ asset('admin_assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
	    <!-- NProgress -->
	    <link href="{{ asset('admin_assets/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
	    <!-- iCheck -->
	    <link href="{{ asset('admin_assets/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
	    <!-- bootstrap-wysiwyg -->
	    <link href="{{ asset('admin_assets/vendors/google-code-prettify/bin/prettify.min.css') }}" rel="stylesheet">
	    <!-- Select2 -->
	    <link href="{{ asset('admin_assets/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
	    <!-- Switchery -->
	    <link href="{{ asset('admin_assets/vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">
	    <!-- starrr -->
	    <link href="{{ asset('admin_assets/vendors/starrr/dist/starrr.css') }}" rel="stylesheet">
	    <!-- Custom Theme Style -->
	    <link href="{{ asset('admin_assets/build/css/custom.min.css') }}" rel="stylesheet">
	    <link rel="stylesheet" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
	    <link rel="stylesheet" href="{{ asset('cropper/css/cropper.css') }}">
	    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
	</head>
	<body>
		<div class="container body">
		    <div class="row">
				<div class="panel panel-default" role="main">
				    <div class="">
				        <div class="page-title">
				            <div class="title_left">
				                <h3>Car Manager</h3>
				            </div>
				        </div>
				        <div class="clearfix"></div>
				        <style>
				            .label {
				                padding: 4px 8px !important;
				                display: inline-block;
				                margin-top: 5px;
				            }

				        </style>
				        <div class="row">
				            <div class="col-xs-12">
				                <div class="x_panel">
				                    <div class="x_title">
				                    	Uploaded Image
				                    </div>
				                    <div class="x_content">
				                    	<div class="modal-body" style="height: 500px; width: 800px;">
				                    		<img id="image" src="{{ $car_image->big }}" data-imageid="{{ $car_image->id }}" alt="picture" style="height: 100%; width: 100%;" />
				                    		<div class="col-md-9 docs-buttons" style="margin-top: 10px;">

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

			                                    <button id="getCroppedCanvas" type="button" class="btn btn-primary" data-method="getCroppedCanvas">
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

			                                                            <i style="display: none;" id="loadingSaveImage" class="fa fa-circle-o-notch fa-spin fa-3x fa-fw margin-bottom"></i>

			                                                            <button type="button" class="btn btn-default" id="closeModalsID" data-dismiss="modal">Close</button>
			                                                            <a class="btn btn-primary" style="display:none" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
			                                                            <a href="#" class="btn btn-primary" id="saveCroppedImage">Save</a>
			                                                    </div>
			                                            </div>
			                                        </div>
			                                    </div><!-- /.modal -->
			                                </div><!-- /.docs-buttons -->

			            <input type="hidden" id="saveCroppedImageUrl" value="{{route('post.save.cropped.image') }}">
			            <!-- <input type="hidden" id="tokenId" name="secrectToken" value="{{ csrf_field() }}"> -->                            
			                                                            
											

				                    	</div>	
				                    </div>
								</div>	                   
				            	<div class="clearfix"></div>
				        	</div>  
				        </div>	  
				    </div>
				</div>
		        <!-- /footer content -->
		    </div>
		</div>
		<!-- jQuery -->
		<script src="{{ asset('admin_assets/vendors/jquery/dist/jquery.min.js') }}"></script>
		<!-- Bootstrap -->
		<script src="{{ asset('admin_assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
		<!-- FastClick -->
		<script src="{{ asset('admin_assets/vendors/fastclick/lib/fastclick.js') }}"></script>
		<!-- NProgress -->
		<script src="{{ asset('admin_assets/vendors/nprogress/nprogress.js') }}"></script>
		<!-- bootstrap-progressbar -->
		<script src="{{ asset('admin_assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
		<!-- iCheck -->
		<script src="{{ asset('admin_assets/vendors/iCheck/icheck.min.js') }}"></script>
		<!-- bootstrap-daterangepicker -->
		<script src="{{ asset('admin_assets/js/moment/moment.min.js') }}"></script>
		<script src="{{ asset('admin_assets/js/datepicker/daterangepicker.js') }}"></script>
		<!-- bootstrap-wysiwyg -->
		<script src="{{ asset('admin_assets/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') }}"></script>
		<script src="{{ asset('admin_assets/vendors/jquery.hotkeys/jquery.hotkeys.js') }}"></script>
		<script src="{{ asset('admin_assets/vendors/google-code-prettify/src/prettify.js') }}"></script>
		<!-- jQuery Tags Input -->
		<script src="{{ asset('admin_assets/vendors/jquery.tagsinput/src/jquery.tagsinput.js') }}"></script>
		<!-- Switchery -->
		<script src="{{ asset('admin_assets/vendors/switchery/dist/switchery.min.js') }}"></script>
		<!-- Select2 -->
		<script src="{{ asset('admin_assets/vendors/select2/dist/js/select2.full.min.js') }}"></script>
		<!-- Parsley -->
		<script src="{{ asset('admin_assets/vendors/parsleyjs/dist/parsley.min.js') }}"></script>
		<!-- Autosize -->
		<script src="{{ asset('admin_assets/vendors/autosize/dist/autosize.min.js') }}"></script>
		<!-- jQuery autocomplete -->
		<script src="{{ asset('admin_assets/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js') }}"></script>
		<!-- starrr -->
		<script src="{{ asset('admin_assets/vendors/starrr/dist/starrr.js') }}"></script>

		<!-- Custom Theme Scripts -->
		<script src="{{ asset('admin_assets/build/js/custom.min.js') }}"></script>

		<!-- bootstrap-daterangepicker -->
		<script>
		    $(document).ready(function() {
		        $('#birthday').daterangepicker({
		            singleDatePicker: true,
		            calender_style: "picker_4"
		        }, function(start, end, label) {
		            console.log(start.toISOString(), end.toISOString(), label);
		        });
		    });
		</script>
		<!-- /bootstrap-daterangepicker -->

		<!-- bootstrap-wysiwyg -->
		<script>
		    $(document).ready(function() {
		        function initToolbarBootstrapBindings() {
		            var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
		                        'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
		                        'Times New Roman', 'Verdana'
		                    ],
		                    fontTarget = $('[title=Font]').siblings('.dropdown-menu');
		            $.each(fonts, function(idx, fontName) {
		                fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
		            });
		            $('a[title]').tooltip({
		                container: 'body'
		            });
		            $('.dropdown-menu input').click(function() {
		                return false;
		            })
		                    .change(function() {
		                        $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
		                    })
		                    .keydown('esc', function() {
		                        this.value = '';
		                        $(this).change();
		                    });

		            $('[data-role=magic-overlay]').each(function() {
		                var overlay = $(this),
		                        target = $(overlay.data('target'));
		                overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
		            });

		            if ("onwebkitspeechchange" in document.createElement("input")) {
		                var editorOffset = $('#editor').offset();

		                $('.voiceBtn').css('position', 'absolute').offset({
		                    top: editorOffset.top,
		                    left: editorOffset.left + $('#editor').innerWidth() - 35
		                });
		            } else {
		                $('.voiceBtn').hide();
		            }
		        }

		        function showErrorAlert(reason, detail) {
		            var msg = '';
		            if (reason === 'unsupported-file-type') {
		                msg = "Unsupported format " + detail;
		            } else {
		                console.log("error uploading file", reason, detail);
		            }
		            $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
		                    '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
		        }

		        initToolbarBootstrapBindings();

		        $('#editor').wysiwyg({
		            fileUploadError: showErrorAlert
		        });

		        window.prettyPrint;
		        prettyPrint();
		    });
		</script>
		<!-- /bootstrap-wysiwyg -->

		<!-- Select2 -->
		<script>
		    $(document).ready(function() {
		        $(".select2_single").select2({
		            placeholder: "Select a state",
		            allowClear: true
		        });
		        $(".select2_group").select2({});
		        $(".select2_multiple").select2({
		            maximumSelectionLength: 4,
		            placeholder: "With Max Selection limit 4",
		            allowClear: true
		        });
		    });
		</script>
		<!-- /Select2 -->

		<!-- jQuery Tags Input -->
		<script>
		    function onAddTag(tag) {
		        alert("Added a tag: " + tag);
		    }

		    function onRemoveTag(tag) {
		        alert("Removed a tag: " + tag);
		    }

		    function onChangeTag(input, tag) {
		        alert("Changed a tag: " + tag);
		    }

		    $(document).ready(function() {
		        $('#tags_1').tagsInput({
		            width: 'auto'
		        });
		    });
		</script>
		<!-- /jQuery Tags Input -->

		<!-- Parsley -->
		<script>
		    $(document).ready(function() {
		        $.listen('parsley:field:validate', function() {
		            validateFront();
		        });
		        $('#demo-form .btn').on('click', function() {
		            $('#demo-form').parsley().validate();
		            validateFront();
		        });
		        var validateFront = function() {
		            if (true === $('#demo-form').parsley().isValid()) {
		                $('.bs-callout-info').removeClass('hidden');
		                $('.bs-callout-warning').addClass('hidden');
		            } else {
		                $('.bs-callout-info').addClass('hidden');
		                $('.bs-callout-warning').removeClass('hidden');
		            }
		        };
		    });

		    $(document).ready(function() {
		        $.listen('parsley:field:validate', function() {
		            validateFront();
		        });
		        $('#demo-form2 .btn').on('click', function() {
		            $('#demo-form2').parsley().validate();
		            validateFront();
		        });
		        var validateFront = function() {
		            if (true === $('#demo-form2').parsley().isValid()) {
		                $('.bs-callout-info').removeClass('hidden');
		                $('.bs-callout-warning').addClass('hidden');
		            } else {
		                $('.bs-callout-info').addClass('hidden');
		                $('.bs-callout-warning').removeClass('hidden');
		            }
		        };
		    });
		    try {
		        hljs.initHighlightingOnLoad();
		    } catch (err) {}
		</script>
		<!-- /Parsley -->

		<!-- Autosize -->
		<script>
		    $(document).ready(function() {
		        autosize($('.resizable_textarea'));
		    });
		</script>
		<!-- /Autosize -->

		<!-- jQuery autocomplete -->
		<script>
		    $(document).ready(function() {
		        var countries = { AD:"Andorra",A2:"Andorra Test",AE:"United Arab Emirates",AF:"Afghanistan",AG:"Antigua and Barbuda",AI:"Anguilla",AL:"Albania",AM:"Armenia",AN:"Netherlands Antilles",AO:"Angola",AQ:"Antarctica",AR:"Argentina",AS:"American Samoa",AT:"Austria",AU:"Australia",AW:"Aruba",AX:"Åland Islands",AZ:"Azerbaijan",BA:"Bosnia and Herzegovina",BB:"Barbados",BD:"Bangladesh",BE:"Belgium",BF:"Burkina Faso",BG:"Bulgaria",BH:"Bahrain",BI:"Burundi",BJ:"Benin",BL:"Saint Barth&eacute;lemy",BM:"Bermuda",BN:"Brunei",BO:"Bolivia",BQ:"British Antarctic Territory",BR:"Brazil",BS:"Bahamas",BT:"Bhutan",BV:"Bouvet Island",BW:"Botswana",BY:"Belarus",BZ:"Belize",CA:"Canada",CC:"Cocos [Keeling] Islands",CD:"Congo - Kinshasa",CF:"Central African Republic",CG:"Congo - Brazzaville",CH:"Switzerland",CI:"Côte d’Ivoire",CK:"Cook Islands",CL:"Chile",CM:"Cameroon",CN:"China",CO:"Colombia",CR:"Costa Rica",CS:"Serbia and Montenegro",CT:"Canton and Enderbury Islands",CU:"Cuba",CV:"Cape Verde",CX:"Christmas Island",CY:"Cyprus",CZ:"Czech Republic",DD:"East Germany",DE:"Germany",DJ:"Djibouti",DK:"Denmark",DM:"Dominica",DO:"Dominican Republic",DZ:"Algeria",EC:"Ecuador",EE:"Estonia",EG:"Egypt",EH:"Western Sahara",ER:"Eritrea",ES:"Spain",ET:"Ethiopia",FI:"Finland",FJ:"Fiji",FK:"Falkland Islands",FM:"Micronesia",FO:"Faroe Islands",FQ:"French Southern and Antarctic Territories",FR:"France",FX:"Metropolitan France",GA:"Gabon",GB:"United Kingdom",GD:"Grenada",GE:"Georgia",GF:"French Guiana",GG:"Guernsey",GH:"Ghana",GI:"Gibraltar",GL:"Greenland",GM:"Gambia",GN:"Guinea",GP:"Guadeloupe",GQ:"Equatorial Guinea",GR:"Greece",GS:"South Georgia and the South Sandwich Islands",GT:"Guatemala",GU:"Guam",GW:"Guinea-Bissau",GY:"Guyana",HK:"Hong Kong SAR China",HM:"Heard Island and McDonald Islands",HN:"Honduras",HR:"Croatia",HT:"Haiti",HU:"Hungary",ID:"Indonesia",IE:"Ireland",IL:"Israel",IM:"Isle of Man",IN:"India",IO:"British Indian Ocean Territory",IQ:"Iraq",IR:"Iran",IS:"Iceland",IT:"Italy",JE:"Jersey",JM:"Jamaica",JO:"Jordan",JP:"Japan",JT:"Johnston Island",KE:"Kenya",KG:"Kyrgyzstan",KH:"Cambodia",KI:"Kiribati",KM:"Comoros",KN:"Saint Kitts and Nevis",KP:"North Korea",KR:"South Korea",KW:"Kuwait",KY:"Cayman Islands",KZ:"Kazakhstan",LA:"Laos",LB:"Lebanon",LC:"Saint Lucia",LI:"Liechtenstein",LK:"Sri Lanka",LR:"Liberia",LS:"Lesotho",LT:"Lithuania",LU:"Luxembourg",LV:"Latvia",LY:"Libya",MA:"Morocco",MC:"Monaco",MD:"Moldova",ME:"Montenegro",MF:"Saint Martin",MG:"Madagascar",MH:"Marshall Islands",MI:"Midway Islands",MK:"Macedonia",ML:"Mali",MM:"Myanmar [Burma]",MN:"Mongolia",MO:"Macau SAR China",MP:"Northern Mariana Islands",MQ:"Martinique",MR:"Mauritania",MS:"Montserrat",MT:"Malta",MU:"Mauritius",MV:"Maldives",MW:"Malawi",MX:"Mexico",MY:"Malaysia",MZ:"Mozambique",NA:"Namibia",NC:"New Caledonia",NE:"Niger",NF:"Norfolk Island",NG:"Nigeria",NI:"Nicaragua",NL:"Netherlands",NO:"Norway",NP:"Nepal",NQ:"Dronning Maud Land",NR:"Nauru",NT:"Neutral Zone",NU:"Niue",NZ:"New Zealand",OM:"Oman",PA:"Panama",PC:"Pacific Islands Trust Territory",PE:"Peru",PF:"French Polynesia",PG:"Papua New Guinea",PH:"Philippines",PK:"Pakistan",PL:"Poland",PM:"Saint Pierre and Miquelon",PN:"Pitcairn Islands",PR:"Puerto Rico",PS:"Palestinian Territories",PT:"Portugal",PU:"U.S. Miscellaneous Pacific Islands",PW:"Palau",PY:"Paraguay",PZ:"Panama Canal Zone",QA:"Qatar",RE:"R&eacute;union",RO:"Romania",RS:"Serbia",RU:"Russia",RW:"Rwanda",SA:"Saudi Arabia",SB:"Solomon Islands",SC:"Seychelles",SD:"Sudan",SE:"Sweden",SG:"Singapore",SH:"Saint Helena",SI:"Slovenia",SJ:"Svalbard and Jan Mayen",SK:"Slovakia",SL:"Sierra Leone",SM:"San Marino",SN:"Senegal",SO:"Somalia",SR:"Suriname",ST:"São Tom&eacute; and Príncipe",SU:"Union of Soviet Socialist Republics",SV:"El Salvador",SY:"Syria",SZ:"Swaziland",TC:"Turks and Caicos Islands",TD:"Chad",TF:"French Southern Territories",TG:"Togo",TH:"Thailand",TJ:"Tajikistan",TK:"Tokelau",TL:"Timor-Leste",TM:"Turkmenistan",TN:"Tunisia",TO:"Tonga",TR:"Turkey",TT:"Trinidad and Tobago",TV:"Tuvalu",TW:"Taiwan",TZ:"Tanzania",UA:"Ukraine",UG:"Uganda",UM:"U.S. Minor Outlying Islands",US:"United States",UY:"Uruguay",UZ:"Uzbekistan",VA:"Vatican City",VC:"Saint Vincent and the Grenadines",VD:"North Vietnam",VE:"Venezuela",VG:"British Virgin Islands",VI:"U.S. Virgin Islands",VN:"Vietnam",VU:"Vanuatu",WF:"Wallis and Futuna",WK:"Wake Island",WS:"Samoa",YD:"People's Democratic Republic of Yemen",YE:"Yemen",YT:"Mayotte",ZA:"South Africa",ZM:"Zambia",ZW:"Zimbabwe",ZZ:"Unknown or Invalid Region" };

		        var countriesArray = $.map(countries, function(value, key) {
		            return {
		                value: value,
		                data: key
		            };
		        });

		        // initialize autocomplete with custom appendTo
		        $('#autocomplete-custom-append').autocomplete({
		            lookup: countriesArray
		        });
		    });
		</script>
		<!-- /jQuery autocomplete -->

		<!-- Starrr -->
		<script>
		    $(document).ready(function() {
		        $(".stars").starrr();

		        $('.stars-existing').starrr({
		            rating: 4
		        });

		        $('.stars').on('starrr:change', function (e, value) {
		            $('.stars-count').html(value);
		        });

		        $('.stars-existing').on('starrr:change', function (e, value) {
		            $('.stars-count-existing').html(value);
		        });
		    });
		</script>
		<!-- /Starrr -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="{{ asset('cropper/js/jquery.min.js') }}"></script>
    <script src="{{ asset('cropper/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('cropper/js/cropper.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script >
    	$(document).on('click', "#mainSlideImage", function() {
            $("#image").attr('src', $(this).attr('src'));

            var blobURL = $(this).attr('src');

            $("#image").one('built.cropper', function () {}).cropper('reset', true).cropper('clear').cropper('replace', blobURL);
        });

        $(document).on('click', ".imageSwitch", function(e) {
            e.preventDefault();

            $("#image").attr('data-imageid', $(this).attr('data-imageIDgive'));

            $("#mainSlideImage").attr('src', $(this).attr('href'));

                return false;
        });


    $(document).on('click', "#saveCroppedImage", function() {

            $("#loadingSaveImage").show();
            $("#saveCroppedImage").hide();

                    $.ajax({
                        url: $("#saveCroppedImageUrl").val(),
                        type: "POST",
                        data: {
                            imageData: $("#download").attr('href'),
                            _token: $('#tokenId').val(),
                            imageID: $("#image").attr('data-imageid')
                        },
                        success: function(response) {
                            window.close();
                           /* $("#mainSlideImage").attr('src', response);

                            $("#loadingSaveImage").hide();

                            $("#closeModalsID").trigger('click');
                            $("#closeBGModal").trigger('click');

                            $('#imageCropModal').modal('hide');
                            $('#getCroppedCanvasModal').modal('hide');*/
                            $('#getCroppedCanvasModal').modal('hide');
                            $("#loadingSaveImage").hide();
                            $("#saveCroppedImage").show();
                        }
                    });
                });

    </script>
    <script type="text/javascript" src="http://assets.freshdesk.com/widget/freshwidget.js"></script>
<script type="text/javascript">
    FreshWidget.init("", {"queryString": "&widgetType=popup&formTitle=Utilisez+le+bouton+photo", "utf8": "✓", "widgetType": "popup", "buttonType": "text", "buttonText": "Reporter un problème à l'aide d'une capture de l'écran.", "buttonColor": "white", "buttonBg": "#204489", "alignment": "1", "offset": "600px", "formHeight": "500px", "url": "https://prediseo.freshdesk.com"} );
</script>
	</body>
</html>