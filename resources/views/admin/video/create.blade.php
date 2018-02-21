@extends("admin.layout.master")
@section("css")
    <link href="{{ asset('admin/css/fileinput.min.css') }}" rel="stylesheet">
@endsection
@section("content")
    <div class="span9">
        <h1>
            添加视频
        </h1>
        <form action="/admin/video" name="myvideo"  method="post" id="myForm" enctype="multipart/form-data"  class="form-horizontal">
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="textarea">视频名称</label>
                    <div class="controls">
                        <input name="title" type="text" class="input-xlarge" id="input01">
                    </div>
                </div>

                @if($lessons)
                <div class="control-group">
                    <label class="control-label" for="textarea">视频所属课程</label>
                    <div class="controls">
                        <select name="lesson_id" class="selectpicker">
                            @foreach($lessons as $v)
                                <option value ="{{$v["id"]}}">{{$v["title"]}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
                {{csrf_field()}}
                {{--<div class="control-group">--}}
                    {{--<label class="control-label" for="textarea">视频介绍</label>--}}
                    {{--<div class="controls">--}}
                        {{--<textarea name="introduce" class="input-xlarge" id="input01" rows="9"></textarea>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="control-group">
                    <label class="control-label" for="textarea">视频存放路径</label>
                    <div class="controls">
                        <input type="file" name="file" id="file"/>
                        <button type="button" class="btn btn-success" onclick="sendRequest()">上传视频</button>
                        {{--<button type="button"  class="btn btn-success btn-image">上传视频</button>--}}
                        <input type="hidden" name="path" id="path">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">提交</button>
                </div>
            </fieldset>
        </form>
    </div>
@endsection
@section("js")
    {{--<script src="{{ asset('js/upload.js') }}" type="text/javascript"></script>--}}
    <script src="{{ asset('admin/js/jquery.form.js') }}" type="text/javascript"></script>
    <script>
        // _tokens = document.head.querySelector('meta[name="csrf-token"]').content;

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
            fd.append("_token", "{{csrf_token()}}");
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
            fd.append("_token", "{{csrf_token()}}");
            fd.append("name", blob.name);
            fd.append("index", totalSlices);

            // xhr.setRequestHeader('content-type', 'application/json')
            xhr.open("POST", "/admin/video/merge", true);
            xhr.setRequestHeader("X_Requested_With", location.href.split("/")[3].replace(/[^a-z]+/g, '$'));
            xhr.send(fd);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    //根据服务器的响应内容格式处理响应结果
                    if(xhr.getResponseHeader('content-type')==='application/json'){
                        var result = JSON.parse(xhr.responseText);
                        //根据返回结果判断验证码是否正确
                        if(result.status_code=== 200){
                            $("#path").attr("value",result.path);
                            $("#file").remove();
                        }
                    } else {
                        console.log("返回视频地址失败！！！");
                    }
                }
            }
        }

        {{--$(function () {--}}
            {{--$(".btn-image").on("click",function () {--}}
                {{--var formData = new FormData($("#myForm")[0]);--}}
                {{--//用form 表单直接 构造formData 对象; 就不需要下面的append 方法来为表单进行赋值了。--}}
                {{--//var formData = new FormData();//构造空对象，下面用append 方法赋值。--}}
                {{--formData.append("policy", "");--}}
                {{--formData.append("_token", "{{csrf_token()}}");--}}
                {{--formData.append("file", $("#file_upload")[0].files[0]);--}}
                {{--var url = "/admin/lesson/uploads";--}}
                {{--$.ajax({--}}
                    {{--url : url,--}}
                    {{--type : 'POST',--}}
                    {{--data : formData,--}}
                    {{--/**--}}
                     {{--* 必须false才会避开jQuery对 formdata 的默认处理--}}
                     {{--* XMLHttpRequest会对 formdata 进行正确的处理--}}
                     {{--*/--}}
                    {{--processData : false,--}}
                    {{--/**--}}
                     {{--*必须false才会自动加上正确的Content-Type--}}
                     {{--*/--}}
                    {{--contentType : false,--}}
                    {{--success : function(responseStr) {--}}

                        {{--$("#dis-img").attr("src",responseStr.photo);--}}
                        {{--$("#dis-img").show();--}}
                        {{--$("#path").attr("value",responseStr.origin);--}}
                    {{--},--}}
                    {{--error : function(responseStr) {--}}
                        {{--alert("失败:" + JSON.stringify(responseStr));//将    json对象    转成    json字符串。--}}
                    {{--}--}}
                {{--});--}}
            {{--})--}}
        {{--})--}}
    </script>

@endsection