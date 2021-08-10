@props(['stocks'])

<table class="table">
     <thead>
          <tr>
          <th scope="col">#</th>
          <th scope="col">code</th>
          <th scope="col">name</th>
          <th scope="col">market_id</th>
          <th scope="col">industry_id</th>
          </tr>
     </thead>
     <tbody>
          @foreach($stocks as $stock)
          <tr>
          <th scope="row" >{{$stock->id}}</th>
          <td>{{$stock->code}}</td>
          <td>{{$stock->name}}</td>
          <td>{{$stock->market_id}}</td>
          <td>{{$stock->industry_id}}</td>
          </tr>
          @endforeach
     </tbody>
</table>
