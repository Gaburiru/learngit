function HTMLEncode(html) {
    var str=html;
    for(var i=0;i<str.length;i++){
        switch(str.charAt(i)){
            case '<':
                str.charAt(i)= "&lt;";
            case '>':
                str.charAt(i)="&gt;";
            case ' ':
                str.charAt(i)="&nbsp;";
            default:
                str.charAt(i)=str.charAt(i);
        }
    }
}

var msg = document.getElementById("block");

function display() {
    fetch('display.php')
        .then(response => response.json())
        .catch((error) => {
            msg.innerText = error
        })
        .then((res) => {
            //console.log(res)
            if (res[0].errcode != 0) {
                msg.innerHTML = res[0].message
            }
            else {
                for (var i = 0; i < res.length; i++) {
                    //console.log(res[i])
                    var newDiv1 = document.createElement("div");
                    newDiv1.setAttribute("class", "p-box");
                    var newDiv2 = document.createElement("div");
                    var newP = document.createElement("p");
                    var newSpan = document.createElement("span");
                   
                    //res[i].message=htmlEncode(res[i].message);
                    console.log(res[i].message)
                    
                   // res[i].username=htmlEncode(res[i].username);
                    
                    var html2 = "留言内容：" + res[i].message
                    var html1 = "用户：" + res[i].username
                    var html3 = "留言时间：" + res[i].time
                    msg.appendChild(newDiv1);
                    newDiv1.appendChild(newDiv2);
                    newDiv1.appendChild(newP);
                    newDiv2.innerHTML = html1;
                    newP.innerHTML = html2;
                    newDiv1.appendChild(newSpan);
                    newSpan.innerHTML = html3;

                }
            }
        })
}
display();
var sub = document.getElementById("logout");
sub.addEventListener('click', function zx() {
    if(confirm("是否确定注销？")){
        fetch('zx.php')
        .then(response => response.json())
        .catch((error) => {
            alert(error);
        })
        .then((res) => {
            alert(res.msg);
            location.reload()
            window.location.href='index.html';
        })
    }
    
})


