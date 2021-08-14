@props(['dailyvolumes', 'uniquedDates'])

<div class="container">
     <div class="row align-items-start">
          {{ $dailyvolumes->links() }}

          <div class="col-3">
               <ul>
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
                         <th scope="col">出来高</th>
                         </tr>
                    </thead>

                    <tbody>
                         @foreach($dailyvolumes as $dailyvolume)
                         <tr>
                         <th scope="row" >{{$dailyvolume->stock->code}}</th>
                         <td>{{$dailyvolume->stock->name}}</td>
                         <td>{{$dailyvolume->date}}</td>
                         <td>{{$dailyvolume->volume}}</td>
                         </tr>
                         @endforeach
                    </tbody>
               </table>
          </div>    <!-- col -->
     </div>    <!-- row -->
</div>    <!-- container -->