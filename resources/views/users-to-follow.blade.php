@if(count($notFollowingUsers )>0)
  <ul class="list-group">
      @foreach($notFollowingUsers as $user)
          <li class="list-group-item">
              <div class="row" style="margin-top: 3px">
                  <div class="col-md-9">
                      <p style="word-break: break-all; ">
                        {{$user->name}}
                      </p>
                  </div>
                  <div class="col-md-2 followFromUsersToFollow" style="cursor: pointer" data-index="{{base64_encode($user->id)}}">
                      <i class="material-icons">add</i>
                  </div>
              </div>
          </li>
      @endforeach
  </ul>
  <script>
      $(document).ready(function(){
          $('.followFromUsersToFollow').click(function(){
                onFollow($(this));
          });
      })
  </script>
@else
    <p>Opa, parece que não tem mais usuários para seguir</p>
@endif