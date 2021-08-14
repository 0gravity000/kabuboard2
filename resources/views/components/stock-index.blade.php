@props(['stocks','sortedStocks','uniquedMarketIds','uniquedIndustryIds'])

<div class="container">
     <div class="row align-items-start">
          <div class="col-3">
               <ul>
                    <ul>市場</ul>
                    @foreach($uniquedMarketIds as $uniquedMarketId)
                    @php
                    $market_count = $stocks->where('market_id', $uniquedMarketId->market_id)->count();
                    @endphp
                    <li>
                         <a href="/dashboard/show/markets/{{$uniquedMarketId->id}}">
                              {{$uniquedMarketId->market->name}} 
                              ( {{$market_count}} )
                         </a>
                    </li>
                    @endforeach
                 
                    <ul>業種</ul>
                    @foreach($uniquedIndustryIds as $uniquedIndustryId)
                    @php
                    $industry_count = $stocks->where('industry_id', $uniquedIndustryId->industry_id)->count();
                    @endphp
                    <li>
                         <a href="/dashboard/show/industries/{{$uniquedIndustryId->id}}">
                              {{$uniquedIndustryId->industry->name}}
                              ( {{$industry_count}} )
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
                         @foreach($sortedStocks as $sortedStock)
                         <tr>
                         <td>{{$sortedStock->code}}</td>
                         <td>{{$sortedStock->name}}</td>
                         <td>{{$sortedStock->market->name}}</td>
                         <td>{{$sortedStock->industry->name}}</td>
                         </tr>
                         @endforeach
                    </tbody>
               </table>
          </div>
     </div>
 </div>
