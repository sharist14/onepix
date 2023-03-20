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