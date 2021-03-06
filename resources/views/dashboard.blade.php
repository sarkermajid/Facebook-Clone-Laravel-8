@extends('layouts.main')

@section('center')
    <div class="col-sm-6">
        <div class="post col-sm-12" id="new_post">
            <div class="row post-heading" style="background: #2d9a40;">
                <div class="col-sm-12">
                    <h4 id="post-header">Create New Post</h4><br/>
                </div>
            </div>
            <div class="row" style="padding: 10px;">
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <textarea name="status" placeholder="Whats up?" maxlength="250"></textarea>
                        @if ($errors->has('status'))
                            <div class="alert alert-danger">
                                {{ $errors->first('status') }}
                            </div>                            
                        @endif
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="pull-left">
                            <label class="btn btn-success"><input name="image" type="file" style="display: none;"/>Add Image</label>
                            @if ($errors->has('image'))
                            <div class="alert alert-danger">
                                {{ $errors->first('image') }}
                            </div>                            
                        @endif
                        </div>
                        <div class="pull-right">
                            <button class="btn btn-primary">POST</button>
                        </div>
                    </div>
                    <br>
                </form>
            </div>
        </div>

        @foreach ($posts as $post)
        <div class="post col-sm-12" id="post_1">
            <div class="row post-heading">
                <div class="col-sm-12">
                    <a href="profile.html">
                        <img src="assets/imgs/2.jpg" class="profile-picture pull-left"/>
                        &nbsp;
                        <span class="post-user-name">{{ $post['user']->fname.' '.$post['user']->lname}}</span><br/>
                        &nbsp;
                        <small class="post-date text-mute">{{ $post['created_at'] }}</small>
                    </a>
                </div>
            </div>
            <div class="row post-body">
                <div class="col-sm-12">
                   {{ $post['status'] }} 
                </div>
                <div class="col-sm-12">
                    <img src="{{ $post['photo'] }}" class="img-thumbnail" width="50%">
                </div>
            </div>
            <div class="row post-action">
                <ul class="post-action-menu">
                    <li><a href="javascript:void(0);" class="text-mute" onclick="like(1);">Like</a></li>
                    <li><a href="javascript:void(0);" class="text-mute" onclick="comment(1);">Comment</a></li>
                    <li><a href="javascript:void(0);" class="text-mute" onclick="share(1);">Share</a></li>
                    <li class="pull-right"><a href="#" class="text-mute"><span id="post_like_count_1">{{ $post['likes'] }}</span> Likes</a></li>
                    <li class="pull-right"><a href="#" class="text-mute"><span id="post_comment_count_1">{{ $post['comments'] }}</span> Comments</a></li>
                    <li class="pull-right"><a href="#" class="text-mute"><span id="post_share_count_1">{{ $post['shares'] }}</span> Shares</a></li>
                </ul>
            </div>
        </div>
        @endforeach
    </div>
@endsection

@push('scripts')

<script type="text/javascript">
    function like(id){
        var elem = document.getElementById("post_like_count_"+id);
        var count = parseInt(elem.innerHTML);
        elem.innerHTML = count+1;
        highlight(elem);
    }
    function share(id){
        var elem = document.getElementById("post_share_count_"+id);
        var count = parseInt(elem.innerHTML);
        elem.innerHTML = count+1;
        highlight(elem);
    }
    function comment(id){
        var elem = document.getElementById("post_comment_count_"+id);
        var count = parseInt(elem.innerHTML);
        elem.innerHTML = count+1;
        highlight(elem);
    }
    function highlight(elem){
        elem.style.color = "red";
        elem.parentElement.parentElement.style.transform="scale(1.5)";
        setTimeout(function(){
            elem.style.color="";
            elem.parentElement.parentElement.style.transform="scale(1)";
        },300);
    }
</script>

@endpush