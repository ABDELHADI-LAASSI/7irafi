<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px; position: fixed; left: 0; top: 0; bottom: 0;">
    <ul class="sidebar" style="height: 100%; display: flex; flex-direction: column; justify-content: center; row-gap: 6rem; list-style: none; padding: 0">
      <li class="nav-item" style="background-color: white; text-align: center; padding: 10px;">
        <a href="{{route('user.show', $user->id)}}" class="nav-link active" aria-current="page">
          المعلومات الشخصية
        </a>
      </li>
      <li style="background-color: white; text-align: center; padding: 10px;">
        <a href="{{route('user.hirafiChat' , $user->id)}}" class="nav-link link-dark">
          المحادتاث
        </a>
      </li>
      <li style="background-color: white; text-align: center; padding: 10px;">
        <a href="{{route('user.workRequest' , $user->id)}}" class="nav-link link-dark">
          ارسال طلب عمل
        </a>
      </li>
      <li style="background-color: white; text-align: center; padding: 10px;">
        <a href="#" class="nav-link link-dark">
          الدفع
        </a>
      </li>
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
