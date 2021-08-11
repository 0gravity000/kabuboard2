@props(['stocks'])

<table class="table">
     <thead>
          <tr>
          <th scope="col">#</th>
          <th scope="col">コード</th>
          <th scope="col">銘柄</th>
          <th scope="col">市場</th>
          <th scope="col">業種</th>
          </tr>
     </thead>
     <tbody>
          @foreach($stocks as $stock)
          <tr>
          <th scope="row" >{{$stock->id}}</th>
          <td>{{$stock->code}}</td>
          <td>{{$stock->name}}</td>
          <td>{{$stock->market->name}}</td>
          <td>{{$stock->industry->name}}</td>
          </tr>
          @endforeach
     </tbody>
</table>
