function htmlEncode(c){
        switch(c) {
    
           case '&':
    
               return "&amp;";
    
           case '<':
    
               return "&lt;";
    
           case '>':
    
               return "&gt;";
    
           case '"':
    
               return "&quot;";
    
           case ' ':
    
               return "&nbsp;";
    
           default:
    
               return c + "";
    
        }
}
var msg = document.getElementById("my-msg");
fetch('http://localhost/task3/mymessage.php')
    .then(response => response.json())
    .catch((error) => {
        msg.innerText = error
    })
    .then((res) => {

        if (res[0].errcode != 0) {
            msg.innerHTML = ('<a href=http://localhost/task3/index.html>'+res[0].message+'</a>')
        }
        else {
            for (var i = 0; i < res.length; i++) {
                var counter = i + 1;
                var newh3 = document.createElement("h3");
                var newDiv1 = document.createElement("div");
                newDiv1.setAttribute("class","com-box");
                var newP = document.createElement("p");
                var newDiv2 = document.createElement("div");
                var del = document.createElement("input");
                var newSpan1=document.createElement("span");                
                var newSpan2=document.createElement("span");
                
                del.setAttribute("type", "button");
                del.setAttribute("name", "del");
                del.setAttribute("value", "删除");
                del.addEventListener("click", function dlt() {
                    if (confirm("是否确定删除？") ) {
                        console.log(this.parentNode.childNodes[1].childNodes[1].innerText) 
                        console.log(this.parentNode.childNodes[2].childNodes[1].innerText)
                        
                        var getmsg=this.parentNode.childNodes[1].childNodes[1].innerText;
                        var gettime=this.parentNode.childNodes[2].childNodes[1].innerText;  
                        //console.log(JSON.stringify({"message": getmsg,"time": gettime}))              
                        fetch('http://localhost/task3/delete.php', {
                            method: 'POST',
                            body: JSON.stringify({"message": getmsg,"time": gettime})
                        })
                            .then(response => response.json())
                            .catch((error) => {
                                alert(error);
                            })
                            .then((data) => {
                                //console.log(data)
                                alert(data.msg);
                                location.reload()
                            })
                    }

                });
                var ipt=document.createElement("textarea");
                ipt.setAttribute("cols","80");
                ipt.setAttribute("rows","5");
                ipt.setAttribute("placeholder","请自觉遵守互联网相关的政策法规，严禁发布色情、暴力、反动的言论。");
                ipt.setAttribute("class","ipt-txt");
                
                var change=document.createElement("input");
                change.setAttribute("type","button");
                change.setAttribute("name","change");
                change.setAttribute("value","修改");
                change.addEventListener("click",function change(){
                    var inp=ipt.value;
                    fetch('http://localhost/task3/update.php', {
                            method: 'POST',
                            body: JSON.stringify({"message": inp,"time":this.parentNode.childNodes[2].childNodes[1].innerText})
                        })
                            .then(response => response.json())
                            .catch((error) => {
                                alert(error);
                            })
                            .then((data) => {
                                //console.log(data)
                                alert(data.msg);
                                location.reload()
                            })


                                   
                })
                    
                html1 = "留言内容：" ;
                html2 = "留言时间：" ;
                msg.appendChild(newDiv1);
                newDiv1.appendChild(newh3);
                newh3.innerHTML = ("#" + counter);
                newDiv1.appendChild(newP);
                newP.innerHTML = html1;
                newP.append(newSpan1);
                for(var j=0;j<res[i].message.length;j++){
                    htmlEncode(res[i].message.charAt(j));
                }
                newSpan1.innerHTML=res[i].message;
                newDiv1.appendChild(newDiv2);
                newDiv2.innerHTML = html2;
                newDiv2.appendChild(newSpan2);
                newSpan2.innerHTML=res[i].time;
                newDiv1.appendChild(del);
                newDiv1.appendChild(document.createElement("br"));
                newDiv1.appendChild(ipt);
                newDiv1.appendChild(document.createElement("br"));
                newDiv1.appendChild(change);
            }
        }
        // console.log(res)          
    })


