@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/gototop.css">
    <link rel="stylesheet" href="css/datebtn.css">
    <link rel="stylesheet" href="css/picker/themes/default.css">
    <link rel="stylesheet" href="css/picker/themes/default.date.css">
    <div id="layout" class="pure-g">
        <input class="datepicker" type="text" hidden/>
        <div class="sidebar pure-u-1 pure-u-md-1-4">
            <div class="header">
                <h1 class="brand-title">南條愛乃の</h1>
                <h2 class="brand-tagline">ツイッターロボット</h2>

                <nav class="nav">
                    <ul class="nav-list">
                        <li class="nav-item">
                            <a class="pure-button" href="http://purecss.io">Pure</a>
                        </li>
                        <li class="nav-item">
                            <a class="pure-button" href="http://yuilibrary.com">YUI Library</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="content pure-u-1 pure-u-md-3-4">
            <div>
                <button style="background-color:#00d6fe;color:
                #FFFFFF;border: 0;border-radius: 60px;" onclick="openPicker()">选择日期
                </button>
                <p id="dateMsg">未选择日期...</p>
                <input id="count" type="hidden" style="display: none" value="0">
                <!-- A wrapper for all the blog posts -->
                <div id="posts" class="posts">
                    {{--@foreach($tweets as $tweet)
                        <h1 class="content-subhead">{{date("Y-m-d H:i:s",$tweet->origin_created_at)}}</h1>

                        <section class="post">
                            <header class="post-header">
                                <img width="48" height="48" alt="avatar" class="post-avatar" src="/img/n.jpg">
                                <h2 class="post-title">{{$tweet->id}}</h2>
                            </header>

                            <div class="post-description">
                                <p>
                                    {!! empty($tweet->html_content) ? $tweet->text : $tweet->html_content !!}
                                </p>
                            </div>
                            @if($tweet->trans_zh_author)
                                <div class="post-description">
                                    <p>
                                        {{$tweet->trans_zh}}
                                    </p>
                                    <label class="content-subhead">翻译自：{{$tweet->trans_zh_author}}</label>
                                </div>
                            @endif
                        </section>
                    @endforeach--}}
                </div>

                <div id="footer" class="footer">
                    <div class="pure-menu pure-menu-horizontal">
                        <ul>
                            <li class="pure-menu-item"><a href="https://www.cool2645.com/" class="pure-menu-link">2645
                                    Studio</a></li>
                            <li class="pure-menu-item"><a href="http://twitter.com/nanjolno/" class="pure-menu-link">Original
                                    Twitter</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <button class="datebtn" onclick="openPicker()">日期</button>
        <button class="gototop"><span>顶部↑</span></button>

    </div>
    <script src="js/jquery.gototop.min.js"></script>
    <script src="js/picker/picker.js"></script>
    <script src="js/picker/picker.date.js"></script>
    <script src="js/picker/translations/zh_CN.js"></script>
    <script src="js/autoloader.js"></script>
    <script>
        var oldDate = "";
        var newDate = "";
        $(function () {
            // $(".gototop").gototop();
            $(".gototop").gototop({
                position: 0,
                duration: 500,
                visibleAt: 300,
                classname: "isvisible"
            });
            var $input = $('.datepicker').pickadate({
                'format': 'yyyy-mm-dd',   //日期显示格式
                firstDay: 1 //星期一作为第一天
            });
            var picker = $input.pickadate('picker');
            picker.on({
                close: function () {
                    var dateMsg = $('#dateMsg');
                    if(picker.get('select', 'yyyy-mm-dd') != "")
                        dateMsg.html(picker.get('select', 'yyyy-mm-dd'));
                    else
                        dateMsg.html("未选择日期...");
                    newDate = dateMsg.html();
                    //console.log("old:" + oldDate + " new:" + newDate);
                    if(oldDate != newDate)
                    {
                        //Reload tweets
                        $('#posts').empty();
                        $('#count').val(0);
                        loadMore();
                    }
                    picker.close();
                }
            });
        });
        function openPicker() {
            var dateMsg = $('#dateMsg');
            oldDate = dateMsg.html();
            var picker = $('.datepicker').pickadate('picker');
            picker.open();
            // If a “click” is involved, prevent the event bubbling.
            event.stopPropagation();
        }

    </script>
@endsection
