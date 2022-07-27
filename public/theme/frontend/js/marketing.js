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
    var initQrcode = function () {
        var qrcodeBox = document.querySelector("#qrcode");
        if (qrcodeBox) {
            var qrCode = new QRCode(qrcodeBox, qrcodeBox.dataset.link);
            qrCode.makeCode(qrcodeBox.dataset.link);
        }
    };
    var initClickShowItemMyteamInfo = function () {
        var listItemMyteamInfo = document.querySelectorAll(".item-myteam-info");
        listItemMyteamInfo.forEach((element) => {
            var btnShowBdshow = element.querySelector(".btn-show-bdshow");
            var bdshow = element.querySelector(".bdshow");
            if (btnShowBdshow && bdshow) {
                btnShowBdshow.onclick = function () {
                    if (this.classList.contains("action")) {
                        this.classList.remove("action");
                        bdshow.style.display = "none";
                    } else {
                        listItemMyteamInfo.forEach((elm) => {
                            var btnShowBdshowElm =
                                elm.querySelector(".btn-show-bdshow");
                            var bdshowElm = elm.querySelector(".bdshow");
                            if (btnShowBdshowElm) {
                                btnShowBdshowElm.classList.remove("action");
                            }
                            if (bdshowElm) {
                                bdshowElm.style.display = "none";
                            }
                        });
                        this.classList.add("action");
                        bdshow.style.display = "block";
                    }
                };
            }
        });
    };
    return {
        _: function () {
            initDateMarketingPicker();
            initFormFillterMyteam();
            initQrcode();
            BASE_GUI.initCopyTextbtn();
        },
        initClickShowItemMyteamInfo() {
            initClickShowItemMyteamInfo();
        },
    };
})();

window.addEventListener("DOMContentLoaded", function () {
    MARKETING_GUI._();
});
