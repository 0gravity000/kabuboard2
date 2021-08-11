@props(['dailyprices'])

<table class="table">
     <thead>
          <tr>
          <th scope="col">#</th>
          <th scope="col">銘柄</th>
          <th scope="col">日付</th>
          <th scope="col">現在値</th>
          <th scope="col">前日終値</th>
          <th scope="col">始値</th>
          <th scope="col">終値</th>
          <th scope="col">高値</th>
          <th scope="col">安値</th>
          </tr>
     </thead>
     <tbody>
          @foreach($dailyprices as $dailyprice)
          <tr>
          <th scope="row" >{{$dailyprice->id}}</th>
          <td>{{$dailyprice->stock->name}}</td>
          <td>{{$dailyprice->date}}</td>
          <td>{{$dailyprice->price}}</td>
          <td>{{$dailyprice->pre_end_price}}</td>
          <td>{{$dailyprice->start_price}}</td>
          <td>{{$dailyprice->end_price}}</td>
          <td>{{$dailyprice->highest_price}}</td>
          <td>{{$dailyprice->lowest_price}}</td>
          </tr>
          @endforeach
     </tbody>
</table>
