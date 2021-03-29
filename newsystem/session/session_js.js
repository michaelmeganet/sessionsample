var sessionMsg = '';
var sessionStatus = true;
async function checkSession() {
    return axios.post("./session/session.axios.php", {
        action: 'checkSession'
    }).then(function (resp) {
        console.log('checkSession...');
        console.log(resp.data);
        if (resp.data.status != 'ok') {
            let msg = resp.data.msg;
            window.alert(msg);
            window.open('./login.php', '_parent');
        }
        return resp.data.status;
    })
}