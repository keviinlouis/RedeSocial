@if(count($posts)>0)
    @foreach($posts as $post)
        <div class="panel panel-default" data-index="{{base64_encode($post->created_at->toDateTimeString())}}" >
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-11">
                        <p style="word-break: break-all">{{$post->user->name}}</p>
                    </div>
                    <div class="col-md-1 ">
                        @if($auth_id == $post->user->id)
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="material-icons " style="color: gray"> keyboard_arrow_down</i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li>
                                        <a href="#" class="removePost" data-index="{{base64_encode($post->id)}}">
                                            <i class="material-icons">delete</i> <span style="margin-top: 3px;margin-left: 3px;position: absolute;">Remover</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-9">
                        <p style="word-break:break-all ">{{$post->text}}</p>
                    </div>
                    <div class="col-md-3">
                        <p>{{$post->created_at->diffForHumans()}}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div data-index="last" class="alert alert-info">
        Ops, parece que não encontramos mais nenhum post, siga mais pessoas!
    </div>
@endif