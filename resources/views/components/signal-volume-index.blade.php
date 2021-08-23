@props(['dailyvolumes'])

<div class="container">
     <div class="row align-items-start">
          <div class="col-3">
     
          </div>    <!-- col -->
          <div class="col">
               <table class="table">
                    <thead>
                         <tr>
                         <th scope="col">コード</th>
                         <th scope="col">銘柄</th>
                         <th scope="col">日付</th>
                         <th scope="col">現在値</th>
                         </tr>
                    </thead>

                    <tbody>
                         @foreach($dailyvolumes as $dailyvolume)
                         <tr>
                         <td>{{$dailyvolume->stock->code}}</td>
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