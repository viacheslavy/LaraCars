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
</head>

<body class="nav-md">

<?php
$notifications = \App\Notification::where('date', date("Y-m-d"))->get();
?>

@if($notifications->count())
    <div style="width: 350px; position: fixed; bottom: 0; right: 0;margin-right: 10px; z-index: 999999">
    @foreach($notifications as $notification)
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{ $notification->title }}</strong> <br>
            <p>{{ $notification->notification }}</p>
        </div>
    @endforeach
    </div>
@endif


<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">

                    <a href="/" class="site_title"><i class="fa fa-paw"></i> <span>Admin panel</span></a>

                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile">
                    <div class="profile_pic">
                        <img src="{{ asset('admin_assets/images/img.jpg') }}" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <!-- <h2>John Doe</h2> -->
                        <h2>{{ Auth::user()->name }}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                            <li><a href="{{ route('get.add.cars') }}"><i class="fa fa-home"></i> Home</a></li>
                            <li><a href="{{ route('get.admins') }}"><i class="fa fa-user"></i> Admin</a></li>
                            <li><a href="{{ route('get.users') }}"><i class="fa fa-user"></i> User</a>
                            </li>
                            <li><a href="{{ route('get.make.cars') }}"><i class="fa fa-life-ring"></i> Marque</a>
                            </li>
                            <li><a href="{{ route('get.model.cars') }}"><i class="fa fa-life-ring"></i> Mod&egrave;le</a>
                            </li>
                            <li><a href="{{ route('get.contacts') }}"><i class="fa fa-phone"></i> Contacts</a></li>
                            <li><a><i class="fa fa-car"></i> Gestionnaire de voiture <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ route('get.add.cars') }}">Add Cars</a></li>
                                    <li><a href="{{ route('get.view.cars') }}">View Cars</a></li>
                                    <li><a href="{{ route('get.jewel.cars') }}">Jewels</a></li>
                                    <li><a href="{{ url('cpanel/price/pricemanager') }}">Gestionnaire de prix</a></li>
                                    {{--<li><a href="price-manager.html">Price Manager</a></li>--}}
                                </ul>
                            </li>

                            {{--<li><a><i class="fa fa-user"></i> Users <span class="fa fa-chevron-down"></span></a>--}}
                                {{--<ul class="nav child_menu">--}}
                                    {{--<li><a href="profile.html">User</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}

                            <li><a><i class="fa fa-certificate"></i> CRM <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ route('get.customers') }}">Customers</a></li>
                                    <li><a href="{{ route('get.customers.groups') }}">Groups</a></li>
                                    {{--<li><a href="inbox.html">Email Manager</a></li>--}}
                                </ul>
                            </li>
                            {{--<li><a><i class="fa fa-cog"></i> Settings <span class="fa fa-chevron-down"></span></a>--}}
                                {{--<ul class="nav child_menu">--}}
                                {{--</ul>--}}
                            {{--</li>--}}

                            <li><a><i class="fa fa-bell" aria-hidden="true"></i> Notifications <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ route('get.notifications') }}">Notifications</a></li>
                                    <li><a href="{{ route('get.notifications.new') }}">Create New</a></li>
                                    {{--<li><a href="inbox.html">Email Manager</a></li>--}}
                                </ul>
                            </li>

                            <li><a><i class="fa fa-shopping-cart"></i> Paiement <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ url('/cpanel/orders/type') }}">Type</a></li>
                                    <li><a href="{{ url('/cpanel/orders') }}">Commandes</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('get.gatewayclassiccars') }}"><i class="fa fa-life-ring"></i> GateWay ClassicCars</a>
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->

                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('admin_assets/images/img.jpg') }}" alt="">{{ Auth::user()->name }}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                {{--<li><a href="javascript:;"> Profile</a></li>--}}
                                {{--<li>--}}
                                    {{--<a href="javascript:;">--}}
                                        {{--<span class="badge bg-red pull-right">50%</span>--}}
                                        {{--<span>Settings</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li><a href="javascript:;">Help</a></li>--}}
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown">
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <li>
                                    <a>
                                        <span class="image"><img src="{{ asset('admin_assets/images/img.jpg') }}" alt="Profile Image" /></span>
                        <span>
                          <!-- <span>John Smith</span> -->
                          <span>{{ Auth::user()->name }}</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="{{ asset('admin_assets/images/img.jpg') }}" alt="Profile Image" /></span>
                        <span>
                          <!-- <span>John Smith</span> -->
                          <span>{{ Auth::user()->name }}</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="{{ asset('admin_assets/images/img.jpg') }}" alt="Profile Image" /></span>
                        <span>
                         <!--  <span>John Smith</span> -->
                         <span>{{ Auth::user()->name }}</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="{{ asset('admin_assets/images/img.jpg') }}" alt="Profile Image" /></span>
                        <span>
                         <!--  <span>John Smith</span> -->
                         <span>{{ Auth::user()->name }}</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="text-center">
                                        <a>
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->



            @yield('content')


        <!-- footer content -->
        <footer>
            <div class="pull-right">

            </div>
            <div class="clearfix"></div>
        </footer>
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


@yield('scripts')
</body>
</html>