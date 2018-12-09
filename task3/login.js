
document.getElementById("login_form").addEventListener('submit', login)
function login(event) {
    event.preventDefault();
    var msg = document.getElementById("result-msg");
    console.log(event.target);
    const formEntries = new FormData(login_form).entries();
    const json = Object.assign(...Array.from(formEntries, ([x, y]) => ({ [x]: y })));

    fetch('http://localhost/task3/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },

        body: JSON.stringify(json)
    })
        .then(response => response.json())
        .catch((error) => {
            msg.innerText = error
        })
        .then((res) => {
            console.log(res)
            if (res.errcode != 0) {
                alert(res.errmsg); 
            } else {
                /*var sub = document.getElementById("sub");
                sub.value = "注销";
                sub.type = "button";
                sub.addEventListener('click', function zx() {
                    fetch('http://localhost/task3/zx.php')
                        .then(response => response.json())
                        .catch((error) => {
                            alert(error);
                        })
                        .then((res)=>{
                            alert(res.msg);
                            location.reload()
                        })
                })
                var sign=document.getElementById("sign");
                var signup=document.getElementById("signup");
                sign.removeChild(signup);*/
                window.location.href='http://localhost/task3/block.html';



            }
        })
}