$(function (){
    var tracking_basic_auth_user = 'e00e4f19c64382477a0a1c321fb73dc6a0662215';
    var tracking_basic_auth_password = 'ffd27e7f350dbd63598878a8b5e60031';

    $("#tracking_frm").submit(function () {
        tracking_req('/api/checkStatus', $(this).serialize())
        .then((data) => JSON.parse(data))
        .then((res) => {
            console.log(res);
            $('.result').html(res.tracking_code)
        })
        return false;
    });

    function tracking_req(url, data) {
        return $.ajax({
            url: url,
            type: "POST",
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Basic ' + window.btoa(tracking_basic_auth_user+':'+tracking_basic_auth_password));
            }
        });
    }
});