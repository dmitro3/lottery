function _defineProperty(obj, key, value) {
    if (key in obj) {
        Object.defineProperty(obj, key, {
            value: value,
            enumerable: true,
            configurable: true,
            writable: true,
        });
    } else {
        obj[key] = value;
    }
    return obj;
}
class SimpleStaticalBox {
    constructor(element) {
        _defineProperty(this, "element", void 0);
        _defineProperty(this, "dateRangePickerBox", void 0);
        _defineProperty(this, "dateRangeValue", void 0);
        _defineProperty(this, "contentBox", void 0);
        this.element = element;
        this.dateRangePickerBox = this.element.find(".date-range-picker-box");
        this.dateRangeValue = this.element.find(".date-range-value");
        this.contentBox = this.element.find(".admin-statical-content-box");
        this.initDateRangePicker();
        return this;
    }
    initDateRangePicker() {
        if (this.dateRangePickerBox.length == 0) return;
        var self = this;
        var dateRangePickerBox = this.dateRangePickerBox;
        var startTime = moment("2022-1-1", "YYYY-MM-DD");
        var endTime = moment();
        function callBackDateRange(
            startTime,
            endTime,
            titleTime = "Tất cả thời gian"
        ) {
            var htmlShow =
                startTime.format("D/M/YYYY") + "-" + endTime.format("D/M/YYYY");
            dateRangePickerBox.find(".date-preview").html(htmlShow);
            self.dateRangeValue.val(htmlShow).trigger("change");
            self.changeEvent();
            var titleTimePicker = self.element.find(".title-time-picker");
            if (titleTimePicker.length > 0) {
                titleTimePicker.html(titleTime);
            }
        }
        this.dateRangePickerBox.daterangepicker(
            {
                startDate: startTime,
                endDate: endTime,
                locale: {
                    customRangeLabel: "Tùy chọn",
                    separator: " - ",
                    applyLabel: "Xác nhận",
                    cancelLabel: "Hủy",
                    fromLabel: "Từ",
                    toLabel: "Đến",
                    weekLabel: "W",
                    daysOfWeek: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
                    monthNames: [
                        "Tháng 1",
                        "Tháng 2",
                        "Tháng 3",
                        "Tháng 4",
                        "Tháng 5",
                        "Tháng 6",
                        "Tháng 7",
                        "Tháng 8",
                        "Tháng 9",
                        "Tháng 10",
                        "Tháng 11",
                        "Tháng 12",
                    ],
                },
                ranges: {
                    "Hôm nay": [moment(), moment()],
                    "Hôm qua": [
                        moment().subtract(1, "days"),
                        moment().subtract(1, "days"),
                    ],
                    "Tuần này": [moment().subtract(7, "days"), moment()],
                    "Tuần trước": [
                        moment().startOf("week").subtract(7, "days"),
                        moment().endOf("week").subtract(7, "days"),
                    ],
                    "Tháng này": [
                        moment().startOf("month"),
                        moment().endOf("month"),
                    ],
                    "Tháng trước": [
                        moment().subtract(1, "month").startOf("month"),
                        moment().subtract(1, "month").endOf("month"),
                    ],
                    "Năm nay": [
                        moment().startOf("year"),
                        moment().endOf("year"),
                    ],
                    "Năm trước": [
                        moment().subtract(1, "year").startOf("year"),
                        moment().subtract(1, "year").endOf("year"),
                    ],
                    "Tất cả thời gian": ["1/1/2022", moment()],
                },
            },
            callBackDateRange
        );
        callBackDateRange(startTime, endTime);
        return this;
    }
    changeEvent() {
        var self = this;
        self.loadContent();
        $.ajax({
            url: self.element.data("action"),
            method: "get",
            data: {
                time: self.dateRangeValue.val(),
            },
            dataType: "json",
        }).done((data) => {
            if (data.html) {
                this.contentBox.html(data.html);
            }
            self.endLoading();
            self.callSubFunction(self.element.data("success"), data);
        });
    }
    callSubFunction(str, data) {
        var temp = str.split(".");
        if (temp.length == 1) {
            var fnc = temp[0];
            if (window[fnc] != undefined && typeof window[fnc] === "function") {
                window[fnc](data);
            }
        } else if (temp.length == 2) {
            var obj = temp[0];
            var fnc = temp[1];
            if (window[obj] != undefined && typeof window[obj] == "object") {
                if (
                    window[obj][fnc] != undefined &&
                    typeof window[obj][fnc] === "function"
                ) {
                    window[obj][fnc](data);
                }
            }
        }
    }
    loadContent() {
        this.showLoading();
    }
    showLoading() {
        this.contentBox.addClass("in-loading-item");
    }
    endLoading() {
        this.contentBox.removeClass("in-loading-item");
    }
}
