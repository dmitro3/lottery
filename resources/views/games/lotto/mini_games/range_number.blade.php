<div class="navv types">
    @foreach ($types as $k=> $type)
        <label type="button" class="type type_js nav-item" data-state="{{$k==0?'true':'false'}}" {{$k==0?'checked':''}} id="{{$type->code}}" data-target="#panel-{{$type->code}}" data-max="2">
            <input type="radio" name="type" class="dnone" value="{{$type->id}}">
            {{$type->name}}
        </label>    
    @endforeach
    
</div>
<div class="tab_panel">
    @foreach ($types as $k=> $type)
    <div class="panel" data-state="{{$k==0?'show':'hide'}}" id="panel-{{$type->code}}">
        <span class="question">
            <img style="pointer-events: none" src="theme/frontend/lotto/images/question.svg"/>
        </span>
        <div class="s-content">
            {!!$type->content!!}
        </div>
        <div class="ls_number">
            {!!$type->getTypeGame()->renderHtml()!!}
        </div>
    </div>
    @endforeach
</div>