<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px; position: fixed; right: 0; top: 0; bottom: 0; background-color:#b4b4b4bf">
    <ul class="sidebar" style="height: 100%; display: flex; flex-direction: column; justify-content: center; row-gap: 6rem; list-style: none; padding: 0">

      <li style=" text-align: center; padding: 10px;">
        <a href="{{route('user.messages.list')}}" class="nav-link link-dark">
          المحادتاث
        </a>
      </li>

      <li style=" text-align: center; padding: 10px;">
        <form action="{{route('logout')}}" method="post">
            @csrf
            <button type="submit">logout</button>
        </form>
        

    </ul>




  </div>


  <style>

    .sidebar li {
      transition: .3s;
    }

    .sidebar li:hover {
      border-radius: 10px;
    }
  </style>
