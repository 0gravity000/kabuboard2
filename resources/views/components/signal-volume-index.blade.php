@props(['signalvolumes'])

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
                         @foreach($signalvolumes as $signalvolume)
                         <tr>
                         <td>{{$signalvolume->daily_volume->stock->code}}</td>
                         <td>{{$signalvolume->daily_volume->stock->name}}</td>
                         <td>{{$signalvolume->daily_volume->date}}</td>
                         <td>{{$signalvolume->daily_volume->volume}}</td>
                         </tr>
                         @endforeach
                    </tbody>
               </table>
          </div>    <!-- col -->
     </div>    <!-- row -->
</div>    <!-- container -->