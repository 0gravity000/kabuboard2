@props(['stocks','uniquedMarketIds','uniquedIndustryIds'])

<div class="container">
     <div class="row align-items-start">
          <div class="col-2">
               <ul>
                    <ul>市場</ul>
                    @foreach($uniquedMarketIds as $uniquedMarketId)
                    <li>
                         <a href="/dashboard/show/markets/{{$uniquedMarketId->id}}">
                              {{$uniquedMarketId->market->name}} 
                         </a>
                    </li>
                    @endforeach
                 
                    <ul>業種</ul>
                    @foreach($uniquedIndustryIds as $uniquedIndustryId)
                    <li>
                         <a href="/dashboard/show/industries/{{$uniquedIndustryId->id}}">
                              {{$uniquedIndustryId->industry->name}}
                         </a>
                    </li>
                    @endforeach
                </ul>

          </div>
          <div class="col">
               <table class="table">
                    <thead>
                         <tr>
                         <th scope="col">コード</th>
                         <th scope="col">銘柄</th>
                         <th scope="col">市場</th>
                         <th scope="col">業種</th>
                         </tr>
                    </thead>
                    <tbody>
                         @foreach($stocks as $stock)
                         <tr>
                         <td>{{$stock->code}}</td>
                         <td>{{$stock->name}}</td>
                         <td>{{$stock->market->name}}</td>
                         <td>{{$stock->industry->name}}</td>
                         </tr>
                         @endforeach
                    </tbody>
               </table>
          </div>
     </div>
 </div>
