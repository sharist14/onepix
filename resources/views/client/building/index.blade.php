@extends('client.layouts.index_core')

@section('content')
    <main class="main">
        <div class="container">
            <div class="page-top">
                <nav class="page-breadcrumb" itemprop="breadcrumb">
                    <a href="/">Главная</a>
                    <span class="breadcrumb-separator"> > </span>

                    Новостройки
                </nav>
            </div>


            <div class="page-section">

                <div class="page-content">
                    <div style="margin: 10px 0" >Количество:  <span id="cnt_rendered">@if( isset($buildings)) {{$buildings->count()}} @else 0 @endif</span>  </div>
                    <h1 class="visuallyhidden">Новостройки</h1>
                    <div class="page-loop__wrapper loop tab-content tab-content__active">
                        @if( isset($buildings) && $buildings->count() )
                            <ul id="building_list" class="page-loop with-filter">
                                @foreach($buildings as $building)
                                    <li class="page-loop__item wow animate__animated animate__fadeInUp"
                                        data-wow-duration="0.8s">

                                        <a href="#" class="favorites-link favorites-link__add" title="Добавить в Избранное"
                                           role="button">
                                            <span class="icon-heart"><span class="path1"></span><span
                                                        class="path2"></span></span>
                                        </a>

                                        <a href="#" class="page-loop__item-link">

                                            <div class="page-loop__item-image">

                                                <img src="/img/preview/{{$building->image_preview}}" alt="">

                                                <div class="page-loop__item-badges">
                                                    <span class="badge">Услуги 0%</span>
                                                    <span class="badge">Комфорт+</span>
                                                </div>

                                            </div>

                                            <div class="page-loop__item-info">

                                                <h3 class="page-title-h3">{{$building->title}}</h3>

                                                <p class="page-text">Срок сдачи: {{ ceil(date('n', strtotime($building->start_time)) / 3) }} кв. {{ date('Y', strtotime($building->start_time)) }} г.</p>
                                                <p class="page-text">Класс жилья: {{ $building->housingName->title }}</p>
                                                <p class="page-text"> <span class="hint_masteropt" title="@foreach($building->getMasteroptions as $opt)- {{$opt->title}}&#013;@endforeach">Основные опции</span> </p>

                                                <p class="page-text"> <span class="hint_secondopt" title="@foreach($building->getSecondoptions as $opt)- {{$opt->title}}&#013;@endforeach">Доп. опции</span> </p>

                                                <p>
                                                </p>

                                                <div class="page-text to-metro">
                                                    <span class="icon-metro icon-metro--red"></span>
                                                    <span class="page-text">Студенческая <span> {{$building->metro_distance}} мин.</span></span>
                                                    <span class="icon-walk-icon"></span>
                                                </div>

                                                <span class="page-text text-desc">{{$building->address}}</span>

                                            </div>
                                        </a>
                                    </li>
                                @endforeach

                            </ul>

                            <div class="show-more">
                                <button id="load_more" class="show-more__button">
                                    <span class="show-more__button-icon"></span>
                                    Показать еще
                                </button>
                            </div>

                        @else
                            <div class="alert alert-warning">
                                Отсутствуют недвижимость по выбранным фильтрам.
                            </div>
                        @endif
                    </div>
                </div>

                <div class="page-filter fixed">
                    <div class="page-filter__wrapper">
                        <form id="page-filter" class="page-filter__form" action="{{ route('client.building.index')}}" method="POST">
                            @csrf
                            <div class="page-filter__body">
                                <div class="page-filter__category">

                                    <a href="#proximity" class="page-filter__category-link" data-toggle="collapse">
                                        <h3 class="page-title-h3">Близость к метро</h3>
                                        <svg width="13" height="8" viewBox="0 0 13 8" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                    d="M6.036 0.611083L0.191897 6.45712C-0.0639745 6.71364 -0.0639745 7.12925 0.191897 7.38642C0.44777 7.64294 0.863375 7.64294 1.11925 7.38642L6.49964 2.00408L11.88 7.38577C12.1359 7.64229 12.5515 7.64229 12.808 7.38577C13.0639 7.12925 13.0639 6.713 12.808 6.45648L6.96399 0.610435C6.71076 0.357856 6.28863 0.357856 6.036 0.611083Z"
                                                    fill="#111111"/>
                                        </svg>
                                    </a>

                                    <div class="page-filter__category-list collapse show" id="proximity">
                                        <ul class="proximity">
                                            <li>
                                                <div class="checkbox">
                                                    <input type="checkbox" name="metro_distance[]" value="10" id="less10" @if(isset($filter["metro_distance"]) && in_array(10, $filter["metro_distance"])) checked @endif>
                                                    <label for="less10">&lt;10</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox">
                                                    <input type="checkbox" name="metro_distance[]" value="20" id="10-20" @if(isset($filter["metro_distance"]) && in_array(20, $filter["metro_distance"])) checked @endif>
                                                    <label for="10-20">10-20</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox">
                                                    <input type="checkbox" name="metro_distance[]" value="40" id="20-40" @if(isset($filter["metro_distance"]) && in_array(40, $filter["metro_distance"])) checked @endif>
                                                    <label for="20-40">20-40</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox">
                                                    <input type="checkbox" name="metro_distance[]" value="41" id="more40" @if(isset($filter["metro_distance"]) && in_array(41, $filter["metro_distance"])) checked @endif>
                                                    <label for="more40">40+</label>
                                                </div>
                                            </li>
                                            <li class="w-100">
                                                <div class="checkbox">
                                                    <input type="checkbox" name="metro_distance[]" value="0" id="any" @if( (isset($filter["metro_distance"][0]) && in_array(0, $filter["metro_distance"]) && count($filter["metro_distance"]) == 1) || !isset($filter["metro_distance"]) ) checked @endif>
                                                    <label for="any">Любой</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                </div>

                                <div class="page-filter__category">

                                    <a href="#deadline" class="page-filter__category-link" data-toggle="collapse">
                                        <h3 class="page-title-h3">Срок сдачи</h3>
                                        <svg width="13" height="8" viewBox="0 0 13 8" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                    d="M6.036 0.611083L0.191897 6.45712C-0.0639745 6.71364 -0.0639745 7.12925 0.191897 7.38642C0.44777 7.64294 0.863375 7.64294 1.11925 7.38642L6.49964 2.00408L11.88 7.38577C12.1359 7.64229 12.5515 7.64229 12.808 7.38577C13.0639 7.12925 13.0639 6.713 12.808 6.45648L6.96399 0.610435C6.71076 0.357856 6.28863 0.357856 6.036 0.611083Z"
                                                    fill="#111111"/>
                                        </svg>
                                    </a>

                                    <div class="page-filter__category-list collapse show" id="deadline">
                                        <ul class="deadline">
                                            <li>
                                                <div class="radio">
                                                    <input type="radio" name="deadline" id="all" value="all" @if( (isset($filter["deadline"]) && $filter["deadline"] == 'all') || !isset($filter["deadline"]) ) checked @endif>
                                                    <label for="all">Любой</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="radio">
                                                    <input type="radio" name="deadline" id="passed" value="passed"  @if( isset($filter["deadline"]) && $filter["deadline"] == 'passed' ) checked @endif>
                                                    <label for="passed">Сдан</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="radio">
                                                    <input type="radio" name="deadline" id="this-year" value="this-year" @if( isset($filter["deadline"]) && $filter["deadline"] == 'this-year' ) checked @endif>
                                                    <label for="this-year">В этом году</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="radio">
                                                    <input type="radio" name="deadline" id="next-year" value="next-year" @if( isset($filter["deadline"]) && $filter["deadline"] == 'next-year' ) checked @endif>
                                                    <label for="next-year">В следующем году</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                </div>

                                <div class="page-filter__category">

                                    <a href="#housing" class="page-filter__category-link" data-toggle="collapse">
                                        <h3 class="page-title-h3">Класс жилья</h3>
                                        <svg width="13" height="8" viewBox="0 0 13 8" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                    d="M6.036 0.611083L0.191897 6.45712C-0.0639745 6.71364 -0.0639745 7.12925 0.191897 7.38642C0.44777 7.64294 0.863375 7.64294 1.11925 7.38642L6.49964 2.00408L11.88 7.38577C12.1359 7.64229 12.5515 7.64229 12.808 7.38577C13.0639 7.12925 13.0639 6.713 12.808 6.45648L6.96399 0.610435C6.71076 0.357856 6.28863 0.357856 6.036 0.611083Z"
                                                    fill="#111111"/>
                                        </svg>
                                    </a>

                                    <div class="page-filter__category-list collapse show" id="housing">
                                        <ul class="housing">
                                            <li>
                                                <div class="checkbox">
                                                    <input type="checkbox" id="economical" name="housing[]" value="economical"  @if( (isset($filter["housing"]) && in_array('economical', $filter["housing"])) || !isset($filter["housing"]) ) checked @endif >
                                                    <label for="economical">Эконом</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox">
                                                    <input type="checkbox" id="comfort" name="housing[]" value="comfort" @if( (isset($filter["housing"]) && in_array('comfort', $filter["housing"])) || !isset($filter["housing"]) ) checked @endif >
                                                    <label for="comfort">Комфорт</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox">
                                                    <input type="checkbox" id="business" name="housing[]" value="business" @if( (isset($filter["housing"]) && in_array('business', $filter["housing"])) || !isset($filter["housing"]) ) checked @endif >
                                                    <label for="business">Бизнес</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox">
                                                    <input type="checkbox" id="elite" name="housing[]" value="elite" @if( (isset($filter["housing"]) && in_array('elite', $filter["housing"])) || !isset($filter["housing"]) ) checked @endif >
                                                    <label for="elite">Элит</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                </div>

                                <div class="page-filter__category">

                                    <a href="#general" class="page-filter__category-link" data-toggle="collapse">
                                        <h3 class="page-title-h3">Основные опции</h3>
                                        <svg width="13" height="8" viewBox="0 0 13 8" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                    d="M6.036 0.611083L0.191897 6.45712C-0.0639745 6.71364 -0.0639745 7.12925 0.191897 7.38642C0.44777 7.64294 0.863375 7.64294 1.11925 7.38642L6.49964 2.00408L11.88 7.38577C12.1359 7.64229 12.5515 7.64229 12.808 7.38577C13.0639 7.12925 13.0639 6.713 12.808 6.45648L6.96399 0.610435C6.71076 0.357856 6.28863 0.357856 6.036 0.611083Z"
                                                    fill="#111111"/>
                                        </svg>
                                    </a>

                                    <div class="page-filter__category-list collapse show" id="general">
                                        <ul class="general">
                                            @foreach($master_options as $option)
                                                <li>
                                                    <div class="checkbox">
                                                        <input type="checkbox" id="master_opt_{{ $option->id }}" name="master_opt[]" value="{{ $option->id }}" @if( isset($filter["master_opt"]) && in_array($option->id, $filter["master_opt"])) ) checked @endif>
                                                        <label for="master_opt_{{ $option->id }}">{{ $option->title }}</label>
                                                        <span class="{{ $option->icon }}"></span>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                </div>

                                <div class="page-filter__category">

                                    <a href="#additional" class="page-filter__category-link" data-toggle="collapse">
                                        <h3 class="page-title-h3">Дополнительные опции</h3>
                                        <svg width="13" height="8" viewBox="0 0 13 8" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                    d="M6.036 0.611083L0.191897 6.45712C-0.0639745 6.71364 -0.0639745 7.12925 0.191897 7.38642C0.44777 7.64294 0.863375 7.64294 1.11925 7.38642L6.49964 2.00408L11.88 7.38577C12.1359 7.64229 12.5515 7.64229 12.808 7.38577C13.0639 7.12925 13.0639 6.713 12.808 6.45648L6.96399 0.610435C6.71076 0.357856 6.28863 0.357856 6.036 0.611083Z"
                                                    fill="#111111"/>
                                        </svg>
                                    </a>

                                    <div class="page-filter__category-list collapse show" id="additional">
                                        <ul class="additional">
                                            @foreach($second_options as $key => $option)
                                                @if($key < 5)
                                                    <li>
                                                        <div class="checkbox">
                                                            <input type="checkbox" name="second_opt[]" id="second_opt_{{ $option->id }}" value="{{ $option->id }}" @if( isset($filter["second_opt"]) && in_array($option->id, $filter["second_opt"])) checked @endif>
                                                            <label for="second_opt_{{ $option->id }}">{{ $option->title }}</label>
                                                        </div>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <div class="collapse" id="additional_collapse">
                                            <ul class="additional additional__collapse">
                                                @php $collapse_cnt = 0; @endphp
                                                @foreach($second_options as $key => $option)
                                                    @if($key >= 5)
                                                        @php $collapse_cnt++; @endphp
                                                        <li>
                                                            <div class="checkbox">
                                                                <input type="checkbox" name="second_opt[]" id="second_opt_{{ $option->id }}" value="{{ $option->id }}" @if( isset($filter["second_opt"]) && in_array($option->id, $filter["second_opt"])) ) checked @endif>
                                                                <label for="second_opt_{{ $option->id }}">{{ $option->title }}</label>
                                                            </div>
                                                        </li>
                                                    @endif
                                            @endforeach
                                            </ul>
                                        </div>
                                        <a href="#additional_collapse" class="page-filter__category-more"
                                           data-toggle="collapse" data-count="{{$collapse_cnt}}"
                                           role="button">Показать еще ({{$collapse_cnt}})</a>

                                    </div>

                                </div>

                                <div class="page-filter__category service">

                                    <div class="checkbox">
                                        <input type="checkbox" name="free_service" id="service" @if( isset($filter["free_service"]) ) checked @endif>
                                        <label for="service"><span class="checkbox__box"></span>Услуги 0%</label>
                                        <span class="tip tip-info" data-toggle="popover" data-placement="top"
                                              data-content="And here's some amazing content. It's very engaging. Right?">
                                            <span class="icon-prompt"></span>
                                        </span>
                                    </div>

                                </div>

                            </div>

                            <div class="page-filter__buttons">

                                <button class="button button--pink w-100" type="submit" id="apply_filter">Применить
                                    фильтры
                                </button>

                                <button class="button w-100" type="reset" id="reset_filter" onclick="location.href='{{ route("client.building.index") }}';">Сбросить фильтры
                                    <svg width="9" height="8" viewBox="0 0 9 8" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M8.5 0.942702L7.5573 0L4.49999 3.05729L1.4427 0L0.5 0.942702L3.55729 3.99999L0.5 7.0573L1.4427 8L4.49999 4.94271L7.55728 8L8.49998 7.0573L5.44271 3.99999L8.5 0.942702Z"/>
                                    </svg>
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>

    </main>

<script>
    $(function(){
        var page = 1;
        $("#load_more").on("click", function (e) {
            var form = $('#page-filter');
            var actionUrl = form.attr('action');
            page++;

            $.ajax({
                type: "POST",
                url: actionUrl + '?page=' + page,
                data: form.serialize(),
                success: function(data)
                {
                    console.log(data);
                    if(data.cnt > 0){
                        $('#building_list').append(data.html);

                        cnt_rendered(data.cnt);
                    } else {
                        hide_loadmore();
                    }
                }
            });
        });
    });

    function hide_loadmore(){
        $('.show-more').hide();
    }

    function cnt_rendered(cnt = 0){
        var old_cnt = parseInt($('#cnt_rendered').text());
        var new_cnt = parseInt(cnt);

        $('#cnt_rendered').text(old_cnt + new_cnt);
    }
</script>
@endsection