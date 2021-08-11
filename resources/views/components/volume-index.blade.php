@props(['dailyvolumes'])

<table class="table">
     <thead>
          <tr>
          <th scope="col">#</th>
          <th scope="col">銘柄</th>
          <th scope="col">日付</th>
          <th scope="col">出来高</th>
          </tr>
     </thead>

     {{ $dailyvolumes->links() }}
     <tbody>
          @foreach($dailyvolumes as $dailyvolume)
          <tr>
          <th scope="row" >{{$dailyvolume->id}}</th>
          <td>{{$dailyvolume->stock->name}}</td>
          <td>{{$dailyvolume->date}}</td>
          <td>{{$dailyvolume->volume}}</td>
          </tr>
          @endforeach
     </tbody>
</table>
