<div class="navbar">
    <div class="navbar-left">
        <div class="c-row c-row-middle-center">
            <img src="theme/frontend/img/back.c3244ab0.png" class="navbar-back">
        </div>
    </div>
    <div class="navbar-title">
        <div class="c-row c-row-middle-center">
            <img height="38px" width="100px" src="theme/frontend/img/headlogo.png" class="logo">
        </div>
    </div>
    <div class="navbar-right">
        <div class="c-row navbarR">
            <div class="c-row item c-row-middle-center">
                <img src="theme/frontend/img/audio.40994602.png" class="item-audio">
            </div>
            <div class="c-row item c-row-middle-center" id="switch_audio" onclick="WINDLOAD.switchAudio(this)">
                @if ($activeAudio)
                    <img src="theme/frontend/img/volume-up-line.png" class="item-volume">
                @else
                    <img src="theme/frontend/img/volume-off-outline.png" class="item-volume">
                @endif
            </div>
        </div>
    </div>
</div>
<div class="game-head">
    <div class="total-box">
        <div class="c-row c-row-between c-row-middle info">
            <div class="c-row c-row-middle">
                <div class="m-r-10">
                    <div class="van-image" style="width: 60px; height: 60px;">
                        <img src="theme/frontend/img/icon_wallet.86908b64.png" class="van-image__img">
                    </div>
                </div>
                <div>
                    <h3 class="total m-b-5">Tổng</h3><span class="wallet">Số dư ví tiền</span>
                </div>
            </div>
            <div class="c-row c-row-middle">
                <div class="num">
                    <span> 0.00 ₫</span>
                </div>
                <div class="van-image img m-l-10" style="width: 15px; height: 15px;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACIAAAAiCAYAAAFNQDtUAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAIqADAAQAAAABAAAAIgAAAAACeqFUAAAFEElEQVRYCbWYa2ibVRjH86aRpUSxkc2pqCA6wXvZ+sXpJl7q3FCcrAjGbeCnMi8xxfW2L36qbdLSlrJO0C/OjSkqU9HZVikyLxMvc471k58UhFmrqLQmhTaJv/+7nMObW5OG5cDJ85zn8n+e85zL+77x+XJtYGBgwfBFtL+/P1skdAWFmng8fou1lBLcu7yCXQheK3LFLWqtLIP/hB0YRqCFUX2FAnmCGXOdEonEo8a7FJWzP51Of1RKmScbGhpaC9pTzGFfnoKBScHxKhCechznhmw2e2tvb+/fVidrUO6wAg+CD8V7XoWXd5MFbpdX6OUJt8c7Ls0TIlNa4/ONjo6u9xMibyZe41Qq9btvcHAwZObsVYKc1Nh6IzgO2hOu0HHSPT09gTwDDdQw/ADDx8Uzi58gP9LXI9sO9dMlbwLgX/FqNkoulQWqfNkFVflfAm0F9GQgENi8vLx8ygXJAWwE4Ex512KNrQHMGyB/U2xSnURAAeY3SFrlj2IFrIaGhkiAuc0sLS3J1Nangp9Vk8VUJpO5z6020r+UFtPabC0qMNguMotmVimYF91UHWWW/mR3d7fd5QQJg3uUvoM+xyJcaeLkgRjhyMhI0+LiYpzxQ/RrAJyhHwT0sLHx0jwQjvBVnPfzMsApDZmkz9I3UTtzX71FFhFktlkQpvIihqM4TzBPpVzUOB93srnOKoDZ8jJyQXQl6cZBuQXlV0XeBQLqM49I2+M49GZ3dXIAz1cDILzc0QiSeYTe4mcaR6QAYFx0Fa3F2Oqi2E1aTxtBtZRsThtb9z4gi2NGsBpK8O+w1/65CI2aHKgVRhenrkXVpG9sbGxdLUDs6vOsbJ+7xMlksuR2rgRMAk44HD7ggjDQ/bmqRhk+xSHT3t6edEGo8p/swlS1KADcS+BWLrOr5SOQNpZ4HUBrAPqvEhCP72cB+BL7WGdn5x+ytwdQAyL8isH1GJyA7mFD2ecrzm3cYu+6To6zk8AfilfLA5GAJbubk/oFrLsRJfO0omtAuiIQj4NlOeXNLGUPGbaRYYNVrMBgq4v7Yy7yONP+dgVTV1U2EUqwk6Cv09fKEmDY7Am/33+Y0kx7y+UNwtqEsXkQm2eQ27sN/1+Q7+7q6vraa2/4okT0/gXISM4gCcB+1uFV41ALzW2KISbSqAmBEQHzbZ06Ym0LhUInbSI6jryqnMNIuy5F9q3lsq8lGfmwxFtYYp2VIH2OOCrzhYrLgF16G+QcQummyPYRyevRFIMKTUFbvfj+8fHxSxGckQF0sp5JKLCKQIyHYVUZ2/zz8/OvkMQlMmCt9lpNnZnGxsa9imnC+IPBYB+D/SRzUzQanTOKetNYLDbL0b6RZF6m317veFXjO2zUn6nGBrL6nLV7oGrPi2DInaNXoHvoY3p4bhAm9H5286pfLORbSyOWPpyUhDbwpPvYM0BcLkc56xvNuF6UJFqI9WYO/wgrMZGXiBRcOKdZrufqmESUJL4XPpV4h0eFe1Id1ukHZJsQHuM2PYTRNMu0BtkCsu1kW/FVVqCVGpPbis0nYIdkC/YOVcL42SveCERJ7iVIgu5WDCc5dOOoR0DVTS/uVDhB8G3Gicm+wKfFQTM2tGQiRsksLoc/BFDEyERJTJ8cM/Tf6PrsEI4+eK7FVv8J5C059u9zX+3T3YGuZFsxkUKP4eHhK/g+fAy53tGa6dcRpInxMvwsvF63zsJ/RuDpjo6Ofwoxyo3/B6WpYSCCoW6IAAAAAElFTkSuQmCC" class="van-image__img"></div>
            </div>
        </div>
        <div class="total-btn c-row c-row-between">
            <div class="item">
                <button class="btn van-button van-button--default van-button--normal van-button--block van-button--round" style="color: rgb(255, 255, 255); background: rgb(255, 206, 31); border-color: rgb(255, 206, 31);">
                    <div class="van-button__content">
                        <span class="van-button__text"> RÚT TIỀN </span>
                    </div>
                </button>
            </div>
            <div class="item">
                <button class="btn van-button van-button--default van-button--normal van-button--block van-button--round" style="color: rgb(255, 255, 255); background: rgb(242, 65, 59); border-color: rgb(242, 65, 59);">
                    <div class="van-button__content">
                        <span class="van-button__text"> NẠP TIỀN </span>
                    </div>
                </button>
            </div>
        </div>
    </div>
    <div class="m-t-15 notice">
        <div role="alert" class="van-notice-bar">
            <i class="van-icon van-icon-volume-o van-notice-bar__left-icon"></i>
            <div role="marquee" class="van-notice-bar__wrap">
                <div class="van-notice-bar__content">Chào mừng bạn đến với chúng tôi. Chúc bạn có những giờ chơi vui vẻ và may mắn.</div>
            </div>
        </div>
    </div>
</div>