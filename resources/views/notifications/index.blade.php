@extends('layouts.master')

@section('css')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/notifications/style.css') }}">



<style>
    .attribution {
        font-size: 11px;
        text-align: center;
    }

    .attribution a {
        color: hsl(228, 45%, 44%);
    }

</style>
@endsection


@section('content')
<!-- row -->
<div class="row" style="margin-top: -57px ;flex-direction: column;">

    <div class="container notifications-container shadow sizem " id="notif" style="width: 54%;margin-bottom: 14px;">
        <div class="buttons-invoice">
            <span class="active" onclick="Choice(1)">الكل</span>
            <span onclick="Choice(2)">اشعاراتي</span>
            <span onclick="Choice(3)">هامة</span>
        </div>
    </div>


    <div class="container notifications-container shadow mb-5 sizem" id="notif" style="width: 54%">

        <div class="row header" style=" display: flex; width: 100%; align-items: center; gap: -18px; justify-content: space-between;">
            <div style="width: fit-content;">
                <span class="title">
                    الإشعارات :
                    <span style="color: dodgerblue">{{ Auth::User()->notifications()->count() }}</span>
                </span>
            </div>
            <div class="mark-as-read text-end" style="width: fit-content; position: relative; left: 27px;">
                <a href=" {{ route('notifications.readAll') }} " type="button" class="btn btn-success mt-1 mb-1 rounded-pill">
                    وضع علامة على الكل كمقروء
                </a>
            </div>
        </div>


        <div class="row notifications">
            <div class="col-12">

                @foreach(Auth::User()->notifications as $notification)

                @php
                $invDate = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $notification->data['date_invoice']);
                $now = Carbon\Carbon::now();
                $diff = $now->diff($invDate);

                if ($diff->days > 0) {
                $formattedDiff = $diff->format('%a يوم');
                } elseif ($diff->h > 0) {
                $formattedDiff = $diff->format('%h ساعة');
                } elseif ($diff->i > 0) {
                $formattedDiff = $diff->format('%i دقيقة');
                } else {
                $formattedDiff = 'الآن';
                }
                @endphp


                <div style="display: flex">
                    <a href=" {{ route("notifications.show",$notification->data["invoiceId"]) }} " class="row single-notification-box unread notiflink" @if ($notification->read_at == '')
                        style=" background-color : #d7e9fb; flex-grow: 1;"
                        @else
                        style="flex-grow: 1;"
                        @endif >
                        <div class="col-2 profile-picture mt-3">
                            @if ($notification->read_at == '')
                            <span class="pulse" style="position: initial;"></span>
                            @endif
                            <img src=" {{ asset('myImages/avatar.png') }} " alt="صورة الملف الشخصي" class="img-fluid rounded-circle shadow" style="    outline: 7px solid white;transform: translateX(-11px)">
                        </div>

                        <div class="col-9 notification-text">
                            <p>
                                <p class="link name">{{$notification->data['name']}}</p>
                                <span class="description">
                                    فقط قم بالنشر
                                </span>
                                <span> انشاء فاتورة
                                    {{ $notification->data['invoiceName'] }}
                                </span>
                            </p>
                            <p class="time"> مند حوالي {{ $formattedDiff }} </p>
                        </div>
                    </a>

                    <div @if ($notification->read_at == '')
                        style=" background-color : #d7e9fb;cursor: pointer; height: 0;
                        width: 0;"

                        @else
                        style="cursor: pointer ; height: 0;
                        width: 0;"

                        @endif >

                        <form action="{{ route('notifications.destroy', $notification->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="border: none; background: none; padding: 0;">
                                <i class="fa-solid fa-trash special" style=" font-size: 19px; color: #a1b0d1; transform: translate(16px, 20px);"></i>
                            </button>
                        </form>
                    </div>
                </div>

                @endforeach

            </div>
        </div>
    </div>

</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection


@section('js')
<script src="{{ asset('script/notifications/main.js') }}" defer></script>



@endsection
