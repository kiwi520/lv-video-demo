@if (count($errors) > 0)
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">友情提示:</h4>
            </div>
            <div class="modal-body">
                    {{--<div class="alert alert-danger">--}}
                        <ul style="color: red;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    {{--</div>--}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endif
<script type="text/javascript">
    // document.getElementById("myModal")[0].modal("show");
   $(function () {
       $('#myModal').modal("show");
       setTimeout(function () {
           $('#myModal').modal('hide')
       },3000);
   })
</script>