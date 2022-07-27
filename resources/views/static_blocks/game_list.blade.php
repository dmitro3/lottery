<div class="home-com">
    <div class="van-tabs van-tabs--line home-tab action">
        <div class="van-tabs__wrap van-hairline--top-bottom">
            <div role="tablist" class="van-tabs__nav van-tabs__nav--line" style="justify-content: center;">
                <div role="tab" aria-selected="true" class="van-tab van-tab--active">
                    <span class="van-tab__text van-tab__text--ellipsis">
                        <div>
                            <img src="theme/frontend/images/CP.f775f9f6.png" class="img">
                        </div>
                    </span>
                </div>
            </div>
        </div>
        <div class="van-tabs__content">
            <div role="tabpanel" class="c-row-between van-tab__pane">
                <div class="gameList m-t-20">
                    @foreach($homeGames as $game)
                    <a href="{{$game->link}}" class="item m-b-20">
                        <div class="info {{$game->color}}">
                            <div class="name"> {{$game->name}} </div>
                            <div class="des"> {{$game->description}} </div><img width="120px" height="85px" src="{%IMGV2.game.img.-1%}" class="img m-r-5">
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>