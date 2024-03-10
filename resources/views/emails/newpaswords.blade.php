<h2>Hi {{ $data['name'] }}</h2>
<br>
<img src="{{ url('front_them/assets/imgs/1.jpg') }}" alt="">
<img src="{{ url('front_them/assets/imgs/2.jpg') }}" alt="">
<br>
<strong>User details: </strong><br>
<strong>Name: </strong>{{ 'New password for - ' . $data['name'] }} <br>
<strong>Email: </strong>{{ $data['email'] }} <br>
<strong>Message: </strong>{{ $data['message'] }} <br><br>

Thank you

