# 留言板项目说明

​        task3文件夹中[index.html]()为登陆页面，点击用户注册可以跳转至注册页面[signup.html]()，登陆成功后可看到留言板页面[block.html]()，右上角有登出按钮和查看自己留言的链接，点击链接后可跳转至mymessage.html查看或删除或修改自己的留言。

​	

​	本项目中js文件和php文件之间均采用fetch API进行交互，实现代码模板为：

```
fetch('http://localhost/task3/x.php')
        .then(response => response.json())
        .catch((error) =>?)
        .then((res)=>?)
```

​        为了防御XSS攻击，用php函数htmlspecialchars()处理php传回给js的数据。

​        

​	为了防御SQL注入,在php向mysql数据库请求数据时设计用户输入的语句避免使用拼接，mysqli_query()函数，转为使用例如如下语句：

```
$sql1="insert into message (username, message, time) values (?,?,now())";
$stmt = mysqli_prepare($connect,$sql1);
$stmt->bind_param('ss',$_SESSION["username"],$_POST["message"]);
$stmt->execute();   
```

​	其中第三行''内s表示string类型，i表示integer类型，d表示double类型，b表示blob并将以包的形式进行发送。

​	第二行若$connect采用面向对象写法：

```
$connect=new mysqli("localhost","root","","login");
```

​	则可以写成面向对象形式：

```
$stmt = $mysqli->prepare($connect,$sql1);
```

​	

​	大概能想到的就是这么多，代码肯定还有混乱冗杂之处，等期末结束再行修改。