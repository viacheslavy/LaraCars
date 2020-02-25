<style type="text/css">
    .gif-image{float:right;display:block;width:16px;margin-top:-19px;}
    .select-box{width:110%;}
</style>
<div class="container-fluid sorting">
    <div class="container">
        <div class="sorting-text-up">
            <div class="col-xs-12">
                <h1>Notre catalogue 2017</h1>
            </div>
        </div>
        <hr>
        <div class="sorting-down">
            <p>Crit&egrave;re de recherche:</p>
            <form action="{{ route('get.search') }}" method="GET">
                {{ csrf_field() }}
                <div class="sorting-down-one">
                    <p>Marque</p>
                    <select id="proizvodjacSearch" name="brand">
                    <option value="" data-modelcode="00"></option>
                    @if ( !empty($makedetails) )
                        @foreach($makedetails as $make)
                            <option value="{{ $make->name }}" data-modelcode="{{ $make->id }}"@if(\Request::get('brand') == $make->name) selected @endif>{{$make->name}}</option>
                        @endforeach
                    @endif    
                    </select>
                </div>
                <div class="sorting-down-one">
                    <p>Mod&egrave;le</p>
                    <select name="model" id="modelSearch">
                        <option value=""></option>
                    </select>
                    <div id="ajaxLoader" style="display:none" class="select-box">
                        <img src="{{url('/images/ajax-loader.gif')}}" alt="loading..." class="gif-image">
                    </div>
                    <input type="hidden" value="{{ \Request::get('model') }}" id="selectThisModel">
                    <input type="hidden" id="model_jsonSearch" value="models/">
                </div>
                <div class="sorting-down-one">
                    <p>Ann&eacute;e min.</p>
                    <select name="year1">
                        <option value=""></option>
                        @if(\Request::get('year1'))
                            <option value="{{ \Request::get('year1') }}" selected>{{ \Request::get('year1') }}</option>
                        @endif
                        {{ $start = date("Y") }}
                        {{$end = date("Y") - 150 }}
                        @while ($start > $end)
                            <option value="{{ $start }}">{{ $start }}</option>
                            {{$start--}}
                        @endwhile
                    </select>
                </div>
                <div class="sorting-down-one">
                    <p>Ann&eacute;e max.</p>
                    <select name="year2">
                        <option value=""></option>

                        @if(\Request::get('year2'))
                            <option value="{{ \Request::get('year2') }}" selected>{{ \Request::get('year2') }}</option>
                        @endif
                        {{ $start = date("Y") }}
                        {{$end = date("Y") - 150 }}
                        @while ($start > $end)
                            <option value="{{ $start }}">{{ $start }}</option>
                            {{$start--}}
                        @endwhile
                    </select>
                </div>
                <div class="sortit-small">
                    <p>&nbsp;</p>
                    <select name="sortby">
                        <option value="" selected="" disabled="">Triez par</option>
                        <option value="price|asc">Prix: plus bas</option>
                        <option value="price|desc">Prix: plus haut</option>
                        <option value="mileage|asc">Kilom&egrave;tres: plus bas</option>
                        <option value="mileage|desc">Kilom&egrave;tres: plus haut</option>
                        <option value="year|asc">Ann&eacute;e: plus bas</option>
                        <option value="year|desc">Ann&eacute;e: plus haut</option>
                    </select>
                </div>
                <button class="search-btn">Rechercher</button>
                @if(\Request::get('brand'))
                    <a style="float:right" class="resetSearch" href="{{ route('get.index') }}">R&eacute;initialiser</a>
                @endif
            </form>
        </div>
    </div>
</div>