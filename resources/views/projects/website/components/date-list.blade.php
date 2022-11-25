<div class="row">
    @for($i = 1; $i <= 10; $i++)
        <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6">
            <a href="#" onclick="changeDateHandler('{{ date ('d/m/Y', strtotime ("+{$i} day")) }}')" class="date-menu-link" @if(!in_array(date ('Y-m-d', strtotime ("+{$i} day")), $available_dates)) style="pointer-events: none; opacity: 0.6;" @endif>
                <p class="m-0">{{ date ('d', strtotime ("+{$i} day")) }}</p>
                <p class="m-0 text-uppercase">{{ date ('D', strtotime ("+{$i} day")) }}</p>
            </a>
        </div>
    @endfor
</div>
