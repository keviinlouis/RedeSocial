@if(count($posts)>0)
    @foreach($posts as $post)
        <div class="panel panel-default" data-index="{{base64_encode($post->created_at->toDateTimeString())}}">
            <div class="panel-heading">
                {{$post->user->name}}
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-9">
                        <p>{{$post->text}}</p>
                    </div>
                    <div class="col-md-3">
                        <p>{{$post->created_at->diffForHumans()}}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div data-index="last">
        Ops, parece que não há nenhum post ainda, siga mais pessoas!
    </div>
@endif