<style type="text/css">
	.col-mar-0 {
		margin-left: 0px;
		margin-right: 0px;
	}

	.col-mar-0>div[class^="col-"] {
		padding-left: 0px;
		padding-right: 0px;
	}

	.col-mar-5 {
		margin-left: -5px;
		margin-right: -5px;
	}

	.col-mar-5>div[class^="col-"] {
		padding-left: 5px;
		padding-right: 5px;
	}

	.col-mar-8 {
		margin-left: -8px;
		margin-right: -8px;
	}

	.col-mar-8>div[class^="col-"] {
		padding-left: 8px;
		padding-right: 8px;
	}

	.col-mar-10 {
		margin-left: -10px;
		margin-right: -10px;
	}

	.col-mar-10>div[class^="col-"] {
		padding-left: 10px;
		padding-right: 10px;
	}

	.root {
		background: #f9f9f9;
	}

	.dashboard-statistics {
		color: #333333;
		margin-bottom: 20px;
	}

	.dashboard-statistics .big-title {
		font-size: 20px;
	}

	.dashboard-statistics .overview .item-over-view,
	.dashboard-statistics .item-total {
		display: -ms-flexbox;
		display: flex;
		-ms-flex-align: start;
		align-items: center;
		justify-content: space-between;
		-webkit-transition: all 0.3s ease 0s;
		-moz-transition: all 0.3s ease 0s;
		-ms-transition: all 0.3s ease 0s;
		-o-transition: all 0.3s ease 0s;
		transition: all 0.3s ease 0s;
		border-radius: 5px;
		margin-bottom: 15px !important;
		padding: 8px !important;
		position: relative;
		z-index: 2;
		background-color: #fff !important;
		box-shadow: 0 13px 27px -5px hsl(240deg 30% 28% / 25%),
			0 8px 16px -8px hsl(0deg 0% 0% / 30%),
			0 -6px 16px -6px hsl(0deg 0% 0% / 3%);
	}

	.dashboard-statistics .overview .item-over-view:hover,
	.dashboard-statistics .item-total:hover {
		background-color: #fefefe !important;
		box-shadow: 0 13px 27px -5px hsl(240deg 30% 28% / 25%),
			0 8px 16px -8px hsl(0deg 0% 0% / 30%),
			0 -6px 16px -6px hsl(0deg 0% 0% / 3%);
	}

	.dashboard-statistics .overview .item-over-view .icon,
	.dashboard-statistics .item-total .icon {
		-webkit-transition: all 0.8s ease 0s;
		-moz-transition: all 0.8s ease 0s;
		-ms-transition: all 0.8s ease 0s;
		-o-transition: all 0.8s ease 0s;
		transition: all 0.8s ease 0s;
		font-size: 26px;
		width: 50px;
		border-radius: 50%;
		color: white;
		height: 50px;
		display: -ms-flexbox;
		display: flex;
		-ms-flex-align: start;
		align-items: center;
		justify-content: center;
		opacity: 0.8;
	}

	.dashboard-statistics .overview .item-over-view:hover .icon,
	.dashboard-statistics .item-total:hover .icon {
		transform: rotate(360deg);
		opacity: 1;
	}

	.dashboard-statistics .overview .item-over-view .content,
	.dashboard-statistics .item-total .content {
		padding-left: 15px;
		width: calc(100% - 58px);
		border-left: solid 1px #e1e1e1;
	}

	.dashboard-statistics .overview .item-over-view .name,
	.dashboard-statistics .item-total .name {
		margin-bottom: 5px;
		font-size: 16px;
		font-family: Robob;
	}

	.dashboard-statistics .overview .item-over-view a,
	.dashboard-statistics .item-total a {
		-webkit-transition: all 0.8s ease 0s;
		-moz-transition: all 0.8s ease 0s;
		-ms-transition: all 0.8s ease 0s;
		-o-transition: all 0.8s ease 0s;
	}

	.dashboard-statistics .overview .item-over-view a:hover,
	.dashboard-statistics .item-total a:hover {
		color: #fcaf17;
	}

	.dashboard-statistics .list-total-posts {
		margin-top: 15px;
		box-shadow: 0 13px 27px -5px hsl(240deg 30% 28% / 25%),
			0 8px 16px -8px hsl(0deg 0% 0% / 30%),
			0 -6px 16px -6px hsl(0deg 0% 0% / 3%);
		background: #ffffff;
	}

	.dashboard-statistics .header-list {
		padding: 35px 15px;
		background-color: #0088FF !important;
		color: white;
		font-size: 20px;
		border-radius: 5px 5px 0px 0px;
		font-family: Robob;
		text-align: center;
	}

	.dashboard-statistics .list-total {
		padding: 0px 20px 20px 20px;
		position: relative;
	}

	.dashboard-statistics .list-total:before {
		content: '';
		position: absolute;
		width: 100%;
		height: 30px;
		left: 0;
		right: 0;
		background-color: #0088FF !important;
	}

	.dashboard-statistics .item-total {
		box-shadow: none !important;
		border: solid 1px #ddd;
	}

	.dashboard-statistics .item-total .icon {
		font-size: 22px;
		width: 45px;
		height: 45px;
	}

	.dashboard-statistics .item-total:hover {
		box-shadow: none !important;
	}

	.dashboard-statistics .list-user-box {
		margin-top: 15px;
		box-shadow: 0 13px 27px -5px hsl(240deg 30% 28% / 25%),
			0 8px 16px -8px hsl(0deg 0% 0% / 30%),
			0 -6px 16px -6px hsl(0deg 0% 0% / 3%);
		background: #ffffff;
	}

	.header-list-user {
		padding: 8px 15px;
		background: #f9f9f9;
		font-size: 22px;
		border-bottom: solid 1px #ddd;
	}

	.all-table-statiscal {
		width: 100%;
		font-size: 14px;
	}

	.all-table-statiscal th {
		position: sticky;
		top: 0;
		background: #343a40 !important;
		color: #f8f9fa !important;
		padding: 8px 10px;
		white-space: nowrap;
		font-size: 16px;
		border: solid 1px #343a40;
		text-align: left;
	}

	.all-table-statiscal th:not(:last-child) {
		border-right: solid 1px #f9f9f9;
	}

	.all-table-statiscal td {
		padding: 6px 10px;
		text-align: left;
		vertical-align: middle !important;
	}

	.all-table-statiscal td {
		-webkit-transition: all 0.3s ease 0s;
		-moz-transition: all 0.3s ease 0s;
		-ms-transition: all 0.3s ease 0s;
		-o-transition: all 0.3s ease 0s;
		transition: all 0.3s ease 0s;
		border-right: solid 1px #8888;
		border-bottom: solid 1px #8888;
	}

	.all-table-statiscal td:first-child {
		border-left: solid 1px #8888;
	}

	.all-table-statiscal span {
		display: inline-block;
		padding: 1px 6px;
		border-radius: 3px;
		background: #ebebeb;
	}

	.all-table-statiscal span.success {
		color: white;
		background: #0FD186 !important;
	}

	.all-table-statiscal span.fail {
		color: white;
		background: #dc3545 !important;
	}

	.all-table-statiscal .active_point {
		background: yellow;
	}

	.img-user {
		width: 35px;
		display: inline-block;
		margin-right: 5px;
		border-radius: 5px;
		overflow: hidden;
		vertical-align: middle;
		box-shadow: 0px 1px 3px 1px rgba(0, 0, 0, 0.1);
	}

	.img-user img {
		max-width: 100%;
	}

	.table-list-user {
		overflow: auto;
		height: 347px;
		position: relative;
	}

	.scrollstyle::-webkit-scrollbar-track {
		background-color: #f7f7f7;
		height: 6px;
		width: 6px;
	}

	.scrollstyle::-webkit-scrollbar {
		background-color: #2891cc;
		margin: 6px;
		height: 6px;
		width: 6px;
	}

	.scrollstyle::-webkit-scrollbar-thumb {
		background-color: #2891cc;
		border-radius: 3px;
		width: 6px;
	}

</style>
<div class="dashboard-statistics">
	<div class="overview">
		<h5 class="title">Thông tin website</h5>
		<div class="row">
			<div class="col-xs-6 col-lg-3">
				<div class="item-over-view">
					<div class="icon" style="background-color:#0FD186 !important">
						<i class="fa fa-cart-plus" aria-hidden="true"></i>
					</div>
					<div class="content">
						<p class="name">{-data.productCount-}</p>
						<a href="{{ $admincp }}/view/products" class="smooth" title="Sản phẩm">Sản phẩm</a>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-lg-3">
				<div class="item-over-view">
					<div class="icon" style="background-color:#FFAE06 !important">
						<i class="fa fa-commenting-o" aria-hidden="true"></i>
					</div>
					<div class="content">
						<p class="name">{-data.commentCount-}</p>
						<a href="{{ $admincp }}/view/comments" class="smooth" title="Bình luận sản phẩm">Bình luận sản
							phẩm</a>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-lg-3">
				<div class="item-over-view">
					<div class="icon" style="background-color:#0088FF !important">
						<i class="fa fa-comments-o" aria-hidden="true"></i>
					</div>
					<div class="content">
						<p class="name">{-data.questionCount-}</p>
						<a href="{{ $admincp }}/view/product_questions" class="smooth" title="Bình luận video mới">Câu hỏi về
							sản phẩm</a>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-lg-3">
				<div class="item-over-view">
					<div class="icon" style="background-color:#17a2b8 !important">
						<i class="fa fa-paper-plane-o" aria-hidden="true"></i>
					</div>
					<div class="content">
						<p class="name">{-data.contactCount-}</p>
						<a href="{{ $admincp }}/view/contacts" class="smooth" title="Đăng ký tư vấn mới">Đăng ký tư vấn
							mới</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-lg-5">
			<div class="list-total-posts">
				<div class="header-list">
					<h4 class="title">Tổng số bài đăng</h4>
				</div>
				<div class="list-total">
					<div class="row col-mar-8">
						{{-- <div class="col-xs-6">
                            <div class="item-total">
                                <div class="icon" style="background-color:#dc3545">
                                    <i class="fa fa-video-camera"></i>
                                </div>
                                <div class="content">
                                    <p class="name"></p>
                                    <a href="{{$admincp}}/view/video_lectures" class="smooth">Video bài giảng</a>
                                </div>
                            </div>
                        </div> --}}
						{{-- <div class="col-xs-6">
                            <div class="item-total">
                                <div class="icon" style="background-color:#ffb1ba">
                                    <i class="fa fa-file-video-o" aria-hidden="true"></i>
                                </div>
                                <div class="content">
                                    <p class="name"></p>
                                    <a href="{{$admincp}}/view/videos" class="smooth">Videos</a>
                                </div>
                            </div>
                        </div> --}}
						{{-- <div class="col-xs-6">
                            <div class="item-total">
                                <div class="icon" style="background-color:#0087ff">
                                    <i class="fa fa-gamepad"></i>
                                </div>
                                <div class="content">
                                    <p class="name"></p>
                                    <a href="{{$admincp}}/view/learning_plays" class="smooth">Đề bài học mà chơi</a>
                                </div>
                            </div>
                        </div> --}}
						{{-- <div class="col-xs-6">
                            <div class="item-total">
                                <div class="icon" style="background-color:#0fd085">
                                    <i class="fa fa-hand-rock-o"></i>
                                </div>
                                <div class="content">
                                    <p class="name"></p>
                                    <a href="{{$admincp}}/view/exercises" class="smooth">Bài luyện tập</a>
                                </div>
                            </div>
                        </div> --}}
						{{-- <div class="col-xs-6">
                            <div class="item-total">
                                <div class="icon" style="background-color:#ffb213">
                                    <i class="fa fa-pencil-square"></i>
                                </div>
                                <div class="content">
                                    <p class="name"></p>
                                    <a href="{{$admincp}}/view/exams" class="smooth">Đề kiểm tra</a>
                                </div>
                            </div>
                        </div> --}}
						{{-- <div class="col-xs-6">
                            <div class="item-total">
                                <div class="icon" style="background-color:#17a2b8 ">
                                    <i class="fa fa-question-circle-o"></i>
                                </div>
                                <div class="content">
                                    <p class="name"></p>
                                    <a href="{{$admincp}}/view/questions" class="smooth">Câu hỏi trắc nghiệm</a>
                                </div>
                            </div>
                        </div> --}}
						{{-- <div class="col-xs-6">
                            <div class="item-total">
                                <div class="icon" style="background-color:#0088FF ">
                                    <i class="fa fa-file-text"></i>
                                </div>
                                <div class="content">
                                    <p class="name"></p>
                                    <a href="{{$admincp}}/view/documents" class="smooth">Tài liệu</a>
                                </div>
                            </div>
                        </div> --}}
						<div class="col-xs-6">
							<div class="item-total">
								<div class="icon" style="background-color:#ff525a">
									<i class="fa fa-newspaper-o"></i>
								</div>
								<div class="content">
									<p class="name">{-data.newCount-}</p>
									<a href="{{ $admincp }}/view/news" class="smooth">Tin tức</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-lg-7">
			<div class="list-user-box">
				<div class="header-list-user">
					<h5 class="title">Top <strong> 10</strong> tài khoản mua hàng nhiều nhất.</h5>
				</div>
				@php

				@endphp
				{{-- <div class="list-user">
                    <p style="font-size:18px;padding: 10px 15px;">Top <strong> 10</strong> tài khoản mua hàng nhiều nhất.</p>
                </div> --}}
				<div class="table-list-user scrollstyle">
					<table class="table-bordered table-hover all-table-statiscal table">
						<thead>
							<tr>
								<th style="text-align:center">STT</th>
								<th>Tên</th>
								<th>Số điện thoại</th>
								<th>Email</th>
								<th>Số đơn hàng</th>
								<th>Số tiền đã mua</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($topUserOrder as $key => $itemUser)
								<tr>
									<td style="text-align:center"><strong>{{ $key + 1 }}</strong></td>
									<td style="padding:1px 6px">
										<div class="img-user">
											<img src="{%IMGV2.itemUser.img.150x0%}" class="img-fluid">
										</div>
										{{ $itemUser->name }}
									</td>
									<td>{{ $itemUser->phone }}</td>
									<td>{{ $itemUser->email }}</td>
									<td>
										{{ $itemUser->count }}
									</td>
									<td>
										{{ Currency::showMoney($itemUser->priceUsage) }}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
