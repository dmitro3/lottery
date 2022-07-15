var MARKETING_GUI = (function () {
    var initDateMarketingPicker = function () {
        if (!BASE_GUI_HOME.elelemtExist("#date-marketing-picker")) return;
        var dateMarketingPickerPreview = document.querySelector(
            "#date-marketing-picker-preview"
        );
        var picker = new Pikaday({
            field: document.getElementById("date-marketing-picker"),
            format: "DD-MM-YYYY",
            i18n: {
                previousMonth: "Tháng trước",
                nextMonth: "Tháng sau",
                months: [
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
                weekdays: [
                    "Sunday",
                    "Monday",
                    "Tuesday",
                    "Wednesday",
                    "Thursday",
                    "Friday",
                    "Saturday",
                ],
                weekdaysShort: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
            },
            onSelect: function () {
                if (dateMarketingPickerPreview) {
                    var day = this.getMoment().format("DD");
                    var month = this.getMoment().format("MM");
                    var year = this.getMoment().format("YYYY");
                    dateMarketingPickerPreview.innerHTML = `Ngày ${day} Tháng ${month} Năm ${year}`;
                }
            },
        });
    };
    var initFormFillterMyteam = function () {
        var formFillterMyteam = document.querySelector("#form-fillter-myteam");
        if (formFillterMyteam) {
            var dateMarketingPicker = document.querySelector(
                "#date-marketing-picker"
            );
            if (dateMarketingPicker) {
                dateMarketingPicker.addEventListener("change", function () {
                    formFillterMyteam.submit();
                });
            }
        }
    };
    return {
        _: function () {
            initDateMarketingPicker();
            initFormFillterMyteam();
            BASE_GUI.initCopyTextbtn();
        },
    };
})();

window.addEventListener("DOMContentLoaded", function () {
    MARKETING_GUI._();
});
