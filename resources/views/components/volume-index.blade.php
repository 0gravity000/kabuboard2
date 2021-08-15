@props(['dailyvolumes', 'uniquedDates'])

<div class="container">
     <div class="row align-items-start">
          {{ $dailyvolumes->links() }}

          <div class="col-3">
               <form method="POST" action="/dailyvolume/show/code">
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