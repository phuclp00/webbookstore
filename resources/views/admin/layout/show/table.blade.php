<tbody>
   @foreach($result as $data =>$user)
   <tr id="show_user_list">
      <td class="text-center"><img class="rounded img-fluid avatar-40"
            src="../images/users/{{$user->user_id}}/{{$user->img}}" alt="profile"></td>
      <td>{{$user->user_name}}</td>
      <td>{{$user->full_name}}</td>
      {{-- <td>{{$user->email}}</td> --}}
      <td><a href="https://iqonic.design/cdn-cgi/l/email-protection" class="__cf_email__"
            data-cfemail="{{$user->email}}">[email&#160;protected]</a>
      </td>
      <td>{{$user->street."  ".$user->district."  ".$user->city}}</td>
      <td>{{$user->phone}}</td>
      @if($user->level=="admin")
      <td><span class="badge iq-bg-warning">{{$user->level}}</span></td>
      @else
      <td><span class="badge iq-bg-info">{{$user->level}}</span></td>
      @endif
      @if($user->status=="ban")
      <td><span class="badge iq-bg-danger">{{$user->status}}</span></td>
      @else
      <td><span class="badge iq-bg-primary">{{$user->status}}</span></td>
      @endif
      <td>{{$user->created}}</td>
      <td>
         <div class="flex align-items-center list-user-action option">
            <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add"
               href="#"><i class="ri-user-add-line"></i></a>
            <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
               href="#"><i class="ri-pencil-line"></i></a>
            <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
               href="{{route('admin.users.delete',[$user->user_name])}}"><i class="ri-delete-bin-line"></i></a>
         </div>
      </td>
   </tr>
   @endforeach
</tbody>