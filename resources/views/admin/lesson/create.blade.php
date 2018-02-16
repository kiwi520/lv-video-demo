@extends("admin.layout.master")
@section("content")
    <div class="span9">
        <h1>
            添加视频课程
        </h1>
        <form  action="/admin/lesson" method="post" id="avatar" class="form-horizontal">
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="textarea">视频课程名称</label>
                    <div class="controls">
                        <input name="name" type="text" class="input-xlarge" id="input01">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="textarea">视频课程介绍</label>
                    <div class="controls">
                        <textarea name="introduce" class="input-xlarge" id="input01" rows="9"></textarea>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="textarea">预览图</label>
                    <div class="controls">
                        <input name="preview" type="file" class="input-large">
                        {{--<input type="button" value="上传" onclick="upload()" />--}}
                            <input type="button" value="上传" onclick="uploadInfo()" />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="textarea">是否推荐</label>
                    <div class="controls">
                        <label class="radio inline">
                            <input type="radio" name="iscommend"  value="1"> 是
                        </label>
                        <label class="radio inline">
                            <input type="radio" name="iscommend" value="0" checked> 否
                        </label>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="textarea">是否热门</label>
                    <div class="controls">
                        <label class="radio inline">
                            <input type="radio" name="ishot"  value="1"> 是
                        </label>
                        <label class="radio inline">
                            <input type="radio" name="ishot"  value="0" checked> 否
                        </label>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">点击量</label>
                    <div class="controls">
                        <input name="click" type="text" class="input-xlarge" value="0">
                    </div>
                </div>

                {{csrf_field()}}
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">提交</button>
                    {{--<button class="btn">Cancel</button>--}}
                </div>
            </fieldset>
        </form>
    </div>

    <script type="text/javascript">
        function uploadInfo() {
            var tokens = '{{csrf_token()}}'
            var url="/admin/lesson/upload";
            var formData = new FormData($("#avatar"));
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': tokens
                },
                url: url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (returndata) {
                    console.log(returndata);
                },
                error: function (returndata) {
                    console.log(returndata);
                }
            });
        }

    </script>
    <script>
        // function upload(){
        //     var form = new FormData($("#upload_form")[0]);
        //     $.ajax({
        //         url:'/admin/lesson/upload',
        //         type:'POST',
        //         data:form,
        //         success:function (result){
        //             alert(result);
        //         },
        //         error:function (result){
        //             alert(result);
        //         }
        //     });
        // }

        function upload(){
            // 请求的后端方法
            var url="/admin/lesson/upload";
            // 获取文件
            // var pic = document.getElementById('pic').files[0];

            {{--var tokens = '{{csrf_token()}}'--}}
            // 初始化一个 XMLHttpRequest 对象
            // var xhr = new XMLHttpRequest();
            // 初始化一个 FormData 对象
            // var form = new FormData();
            // var  formData = new FormData($("#upload_form")[0]);
            //
            //     console.log(formData)
            // $.ajax({
            //     headers: {
            //         'X-CSRF-TOKEN': tokens
            //     },
            //     type: 'POST',
            //     url: url ,
            //     data: formData ,
            //     processData:false,
            //     //mimeType:"multipart/form-data",
            //     contentType: false,
            //     cache: false,
            //     success:function(data){
            //         console.log(data);
            //         if(data.status){
            //             console.log(data.message);
            //         }
            //     },
            //     error:function(err){
            //         console.log(err);
            //     }
            // });

            var form = new FormData($("#upload_form")[0]);
            $.ajax({
                url:url,
                type:'POST',
                data:form,
                success:function (result){
                    alert(result);
                },
                error:function (result){
                    alert(result);
                }
            });

            // // 携带文件
            // form.append("pic", pic);
            // form.append("_token", tokens);
            // xhr.responseType="json";
            //
            //
            // //开始上传
            // xhr.open("POST", url, true);
            // //在readystatechange事件上绑定一个事件处理函数
            // xhr.onreadystatechange=callback;
            // xhr.send(form);
            //
            // function callback() {
            //     if(xhr.readyState == 4){
            //         if(xhr.status == 200){
            //             console.log( xhr.responseText);
            //             // console.log( eval('('+ xhr.responseText +')'));
            //             // if(xhr.responseText == 1){
            //             //     alert('添加成功');
            //             //     window.location.reload();
            //             // }else{
            //             //     alert("添加失败");
            //             // }
            //         }
            //     }
            // }
        }
    </script>
@endsection