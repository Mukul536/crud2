@extends('layouts.header')
@section('css')
@endsection

@section('body')



    <div class="container">










        <form class="form-horizontal" action="{{ url('send') }}" method="POST" id="" role="form">
            {!! csrf_field() !!}
            <div class="card-body">

                <div class="form-group mb-3 ">

                 <div class="row">
                    <div class="col-md-3">
                        <label class="form-label"><b>Title</b></label>
                        <input type="text" class="form-control" name="Title" placeholder="Enter Title">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><b>User_Code</b></label>
                        <input type="text" class="form-control" name="user_code" id placeholder="Enter Title"
                            value={{ session()->get('user_array')[0]['user_code'] }}>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><b>Token</b></label>
                        <input type="text" id="getting_token" class='form-control' name="getting_token">
                    </div>


                    <div class="col-md-3">
                        <label class="form-label"> Message</label>
                        <input type="text" class="form-control" name="Message"
                            placeholder="Enter your Message to the user">
                    </div>
                    </div>

                </div>
                    
                        <div class="row">


                            <table class="table table-responsive table-bordered">
                                <th data-field="user" data-checkbox="true">Users</th>
                                <th data-field="checkbox" data-checkbox="true">Permission To Send</th>
                                <tbody>

                                    @if (!empty($user))
                                    
                                        @foreach ($user as  $value)
                                            <tr>
                                                
                                                <td>
                                                    {{ $value->user_code }}

                                                </td>
                                                <td>
                                                    <input type="checkbox" class="" name="TOKENS[]"
                                                        value={{ $value->device_token }}>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>


                            </table>

                        

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">Allow Notification</button>
                        </div>
                    </div>


                  



                </div>
            </div>


        </form>



    </div>
@endsection
@section('js')
    <script>
        function testing() {



            var user_code = $('input[name^="user_code"]').val();
            console.log(user_code);

            // $.ajax({
            //     type: "get",
            //     url: "storingToken",
            //     data: {
            //         token:"123",
            //         user_code:user_code,
            //     },
            //     dataType: "dataType",
            //     success: function (response) {

            //     }
            // });

        }
    </script>

    <script>
        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyBCZNzaWNDUF9N4n_chGtxbTyk6eqh7U90",
            authDomain: "baidyanath-b1200.firebaseapp.com",
            databaseURL: "https://baidyanath-b1200-default-rtdb.asia-southeast1.firebasedatabase.app",
            projectId: "baidyanath-b1200",
            storageBucket: "baidyanath-b1200.appspot.com",
            messagingSenderId: "971450823523",
            appId: "1:971450823523:web:34c616d7cccc78debb5956",
            measurementId: "G-Y5R83QEKES"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        //firebase.analytics();
        const messaging = firebase.messaging();
        messaging
            .requestPermission()
            .then(function() {
                //MsgElem.innerHTML = "Notification permission granted." 
                console.log("Notification permission granted.");

                // get the token in the form of promise


                return messaging.getToken()
            })
            .then(function(token) {
                // print the token on the HTML page     
                console.log(token);
                document.getElementById('getting_token').value = token;
                var user_code = $('input[name^="user_code"]').val();

                $.ajax({
                    type: "get",
                    url: "storingToken",
                    data: {
                        token: token,
                        user_code: user_code,

                    },

                    success: function(response) {
                        console.log(response);
                    }
                });




            })
            .catch(function(err) {
                console.log("Unable to get permission to notify.", err);
            });

        messaging.onMessage(function(payload) {
            console.log(payload);

            var notify;
            notify = new Notification(payload.notification.title, {
                body: payload.notification.body,
                icon: payload.notification.icon,
                tag: "Dummy"
            });
            console.log(payload.notification);
        });


        messaging.onTokenRefresh(function() {
            messaging.getToken()
                .then(function(newtoken) {
                    console.log("New Token:" + newtoken);


                })
                .catch(function(reason) {
                    console.log(reason);
                })
        })

        //firebase.initializeApp(config);
        var database = firebase.database().ref().child("/users/");

        database.on('value', function(snapshot) {
            renderUI(snapshot.val());
        });

        // On child added to db
        database.on('child_added', function(data) {
            console.log("Comming");
            if (Notification.permission !== 'default') {
                var notify;

                notify = new Notification('CodeWife - ' + data.val().username, {
                    'body': data.val().message,
                    'icon': 'bell.png',
                    'tag': data.getKey()
                });
                notify.onclick = function() {
                    alert(this.tag);
                }
            } else {
                alert('Please allow the notification first');
            }
        });

        self.addEventListener('notificationclick', function(event) {
            event.notification.close();
        });
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
@endsection
