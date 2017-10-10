@if(count($posts)>0)
    @foreach($posts as $post)
        <div class="panel panel-default">
            <div class="panel-heading">
                {{$post->user->name}}
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-10">
                        <p>{{$post->text}}</p>
                    </div>
                    <div class="col-md-2">
                        <p>{{$post->created_at->diffForHumans}}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    Ops, parece que não há nenhum post ainda, siga mais pessoas!
@endif