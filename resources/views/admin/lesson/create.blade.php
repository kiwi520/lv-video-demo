@extends("admin.layout.master")
@section("css")
    <link href="{{ asset('admin/css/fileinput.min.css') }}" rel="stylesheet">
@endsection
@section("content")
    <div class="span9">
        <h1>
            添加视频课程
        </h1>
        <form  method="post" id="myForm" enctype="multipart/form-data"  class="form-horizontal">
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
                        {{--<input name="preview" type="file" class="input-large" id="preview">--}}
                        {{--<input type="button" value="上传" onclick="upload()" />--}}
                        {{--<input type="button" value="上传" onclick="doUpload()" />--}}
                        {{--<form action="/admin/lesson/uploads" enctype="multipart/form-data" class="" method="post">--}}
                            {{--<div class="preview"></div>--}}
                            <input type="file" name="file" id="file_upload"/>
                            <br/>
                            <button type="button"  class="btn btn-success btn-image">Image Upload</button>
                        {{--</form>--}}
                        {{--<form enctype="multipart/form-data">--}}

                            {{--<div class="form-group">--}}
                                {{--<input id="file-1" type="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="1">--}}
                            {{--</div>--}}

                        {{--</form>--}}
                        {{--<form id="fileupload-form">--}}
                            {{--<input id="fileupload" type="file" name="file" >--}}
                            {{--{{csrf_field()}}--}}
                        {{--</form>--}}
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


    </script>
@endsection
@section("js")
    {{--<script src="{{ asset('admin/js/fileinput.min.js') }}" type="text/javascript"></script>--}}
    <script src="{{ asset('admin/js/jquery.form.js') }}" type="text/javascript"></script>
    <script>
        $(function () {
            $(".btn-image").on("click",function () {


                var formData = new FormData($("#myForm")[0]);
                //用form 表单直接 构造formData 对象; 就不需要下面的append 方法来为表单进行赋值了。
                //var formData = new FormData();//构造空对象，下面用append 方法赋值。
                 formData.append("policy", "");
                 formData.append("_token", "{{csrf_token()}}");
                 formData.append("file", $("#file_upload")[0].files[0]);
                var url = "/admin/lesson/uploads";
                $.ajax({
                    url : url,
                    type : 'POST',
                    data : formData,
                    /**
                     * 必须false才会避开jQuery对 formdata 的默认处理
                     * XMLHttpRequest会对 formdata 进行正确的处理
                     */
                    processData : false,
                    /**
                     *必须false才会自动加上正确的Content-Type
                     */
                    contentType : false,
                    success : function(responseStr) {
                        alert("成功：" + JSON.stringify(responseStr));
                        //                  var jsonObj = $.parseJSON(responseStr);//eval("("+responseStr+")");
                    },
                    error : function(responseStr) {
                        alert("失败:" + JSON.stringify(responseStr));//将    json对象    转成    json字符串。
                    }
                });
            })
        })



        //绑定了`submit`事件。
        // $('#fileupload-form').on('submit',(function(e) {
        //     e.preventDefault();
        //     //序列化表单
        //     var serializeData = $(this).serialize();
        //
        //     // var formData = new FormData(this);
        //     $(this).ajaxSubmit({
        //         type:'POST',
        //         url: '/admin/lesson/uploads',
        //         dataType: 'json',
        //         data: serializeData,
        //         // data: formData,
        //
        //         //attention!!!
        //         contentType: false,
        //         cache: false,
        //         processData:false,
        //
        //         beforeSubmit: function() {
        //         //上传图片之前的处理
        //     },
        //     uploadProgress: function (event, position, total, percentComplete){
        //         //在这里控制进度条
        //     },
        //     success:function(){
        //
        //     },
        //     error:function(data){
        //         alert('上传图片出错');
        //     }
        // });
        // }));

        //绑定文件选择事件，一选择了图片，就让`form`提交。

        // $("#fileupload").on("change", function() {
        //     $(this).parent().submit();
        // });
        // $(function () {
        //     $("#file-1").fileinput({
        //         uploadUrl: '/admin/lesson/uploads', // you must set a valid URL here else you will get an error
        //         allowedFileExtensions : ['jpg', 'png','gif'],
        //         overwriteInitial: false,
        //         maxFileSize: 1000,
        //         maxFilesNum: 10,
        //         //allowedFileTypes: ['image', 'video', 'flash'],
        //         slugCallback: function(filename) {
        //             alert(filename)
        //         }
        //     });
        // })
    </script>

@endsection