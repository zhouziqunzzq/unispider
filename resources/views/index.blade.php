@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/gototop.css">
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
                <a href="#" onclick="openPicker()">Select a date...</a>
                <p id="dateTest">No date selected...</p>
                <!-- A wrapper for all the blog posts -->
                <div class="posts">
                    @foreach($tweets as $tweet)
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
                    @endforeach

                </div>

                <div class="footer">
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
        <button class="gototop"><span>Top↑</span></button>
    </div>
    <script src="js/jquery.gototop.min.js"></script>
    <script src="js/picker/picker.js"></script>
    <script src="js/picker/picker.date.js"></script>
    <script src="js/picker/translations/zh_CN.js"></script>
    <script>
        $(function(){
            // $(".gototop").gototop();
            $(".gototop").gototop({
                position : 0,
                duration : 500,
                visibleAt : 300,
                classname : "isvisible"
            });
        });
        function openPicker() {
            var $input = $('.datepicker').pickadate();
            var picker = $input.pickadate('picker');
            picker.on({
                close: function() {
                    $('#dateTest').html(picker.get('select', 'yyyy/mm/dd'));
                    //console.log(picker.get('select', 'yyyy/mm/dd'))
                    picker.close();
                    //event.stopPropagation();
                }
            });
            picker.open();
            // If a “click” is involved, prevent the event bubbling.
            event.stopPropagation();
        }
        $('.datepicker').pickadate({
            'format':'yyyy-mm-dd',   //日期显示格式
            firstDay: 1 //星期一作为第一天
        });
        $(document).ready(function () {
            //
        })
    </script>
@endsection
