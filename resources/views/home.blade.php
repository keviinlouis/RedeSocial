@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            
            <post-new v-on:newpost="newPost"></post-new>
                
            <sugested-users 
                v-on:refresh="refreshSugestedUsers" 
                v-on:follow="follow"
                :sugested-users="sugestedUsers" 
                :busy="busy.sugestedUsers"></sugested-users>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Dashboard</h4></div>

                <div class="panel-body" >
                    <posts-list 
                        :posts="posts" 
                        :empty-posts="emptyPosts" 
                        :busy="busy.posts" 
                        :user-session="userSession"
                        v-on:loadposts="loadPosts"
                        v-on:removepost="removePost"></posts-list>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
