<div class="row">
    <div class="col-lg-6 mt-4">
        <p class="mb-2" style="font-size: 16px;">Tổng tiền thu vào: <strong class="text-info" style="font-size: 20px;">{{\Currency::showMoney($totalReceipt)}}</strong></p>
        <div class="module-paginate-ajax" style="min-height: 150px" data-action="esystem/system-statical/total-receipts?time={{urlencode(request()->time ?? '')}}" data-currenturl="esystem/system-statical/total-receipts"></div>
    </div>
    <div class="col-lg-6 mt-4">
        <p class="mb-2" style="font-size: 16px;">Tổng tiền xuất ra: <strong class="text-danger" style="font-size: 20px;">{{\Currency::showMoney($totalAmountSpent)}}</strong></p>
        <div class="module-paginate-ajax" style="min-height: 150px" data-action="esystem/system-statical/total-amount-spent?time={{urlencode(request()->time ?? '')}}" data-currenturl="esystem/system-statical/total-amount-spent"></div>
    </div>
    <div class="text-right px-3">
        <span style="font-size: 18px">Doanh thu thật: </span>
        <strong style="font-size: 30px;" class="text-success">{{\Currency::showMoney($totalReceipt - $totalAmountSpent)}}</strong>    
    </div>
</div>