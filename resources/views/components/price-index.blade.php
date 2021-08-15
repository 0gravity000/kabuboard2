@props(['dailyprices', 'uniquedDates'])

<div class="container">
     <div class="row align-items-start">
          
          {{ $dailyprices->links() }}

          <div class="col-3">
               <form method="POST" action="/dailyprice/show/code">
                    @csrf
                    <div class="input-group rounded">
                         <input type="search" class="form-control rounded" placeholder="Search code" name="searchtext" />
                         <button type="submit">
                              <span class="input-group-text border-0" id="search-addon">
                                   <i class="bi bi-search"></i>
                              </span>
                         </button>
                    </div>
               </form>
               @if (session('flash_message'))
               <div class="flash_message alert alert-danger">
                   {{ session('flash_message') }}
               </div>
                @endif
     
               <ul class="mt-3">
                    <ul>日付</ul>
                    @foreach($uniquedDates as $uniquedDate)
                    <li>
                         {{$uniquedDate->date}}
                    </li>
                    @endforeach
               </ul>
          </div>    <!-- col -->
          <div class="col">
               <table class="table">
                    <thead>
                         <tr>
                         <th scope="col">コード</th>
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
                         <th scope="row" >{{$dailyprice->stock->code}}</th>
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
          </div>    <!-- col -->
     </div>    <!-- row -->
</div>    <!-- container -->