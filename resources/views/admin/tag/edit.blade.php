@extends("admin.layout.master")
@section("content")
    <div class="span9">
        <h1>
            编辑标签
        </h1>
        {{--<ul class="files zebra-list">--}}
            {{--<li>--}}
                {{--<i class="icon-file"></i> <a class="title" href="#">List of Customer Emails</a> <span class="meta">Uploaded <em>2 days ago</em> by <em>John</em></span>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<i class="icon-file"></i> <a class="title" href="#">Weekly Stat Report</a> <span class="meta">Uploaded <em>5 days ago</em> by <em>John</em></span>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<i class="icon-file"></i> <a class="title" href="#">Company Newsletter - Jan 2012</a> <span class="meta">Uploaded <em>2 weeks ago</em> by <em>Jill</em></span>--}}
            {{--</li>--}}
        {{--</ul>--}}
        {{--<a class="toggle-link" href="#new-file"><i class="icon-plus"></i> New File</a>--}}
        <form  action="/admin/tag/{{$id}}" method="post" id="new-file" class="form-horizontal">
            <fieldset>
                {{--<legend>New File</legend>--}}
                <div class="control-group">
                    <label class="control-label" for="textarea">标签名称</label>
                    <div class="controls">
                        <input  type="text" name="title" class="input-xlarge" id="input01">
                    </div>
                </div>
                {{ method_field('PUT') }}
                {{csrf_field()}}
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">提交</button>
                    {{--<button class="btn">Cancel</button>--}}
                </div>
            </fieldset>
        </form>
    </div>
@endsection