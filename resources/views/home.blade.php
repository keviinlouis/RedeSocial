@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Postar</div>
                <div class="panel-body">
                    {{Form::textarea('postText', null, ['id' => 'postText', 'class' => "form-control", "style" => "resize: none", "rows" => 3, "maxlength" => 140])}}
                    <div class="alert alert-danger small " style="margin-top: 10px; display:none" id="postError">Insira algum texto antes de postar</div>
                    <button class="btn btn-default pull-right" style="margin-top: 10px" id="post">Postar :)</button>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-10">
                            Que tal seguir esses?
                        </div>
                        <div class="col-md-2">
                            <i class="material-icons" id="reloadUsersToFollow" style="cursor: pointer; color: grey" >autorenew</i>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div id="usersToFollow">

                    </div>
                    <div id="loadingUsersToFollow" style="height: 100px" class="cssload-container">
                        <div class="cssload-whirlpool"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body" >
                    <div id="posts">

                    </div>
                    <div id="loading" style="height: 100px" class="cssload-container">
                        <div class="cssload-whirlpool"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection
