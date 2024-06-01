<div>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f0f2f5;
        }
        .chat-area {
            margin-top: 20px;
        }
        .chatbox {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            height: 80vh;
            display: flex;
            flex-direction: column;
        }
        .msg-head {
            background: #ededed;
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .msg-head img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }
        .msg-body {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            background: #f0f2f5;
        }
        .msg-body ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .msg-body ul li {
            margin-bottom: 15px;
            display: flex;
        }
        .msg-body ul li.sender {
            justify-content: flex-start;
        }
        .msg-body ul li.sender p {
            background: #dcf8c6;
            color: #000;
            margin: 0;
            padding: 10px;
            border-radius: 7.5px;
            max-width: 70%;
        }
        .msg-body ul li.repaly {
            justify-content: flex-end;
        }
        .msg-body ul li.repaly p {
            background: #fff;
            margin: 0;
            padding: 10px;
            border-radius: 7.5px;
            max-width: 70%;
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
        }
        .send-box {
            padding: 10px;
            border-top: 1px solid #ddd;
            background: #ededed;
        }
        .send-box form {
            display: flex;
            align-items: center;
        }
        .send-box form input {
            flex: 1;
            border: none;
            padding: 10px;
            border-radius: 20px;
            margin-right: 10px;
            background: #fff;
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
        }
        .send-box form button {
            border: none;
            padding: 10px 15px;
            border-radius: 20px;
            background: #007bff;
            color: #fff;
        }
        .send-btns {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }
        .send-btns .attach {
            display: flex;
            align-items: center;
            position: relative;
        }
        .send-btns .attach .label {
            cursor: pointer;
            display: flex;
            align-items: center;
            background: #007bff;
            color: #fff;
            padding: 10px 15px;
            border-radius: 20px;
            margin-right: 10px;
        }
        .send-btns .attach input {
            display: none;
        }
    </style>

    <!-- Chat Area -->
    <section class="message-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="chat-area">
                        <!-- Chatbox -->
                        <div class="chatbox">
                            <div class="modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="msg-head">
                                        <div class="d-flex align-items-center">
                                            <div class="back-icon me-3">
                                                <img class="img-fluid" src="https://mehedihtml.com/chatbox/assets/img/arroleftt.svg" alt="Back">
                                            </div>
                                            <div class="user-info d-flex align-items-center">
                                                <img class="img-fluid" src="https://mehedihtml.com/chatbox/assets/img/user.png" alt="User">
                                                <div class="user-name ms-3">
                                                    <h6 class="mb-0">{{$user->name}}</h6>
                                                    <small class="text-muted">Online</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="{{route('dashboard')}}">Go Back</a></li>
                                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="msg-body">
                                            <ul>
                                                @foreach($messages as $message)
                                                @if($message['sender'] != auth()->user()->name)
                                                    <li class="sender">
                                                        <p>{{$message['message']}}</p>
                                                    </li>
                                                @else
                                                    <li class="repaly">
                                                        <p>{{$message['message']}}</p>
                                                    </li>
                                                @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="send-box">
                                        <form wire:submit="sendMessage()">
                                            <input type="text" wire:model="message" class="form-control" aria-label="message…" placeholder="Write message…">
                                            <button type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</button>
                                        </form>
                                        <div class="send-btns">
                                            <div class="attach">
                                                <label class="label" for="upload">
                                                    <img class="img-fluid" src="https://mehedihtml.com/chatbox/assets/img/upload.svg" alt="Attach"> Attach file 
                                                </label>
                                                <input type="file" name="upload" id="upload" class="upload-box" aria-label="Upload File">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Chatbox -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Chat Area -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</div>
