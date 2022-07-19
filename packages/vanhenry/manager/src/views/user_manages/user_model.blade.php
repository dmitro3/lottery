@php
    use App\Models\WalletTransactionType;
@endphp
<div id="modelEditUserInfo" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Sửa thông tin khách hàng <strong>{{$user->name}}</strong></h4>
            </div>
            <div class="modal-body">
                <form action="esystem/user-manage/edit-user-info?user={{$user->id}}" method="post" accept-charset="utf8" class="form-user-info" reload>
                    @csrf
                    <p class="mb-2"><strong>Tên người dùng</strong></p>
                    <input type="text" name="name" placeholder="Tên người dùng" value="{{Support::show($user,'name')}}">
                    <p class="mb-2 mt-3"><strong>Số điện thoại</strong></p>
                    <input type="text" name="phone" placeholder="Số điện thoại" value="{{Support::show($user,'phone')}}">
                    <p class="mb-2 mt-3"><strong>Đại lý</strong></p>
                    <select name="h_user_id" class="select2" style="width: 100%;">
                        @foreach ($listAdminAgencyUser as $itemAdminAgencyUser)
                            <option value="{{$itemAdminAgencyUser->id}}" {{$itemAdminAgencyUser->id == $user->h_user_id ? 'selected':''}}>{{$itemAdminAgencyUser->name}}</option>
                        @endforeach
                    </select>
                    <div class="text-right mt-4">
                        <button type="button" class="btn btn-default me-3" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if (isset($userBank))
    <div id="modelEditUserBankInfo" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sửa thông tin ngân hàng khách hàng</h4>
                </div>
                <div class="modal-body">
                    <form action="esystem/user-manage/edit-user-bank-info?user={{$user->id}}" method="post" accept-charset="utf8" class="form-user-info" reload>
                        @csrf
                        <input type="hidden" name="user_bank_id" value="{{$userBank->id}}">
                        <p class="mb-2"><strong>Ngân hàng</strong></p>
                        <select name="bank_id" class="select2" style="width: 100%;">
                            @foreach ($listBank as $itemBank)
                                <option value="{{$itemBank->id}}" {{$itemBank->id == $userBank->bank_id ? 'selected':''}}>{{$itemBank->name}}</option>
                            @endforeach
                        </select>
                        <p class="mb-2 mt-3"><strong>Chủ tài khoản</strong></p>
                        <input type="text" name="account_holder" placeholder="Chủ tài khoản" value="{{Support::show($userBank,'account_holder')}}">
                        <p class="mb-2 mt-3"><strong>Số tài khoản</strong></p>
                        <input type="text" name="account_number" placeholder="Số tài khoản" value="{{Support::show($userBank,'account_number')}}">
                        <p class="mb-2 mt-3"><strong>Chi nhánh</strong></p>
                        <input type="text" name="account_branch" placeholder="Chi nhánh" value="{{Support::show($userBank,'account_branch')}}">
                        <p class="mb-2 mt-3"><strong>Số điện thoại</strong></p>
                        <input type="text" name="phone" placeholder="Số điện thoại" value="{{Support::show($userBank,'phone')}}">
                        <p class="mb-2 mt-3"><strong>Email</strong></p>
                        <input type="text" name="email" placeholder="Email" value="{{Support::show($userBank,'email')}}">
                        <p class="mb-2 mt-3"><strong>Tỉnh/Thành phố</strong></p>
                        <input type="text" name="province" placeholder="Tỉnh/Thành phố" value="{{Support::show($userBank,'province')}}">

                        <div class="text-right mt-4">
                            <button type="button" class="btn btn-default me-3" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
<div id="modelPlusUserMoney" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Bạn chắc chắn muốn thực hiện thao tác này ?</h4>
            </div>
            <div class="modal-body">
                <form action="esystem/user-manage/plus-user-money?user={{$user->id}}" method="post" accept-charset="utf8" class="form-user-info" reload>
                    @csrf
                    <p>Sau khi bấm xác nhận, hệ thống tự động cộng tiền trong tài khoản khách hàng.</p>
                    <p class="mb-2"><strong>Số tiền</strong></p>
                    <input type="number" name="amount" placeholder="Số tiền">
                    <p class="mb-2 mt-3"><strong>Phương thức cộng tiền</strong></p>
                    <select name="transaction_type" class="select2" style="width: 100%;">
                        <option value="{{WalletTransactionType::RECHARGE_MONEY}}">Nạp tiền (Ghi nhận vào doanh thu)</option>
                        <option value="{{WalletTransactionType::ADMIN_PLUS_MONEY}}">Cộng tiền (Không ghi nhận vào doanh thu)</option>
                    </select>
                    <div class="text-right mt-4">
                        <button type="button" class="btn btn-default me-3" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="modelMinusUserMoney" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Bạn chắc chắn muốn thực hiện thao tác này ?</h4>
            </div>
            <div class="modal-body">
                <form action="esystem/user-manage/minus-user-money?user={{$user->id}}" method="post" accept-charset="utf8" class="form-user-info" reload>
                    @csrf
                    <p>Sau khi bấm xác nhận, hệ thống tự động trừ tiền trong tài khoản khách hàng.</p>
                    <p class="mb-2"><strong>Số tiền</strong></p>
                    <input type="number" name="amount" placeholder="Số tiền">
                    <p class="mb-2 mt-3"><strong>Phương thức trừ tiền tiền</strong></p>
                    <select name="transaction_type" class="select2" style="width: 100%;">
                        <option value="{{WalletTransactionType::WITHDRAW_MONEY}}">Rút tiền (Ghi nhận vào chi phí)</option>
                        <option value="{{WalletTransactionType::ADMIN_MINUS_MONEY}}">Trừ tiền (Không ghi nhận vào chi phí)</option>
                    </select>
                    <div class="text-right mt-4">
                        <button type="button" class="btn btn-default me-3" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>