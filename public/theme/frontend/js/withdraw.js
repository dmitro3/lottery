var WITHDRAW_GUI = {
    sendWithdrawDone(res) {
        if (res.code == 200) {
            swal({
                title: "Gửi yêu cầu thành công",
                text: res.message,
                icon: "success",
                button: "Đóng!",
            }).then(() => {
                window.location.reload();
            });
        } else {
            if (res.message) {
                BASE_GUI.createFlashNotify(res.message);
            }
        }
    },
};
