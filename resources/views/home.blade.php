@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Postar</h4></div>
                <div class="panel-body">
                    <post-new v-on:newpost="newPost"></post-new>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-10">
                            <h4>Que tal seguir esses?</h4>
                        </div>
                        <div class="col-md-2">
                            <h4><i class="material-icons" id="reloadUsersToFollow" style="cursor: pointer; color: grey" >autorenew</i></h4>
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
                <div class="panel-heading"><h4>Dashboard</h4></div>

                <div class="panel-body" >
                    <posts-list :posts="posts" :empty-posts="emptyPosts" :busy="busy" v-on:loadposts="loadPosts"></posts-list>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
