const BYTES_PER_CHUNK = 1024 * 1024; // 每个文件切片大小定为1MB .
var slices;
var totalSlices;

//发送请求
function sendRequest() {

    var blob = document.getElementById('file').files[0];

    if(!blob){
        alert("请选择上传文件")
    }else{
        var start = 0; //开始的索引数
        var end;    //结束
        var index = 0; //索引数

        // 计算文件切片总数
        slices = Math.ceil(blob.size / BYTES_PER_CHUNK);
        totalSlices= slices;
        //循环上传
        while(start < blob.size) {
            end = start + BYTES_PER_CHUNK;
            if(end > blob.size) {
                end = blob.size;
            }
            //调用上传方法
            uploadFile(blob, index, start, end);

            start = end;
            index++;
        }
    }
}

//上传文件
function uploadFile(blob, index, start, end) {
    var xhr;
    var fd;
    var chunk;

    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4) {
            if(xhr.responseText) {
                if (xhr.status != 200) {
                    // 表明服务器发送响应成功
                    alert("上传失败，请重新上传")
                }
            }

            slices--;

            // 如果所有文件切片都成功发送，发送文件合并请求。
            if(slices == 0) {
                mergeFile(blob);
                alert('文件上传完毕');
            }
        }
    };


    chunk =blob.slice(start,end);//切割文件

    //构造form数据
    fd = new FormData();
    fd.append("file", chunk);
    fd.append("name", blob.name);
    fd.append("index", index);

    xhr.open("POST", "/admin/video/uploads", true);

    //设置二进制文边界件头
    xhr.setRequestHeader("X_Requested_With", location.href.split("/")[3].replace(/[^a-z]+/g, '$'));
    xhr.send(fd);
}

//发起合并
function mergeFile(blob) {
    var xhr;
    var fd;

    xhr = new XMLHttpRequest();

    fd = new FormData();
    fd.append("name", blob.name);
    fd.append("index", totalSlices);

    xhr.open("POST", "/admin/video/merge", true);
    xhr.setRequestHeader("X_Requested_With", location.href.split("/")[3].replace(/[^a-z]+/g, '$'));
    xhr.send(fd);
}