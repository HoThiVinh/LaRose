<section class="navbar main-menu">
  <div class="navbar-inner main-menu">                
    <a href="./" class="logo pull-left"><img src="img/logo.png" class="site_logo" alt=""></a>
    <nav id="menu" class="pull-left" style="padding-left: 175px;">
      <ul>
        @foreach($category as $cate)
        @if($cate->parent_id == 0)
        <li><a class=""  href="category/{{$cate->id}}/{{$cate->name}}">{{$cate->name}}</a>         
          <ul>
            @foreach($category as $ca2)
            @if($cate->id == $ca2->parent_id)
            <li><a href="category/{{$ca2->id}}/{{$ca2->name}}">{{$ca2->name}}</a>
              @endif
              @endforeach
            </li>
          </ul>
        </li>
        @endif()
        @endforeach
      </ul>
    </nav>
  </div>
</section>