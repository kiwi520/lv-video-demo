@extends("admin.layout.master")
@section("content")
    <div class="span9">
        <h2>
            视频课程列表
        </h2>
        <table class="table table-bordered table-striped">
            <tr>
                <th>
                    Id
                </th>
                <th>
                    视频课程名称
                </th>
                <th>
                    视频数量
                </th>
                <th>
                    操作
                </th>
            </tr>
            @if($data)
                @foreach($data as $datum)
                    <tr>
                        <td>
                            {{$datum->id}}
                        </td>
                        <td>
                            {{$datum->title}}
                        </td>
                        <td>
                            {{$datum->videos()->count()}}
                        </td>
                        <td>
                            <a href="/admin/lesson/{{$datum['id']}}/edit" class="btn btn-primary">编辑</a>
                            <a href="javascript:; " onclick ='del({{$datum["id"]}})' class="btn btn-danger">删除</a>
                        </td>

                    </tr>
                @endforeach
            @else
                <h5>没有数据</h5>
            @endif
        </table>

        <!-- 信息删除确认 -->
        <div class="modal fade" id="delcfmModel">
            <div class="modal-dialog">
                <div class="modal-content message_align">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">提示信息</h4>
                    </div>
                    <div class="modal-body">
                        <p>您确认要删除吗？</p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="url"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <a  onclick="urlSubmit()" class="btn btn-success" data-dismiss="modal">确定</a>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

    <script>
        function del(url) {
            $('#url').val(url);//给会话中的隐藏属性URL赋值
            $('#delcfmModel').modal();
        }
        function urlSubmit(){
            var url=$.trim($("#url").val());//获取会话中的隐藏属性URL
            // alert(url)
            var tokens = '{{csrf_token()}}'
            // window.location.href=url;
            $.ajax({
                type: 'POST',
                url : "/admin/lesson/" + url,
                method : "DELETE",
                data:{_token:tokens},
                dataType:"json",
                success: function (resqonse ) {
                    if(resqonse.valid == 1){
                        alert(resqonse.message)
                    }
                }
            })
        }
    </script>
@endsection