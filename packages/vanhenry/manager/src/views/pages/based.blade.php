@php
	use App\Models\WithdrawalRequest;
	use App\Models\RechargeRequest;
	use App\Models\User;
	use vanhenry\manager\model\HUser;
@endphp
<div class="dashboard-statistics">
	<div class="overview">
        <p class="big-title">Tổng quan</p>
        <div class="row col-mar-8">
            <div class="col-xs-6 col-lg-3">
                <div class="item-over-view">
                    <div class="icon" style="background-color:#46be8a !important">
                        <i class="fa fa-money" aria-hidden="true"></i>
                    </div>
                    <div class="content">
                        <p class="name">{{RechargeRequest::where('recharge_status_id',1)->count()}}</p>
                        <a href="esystem/view/recharge_requests?tab=1" class="smooth">Yêu cầu nạp tiền chưa xử lý</a>
                    </div>
                </div>
            </div>
             <div class="col-xs-6 col-lg-3">
                <div class="item-over-view">
                    <div class="icon" style="background-color:#ffa615 !important">
                        <i class="fa fa-money" aria-hidden="true"></i>
                    </div>
                    <div class="content">
                        <p class="name">{{WithdrawalRequest::where('withdrawal_request_status_id',1)->count()}}</p>
                        <a href="esystem/view/withdrawal_requests?tab=1" class="smooth">Yêu cầu rút tiền chưa xử lý</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-lg-3">
                <div class="item-over-view">
                    <div class="icon" style="background-color:#1b74e4 !important">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                    </div>
                    <div class="content">
                        <p class="name">{{User::getTotalRecordToday()}}</p>
                        <a href="esystem/view/users" class="smooth">Thành viên mới hôm nay</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-lg-3">
                <div class="item-over-view">
                    <div class="icon" style="background-color:#17a2b8 !important">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <div class="content">
                        <p class="name">{{HUser::where('group',2)->count()}}</p>
                        <a href="esystem/search/h_users?raw_username_type_filter=~%3D&raw_group=2" class="smooth">Đại lý</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-5">
			<div class="list-total-posts">
				<div class="header-list">
					<p>Tổng số bản ghi</p>
				</div>
				<div class="list-total">
					<div class="row col-mar-8">
						<div class="col-xs-6">
							<div class="item-total">
								<div class="icon" style="background-color:#0087ff">
									<i class="fa fa-user"></i>
								</div>
								<div class="content">
									<p class="name">{{User::count()}}</p>
									<a href="esystem/view/users" class="smooth">Người dùng</a>
								</div>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="item-total">
								<div class="icon" style="background-color:#17a2b8 ">
									<i class="fa fa-question-circle-o"></i>
								</div>
								<div class="content">
									<p class="name">{{HUser::where('group',2)->count()}}</p>
									<a href="esystem/search/h_users?raw_username_type_filter=~%3D&raw_group=2" class="smooth">Đại lý</a>
								</div>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="item-total">
								<div class="icon" style="background-color:#0fd085">
									<i class="fa fa-credit-card" aria-hidden="true"></i>
								</div>
								<div class="content">
									<p class="name">{{RechargeRequest::count()}}</p>
									<a href="esystem/view/exercises" class="smooth">Yêu cầu nạp tiền</a>
								</div>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="item-total">
								<div class="icon" style="background-color:#dc3545">
									<i class="fa fa-credit-card" aria-hidden="true"></i>
								</div>
								<div class="content">
									<p class="name">{{RechargeRequest::where('recharge_status_id',3)->count()}}</p>
									<a href="esystem/view/video_lectures" class="smooth">Yêu cầu nạp tiền thất bại</a>
								</div>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="item-total">
								<div class="icon" style="background-color:#0fd085">
									<i class="fa fa-money" aria-hidden="true"></i>
								</div>
								<div class="content">
									<p class="name">{{WithdrawalRequest::count()}}</p>
									<a href="esystem/view/withdrawal_requests" class="smooth">Yêu cầu rút tiền</a>
								</div>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="item-total">
								<div class="icon" style="background-color:#dc3545">
									<i class="fa fa-money" aria-hidden="true"></i>
								</div>
								<div class="content">
									<p class="name">{{WithdrawalRequest::where('withdrawal_request_status_id',3)->count()}}</p>
									<a href="esystem/view/withdrawal_requests?tab=3" class="smooth">Yêu cầu rút tiền thất bại</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-7">
			<div class="list-user-box">
				<div class="header-list-user">
                    <span class="main-title">Top nạp tiền</span>
                </div>
				<div class="module-paginate-ajax" style="min-height: 60px" data-action="esystem/user-manage/top-recharge-user" data-currenturl="esystem/user-manage/top-recharge-user"></div>
			</div>
		</div>
	</div>
	<div class="revenue-statistics mt-4">
		<p class="big-title">Doanh thu</p>
		<div class="module-admin-statical-box" data-action="esystem/system-statical/all-revenue-cost" data-success="SHOP_CHART.initChartShop">
			<div class="header-box d-flex align-items-center" style="font-size: 16px;">
				<div>
					<input type="hidden" class="date-range-value">
					<div class="date-range-picker-box">
						<i class="fa fa-calendar"></i>
						<span class="date-preview"></span>
					</div>
				</div>
				<p class="title-time-picker ms-3">Tháng này</p>
			</div>
			<div class="admin-statical-content-box"></div>
		</div>
	</div>
</div>
