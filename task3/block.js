

document.getElementById("ly_form").addEventListener('submit', ly)
function ly(event) {
    //console.log(event);
    event.preventDefault();
    
    var inp=document.getElementById("message").value;
    //console.log(inp);
    let formdata = new FormData()
    formdata.append('message',inp)
    fetch('http://localhost/task3/block.php', {
        method: 'POST',        
        body:formdata
    })
    .then(response => response.json())
    .catch((error) => {
        msg.innerText = error
    })
    .then((res) => {
        if (res.errcode != 0) {
           alert(res.errmsg);
        } else {
            alert(res.sucmsg);
            location.reload()

        }
    })
}








