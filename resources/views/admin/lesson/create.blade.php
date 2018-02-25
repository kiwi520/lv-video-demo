@extends("admin.layout.master")
@section("css")
    <link href="{{ asset('admin/css/fileinput.min.css') }}" rel="stylesheet">
@endsection
@section("content")
    <div class="span9">
        <h1>
            添加视频课程
        </h1>
        <form action="/admin/lesson"  method="post" id="myForm" enctype="multipart/form-data"  class="form-horizontal">
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="textarea">视频课程名称</label>
                    <div class="controls">
                        <input name="title" type="text" class="input-xlarge" id="input01">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="textarea">视频所属课程</label>
                    <div class="controls">
                        <select name="tag_id" class="selectpicker">
                            @foreach($tags as $v)
                                <option value ="{{$v["id"]}}">{{$v["title"]}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{csrf_field()}}
                <div class="control-group">
                    <label class="control-label" for="textarea">视频课程介绍</label>
                    <div class="controls">
                        <textarea name="introduce" class="input-xlarge" id="input01" rows="9"></textarea>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="textarea">预览图</label>
                    <div class="controls">
                            <input type="file" name="file" id="file_upload"/>
                            <br/>
                            <button type="button"  class="btn btn-success btn-image">上传图片</button>
                            <img id="dis-img" style="display: none;"alt="" />
                        <input type="hidden" name="preview" id="preview">
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
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">提交</button>
                    {{--<button class="btn">Cancel</button>--}}
                </div>
            </fieldset>
        </form>
    </div>
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

                        $("#dis-img").attr("src",responseStr.photo);
                        $("#dis-img").show();
                        $("#preview").attr("value",responseStr.origin);
                    },
                    error : function(responseStr) {
                        alert("失败:" + JSON.stringify(responseStr));//将    json对象    转成    json字符串。
                    }
                });
            })
        })
    </script>

@endsection