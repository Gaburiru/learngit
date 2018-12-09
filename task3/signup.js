document.getElementById("signup_form").addEventListener('submit',signup)

function signup(event){

    event.preventDefault();
    var msg = document.getElementById("result-msg");
    console.log(event.target);
    const formEntries = new FormData(signup_form).entries();
    const json = Object.assign(...Array.from(formEntries, ([x,y]) => ({[x]:y})));

    fetch('http://localhost/task3/signup.php', {
        method: 'POST',       
        headers: {
            'Content-Type': 'application/json'
        },
        body:JSON.stringify(json)
    })
    .then(response => response.json())
    .catch((error) => {
        msg.innerText = error
    })
    .then((res) => {
        if (res.errcode != 0) {
            msg.innerText = res.errmsg
        } else {
           alert("注册成功");
           window.location.href='http://localhost/task3/index.html';
        }
    })
}